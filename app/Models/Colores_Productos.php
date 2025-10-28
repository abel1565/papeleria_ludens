<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Colores_Productos extends Model
{
    protected $table = 'colores_productos';

    // Campos que se pueden asignar masivamente
    protected $fillable = [
        'color_id',
        'producto_id',
    ];

    /**
     * Relación con el modelo Color
     */
    public function color()
    {
        return $this->belongsTo(Color::class, 'color_id');
    }

    /**
     * Relación con el modelo Producto
     */
    public function producto()
    {
        return $this->belongsTo(Producto::class, 'producto_id');
    }
}
