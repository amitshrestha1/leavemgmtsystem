<?php

namespace App\Livewire;

use App\Models\Leave;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Exportable;
use PowerComponents\LivewirePowerGrid\Facades\Filter;
use PowerComponents\LivewirePowerGrid\Facades\Rule;
use PowerComponents\LivewirePowerGrid\Footer;
use PowerComponents\LivewirePowerGrid\Header;
use PowerComponents\LivewirePowerGrid\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridColumns;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use PowerComponents\LivewirePowerGrid\Traits\WithExport;

final class LeaveTable extends PowerGridComponent
{
    use WithExport;

    public function setUp(): array
    {

        return [

            Header::make()->showSearchInput(),
            Footer::make()
                ->showPerPage()
                ->showRecordCount(),
        ];
    }

    public function datasource(): Builder
    {
            if(Auth()->user()->role->name == 'SuperAdmin'||Auth()->user()->role->name == 'Admin'){
                return Leave::query()->with('user')->with('types');
            }
            else {
               
                return Leave::query()->with('user')->with('types')->where('user_id',Auth()->user()->id);
                
            }
        }

    public function relationSearch(): array
    {
        return [];
    }

    public function addColumns(): PowerGridColumns
    {
        return PowerGrid::columns()
            ->addColumn('id')
            ->addColumn('type_id', function (Leave $user) {
                return $user->types->name;
            })
            ->addColumn('reason')
            ->addColumn('from')
            ->addColumn('to')
            ->addColumn('user_id', function (Leave $user) {
                    return $user->user->name;
                
            })
            ->addColumn('status');
    }

    public function columns(): array
    {
        return [
            Column::make('Name', 'user_id'),
            Column::make('Leave Type', 'type_id'),
            Column::make('Reason', 'reason')
                ->sortable()
                ->searchable(),

            Column::make('From', 'from')
                ->sortable()
                ->searchable(),

            Column::make('To', 'to')
                ->sortable()
                ->searchable(),
            Column::make('Status', 'status')
                ->searchable(),
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

    public function actions(\App\Models\Leave $row): array
    {
        return [
            Button::add('approve')
                ->slot('Approve')
                ->class('btn btn-success text-white')
                ->dispatch('approve-leave',['approvekey' => $row->id]),
            Button::add('reject')
                ->slot('Reject')
                ->class('btn btn-danger text-white')
                ->dispatch('reject-leave',['rejectkey'=>$row->id]),
            Button::add('delete')
                ->slot('Delete')
                ->class('btn btn-info text-white')
                ->dispatch('show-delete-button',[$row->id]),
        ];
    }

    
    public function actionRules($row): array
    {
       return [
            // Hide button edit for ID 1
            Rule::button('approve')
                ->when(fn($row) => $row->user->role_id == 5 || $row->user->role_id == 3 || $row->user->role_id == 4)
                ->hide(),
            Rule::button('reject')
                ->when(fn($row) => $row->user->role_id == 5 || $row->user->role_id == 3 || $row->user->role_id == 4)
                ->hide(),
            Rule::button('delete')
                ->when(fn($row) => $row->user->role_id == 5 || $row->user->role_id == 3 || $row->user->role_id == 4)
                ->hide(),
        ];
    }
}
