<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreReviewRequest;
use App\Http\Requests\UpdateReviewRequest;
use App\Models\Review;
use App\Models\Restaurant;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // GET /restaurants/{restaurant}/reviews
    public function index(Restaurant $restaurant)
    {
        return response()->json($restaurant->reviews()->with('user')->get());
    }

    /**
     * Store a newly created resource in storage.
     */
     
    public function store(StoreReviewRequest $request, Restaurant $restaurant)
    {
           $review = $restaurant->reviews()->create([
            'user_id' => $request->user()->id,
            ...$request->validated(),
        ]);

        return response()->json($review, 201);
    }

    /**
     * Display the specified resource.
     */
    // GET /restaurants/{restaurant}/reviews/{review}
    public function show(Restaurant $restaurant, Review $review)
    {
        return response()->json($review->load('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateReviewRequest $request, Restaurant $restaurant, Review  $review)
    {
        $this->authorize('update', $review);      // en ReviewPolicy
        $review->update($request->validated());

        return response()->json($review);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Restaurant $restaurant, Review  $review)
    {
        $this->authorize('delete', $review);      // en ReviewPolicy
        $review->delete();

        return response()->json(null, 204);
    }
}
