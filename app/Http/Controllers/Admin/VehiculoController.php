<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ValidationVehiculoRequest;
use App\Http\Requests\ValidationVehiculoUpdateRequest;
use App\Models\Vehiculo;

class VehiculoController extends Controller
{
    
    public function index()
    {
        return view('admin.vehiculo.index');    
    }
    public function store(ValidationVehiculoRequest $request)
    {
        Vehiculo::create($request->validated());

        return redirect()->route('admin.vehiculo.index')
            ->with('success', 'El vehiculo fue registrado correctamente.');
    }

    public function update(ValidationVehiculoUpdateRequest $request, string $id)
    {
        $vehiculo = Vehiculo::findOrFail($id);
        $vehiculo->update($request->validated());

        return redirect()->route('admin.vehiculo.index')
            ->with('success', 'El vehiculo fue actualizado correctamente.');
    }
    public function destroy(string $id)
    {
        Vehiculo::find($id)->delete();
        return redirect()->route('admin.vehiculo.index')
            ->with('success', 'El vehiculo fue eliminado correctamente.');
    }
}
