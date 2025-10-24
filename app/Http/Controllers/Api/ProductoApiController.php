<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Producto;
use App\Http\Requests\ValidationProductoRequest;
use App\Http\Requests\ValidationProductoUpdateRequest;
use Illuminate\Http\JsonResponse;

class ProductoApiController extends Controller
{
    // 📥 GET /api/products - Listar todos los productos
    public function index(): JsonResponse
    {
        $productos = Producto::all();
        return response()->json([
            'success' => true,
            'message' => 'productos obtenidos correctamente',
            'data' => $productos
        ], 200);
    }

    // ➕ POST /api/products - Crear un nuevo producto
    public function store(ValidationProductoRequest $request): JsonResponse
    {
        $producto = Producto::create($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Producto creado correctamente',
            'data' => $producto
        ], 201);
    }

    // 🔍 GET /api/products/{id} - Obtener un producto específico
    public function show(Producto $producto): JsonResponse
    {
        return response()->json([
            'success' => true,
            'message' => 'Producto obtenido correctamente',
            'data' => $producto
        ], 200);
    }

    // ✏️ PUT/PATCH /api/products/{id} - Actualizar un producto
    public function update(ValidationProductoUpdateRequest $request, Producto $producto): JsonResponse
    {
        $producto->update($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Producto actualizado correctamente',
            'data' => $producto
        ], 200);
    }

    // 🗑️ DELETE /api/products/{id} - Eliminar un producto
    public function destroy(Producto $producto): JsonResponse
    {
        $producto->delete();

        return response()->json([
            'success' => true,
            'message' => 'Producto eliminado correctamente',
            'data' => null
        ], 204);
    }
}
