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
            // Ensure size is an array
            'size' => 'required|array', // Validate size as an array
            'size.*' => 'string|max:10',
            'quantity' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
            'discount_price' => 'nullable|numeric|min:0|lt:price',
            'status' => 'string',
            'category_id' => 'required|exists:categories,id',
            'color_id' => 'required|array',
            'color_id.*' => 'exists:colors,id',
        ];
        if ($this->route()->getActionMethod() === 'store') {
            $rules['imagepath.*'] =  'nullable';
        };
        return $rules;
    }
}
