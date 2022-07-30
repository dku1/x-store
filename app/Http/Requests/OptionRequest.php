<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OptionRequest extends FormRequest
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
        $id = is_null($this->option) ? '' : $this->option->id;
        return [
            'title_ru' => 'required|min:3|max:255|string|unique:options,title_ru,' . $id,
            'title_en' => 'required|min:3|max:255|string|unique:options,title_en,' . $id,
        ];
    }

    public function messages()
    {
        return [
            'title_ru.required' => 'Введите название ru',
            'title_ru.min' => 'Минимум 3 символа',
            'title_ru.max' => 'Максимум 255 символов',
            'title_ru.unique' => 'Название должно быть уникальным',

            'title_en.required' => 'Введите название en',
            'title_en.min' => 'Минимум 3 символа',
            'title_en.max' => 'Максимум 255 символов',
            'title_en.unique' => 'Название должно быть уникальным',
        ];
    }
}
