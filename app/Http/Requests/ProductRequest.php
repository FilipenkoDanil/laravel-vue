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
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|min:3',
            'description' => 'required|min: 2',
            'price' => 'required|numeric',
            'img' => 'required|url',
            'category_id' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Поле Название обязательно для заполнения.',
            'title.min' => 'Количество символов в поле Название должно быть не меньше :min.',
            'price.required' => 'Поле Цена обязательно для заполнения.',
            'price.numeric' => 'Поле Цена должно быть числом.',
            'img.required' => 'Поле Изображение обязательно для заполнения.',
            'img.url' => 'Поле Изображение имеет ошибочный формат URL.',
            'category_id.required' => 'Поле Категория обязательно для заполнения.',
        ];
    }
}
