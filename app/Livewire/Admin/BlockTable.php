<?php

namespace App\Livewire\Admin;

use App\Models\Block;
use Livewire\Component;
use Livewire\WithPagination;

class BlockTable extends Component
{
    use WithPagination;

    public function render()
    {
        $blocks =Block::orderBy('created_at', 'desc')->paginate(10);
        return view('livewire.admin.block-table', compact('blocks'));
    }
}