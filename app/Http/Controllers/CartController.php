<?php

namespace App\Http\Controllers;

use App\Models\Productos;
use App\Models\CartItem;
use App\Models\Cart;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Address;

class CartController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        $cart = Cart::with('items.productos')
            ->where('user_id', $userId) // Usamos $userId aquí
            ->first();
        $addresses = Address::where('user_id', $userId)->get();
        
        $subtotal = 0;
        $shipping = 0;
        $total = 0;
        $final = 0;
        $discount = 0; // Variable de descuento
        $discountAmount = 0; // Cantidad a descontar

        if ($cart && $cart->items->isNotEmpty()) {
            
            // 1. Calcular Subtotal
            $subtotal = $cart->items->sum(function($item) {
                return $item->productos ? $item->productos->price * $item->quantity : 0;
            });
            
            // 2. Calcular Total (antes de descuentos)
            $total = $subtotal + $shipping;

            // 3. Calcular Descuento (usando tus reglas)
            if ($total >= 3000 && $total <= 5000) {
                $discount = 0.15;
            } elseif ($total > 5000 && $total <= 29999) {
                $discount = 0.25;
            } elseif ($total >= 30000 && $total <= 100000) {
                $discount = 0.34;
            } elseif ($total > 100000) {
                $discount = 0.39;
            }
            
            // 4. Calcular Total Final
            $discountAmount = $total * $discount;
            $final = $total - $discountAmount;
        }

        // 5. Pasar las variables a la vista (pasamos 'final' que ya tiene el descuento)
        return view('carrito.carrito', compact('cart', 'subtotal', 'shipping', 'final', 'addresses'));
    }

    public function addcart(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:productos,id',
            'quantity' => 'integer|min:1'
        ]);

        $cart = Cart::firstOrCreate(['user_id' => Auth::id()]);
        $product = Productos::findOrFail($request->product_id);

        $cartItem = CartItem::where('cart_id', $cart->id)
            ->where('productos_id', $product->id)
            ->first();

        if ($cartItem) {
            $cartItem->quantity += $request->quantity ?? 1;
            $cartItem->save();
        } else {
            CartItem::create([
                'cart_id' => $cart->id,
                'productos_id' => $product->id,
                'quantity' => $request->quantity ?? 1,
                'price' => $product->price,
            ]);
        }

        return redirect()->route('carrito.carrito')->with('success', 'Producto agregado al carrito.');
    }

    public function checkout(Request $request)
    {
        $cart = Cart::with('items.productos')
            ->where('user_id', Auth::id())
            ->first();

        if (!$cart || $cart->items->isEmpty()) {
            return back()->with('error', 'Tu carrito está vacío.');
        }

        // ===============================================
        // ¡INICIO DE LA CORRECCIÓN!
        // No confiamos en el request. Recalculamos el total.
        // ===============================================

        $subtotal = 0;
        $shipping = 0;
        $total = 0;
        $final = 0;
        $discount = 0;

        // 1. Calcular Subtotal
        $subtotal = $cart->items->sum(function($item) {
            return $item->productos ? $item->productos->price * $item->quantity : 0;
        });
        
        // 2. Calcular Total (antes de descuentos)
        $total = $subtotal + $shipping;

        // 3. Calcular Descuento (copiamos la misma lógica de 'index')
        if ($total >= 3000 && $total <= 5000) {
            $discount = 0.15;
        } elseif ($total > 5000 && $total <= 29999) {
            $discount = 0.25;
        } elseif ($total >= 30000 && $total <= 100000) {
            $discount = 0.34;
        } elseif ($total > 100000) {
            $discount = 0.39;
        }
        
        // 4. Calcular Total Final
        $final = $total - ($total * $discount);

        // ===============================================
        // ¡FIN DE LA CORRECCIÓN!
        // Ahora $final SÍ tiene un valor calculado.
        // ===============================================
        
        $reference = 'ORD-' . now()->format('Ymd') . '-' . Str::upper(Str::random(5));

        $order = Order::create([
            'user_id' => Auth::id(),
            'address_id' => $request->address_id,
            'total' => $final, // <-- Ahora $final nunca es null
            'status' => 'pending',
            'ref'=> $reference,
            'payment_method' => $request->payment_method,
        ]);

        foreach ($cart->items as $item) {
            // (Asegúrate que tu tabla 'order_items' tenga 'product_id' y no 'productos_id')
            $order->items()->create([
                'product_id' => $item->productos_id, // Esta columna en 'order_items' debe llamarse 'product_id' o 'productos_id'
                'quantity' => $item->quantity,
                'price' => $item->productos->price,
                'subtotal' => $item->productos->price * $item->quantity,
            ]);
        }

        $cart->items()->delete();

        return redirect()->route('cliente.thankyou')
            ->with('success', 'Orden creada con éxito.');
    }

    public function remove(Request $request, $id) // Agregado Request $request
    {
        $item = CartItem::findOrFail($id);
        $item->delete();
        return redirect()->route('carrito.carrito')->with('success', 'Producto eliminado.');
    }

    public function update(Request $request, $id)
    {
        // Leemos la cantidad desde el Request (funciona para GET o POST)
        $quantity = $request->input('quantity');

        if ($quantity && $quantity >= 1) {
            $item = CartItem::findOrFail($id);
            $item->quantity = $quantity;
            $item->save();
            return redirect()->route('carrito.carrito')->with('success', 'Cantidad actualizada.');
        }

        return redirect()->route('carrito.carrito')->with('error', 'Cantidad no válida.');
    }

    public function clear()
    {
        $cart = Cart::where('user_id', Auth::id())->first();
        if ($cart) {
            $cart->items()->delete();
        }
        return redirect()->route('carrito.carrito')->with('success', 'Carrito vacío.');
    }
}