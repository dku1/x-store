<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CurrencyRequest extends FormRequest
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
        $id = is_null($this->currency) ? '' : $this->currency->id;
        return [
            'code' => 'required|string|size:3|unique:currencies,code,' . $id,
            'symbol' => 'required|string|size:1|unique:currencies,symbol,' . $id,
        ];
    }


    public function messages()
    {
        return [
            'code.required' => 'Введите код валюты',
            'code.size' => 'Код состоит из 3 символов',
            'code.unique' => 'Код должен быть уникален',

            'symbol.required' => 'Введите символ',
            'symbol.size' => 'Один символ',
            'symbol.unique' => 'Символ должен быть уникальным',
        ];
    }
}
