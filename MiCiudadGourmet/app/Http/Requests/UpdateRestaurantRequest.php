<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRestaurantRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Asume que tu ruta usa el {restaurant} model binding
        $restaurant = $this->route('restaurant');

        // Esto llama a RestaurantPolicy::update($user, $restaurant)
        return $this->user()->can('update', $this->route('restaurant'));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
             'name'       => 'sometimes|required|string|max:100',
             'address'    => 'sometimes|required|string|max:255',
             'phone'      => 'sometimes|nullable|string|max:20',
             'categories' => 'sometimes|array',
             'categories.*' => 'integer|exists:categories,id',
        ];
    }
}
