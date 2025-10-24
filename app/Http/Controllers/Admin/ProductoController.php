<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ValidationProductoRequest;
use App\Http\Requests\ValidationProductoUpdateRequest;
use App\Models\Producto;

class ProductoController extends Controller
{
    public function index()
    {
        return view('admin.producto.index');
    }

    public function store(ValidationProductoRequest $request)
    {
        Producto::create($request->validated());

        return redirect()->route('admin.producto.index')
            ->with('success', 'El producto fue registrado correctamente.');
    }

    public function update(ValidationProductoUpdateRequest $request, string $id)
    {
        $producto = Producto::findOrFail($id);
        $producto->update($request->validated());

        return redirect()->route('admin.producto.index')
            ->with('success', 'El producto fue actualizado correctamente.');
    }

    public function destroy(string $id)
    {
        Producto::findOrFail($id)->delete();

        return redirect()->route('admin.producto.index')
            ->with('success', 'El producto fue eliminado correctamente.');
    }
}
