<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ValidationRestauranteRequest;
use App\Http\Requests\ValidationRestauranteUpdateRequest;
use App\Models\Restaurante;


class RestauranteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.restaurante.index');
    }
    public function store(ValidationRestauranteRequest $request)
    {
        Restaurante::create($request->validated());

        return redirect()->route('admin.restaurante.index')
            ->with('success', 'El plato fue registrado correctamente.');
    }
    public function update(ValidationRestauranteUpdateRequest $request, string $id)
    {
        $restaurante = Restaurante::findOrFail($id);
        $restaurante->update($request->validated());

        return redirect()->route('admin.restaurante.index')
            ->with('success', 'El plato fue actualizado correctamente.');
    }
    public function destroy(string $id)
    {
        Restaurante::find($id)->delete();
        return redirect()->route('admin.restaurante.index')
            ->with('success', 'El plato fue eliminado correctamente.');

    }
}
