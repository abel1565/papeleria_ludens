<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Subcategoria extends Model
{
    use HasFactory;

    // Nombre de la tabla (porque no sigue la convención en plural)
    protected $table = 'subcategoria';

    // Campos que se pueden asignar masivamente
    protected $fillable = [
        'categoria_id',
        'subcategoria',
        'status',
    ];

    // Casts para asegurar tipos correctos
    protected $casts = [
        'categoria_id' => 'integer',
    ];

    /**
     * Relación con Categoria
     * Una subcategoria pertenece a una categoría
     */
    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'categoria_id');
    }
    Public function productos(){
        return $this->belongsToMany(Productos::class,'categoria_Productos','subcategoria_id','productos_id');
    }
}
