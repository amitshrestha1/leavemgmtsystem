<?php

namespace App\Livewire\Admin\LeaveType;

use App\Models\LeaveType as Type;
use App\Models\LeaveType as ModelsLeaveType;
use Livewire\Attributes\Layout;
use Livewire\Component;

class LeaveType extends Component
{
    #[Layout('layout.admin-app')]
    public $types =[];
    public $delete_id;
    protected $listeners = ['DeleteConfirm'=>'deleteLeaveType','show-delete-button'=>'deleteConfirmation'];
    

    public function mount(){
        $this->types=Type::all();
    }

    public function render()
    {
        return view('livewire.admin.leave-type.leave-type');
    }

    public function deleteConfirmation($id){
        $this->delete_id = $id;
        $this->dispatch('show-delete-button');
    }

    public function deleteLeaveType(){
        $type = ModelsLeaveType::where('id',$this->delete_id)->first();
        $type->delete();
        return $this->redirect(route('admin.type'),navigate:true);
    }
}

