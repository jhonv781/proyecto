<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ValidationEstudianteRequest;
use App\Http\Requests\ValidationEstudianteUpdateRequest;
use App\Models\Estudiante;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class EstudianteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.estudiante.index');
    }
    public function store(ValidationEstudianteRequest $request)
    {
        Estudiante::create($request->validated());

        return redirect()->route('admin.estudiante.index')
            ->with('success', 'El alumno fue registrado correctamente.');
    }
    public function update(ValidationEstudianteUpdateRequest $request, string $id)
    {
        $estudiante = Estudiante::findOrFail($id);
        $estudiante->update($request->validated());

        return redirect()->route('admin.estudiante.index')
            ->with('success', 'El estudiante fue actualizado correctamente.');
    }
    public function destroy(string $id)
    {
        Estudiante::findOrFail($id)->delete();
        return redirect()->route('admin.estudiante.index')->with('success', 'El estudiante fue eliminado correctamente.');
    }
}
