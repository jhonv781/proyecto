<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidationVehiculoUpdateRequest extends FormRequest
{
    
    public function authorize(): bool
    {
        return true;
    }

    
    public function rules(): array
    {
        return [
            'marca' => ['required', 'string', 'max:100'],
            'modelo' => ['required', 'string', 'max:100'],
            'anio' => ['required', 'integer', 'min:1900', 'max:' . (date('Y') + 1)], // Año requerido, entero, no antes de 1900, y hasta el año actual + 1
            'color' => ['required', 'string', 'max:50'],
        ];
    }
    public function messages(): array
    {
        return [
            
            'marca.required' => 'La marca del vehículo es obligatoria.',
            'marca.string' => 'La marca debe ser un texto.',
            'marca.max' => 'La marca no debe exceder los 100 caracteres.',

            
            'modelo.required' => 'El modelo del vehículo es obligatorio.',
            'modelo.string' => 'El modelo debe ser un texto.',
            'modelo.max' => 'El modelo no debe exceder los 100 caracteres.',

            
            'anio.required' => 'El año de fabricación es obligatorio.',
            'anio.integer' => 'El año debe ser un número entero.',
            'anio.min' => 'El año no puede ser anterior a 1900.',
            'anio.max' => 'El año no puede ser futuro.',

            
            'color.required' => 'El color es obligatorio.',
            'color.string' => 'El color debe ser un texto.',
            'color.max' => 'El color no debe exceder los 50 caracteres.',
        ];
    }
}
