<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CouponRequest extends FormRequest
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
            'code' => 'required|string|min:6|max:8|unique:coupons,code',
            'value' => 'required|numeric|min:1',
            'type' => 'required',
            'currency_id' => 'nullable|integer|exists:currencies,id',
            'end_date' => 'required',
            'disposable' => 'nullable',
        ];
    }

    public function messages()
    {
        return [
            'code.required' => 'Код обязателен',
            'code.unique' => 'Код должен быть уникальным',
            'code.min' => 'Код минимум 6 символов',
            'code.max' => 'Код максимум 8 символов',
            'value.required' => 'Номинал обязателен',
            'value.numeric' => 'Номинал не соответствует формату',
            'type.required' => 'Выберите тип купона',
            'currency_id.integer' => 'Неверный формат валюты',
            'currency_id.exists' => 'Валюты не существует',
            'end_date.required' => 'Выберите дату',
        ];

    }
}
