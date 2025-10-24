<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ValidationBlockRequest;
use App\Http\Requests\ValidationBlockUpdateRequest;
use App\Models\Block;
use Illuminate\Http\JsonResponse;

class BlockApiController extends Controller
{
    public function index(): JsonResponse
    {
        $libro = Block::all();
        return response()->json([
            'success' => true,
            'message' => 'productos obtenidos correctamente',
            'data' => $libro
        ], 200);
    }

    // ➕ POST /api/products - Crear un nuevo producto
    public function store(ValidationBlockRequest $request): JsonResponse
    {
        $libro = Block::create($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Producto creado correctamente',
            'data' => $libro
        ], 201);
    }

    // 🔍 GET /api/products/{id} - Obtener un producto específico
    public function show(Block $libro): JsonResponse
    {
        return response()->json([
            'success' => true,
            'message' => 'Producto obtenido correctamente',
            'data' => $libro
        ], 200);
    }

    // ✏️ PUT/PATCH /api/products/{id} - Actualizar un producto
    public function update(ValidationBlockUpdateRequest $request, Block $libro): JsonResponse
    {
        $libro->update($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Producto actualizado correctamente',
            'data' => $libro
        ], 200);
    }

    // 🗑️ DELETE /api/products/{id} - Eliminar un producto
    public function destroy(Block $libro): JsonResponse
    {
        $libro->delete();

        return response()->json([
            'success' => true,
            'message' => 'Producto eliminado correctamente',
            'data' => null
        ], 204);
    }
}
