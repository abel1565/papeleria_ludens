<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductosController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\CatgeoriaController;
use App\Http\Controllers\SubcategoriaController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\AddresController;
use App\Http\Controllers\OrderController;



Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard') ->middleware(['auth', 'role:cliente-mayoreo'])->name('dashboard');

Route::get('/admin/dashboard', function () {return view('admin.dashboard');})->middleware(['auth', 'role:super-admin'])->name('admin.dashboard');
Route::get('/vendedor/dashboard', function () {return view('vendedor.dashboard');})->middleware(['auth', 'role:trabajador'])->name('vendedor.dashboard');



Route::post('/admin/registrer',[UsersController::class,'store'])->middleware(['auth', 'role:super-admin|trabajador'])->name('admin.store');
Route::get('/admin/registrer',[UsersController::class,'create'])->middleware(['auth', 'role:super-admin|trabajador'])->name('admin.registrer');
Route::post('/product/store',[ProductosController::class,'store'])->middleware(['auth', 'role:super-admin'])->name('productos.store');
Route::get('/product/create', [ProductosController::class, 'create'])->middleware(['auth', 'role:super-admin'])->name('productos.create');
Route::get('/product/edit/{producto}', [ProductosController::class, 'edit'])->middleware(['auth', 'role:super-admin'])->name('admin.edit');
Route::patch('/product/update/{producto}', [ProductosController::class, 'update'])->middleware(['auth', 'role:super-admin'])->name('admin.update');
Route::get('/product/index', [ProductosController::class, 'index'])->middleware(['auth', 'role:super-admin'])->name('admin.index');
Route::delete('/product/store/{id}',[ProductosController::class,'destroy'])->middleware(['auth', 'role:super-admin'])->name('admin.destroy');


Route::get('/categorias', [CatgeoriaController::class, 'index'])->name('categorias.index');
// Muestra UNA categoría específica con sus subcategorías
Route::get('/categorias/{categoria:slug}', [CatgeoriaController::class, 'show'])->name('categorias.show');

// --- RUTAS PARA SUBCATEGORÍAS ---
// Muestra los productos de UNA subcategoría (la que usa tu menú)
Route::get('/categorias/subcatgeoria', [SubcategoriaController::class, 'show'])->name('subcategorias.show');

Route::get('/subcategorias/{categoria}',[CatgeoriaController::class,'getSubcategorias']);

Route::get('/subcategoria/{subcategoria}',[SubcategoriaController::class,'productos'])->name('productos.categoria');


Route::get('/subcategoria/producto/{producto}',[SubcategoriaController::class,'view'])->name('productos.view');





Route::post('/vendedor/registrer',[UsersController::class,'storevendedor'])->middleware(['auth', 'role:trabajador'])->name('vendedor.store');

Route::get('/vendedor/registrer',[UsersController::class,'createvendedor'])->middleware(['auth', 'role:trabajador'])->name('vendedor.registrer');




Route::get('/cart', [CartController::class, 'index'])->middleware(['auth', 'role:cliente-mayoreo'])->name('carrito.carrito');
Route::post('/cart/checkout', [CartController::class, 'checkout'])->middleware(['auth', 'role:cliente-mayoreo'])->name('checkout.process');
Route::post('/cart/add',[CartController::class, 'addcart'])->middleware(['auth', 'role:cliente-mayoreo'])->name('cart.add');
Route::delete('/cart/remove/{id}',[CartController::class, 'remove'])->middleware(['auth', 'role:cliente-mayoreo'])->name('cart.remove');
Route::patch('/cart/update/{id}',[CartController::class, 'update'])->middleware(['auth', 'role:cliente-mayoreo'])->name('cart.update');

Route::get('/create/form/address',[AddresController::class,'create'])->middleware(['auth', 'role:cliente-mayoreo'])->name('address.create');
Route::post('/create/form/address/create',[AddresController::class,'store'])->middleware(['auth', 'role:cliente-mayoreo'])->name('address.store');

//Route::get('/order/user/{$order}',[OrderController::class,'show'])->middleware (['auth', 'role:cliente-mayoreo'])->name('orders.show');

Route::get('/order/user/miscompras',[UsersController::class,'compras'])->middleware (['auth', 'role:cliente-mayoreo'])->name('cliente.compras');

Route::get('order/user/miscompras/{order}',[UsersController::class,'productoscompras'])->middleware(['auth', 'role:cliente-mayoreo'])->name('compras.productos');



Route::view('order/user/thanyou','cliente.thankyou') ->middleware(['auth', 'role:cliente-mayoreo'])->name('cliente.thankyou');
Route::view('order/user/contacto','cliente.contacto') ->middleware(['auth', 'role:cliente-mayoreo'])->name('cliente.contacto');
Route::view('order/user/quiero-comprar','cliente.quierocomprar') ->middleware(['auth', 'role:cliente-mayoreo'])->name('cliente.quierocomprar');


Route::get ('dashboard/lo-nuevo/productos',[ProductosController::class,'new'])->middleware(['auth', 'role:cliente-mayoreo'])->name('cliente.nuevo');
Route::get ('search/productos',[ProductosController::class,'search'])->middleware(['auth', 'role:cliente-mayoreo'])->name('cliente.buscar');




Route::view('car/producto','productos.productoid') ->middleware(['auth', 'role:cliente-mayoreo'])->name('productos.productoid');

Route::get('/order/user/clientes/ventas',[UsersController::class,'ordenCliente'])->middleware (['auth', 'role:trabajador'])->name('vendedor.cliente');
Route::get('/order/user/clientes/ventas/{order}',[UsersController::class,'ccomprasCliente'])->middleware (['auth', 'role:trabajador'])->name('vendedor.compras');
Route::put('/order/user/clientes/ventas/{order}',[UsersController::class,'OrderUpdate'])->middleware (['auth', 'role:trabajador'])->name('vendedor.modificar');



//esperamos el id de la categoria para que muestre las subcategorias 


Route::get('/trabajador/dashboard', function () {
    return view('trabajador.dashboard');
})->middleware(['auth', 'role:trabajador'])->name('trabajador.dashboard');




Route::view('profile', 'profile')->middleware(['auth'])->name('profile');

require __DIR__.'/auth.php';

