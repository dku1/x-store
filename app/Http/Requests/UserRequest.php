<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'first_name' => 'required|string|min:3|max:255',
            'last_name' => 'required|string|min:3|max:255',
            'email' => 'required|string|email|unique:users,email',
            'role_ids' => 'nullable|array',
            'role_ids.*' => 'nullable|integer|exists:roles,id',
        ];
    }

    public function messages()
    {
        return [
            'first_name.required' => 'Введите имя',
            'first_name.string' => 'Имя не соответствует формату',
            'first_name.min' => 'Имя минимум 3 символа',
            'first_name.max' => 'Имя максимум 255 символов',

            'last_name.required' => 'Введите фамилию',
            'last_name.string' => 'Фамилия не соответствует формату',
            'last_name.min' => 'Фамилия минимум 3 символа',
            'last_name.max' => 'Фамилия максимум 255 символов',

            'email.required' => 'Введите email',
            'email.email' => 'Email не соответствует формату',
            'email.unique' => 'Email не уникален',
        ];
    }
}
