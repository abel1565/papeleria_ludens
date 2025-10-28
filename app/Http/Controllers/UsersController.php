<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use Exception;

class UsersController extends Controller
{

    public function create()
    {
        $user = auth()->user();

        if ($user->hasRole('super-admin')) {
            // Admin puede crear cualquier rol
            $rolesDisponibles = Role::pluck('name'); // todos los roles existentes
        } elseif ($user->hasRole('trabajador')) {
            // Vendedor solo puede crear clientes
            $rolesDisponibles = Role::where('name', 'cliente-mayoreo')->pluck('name');
        } else {
            $rolesDisponibles = collect(); // vacío si no tiene permisos
        }
    
        return view('admin.registrer', compact('rolesDisponibles'));
    }

    public function store(Request $request)
    {
        $rolesValidos = Role::pluck('name')->toArray();
        $validated = $request->validate([
            'name'   => ['required', 'string', 'max:255'],
            'email'  => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email'],
            'phone'  => ['required','string','max:10'],
            'role'  => ['required','in:' . implode(',', $rolesValidos)]//accedemos a los roles de manera dinamica
        ]);

        try {
            DB::beginTransaction();
            // Generar código único
            

            // Crear usuario
            $user = User::create([
                'name'        => $request->name,
                'email'       => $request->email,
                'phone'       => $request->phone,
                'password'    => Hash::make($request->phone),
                'no_client'   => "",
                'vendedor_id' => auth()->id(), // quién creó al usuario
            ]);
            //modificamos el numero de cliente para que obtenga su numeor de cliente 
            $user->update([
                'no_client' => 'DNV' . str_pad($user->id, 6, '0', STR_PAD_LEFT) 
            ]);

            // 🔹 Validaciones según el rol de quien crea
            if (auth()->user()->hasRole('super-admin')) {
                // Admin puede crear cualquier rol, no se restringe nada
            } elseif (auth()->user()->hasRole('trabajador')) {
                // Vendedor solo puede crear clientes
                if ($request->role !== 'cliente') {
                    DB::rollBack();
                    return back()->withErrors(['role' => 'Un vendedor solo puede crear clientes.']);
                }
            } else {
                DB::rollBack();
                return back()->withErrors(['role' => 'No tienes permisos para crear usuarios.']);
            }

            // Asignar rol permitido
            $user->assignRole($request->role);

            DB::commit();

            return redirect()->route('admin.dashboard')
                ->with('success', 'Usuario creado correctamente');

        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->route('admin.dashboard')
                ->with('error', 'Error al crear el usuario ');

            
        }
    }

    public function createvendedor()
    {
        $user = auth()->user();

        if ($user->hasRole('trabajador')) {
            // Vendedor solo puede crear clientes
            $rolesDisponibles = Role::where('name', 'cliente-mayoreo')->pluck('name');
        } else {
            $rolesDisponibles = collect(); // vacío si no tiene permisos
        }
    
        return view('vendedor.register', compact('rolesDisponibles'));
    }



    public function storevendedor(Request $request)
    {
        $rolesValidos = Role::pluck('name')->toArray();
        $validated = $request->validate([
            'name'   => ['required', 'string', 'max:255'],
            'email'  => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email'],
            'phone'  => ['required','string','max:10'],
            'role'  => ['required','in:' . implode(',', $rolesValidos)]//accedemos a los roles de manera dinamica
        ]);

        try {
            DB::beginTransaction();

            // Crear usuario
            $user = User::create([
                'name'        => $request->name,
                'email'       => $request->email,
                'phone'       => $request->phone,
                'password'    => Hash::make($request->phone),
                'no_client'   => "",
                'vendedor_id' => auth()->id(), // quién creó al usuario
            ]);
            $user->update([
                'no_client' => 'DNV' . str_pad($user->id, 6, '0', STR_PAD_LEFT) 
            ]);

            // 🔹 Validaciones según el rol de quien crea
            if (auth()->user()->hasRole('trabajador')) {
                // Si el usuario autenticado quiere crear un usuario diferente a cliente-mayoreo, se hace rollback.
                if ($request->role !== 'cliente-mayoreo') {
                    DB::rollBack();
                    return back()->withErrors(['role' => 'Un vendedor solo puede crear clientes al mayoreo (cliente-mayoreo).'])->withInput();
                }

            } else {
                // Si el usuario no tiene el rol 'trabajador', no tiene permisos.
                DB::rollBack();
                return back()->withErrors(['role' => 'No tienes permisos para crear usuarios.'])->withInput();
            }

            // Asignar rol permitido
            $user->assignRole($request->role);

            //crear el carrito del usuario cuando se crea un cliente
            $cart=Cart::create([
            'user_id'=> $user -> id ,
            ]);
            
            
            DB::commit();
       


            return redirect()->route('vendedor.dashboard')
                ->with('success', 'Usuario creado correctamente');

        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->route('vendedor.dashboard')
                ->with('error', 'Error al crear el usuario. Por favor, revisa los logs.');
            
        }
    }


    public function users_vendedor(Request $request)
    {
        try {
            // 1. Obtener el ID del vendedor autenticado
            $vendedorId = auth()->id();
    
            // 2. Ejecutar la consulta Eloquent:
            $myusers = User::where('vendedor_id', $vendedorId)
                           ->orderBy('created_at', 'desc') // Ordenamos por fecha de creación para ver los más recientes
                           ->get();
    
            // 3. Retornar la vista con los usuarios
            return view('vendedor.clientes', compact('myusers'));
            
        } catch (Exception $e) {
        
            Log::error("Error al obtener usuarios del vendedor {$vendedorId}: " . $e->getMessage());
            
            // Retorna al dashboard con un mensaje de error
            return redirect()->route('vendedor.dashboard')
                ->with('error', 'No se pudieron cargar tus clientes debido a un error del sistema.');
        }
    }


 
    public function compras (Request $request){
        try {
            $user = auth()->id();

            $mycompras = Order::where('user_id', $user)
                ->orderBy('created_at', 'desc')
                ->get();

            return view('cliente.compras', compact('mycompras'));
        } catch (\Exception $e) { 
            \Log::error($e->getMessage());

            return back()->with('error', 'Hubo un problema al obtener tus compras. Intenta más tarde.');
        }
    }

    public function productoscompras(Order $order){

        $items = $order->Items()->with('producto')->get();
        $direccion = $order->address;

        return view('cliente.comprasproductos', compact('items', 'direccion'));
       
    }






    public function ordenes(Request $requets){
        try {
            $user_vendedor= auth()->id();
            $user_cliente=User::where(' vendedor_id',$user_vendedor)->get();

            $order_client=Order::where('user_id',$user_cliente)
                    ->orderBy('created_at','desc')
                    ->get();            //obtener una consulta para iobtener las  ordenes de compra 
        } catch (\Exception $e) { 
                    \Log::error($e->getMessage());
        
                    return back()->with('error', 'Hubo un problema al obtener tus compras. Intenta más tarde.');
        }
    }




}

