<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddProductRequest extends FormRequest
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
            'name' => 'required|max:20|unique:products,name,'. $this->productId,
            'price' => 'required',
            'quantity' => 'required',
            'description' => 'required|max:255',
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg,webp|max:2048'
        ];
    }
}
