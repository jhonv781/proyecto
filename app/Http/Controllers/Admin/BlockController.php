<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ValidationBlockRequest;
use App\Http\Requests\ValidationBlockUpdateRequest;
use App\Models\Block;

class BlockController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.block.index');
    }
    public function store(ValidationBlockRequest $request)
    {
        Block::create($request->validated());

        return redirect()->route('admin.block.index')
            ->with('success', 'El libro fue registrado correctamente.');
    }
    public function update(ValidationBlockUpdateRequest $request, string $id)
    {
        $block = Block::findOrFail($id);
        $block->update($request->validated());

        return redirect()->route('admin.block.index')
            ->with('success', 'El libro fue actualizado correctamente.');
    }
    public function destroy(string $id)
    {
        Block::find($id)->delete();
        return redirect()->route('admin.block.index')
            ->with('success', 'El libro fue eliminado correctamente.');
    }
}
