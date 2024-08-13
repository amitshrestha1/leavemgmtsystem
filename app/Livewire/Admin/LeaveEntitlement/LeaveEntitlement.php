<?php

namespace App\Livewire\Admin\LeaveEntitlement;

use App\Models\LeaveEntitlement as ModelsLeaveEntitlement;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;



class LeaveEntitlement extends Component
{
    use LivewireAlert;
    protected $listeners = ['DeleteConfirm'=>'deleteEntitlement','show-delete-button'=>'deleteConfirmation'];
    public $delete_id;
    public function render()
    {
        return view('livewire.admin.leave-entitlement.leave-entitlement');
    }

    public function deleteConfirmation($id){
        $this->delete_id = $id;
    }

    public function deleteEntitlement(){
        $entitlement = ModelsLeaveEntitlement::where('id',$this->delete_id)->first();
        $entitlement->delete();
        $this->flash('success', 'Department Deleted Successfully');
        return $this->redirect('/leaveentitlement',navigate:true);
    }
}
