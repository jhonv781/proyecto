<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidationRestauranteUpdateRequest extends FormRequest
{
     public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nombre' => ['required', 'string', 'max:255'],
            'descripcion' => ['nullable', 'string'],
            'precio' => ['required', 'decimal', 'min:0'],
            'categoria' => ['required', 'string', 'max:255'],
        ];
    }

    public function messages(): array
    {
        return [
            'nombre.required' => 'El nombre del producto es obligatorio.',
            'nombre.string' => 'El nombre debe ser un texto.',
            'nombre.max' => 'El nombre no debe exceder los 255 caracteres.',

            'descripcion.string' => 'La descripción debe ser texto.',

            'precio.required' => 'El precio es obligatorio.',
            'precio.numeric' => 'El precio debe ser un número.',
            'precio.min' => 'El precio no puede ser negativo.',
            
            'categoria.required' => 'El nombre de la categoría es obligatorio.', 
            'categoria.string' => 'El nombre de la categoría debe ser un texto.',
            'categoria.max' => 'El nombre de la categoría no debe exceder los 255 caracteres.',

        ];
    }
}
