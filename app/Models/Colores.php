<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Colores extends Model
{
    use HasFactory;

    protected $table = 'colores';

    protected $fillable = [
        'colores',
    ];

    /**
     * Relación muchos a muchos con productos
     */
    public function productos()
    {
        return $this->belongsToMany(Productos::class, 'colores_productos', 'color_id','producto_id'    // FK en la pivote que apunta a productos
        );
    }
}
