<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:50'],
            'price' => ['required', 'numeric', 'min:0'],
            'description' => ['nullable', 'string', 'max:1000'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Ürün adı zorunludur.',
            'name.max' => 'Ürün adı en fazla 50 karakter olabilir.',
            'price.required' => 'Fiyat zorunludur.',
            'price.numeric' => 'Fiyat sayısal bir değer olmalıdır.',
            'price.min' => 'Fiyat 0\'dan küçük olamaz.',
            'description.max' => 'Açıklama en fazla 1000 karakter olabilir.',
        ];
    }
}
