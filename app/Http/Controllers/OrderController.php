<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Muestra la página de confirmación de una orden específica.
     */
    public function show(Order $order)
    {
        // 1. (Seguridad) Asegurarnos que el usuario solo vea sus propias órdenes
        if ($order->user_id !== Auth::id()) {
            abort(403, 'No autorizado');
        }

        // 2. Cargamos las relaciones que la vista necesita para no hacer 100 consultas
        $order->load('items.producto', 'user');

        // 3. Pasamos la orden a la vista
        return view('orders.show', compact('order'));
    }
    
}