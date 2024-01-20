<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'category' => 'required|exists:secondary_categories,id', 
            'shop' => 'required|exists:shops,id',
            'name' => 'required|string|max:50',
            'information' => 'required|string|max:1000',
            'price' => 'required|integer',
            'quantity' => 'required|integer|between:0,500',
            'sort_order' => 'integer|nullable',
            'image1' => 'nullable|exists:images,id',
            'image2' => 'nullable|exists:images,id',
            'image3' => 'nullable|exists:images,id',
            'image4' => 'nullable|exists:images,id',
            'is_selling' => 'required|integer|boolean',
        ];
    }
}
