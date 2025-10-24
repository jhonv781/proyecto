<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Block extends Model
{
    /** @use HasFactory<\Database\Factories\BlockFactory> */
    use HasFactory;
    protected $fillable = [
        'titulo',
        'contenido',
        'estado'
    ];
}
