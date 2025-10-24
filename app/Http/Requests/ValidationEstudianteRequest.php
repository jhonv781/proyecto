<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidationEstudianteRequest extends FormRequest
{
    
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            
            'nombre' => ['required', 'string', 'max:255'],
            'categoria' => ['required', 'string', 'max:255'],
            'materia' => ['required', 'string', 'max:255'], 
            'nota' => ['required', 'numeric', 'min:0', 'max:100'], 
        ];
    }

    
    
    public function messages(): array
    {
        return [
            
            'nombre.required' => 'El nombre es obligatorio.',
            'nombre.string' => 'El nombre debe ser un texto.',
            'nombre.max' => 'El nombre no debe exceder los 255 caracteres.',

            
            'categoria.required' => 'La categoría es obligatoria.',
            'categoria.string' => 'La categoría debe ser un texto.',
            'categoria.max' => 'La categoría no debe exceder los 255 caracteres.',
            
            
            'materia.string' => 'La materia debe ser un texto.',
            'materia.max' => 'La materia no debe exceder los 255 caracteres.',

            
            'nota.required' => 'La nota es obligatoria.',
            'nota.numeric' => 'La nota debe ser un número.',
            'nota.min' => 'La nota mínima es 0.',
            'nota.max' => 'La nota máxima es 100.',
        ];
    }
}
