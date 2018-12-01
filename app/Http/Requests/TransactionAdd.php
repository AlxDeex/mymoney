<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TransactionAdd extends FormRequest
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
            'type' => 'numeric',
            'category' => 'numeric',
            'date' => 'date',
            'sum' => 'required|numeric',
            'comment' => 'nullable'

        ];
    }

    public function messages()
    {
        return [
            'type.numeric' => 'Ошибка типа операции',
            'category.numeric' => 'Ошибка категории',
            'date.date' => 'Неверная дата',
            'sum.required' => 'Введите сумму',
            'sum.numeric' => 'Неверная сумма',
        ];
    }
}
