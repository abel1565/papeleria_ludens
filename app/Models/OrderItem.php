<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderItem extends Model
{
    protected $fillable = [
        'order_id',
        'product_id', // De tu migración 'create_order_items'
        'quantity',
        'price',
    ];

    /**
     * Un item de orden pertenece a una orden.
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * Un item de orden es un producto.
     * Le decimos el nombre de la llave foránea 'product_id'
     * (que SÍ sigue la convención de Laravel para el modelo 'Productos')
     */
    public function producto()
    {
        return $this->belongsTo(Productos::class, 'product_id');
    }
}

