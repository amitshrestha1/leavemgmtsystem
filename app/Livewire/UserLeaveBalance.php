<?php

namespace App\Livewire;

use App\Livewire\Admin\LeaveEntitlement\LeaveEntitlement;
use App\Models\LeaveEntitlement as ModelsLeaveEntitlement;
use App\Models\LeaveType;
use App\Models\User;
use App\Models\UserLeaveBalance as ModelsUserLeaveBalance;
use Livewire\Component;

class UserLeaveBalance extends Component
{
    public $remainingDays;
    public $type = [];
    public $users = [];
    public $userLeaveBalances = [];
    public $user=[];

    public function mount()
    {
        $this->userLeaveBalances = ModelsUserLeaveBalance::all();
        $this->type = LeaveType::all();
        $this->users = User::where('role_id','!=','1')->get();
        foreach($this->users as $user){
        foreach ($this->type as $leavetype) {
            $balance = $this->userLeaveBalances->where('user_id',$user->id)->where('leave_type_id', $leavetype->id)->first();
            $entitlement = ModelsLeaveEntitlement::where('user_id',$user->id)->where('leave_type_id', $leavetype->id)->first();

            if ($balance) {
                $this->remainingDays[$leavetype->id]['user'][$balance->user_id] = [
                    'name' => $leavetype->name,
                    'days' => $balance->remaining_days,
                ];
                // dd( $this->remainingDays[$leavetype->id]['user'][$entitlement->user_id]);
            } else if($entitlement) {
                $this->remainingDays[$leavetype->id]['user'][$entitlement->user_id] = [
                    'name' => $leavetype->name,
                    'days' => $entitlement->days,
                ];
                
            }else{
                $this->remainingDays[$leavetype->id]['user'][$user->id] = [
                    'name' => $leavetype->name,
                    'days' => $leavetype->days,
                ];
                
            }
        }
    }
}

    public function render()
    {
        return view('livewire.user-leave-balance');
    }
}
