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

        $rules = [
            'name' => 'required|string|max:255,min:2',
            'description' => 'required|string|max:255,min:2',
            'short_description' => 'nullable|string|max:255,min:2',
            'shipping' => 'nullable|string|max:255,min:2',
            'size' => 'nullable|array',
            'size.*' => 'nullable|string|max:10',
            'quantity' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0',
            'discount_price' => 'nullable|numeric|lt:price',
            'is_featured' => 'string',
            'is_trending' => 'string',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'required|exists:brands,id',
            'color_id' => 'nullable|array',
            'color_id.*' => 'exists:colors,id',
        ];
        if ($this->route()->getActionMethod() === 'store') {
            $rules['imagepath.*'] =  'nullable';
        };
        return $rules;
    }
}
