<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreServiceOrdersRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'vehiclePlate' => 'required|string|max:7',
            'entryDateTime' => 'required|date_format:Y-m-d H:i:s',
            'exitDateTime' => 'nullable|date_format:Y-m-d H:i:s',
            'priceType' => 'required|string|max:55',
            'price' => 'required|numeric|min: 0',
            'userId' => 'required|integer|exists:users,id'
        ];
    }

    public function messages()
    {
        return [
            'vehiclePlate.required' => 'O campo placa do veículo é obrigatório',
            'vehiclePlate.max' => 'O campo placa do veículo deve ter no máximo 7 caracteres',
            'vehiclePlate.string' => 'O campo placa do veículo deve ser do tipo texto',
            'entryDateTime.required' => 'O campo data e hora de entrada é obrigatório',
            'entryDateTime.date_format' => 'O campo data e hora de entrada deve ser do tipo data e hora',
            'exitDateTime.date_format' => 'O campo data e hora de saída deve ser do tipo data e hora',
            'priceType.required' => 'O campo tipo de preço é obrigatório',
            'priceType.max' => 'O campo tipo de preço deve ter no máximo 55 caracteres',
            'priceType.string' => 'O campo tipo de preço deve ser do tipo texto',
            'price.required' => 'O campo preço é obrigatório',
            'price.numeric' => 'O campo preço deve ser do tipo numérico',
            'price.min' => 'O campo preço deve ser maior ou igual a 0',
            'userId.required' => 'O campo usuário é obrigatório',
            'userId.integer' => 'O campo usuário deve ser do tipo inteiro',
            'userId.exists' => 'O campo usuário não existe em nossa base de dados.',
        ];
    }
}
