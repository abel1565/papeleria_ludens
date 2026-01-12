
<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\{PowerGrid, PowerGridComponent, PowerGridColumns, Column, Button};
use PowerComponents\LivewirePowerGrid\Traits\ActionButton;

final class ClientesVendedorTable extends PowerGridComponent
{
    use ActionButton;

    /**
     * Fuente de datos
     */
    public function datasource(): Builder
    {
        $vendedor = Auth::user();

        return User::query()
            ->where('creado_por', $vendedor->id);
    }

    /**
     * Columnas a mostrar
     */
    public function columns(): array
    {
        return [
            Column::make('ID', 'id')->sortable(),
            Column::make('Nombre', 'name')->searchable()->sortable(),
            Column::make('Correo electrónico', 'email')->searchable()->sortable(),
            Column::make('Fecha de creación', 'created_at')->sortable(),
        ];
    }

    /**
     * Acciones (opcional)
     */
    public function actions(): array
    {
        return [
            Button::make('ver', 'Ver')
                ->class('bg-blue-500 text-white px-3 py-1 rounded')
                ->route('clientes.show', ['id' => 'id']),
        ];
    }
}
