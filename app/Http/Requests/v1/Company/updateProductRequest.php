<?php

namespace App\Http\Requests\v1\Company;

use Illuminate\Foundation\Http\FormRequest;

class updateProductRequest extends FormRequest
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
            'name' => 'required|string|unique:products,name',
            'vendor_code' => 'required|string',
            'categories_id' => 'array',
            'categories_id.*' => 'exists:categories,id',
            'brand_id' => 'integer|exists:brands,id',
        ];
    }
}
