<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Productos extends Model
{
    // Nombre de la tabla
    protected $table = 'productos';

    // Campos que se pueden asignar masivamente
    protected $fillable = [
        'name',
        'code',
        'stock',
        'price',
        'pieces_per_package',
        'pieces_per_box',
        'sale_note',
        'description',
        'material',
        'models',
        'measurements',
        'separators',
        'extra_notes',
        'weight',
        'barcode',
        'sku',
        'image',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'weight' => 'decimal:3',
        'stock' => 'integer',
        'pieces_per_package' => 'integer',
        'pieces_per_box' => 'integer',
        'models' => 'integer',
        'separators' => 'integer',
    ];
    public function colores()
    {
    
        return $this->belongsToMany(Colores::class,'Colores_productos', 'producto_id', 'color_id');

    }
    public function subcategorias()
    {
        return $this->belongsToMany(Subcategoria::class,'categoria_Productos', 'productos_id', 'subcategoria_id');

    }
    public function cart(){
        return $this->belongsToMany(Cart::class, 'cart_items', 'productos_id', 'cart_id')
                    ->withPivot('quantity', 'colores_id');
    
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_items', 'product_id', 'order_id')
                    ->withPivot('quantity', 'price');
    }
};


