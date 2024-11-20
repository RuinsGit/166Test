<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Kullanıcı giriş yapmışsa izin ver
    }

    public function rules(): array
    {
        return [
            'products' => ['required', 'array', 'min:1'],
            'products.*.id' => ['required', 'exists:products,id'],
            'products.*.quantity' => ['required', 'integer', 'min:1', 'max:100'],
        ];
    }

    public function messages(): array
    {
        return [
            'products.required' => 'En az bir ürün seçmelisiniz.',
            'products.array' => 'Geçersiz ürün formatı.',
            'products.min' => 'En az bir ürün seçmelisiniz.',
            'products.*.id.required' => 'Ürün ID\'si gereklidir.',
            'products.*.id.exists' => 'Seçilen ürün bulunamadı.',
            'products.*.quantity.required' => 'Ürün miktarı gereklidir.',
            'products.*.quantity.integer' => 'Ürün miktarı tam sayı olmalıdır.',
            'products.*.quantity.min' => 'Ürün miktarı en az 1 olmalıdır.',
            'products.*.quantity.max' => 'Bir üründen en fazla 100 adet sipariş verebilirsiniz.',
        ];
    }
}
