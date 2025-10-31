<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Colores;
use App\Models\Subcategoria;
use App\Models\Productos;
use App\Models\Categoria;
use App\Models\Categoria_Productos;
use App\Http\Requests\StoreProductoRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ProductosController extends Controller
{   

    public function index(Request $request)
    {
        // 1. Obtenemos el término de búsqueda de la URL (?search=valor)
        $search = $request->input('search');

        // 2. Iniciamos una consulta para el modelo Productos
        // Usar query() nos permite añadir condiciones dinámicamente
        $query = Productos::query();

        // 3. Si hay un término de búsqueda, aplicamos el filtro
        if ($search) {
            // Buscamos que el término esté en el nombre O en el código
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('code', 'like', "%{$search}%");
            });
        }
        
        // 4. Ejecutamos la consulta y paginamos los resultados
        // Paginator es ideal para listas largas. Muestra 10 por página.
        $productos = $query->orderBy('name')->paginate(10);

        // 5. Devolvemos la vista, pasándole los productos y el término de búsqueda
        return view('admin.search', compact('productos', 'search'));
    }

    public function search(Request $request){
        // 1. Obtenemos el término de búsqueda de la URL (?search=valor)
        $search = $request->input('search');

        // 2. Iniciamos una consulta para el modelo Productos
        // Usar query() nos permite añadir condiciones dinámicamente
        $query = Productos::query();

        // 3. Si hay un término de búsqueda, aplicamos el filtro
        if ($search) {
            // Buscamos que el término esté en el nombre O en el código
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('code', 'like', "%{$search}%");
            });
        }
        
        // 4. Ejecutamos la consulta y paginamos los resultados
        // Paginator es ideal para listas largas. Muestra 10 por página.
        $productos = $query->orderBy('name')->paginate(10);

        // 5. Devolvemos la vista, pasándole los productos y el término de búsqueda
        return view('cliente.search', compact('productos', 'search'));

    }

    public function new(Request $request){

        // Pide a la DB que ordene los productos ANTES de traerlos.
        // Usualmente para "nuevo" querrás 'desc' (descendente)
        $productos = Productos::orderBy('created_at', 'desc')->get();
    
        return view('cliente.nuevos', compact('productos'));
    }
    


    public function create()
    {
        $colors=Colores::all();
        $categorias=Categoria::all();

        return view('admin.productform',compact('colors','categorias'));
    }

    public function store(StoreProductoRequest $request)
    {

        // 1. Obtener todos los datos validados
        $data = $request->validated();
        DB::beginTransaction();

        try {
        

            // Manejar la subida de la imagen
            if ($request->hasFile('image')) {
                // Guarda la imagen en 'storage/app/public/productos' y obtiene la ruta
                $path = $request->file('image')->store('productos', 'public');
                
                // añadimos la imagen
                $data['image'] = $path;
            }

            // Extraer IDs de relaciones (esto no cambia)
            $subcategoriaId = $data['subcategoria_id'];

            $coloresIds = $data['colors'] ?? [];
            unset($data['subcategoria_id'], $data['colors']);

            // 4. Crear el producto con todos sus datos, incluida la ruta de la imagen
            $producto = Productos::create($data);

            // 5. Adjuntar las relaciones en las tablas pivote
            $producto->subcategorias()->attach($subcategoriaId);
            $producto->colores()->attach($coloresIds);

            DB::commit();
            return redirect()->route('admin.dashboard')->with('success', 'Producto creado correctamente');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Error al crear el producto: ' . $e->getMessage())->withInput();
        }
    }
   
    //funcion para mostrar el formulario para editar

    public function edit(Productos $producto){
        
        $colors=Colores::all();
        $categorias=Categoria::all();
        return view('admin.productedit', compact('producto' , 'colors', 'categorias'));
    }

    //funcion para realizar el update del producto 

    public function update(StoreProductoRequest $request, Productos $producto)
    {
        try {
            
    
            $data = $request->validated();
    
            // Separar colores y subcategorias
            $colors = $data['colors'];
            unset($data['colors']);
            $subcategorias = $data['subcategoria_id'];
            unset($data['subcategoria_id']);
    
            // Actualizar datos base
            $producto->update($data);
    
            // Actualizar relaciones
            $producto->colores()->sync($colors);
            $producto->subcategorias()->sync($subcategorias);
    
            return redirect()->route('admin.index')
                ->with('success', 'Producto actualizado correctamente');
        } catch (\Exception $e) {
           dd($e);
        }
    }

    public function destroy($id) //funcion para eliminar producto
    {
        try {
            $producto = Productos::findOrFail($id);
            $producto->delete();
            return redirect()->route('admin.index')->with('success', 'Producto eliminado correctamente.');
        } catch (\Exception $e) {
            return redirect()->route('admin.index')->with('error', 'No se pudo eliminar el producto.');
        }
    }

 




}


