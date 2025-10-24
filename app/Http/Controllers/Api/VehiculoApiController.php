<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ValidationVehiculoRequest;
use App\Http\Requests\ValidationVehiculoUpdateRequest;
use App\Models\Vehiculo;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class VehiculoApiController extends Controller
{
    // 📥 GET /api/products - Listar todos los productos
    public function index(): JsonResponse
    {
        $vehiculo = Vehiculo::all();
        return response()->json([
            'success' => true,
            'message' => 'Auto obtenidos correctamente',
            'data' => $vehiculo
        ], 200);
    }

    // ➕ POST /api/products - Crear un nuevo producto
    public function store(ValidationVehiculoRequest $request): JsonResponse
    {
        $vehiculo = Vehiculo::create($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Plato creado correctamente',
            'data' => $vehiculo
        ], 201);
    }

    // 🔍 GET /api/products/{id} - Obtener un producto específico
    public function show(Vehiculo $vehiculo): JsonResponse
    {
        return response()->json([
            'success' => true,
            'message' => 'Plato obtenido correctamente',
            'data' => $vehiculo
        ], 200);
    }

    // ✏️ PUT/PATCH /api/products/{id} - Actualizar un producto
    public function update(ValidationVehiculoUpdateRequest $request, Vehiculo $vehiculo): JsonResponse
    {
        $vehiculo->update($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Plato actualizado correctamente',
            'data' => $vehiculo
        ], 200);
    }

    // 🗑️ DELETE /api/products/{id} - Eliminar un producto
    public function destroy(Vehiculo $vehiculo): JsonResponse
    {
        $vehiculo->delete();

        return response()->json([
            'success' => true,
            'message' => 'Plato eliminado correctamente',
            'data' => null
        ], 204);
    }

}
