<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|max:20',
            'price' => 'required',
            'quantity' => 'required',
            'description' => 'required|max:255',
            'image' => 'image|mimes:jpg,png,jpeg,gif,svg,webp|max:2048',
            'productId' => 'required|exists:products,id'
        ];
    }
}
