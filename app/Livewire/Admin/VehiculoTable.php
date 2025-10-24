<?php

namespace App\Livewire\Admin;

use App\Models\Vehiculo;
use Livewire\Component;

class VehiculoTable extends Component
{
    public function render()
    {
        $vehiculos = Vehiculo::orderBy('created_at', 'desc')->paginate(10);
        return view('livewire.admin.vehiculo-table', compact('vehiculos'));
    }
}
