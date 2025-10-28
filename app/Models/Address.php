<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    // Nombre de la tabla
    protected $table = 'address';

    // Campos que se pueden asignar masivamente
    protected $fillable = [
        'name',
        'cp',
        'estado',
        'municipio',
        'ciudad',
        'calle',
        'num_ext',
        'num_int',
        'edificio',
        'entre_calle',
        'y_calle',
        'num_celular',
        'num_particular',
        'user_id',
    ];

    // Casts para tipos de datos
    protected $casts = [
        'cp' => 'integer',
        'user_id' => 'integer',
    ];

    /**
     * Relación con el modelo User
     * Un address pertenece a un usuario
     */

     public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}