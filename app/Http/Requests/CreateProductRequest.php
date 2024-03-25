<?php

namespace App\Http\Requests;

use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;

class CreateProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'short_description' => 'required|string',
            'long_description' => 'required|string',
            'is_simple' => 'required|boolean',
            'main_picture_url' => 'nullable|required|string',
            'is_active' => 'required|boolean',
            'slug' => 'required|string|max:255'
        ];
    }
}
