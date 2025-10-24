<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ValidationEstudianteUpdateRequest;
use App\Http\Requests\ValidationRestauranteRequest;
use App\Models\Restaurante;
use Illuminate\Http\JsonResponse;

class RestauranteApiController extends Controller
{
    // 📥 GET /api/products - Listar todos los productos
    public function index(): JsonResponse
    {
        $restaurante = Restaurante::all();
        return response()->json([
            'success' => true,
            'message' => 'Plato obtenidos correctamente',
            'data' => $restaurante
        ], 200);
    }

    // ➕ POST /api/products - Crear un nuevo producto
    public function store(ValidationRestauranteRequest $request): JsonResponse
    {
        $restaurante = Restaurante::create($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Plato creado correctamente',
            'data' => $restaurante
        ], 201);
    }

    // 🔍 GET /api/products/{id} - Obtener un producto específico
    public function show(Restaurante $restaurante): JsonResponse
    {
        return response()->json([
            'success' => true,
            'message' => 'Plato obtenido correctamente',
            'data' => $restaurante
        ], 200);
    }

    // ✏️ PUT/PATCH /api/products/{id} - Actualizar un producto
    public function update(ValidationEstudianteUpdateRequest $request, Restaurante $restaurante): JsonResponse
    {
        $restaurante->update($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Plato actualizado correctamente',
            'data' => $restaurante
        ], 200);
    }

    // 🗑️ DELETE /api/products/{id} - Eliminar un producto
    public function destroy(Restaurante $restaurante): JsonResponse
    {
        $restaurante->delete();

        return response()->json([
            'success' => true,
            'message' => 'Plato eliminado correctamente',
            'data' => null
        ], 204);
    }
}
