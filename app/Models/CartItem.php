<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class CartItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'cart_id',
        'productos_id',   
        'quantity',
        'subtotal',
        'price',
    ];

    /**
     * Un item pertenece a un carrito.
     */

    public function cart(){
        return $this->belongsTo(Cart::class);

    }
     //Un item es un producto
     //* Le decimos el nombre de la llave foránea 'productos_id'
    public function productos(){
        return $this->belongsTo(Productos::class,'productos_id','id');
     
    }
}
