<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Address;


class AddresController extends Controller
{
    public function create()
    {
        return view('address.create');
    }

    /**
     * Guarda la nueva dirección en la base de datos.
     */
    public function store(Request $request)
    {
        // 1. Validación (basada en tu esquema de BD)
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'cp' => 'required|integer',
            'estado' => 'required|string|max:255',
            'municipio' => 'required|string|max:255',
            'ciudad' => 'required|string|max:255',
            'calle' => 'required|string|max:255',
            'num_ext' => 'required|string|max:255',
            'num_int' => 'nullable|string|max:255',
            'edificio' => 'nullable|string|max:255',
            'entre_calle' => 'nullable|string|max:255',
            'y_calle' => 'nullable|string|max:255',
            'num_celular' => 'required|string|max:255',
            'num_particular' => 'nullable|string|max:255',
        ]);

        // 2. Añadimos el user_id (que no viene del formulario)
        $validatedData['user_id'] = Auth::id();;

        // 3. Creamos la dirección
        Address::create($validatedData);

        // 4. Redirigimos de vuelta al carrito
        return redirect()->route('carrito.carrito')
                         ->with('success', '¡Dirección guardada con éxito!');
    }

    // (Aquí irían tus métodos 'edit' y 'update' más adelante)
}
    

