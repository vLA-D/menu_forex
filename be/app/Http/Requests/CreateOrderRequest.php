<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class CreateOrderRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'purchased_currency_id' => 'required|exists:currencies,id',
            'amount'                => 'required|numeric|min:1',
            'email'                 => 'required|email',
        ];
    }
}
