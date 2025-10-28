<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subcategoria;
use App\Models\Productos;
use App\Models\Categoria_Productos;

class SubcategoriaController extends Controller
{
    public function show(Subcategoria $subcategoria){

        return view('productos.subcategoria',compact('subcategoria'));
    }





    public function productos(Subcategoria $subcategoria)
    {
        // 1. Laravel automáticamente busca la Subcategoria por su ID o slug (ej. /subcategoria/5)
        //    y la inyecta en la variable $subcategoria.

        // 2. Aquí está la magia:
        //    Llamas a la relación 'productos' que definiste en el modelo.
        $productos = $subcategoria->productos;

        // 3. Pasas los productos (y la subcategoría) a tu vista.
        return view('productos.categoria', [
            'subcategoria' => $subcategoria,
            'productos' => $productos
        ]);
    }


    public function view (Productos $producto){
        //con el orm de laravel simplemnete pasamos la funcion 
        return view('productos.productoid',['producto' => $producto]);

    }


}
