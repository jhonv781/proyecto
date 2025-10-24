<?php

namespace App\Livewire\Admin;


use App\Models\Restaurante;
use Livewire\Component;
use Livewire\WithPagination;

class RestauranteTable extends Component
{
    use WithPagination;

    public function render()
    {
        $restaurantes = Restaurante::orderBy('created_at', 'desc')->paginate(10);
        return view('livewire.admin.restaurante-table', compact('restaurantes'));
    }
}