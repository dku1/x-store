<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|email',
            'city' => 'required|string',
            'address' => 'required|string',
            'index' => 'required|string|size:6',
        ];
    }

    public function messages()
    {
        return [
            'first_name.required' => 'Введите имя',
            'last_name.required' => 'Введите фамилию',
            'email.required' => 'Введите email',
            'email.email' => 'Email не соответствует формату',
            'city.required' => 'Введите город',
            'address.required' => 'Введите адрес',
            'index.required' => 'Введите индекс',
            'index.size' => 'Индекс состоит из 6 символов',
        ];
    }
}
