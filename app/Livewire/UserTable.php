<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Facades\Filter;
use PowerComponents\LivewirePowerGrid\Facades\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridFields;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;

final class UserTable extends PowerGridComponent
{
    public string $tableName = 'user-table-fribmf-table';

    public function setUp(): array
    {
        $this->showCheckBox();

        return [
            PowerGrid::header()
                ->showSearchInput(),
            PowerGrid::footer()
                ->showPerPage()
                ->showRecordCount(),
        ];
    }

    public function datasource(): Builder
    {
        return User::query();
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id')
            ->add('name')
            ->add('email')
            ->add('phone')
            ->add('created_at')
            ->add('roles', function(User $user) {
                return $user->getRoleNames()->implode(', ');
            });
    }

    public function columns(): array
    {
        return [
            Column::make('Id', 'id'),
            Column::make('Name', 'name')
                ->sortable()
                ->editOnClick(hasPermission: true)
                ->searchable(),

            Column::make('Email', 'email')
                ->sortable()
                ->editOnClick(hasPermission: true)
                ->searchable(),

             Column::make('Phone', 'phone')
                ->sortable()
                ->editOnClick(hasPermission: true)
                ->searchable(),
            Column::make('Cliente', 'no_client')
                ->sortable()
                ->editOnClick(hasPermission: false)
                ->searchable(),
            
            Column::make('Roles', 'roles')
                ->sortable()
                ->searchable(),
            





            Column::action('Action')
        ];
    }

    public function filters(): array
    {
        return [
        ];
    }

    #[\Livewire\Attributes\On('edit')]
    public function edit($rowId): void
    {
        $this->js('alert('.$rowId.')');
    }

    public function actions(User $row): array
    {
        return [


                Button::add('delete')
                ->slot('Eliminar ')
                ->id()
                ->class('bg-red-500 text-white px-2 py-1 rounded hover:bg-red-600')
                ->dispatch('deleteUser', ['rowid' => $row->id])
                ->confirm('¿Estás seguro de que deseas eliminar este usuario?')
        ];
    }

    /*
    public function actionRules($row): array
    {
       return [
            // Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($row) => $row->id === 1)
                ->hide(),
        ];
    }
    */
    public function onUpdatedEditable(string|int $id, string $field, string $value): void
{
    User::query()->find($id)->update([
        $field => e($value),
    ]);
}
#[\Livewire\Attributes\On('deleteUser')]
public function deleteUser(int $rowid): void
{
    // Encuentra el usuario por su ID y lo elimina.
    // Usamos findOrFail para que falle si el ID no existe.
    $user = User::findOrFail($rowid);
    $user->delete();

    // (Opcional) Puedes mostrar una notificación de éxito.
    $this->js('alert("Usuario eliminado correctamente.")');
}
}
