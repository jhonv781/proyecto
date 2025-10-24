<?php

namespace App\Livewire\Admin;

use App\Models\Estudiante;
use Livewire\Component;
use Livewire\WithPagination;

class EstudianteTable extends Component
{
    use WithPagination;

    public function render()
    {
        $estudiantes = Estudiante::orderBy('created_at', 'desc')->paginate(10);
        return view('livewire.admin.estudiante-table', compact('estudiantes'));
    }
}