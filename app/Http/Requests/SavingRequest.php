<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class SavingRequest extends FormRequest
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
            'expense_id' => 'required|exists:expenses,id',
            'amount' => 'required|numeric|min:0',
            'savings_purpose' => 'nullable|string|max:255',
            'description' => 'required|string|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'expense_id.required' => 'El gasto es obligatorio',
            'expense_id.exists' => 'El gasto seleccionado no existe',
            'amount.required' => 'El valor es obligatorio',
            'amount.numeric' => 'El valor debe ser numerico',
            'amount.min' => 'El valor no puede ser negativo',
            'savings_purpose.max' => 'El propósito de ahorro no puede tener más de 255 caracteres',
            'description.required' => 'La descripción es obligatoria',
            'description.max' => 'La descripción no puede tener más de 255 caracteres',
        ];
    }
}
