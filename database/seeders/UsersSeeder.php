<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash; // Para Hash::make()
use App\Models\User; // Modelo de usuario
use Spatie\Permission\Models\Permission; // Permisos
use Spatie\Permission\Models\Role; // Roles

class UsersSeeder extends Seeder
{
    public function run(): void
    {
        Permission::create(['name' => 'ver usuarios']);
        Permission::create(['name' => 'crear usuarios']);
        Permission::create(['name' => 'editar usuarios']);
        Permission::create(['name' => 'eliminar usuarios']);

        // 📌 Permisos de productos
        Permission::create(['name' => 'ver productos']);
        Permission::create(['name' => 'crear productos']);
        Permission::create(['name' => 'editar productos']);
        Permission::create(['name' => 'eliminar productos']);

        // 📌 Permisos de pedidos
        Permission::create(['name' => 'ver pedidos']);
        Permission::create(['name' => 'levantar pedidos']);
        Permission::create(['name' => 'hacer pedido']);
        Permission::create(['name' => 'ver sus pedidos']);

        // 📌 Permisos de carrito
        Permission::create(['name' => 'agregar al carrito']);
        Permission::create(['name' => 'ver carrito']);
        Permission::create(['name' => 'eliminar del carrito']);

        // 📌 Usuario admin
        $adminUser = User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('12345678'),
            'email_verified_at' => now()
        ]);

        $roleAdmin = Role::create(['name' => 'super-admin']);
        $adminUser->assignRole($roleAdmin);

        // Admin tiene todos los permisos
        $permissionsAdmin = Permission::pluck('name')->toArray();
        $roleAdmin->syncPermissions($permissionsAdmin);

        // 📌 Usuario trabajador (vendedor)
        $trabajador = User::create([
            'name' => 'trabajador',
            'email' => 'trabajador@gmail.com',
            'password' => Hash::make('12345678'),
            'email_verified_at' => now()
        ]);

        $rolTrabajador = Role::create(['name' => 'trabajador']);
        $trabajador->assignRole($rolTrabajador);

        $rolTrabajador->syncPermissions([
            'ver productos',
            'levantar pedidos',
            'crear usuarios',
            'ver usuarios'
        ]);

        // 📌 Usuario cliente mayorista
        $client_may = User::create([
            'name' => 'user_may',
            'email' => 'user_mayorista@gmail.com',
            'password' => Hash::make('12345678'),
            'email_verified_at' => now()
        ]);

        $roleUser = Role::create(['name' => 'cliente-mayoreo']);
        $client_may->assignRole($roleUser);

        $roleUser->syncPermissions([
            'ver productos',
            'agregar al carrito',
            'ver carrito',
            'eliminar del carrito',
            'hacer pedido',
            'ver sus pedidos'
        ]);
    }
}
