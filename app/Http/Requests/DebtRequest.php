<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Override;

class DebtRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
    //LA VALIDACION DE LOS PUNTOS AQUI BEBERIA IR 
    protected function prepareForValidation():
    void
    {
        $this->merge([
            'amount' => str_replace('.', '', $this->amount),
        ]);
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'creditor' => 'required|string|max:50',
            'amount' => 'required|numeric|min:0',
            'description' => 'required|string|max:255',
            'status' => ['sometimes','boolean'], 
        ];
    }
    public function messages(): array
    {
        return[
            'creditor.required' => 'El Nombre es obligatorio',

            'amount.required' => 'El valor es obligatorio',
            'amount.numeric' => 'El valor debe ser numerico',
            'amount.min' => 'El valor no puede ser negativo',

            // DESCRIPTION
            'description.required' => 'La descripción es obligatoria',
            'description.max' => 'La descripción no puede tener más de 255 caracteres',
        ];
    }
}
