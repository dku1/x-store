<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
        $id = is_null($this->product) ? '' : $this->product->id;
        $required = $this->path() == 'admin/products' ? '|required' : '';
        return [
            'title_ru' => 'required|min:3|max:255|string|unique:categories,title_ru,' . $id,
            'title_en' => 'required|min:3|max:255|string|unique:categories,title_en,' . $id,
            'price' => 'required|numeric',
            'old_price' => 'nullable|numeric',
            'count' => 'required|numeric',
            'category_id' => 'nullable|exists:categories,id',
            'value_ids' => 'nullable|array',
            'value_ids.*' => 'nullable|integer|exists:values,id',
            'description' => 'required',
            'image' => 'image:jpg,jpeg,png' . $required,
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

            'price.required' => 'Добавьте цену',
            'price.numeric' => 'Цена не соответствует формату',
            'old_price.numeric' => 'Старая цена не соответствует формату',

            'count.required' => 'Укажите кол-во товара',
            'count.numeric' => 'Кол-во товара - число',

            'category_id.exists' => 'Категории не существует',
            'description.required' => 'Добавьте описание',

            'image.required' => 'Добавьте изображение',
            'image.image' => 'Изображение не соответствует формату',
        ];
    }
}
