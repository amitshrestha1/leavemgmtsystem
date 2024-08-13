<?php

namespace App\Livewire\Admin\LeaveEntitlement;

use App\Models\LeaveEntitlement;
use App\Models\LeaveType;
use App\Models\User;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class CreateLeaveEntitlement extends Component
{
    use LivewireAlert;
    public $users = [];
    public $leave_types = [];
    public $user_id = null;
    public $leave_type_id = null;
    public $days;

    public function mount(){
        $this->users = User::where('role_id','!=',1)->get();
        $this->leave_types = LeaveType::all();
    }

    public function create_entitlement(){
        $validated = $this->validate([
            'user_id' => 'required',
            'leave_type_id' => 'required|unique:leave_entitlements,leave_type_id,NULL,id,user_id,' . $this->user_id,
            'days'=> 'required'
        ]);
        LeaveEntitlement::Create($validated);
        $this->flash('success', 'Leave Entitlement Created Successfully');
        return $this->redirect('/leaveentitlement',navigate:true);
    }

    public function render()
    {
        return view('livewire.admin.leave-entitlement.create-leave-entitlement');
    }
}
