<?php

namespace App\Livewire;

use App\Models\Department;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Features\SupportNavigate\SupportNavigate;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Exportable;
use PowerComponents\LivewirePowerGrid\Facades\Filter;
use PowerComponents\LivewirePowerGrid\Footer;
use PowerComponents\LivewirePowerGrid\Header;
use PowerComponents\LivewirePowerGrid\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridColumns;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use PowerComponents\LivewirePowerGrid\Responsive;
use PowerComponents\LivewirePowerGrid\Traits\WithExport;
use App\Models\User as UserCount;

final class UserTable extends PowerGridComponent
{
    public bool $multiSort = true; 
    use WithExport;

    public function setUp(): array
    {

        return [
            // Responsive::make(),
            Header::make()->showSearchInput(),
            Footer::make()
                ->showPerPage()
                ->showRecordCount(),

        ];
    }

    public function datasource(): Builder
    {
        return User::query()->where('role_id','!=','1')->with('department')->with('role');
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function addColumns(): PowerGridColumns
    {
        return PowerGrid::columns()
            ->addColumn('id')
            ->addColumn('name')
            ->addColumn('email')
            // ->addColumn('image', function (User $user){
            //     $imagePath = $user->image;
            //     $a = "<img class=\"img-md img-fluid rounded-circle\"src=\"{{ asset('storage/'\. $user->image) }}\" alt=\"Profile image\">";
            //    return $a;

            // })
            ->addColumn('department', function (User $user) {
                if ($user->department_id == null) {
                return $a = '-';
                }
                return $user->department->name;
            })
            ->addColumn('role', function (User $user) {
                if ($user->role_id == null) {
                return $a = '-';
                }
                return $user->role->name;
            });
            
    }


    public function columns(): array
    {
        return [
            Column::make('Name', 'name')
                ->sortable()
                ->searchable(),

            Column::make('Email', 'email')
                ->sortable()
                ->searchable(),

            Column::make('Department', 'department')
                ->searchable(),
            Column::make('Role', 'role')
                ->searchable(),
            
            // Column::make('Image', '$a')
            //     ->sortable()
            //     ->searchable(),


            Column::action('Action')
        ];
    }

    public function filters(): array
    {
        return [];
    }

    #[\Livewire\Attributes\On('edit')]
    public function edit($rowId): void
    {
        $this->js('alert(' . $rowId . ')');
    }

    public function actions(\App\Models\User $row): array
    {
        return [
            //...
            Button::add('edit')
                ->slot('Edit')
                ->class('btn btn-info text-white')
                ->bladeComponent('user-edit-button', ['user' => $row->id]),
            Button::add('delete')
                ->slot('Delete')
                ->class('btn btn-danger text-white')
                ->dispatch('show-delete-button',[$row->id]),

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
}
