<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidationBlockRequest extends FormRequest
{
    
    public function authorize(): bool
    {
        return true;
    }

    
    public function rules(): array
    {
        return [
            'titulo' => ['required', 'string', 'max:255'],
            'contenido' => ['required', 'string'],
            'estado' => ['required', 'string', 'max:50'],
        ]; 
    }

    
    public function messages(): array
    {
        return [

            'titulo.required' => 'El título es obligatorio.',
            'titulo.string' => 'El título debe ser un texto.',
            'titulo.max' => 'El título no debe exceder los 255 caracteres.',

            'contenido.required' => 'El contenido es obligatorio.',
            'contenido.string' => 'El contenido debe ser texto.',
            
            
            'estado.required' => 'El estado es obligatorio.',
            'estado.string' => 'El estado debe ser un texto.',
            'estado.max' => 'El estado no debe exceder los 50 caracteres.',
        ];
    }
}
