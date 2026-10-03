<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class IncomeRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'amount' => 'required|numeric|min:0',
            'description' => 'required|string|max:255',
            
        ];

    }
    public function messages(): array
    {
        return[
            'amount.required' => 'El valor es obligatorio',
            'amount.numeric' => 'El valor debe ser numerico',
            'amount.min' => 'El valor no puede ser negativo',

            // DESCRIPTION
            'description.required' => 'La descripción es obligatoria',
            'description.max' => 'La descripción no puede tener más de 255 caracteres',
        ];
    }
}
