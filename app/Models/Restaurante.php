<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurante extends Model
{
    /** @use HasFactory<\Database\Factories\RestauranteFactory> */
    use HasFactory;
    
    protected $fillable = [
        'nombre',
        'categoria',
        'descripcion',
        'precio'
    ];
}
