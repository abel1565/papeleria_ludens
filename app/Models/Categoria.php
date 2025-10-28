<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Categoria extends Model
{
    use HasFactory;

    // Nombre de la tabla
    protected $table = 'Categoria';

    // Campos que se pueden asignar masivamente
    protected $fillable = [
       
        'categoria'
    ];
    public function subcategoria(){
        return $this->hasMany(Subcategoria::class,'categoria_id');
    }


}
