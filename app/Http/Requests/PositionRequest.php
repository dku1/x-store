<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PositionRequest extends FormRequest
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
        $required = $this->path() == 'admin/products' ? '|required' : '';
        return [
            'product_id' => 'required|string|exists:products,id',
            'price' => 'required|numeric',
            'old_price' => 'nullable|numeric',
            'count' => 'required|integer',
            'image' => 'image:jpg,jpeg,png' . $required,
        ];
    }

    public function messages()
    {
        return [
            'price.required' => 'Укажите цену',
            'price.numeric' => 'Неверный формат',
            'old_price.numeric' => 'Неверный формат',
            'count.required' => 'Укажите количество',
            'count.integer' => 'Неверный формат',
            'image.required' => 'Добавьте изображение',
            'image.image' => 'Изображение не соответствует формату',
        ];
    }
}
