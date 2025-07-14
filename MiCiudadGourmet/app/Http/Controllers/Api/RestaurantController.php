<?php

namespace App\Http\Controllers\Api;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRestaurantRequest;
use App\Http\Requests\UpdateRestaurantRequest;
use App\Models\Restaurant;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class RestaurantController extends Controller
{
    use AuthorizesRequests;

    /**
     * Display a listing of restaurants (public endpoint).
     * GET /api/restaurants
     */
    public function index(): JsonResponse
    {
        // Eager‑load relationships to prevent N+1 queries
        $restaurants = Restaurant::with(['categories', 'user'])
            ->withCount('reviews')
            ->paginate(10);

        return response()->json($restaurants);
    }

    /**
     * Store a newly created restaurant (protected route).
     * POST /api/restaurants
     */
    public function store(StoreRestaurantRequest $request): JsonResponse
    {
        // FormRequest handles validation; user() is provided by Sanctum middleware
        $data = $request->validated();
        $data['user_id'] = $request->user()->id;

        // Wrap in transaction in case future logic touches multiple tables
        $restaurant = DB::transaction(function () use ($data, $request) {
            $restaurant = Restaurant::create($data);

            // Attach categories if provided: categories=[1,2,3]
            if ($request->filled('categories')) {
                $restaurant->categories()->sync($request->input('categories'));
            }

            return $restaurant->load('categories', 'user');
        });

        return response()->json($restaurant, Response::HTTP_CREATED);
    }

    /**
     * Display the specified restaurant (public endpoint).
     * GET /api/restaurants/{id}
     */
    public function show(Restaurant $restaurant): JsonResponse
    {
            // 1) Cargamos relaciones y 2) añadimos el contador en una misma “cadena”
    $restaurant
        ->load([
            'categories',
            'user',
            'reviews.user',
            // Para limitar columnas en la relación hay que usar un closure:
            'favoritedBy' => fn ($q) => $q->select('users.id'),
        ])
        ->loadCount('favoritedBy');   // nº de usuarios que lo marcaron
        return response()->json($restaurant);
    }

    /**
     * Update the specified restaurant (protected + policy).
     * PUT/PATCH /api/restaurants/{id}
     */
    public function update(UpdateRestaurantRequest $request, Restaurant $restaurant): JsonResponse
    {
        // Lanza 403 si no es el dueño
        $this->authorize('update', $restaurant); 

        $data = $request->validated();
        $restaurant->update($data);

        if ($request->filled('categories')) {
            $restaurant->categories()->sync($request->input('categories'));
        }

        return response()->json($restaurant->fresh(['categories', 'user']));
    }

    /**
     * Remove the specified restaurant (protected + policy).
     * DELETE /api/restaurants/{id}
     */
    public function destroy(Restaurant $restaurant): JsonResponse
    {
        $this->authorize('delete', $restaurant);

        try {
            $restaurant->delete();
            return response()->json(null, Response::HTTP_NO_CONTENT);
        } catch (\Throwable $e) {
            Log::error('Failed to delete restaurant', ['id' => $restaurant->id, 'error' => $e->getMessage()]);
            return response()->json([
                'message' => 'Could not delete restaurant.'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }


    public function favorite(Restaurant $restaurant): JsonResponse
    {
        $restaurant->favoritedBy()->syncWithoutDetaching([auth()->id()]);
        // Opcional: devuelve el nuevo contador
        return response()->json(['favorited_by_count' => $restaurant->favorited_by_count + 1], 204);
    }

    public function unfavorite(Restaurant $restaurant): JsonResponse
    {
        $restaurant->favoritedBy()->detach(auth()->id());
        return response()->json(null, 204);
    }

}
