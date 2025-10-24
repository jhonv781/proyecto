<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ValidationEstudianteRequest;
use App\Http\Requests\ValidationEstudianteUpdateRequest;
use App\Models\Estudiante;
use Illuminate\Http\JsonResponse;

class EstudianteApiController extends Controller
{
    // 📥 GET /api/products - Listar todos los productos
    public function index(): JsonResponse
    {
        $estudiante = Estudiante::all();
        return response()->json([
            'success' => true,
            'message' => 'productos obtenidos correctamente',
            'data' => $estudiante
        ], 200);
    }

    // ➕ POST /api/products - Crear un nuevo producto
    public function store(ValidationEstudianteRequest $request): JsonResponse
    {
        $estudiante = Estudiante::create($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Estudiante creado correctamente',
            'data' => $estudiante
        ], 201);
    }

    // 🔍 GET /api/products/{id} - Obtener un producto específico
    public function show(Estudiante $estudiante): JsonResponse
    {
        return response()->json([
            'success' => true,
            'message' => 'Estudiante obtenido correctamente',
            'data' => $estudiante
        ], 200);
    }

    // ✏️ PUT/PATCH /api/products/{id} - Actualizar un producto
    public function update(ValidationEstudianteUpdateRequest $request, Estudiante $estudiante): JsonResponse
    {
        $estudiante->update($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Estudiante actualizado correctamente',
            'data' => $estudiante
        ], 200);
    }

    // 🗑️ DELETE /api/products/{id} - Eliminar un producto
    public function destroy(Estudiante $estudiante): JsonResponse
    {
        $estudiante->delete();

        return response()->json([
            'success' => true,
            'message' => 'Estudiante eliminado correctamente',
            'data' => null
        ], 204);
    }
}
