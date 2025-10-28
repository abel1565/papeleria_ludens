<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
    ];
    //relacion de usuarios con el producto 
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    //el carro puede tener muchos items (productos)
    public function items()
    {
        return $this->hasMany(CartItem::class);
    }
    
}
