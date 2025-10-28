<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;
use App\Models\Subcategoria;


class CatgeoriaController extends Controller
{
    public function getSubcategorias(Categoria $categoria){
        return $categoria->subcategoria;
    }
    



    //VISTA PARA OBTENER SUBCATGEIRAS 
    public function show(Subcategoria $subcategoria){

        return view('layout.navigation',compact('subcategoria'));
    }



    public function sub(Request $request, Subcategoria $subcategoria){
        
        $categoriasMenu= Categoria::with('subcategoria')->get();

    }



}
