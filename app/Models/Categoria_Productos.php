<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Categoria_Productos extends Model
{
    use HasFactory;

    protected $fillable = [
        'productos_id',
        'subcategoria_id'
    ];    

    public function productos(){

        return $this->belongsTo(Productos::class,'productos_id');
    }
    public function subcategoria(){

        return $this->belongsTo(Subcategoria::class,'subcategoria_id');
    }
    public function getRouteKeyName()
    {
        return 'nombre'; // O 'slug' si tienes esa columna
    }



}
