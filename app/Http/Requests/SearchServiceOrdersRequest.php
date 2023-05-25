<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SearchServiceOrdersRequest extends FormRequest
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
            'plate_number' => 'string|max:7:exists:service_orders,vehiclePlate',
        ];
    }

    public function messages(){
        return [
            'plate_number.string' => 'O campo placa do veículo deve ser do tipo texto',
            'plate_number.max' => 'O campo placa do veículo deve ter no máximo 7 caracteres',
            'plate_number.exists' => 'O campo placa do veículo não existe em nossa base de dados.',
        ];
    }
}
