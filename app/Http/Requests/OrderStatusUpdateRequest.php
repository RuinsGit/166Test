<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class OrderStatusUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->can('update', $this->order);
    }

    public function rules(): array
    {
        return [
            'status' => [
                'required',
                Rule::in(['pending', 'approved', 'canceled']),
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'status.required' => 'Sipariş durumu zorunludur.',
            'status.in' => 'Geçersiz sipariş durumu.',
        ];
    }
}
