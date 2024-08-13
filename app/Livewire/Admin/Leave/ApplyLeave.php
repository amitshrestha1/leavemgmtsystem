<?php

namespace App\Livewire\Admin\Leave;

use App\Mail\LeaveMail;
use App\Models\Leave;
use App\Models\LeaveEntitlement;
use App\Models\LeaveType;
use App\Models\User;
use App\Models\UserLeaveBalance;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class ApplyLeave extends Component
{
    use LivewireAlert;
    public $type_id = null;
    public $user_id = null;
    public $typen = null;
    public $reason, $from, $to;
    public $type = [];
    public $users = [];
    public $userleaveBalance = [];
    public $remainingDays = [];
    public $remainingDays1 = [];
    public $typeid;
    protected $listeners = ['SelectedUser' => 'handleSelectedUser', 'SelectedType' => 'handleSelectedType'];
    public $selected_user;
    public $selected_type;
    public $find;
    public $find_type;


    public function mount()
    {
        $this->type = LeaveType::all();
        $this->users = User::where('role_id', '!=', '1')->get();
        $userId = Auth()->user()->id;
        $userLeaveBalances = UserLeaveBalance::where('user_id', $userId)->get();
        foreach ($this->type as $leavetype) {
            $balance = $userLeaveBalances->where('leave_type_id', $leavetype->id)->first();
            $entitlement = LeaveEntitlement::where('user_id', $userId)->where('leave_type_id', $leavetype->id)->first();

            if ($balance) {
                $this->remainingDays[$leavetype->id] = [
                    'name' => $leavetype->name,
                    'days' => $balance->remaining_days,
                ];
            } else if ($entitlement) {
                $this->remainingDays[$leavetype->id] = [
                    'name' => $leavetype->name,
                    'days' => $entitlement->days,
                ];
            } else {
                $this->remainingDays[$leavetype->id] = [
                    'name' => $leavetype->name,
                    'days' => $leavetype->days,
                ];
            }
        }
    }


    public function render()
    {
        return view('livewire.admin.leave.apply-leave');
    }

    public function applyLeave()
    {
        $user_id = Auth()->user()->id;
        $validated = $this->validate([
            'type_id' => 'required',
            'typen' => 'required',
            'reason' => 'required',
            'from' => 'required|date|after:yesterday',
            'to' => 'required|date|after_or_equal:from',
        ]);
        $weekleavecheck = Leave::where('user_id', $user_id)
            ->whereBetween('from', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
            ->exists();
        if ($weekleavecheck) {
            $this->flash('warning', 'You have already applied leave this week!');
            return $this->redirect(route('admin.applyleave'), navigate: true);
        }
        $startDate = Carbon::parse($this->from);
        $endDate = Carbon::parse($this->to);
        $diff = $startDate->diffInDays($endDate) + 1;
        $balance = UserLeaveBalance::where('leave_type_id', $this->type_id)->where('user_id',Auth()->user()->id)->first();
        if ($balance) {
            if ($balance->remaining_days < $diff) {
                $this->flash('warning', 'You have less remaining days');
                return $this->redirect(route('admin.applyleave'), navigate: true);
            }
        }
        Leave::create([
            'type_id' => $this->type_id,
            'type' => $this->typen,
            'reason' => $this->reason,
            'from' => $this->from,
            'to' => $this->to,
            'user_id' => $user_id,
        ]);
        $leave_type = LeaveType::find($this->type_id);
        $userleaveBalance = UserLeaveBalance::where('user_id', $user_id)->where('leave_type_id', $leave_type->id)->first();
        $entitlement = LeaveEntitlement::where('user_id', Auth()->user()->id)->where('leave_type_id', $leave_type->id)->first();
        if (!$userleaveBalance) {
            if ($entitlement) {
                UserLeaveBalance::create([
                    'user_id' => $user_id,
                    'leave_type_id' => $this->type_id,
                    'remaining_days' => $entitlement->days,

                ]);
            } else {
                UserLeaveBalance::create([
                    'user_id' => $user_id,
                    'leave_type_id' => $this->type_id,
                    'remaining_days' => $leave_type->days,

                ]);
            }

            $admin = User::whereIn('role_id', [1, 2])->get();
            $username = User::where('id', Auth()->user()->id)->first();
            $typename = LeaveType::where('id', $this->type_id)->first();
            $leave = (object)[
                'type' => $typename->name,
                'reason' => $this->reason,
                'from' => $this->from,
                'to' => $this->to,
                'user' => $username->name,
            ];
            foreach ($admin as $admin) {
                $email = $admin->email;
                Mail::to($email)->send(new LeaveMail($leave));
            }

            $this->flash('success', 'Leave Applied Successfully');
            return $this->redirect(route('admin.leave'), navigate: true);
        }
    }
    public function applyleaveasAdmin()
    {
        $user = $this->find;
        $validationRules = [
            'user_id' => 'required',
            'type_id' => 'required',
            'reason' => 'required',
            'from' => 'required|date|unique:leaves',
            'to' => 'required|date|after_or_equal:from'
        ];
        $weekleavecheck = Leave::where('user_id', $user->id)
            ->whereBetween('from', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
            ->exists();
        if ($weekleavecheck) {
            $this->flash('warning', 'You have already applied leave this week!');
            return $this->redirect(route('admin.applyleave'), navigate: true);
        }
        $startDate = Carbon::parse($this->from);
        $endDate = Carbon::parse($this->to);
        $diff = $startDate->diffInDays($endDate) + 1;
        $balance = UserLeaveBalance::where('leave_type_id', $this->type_id)->where('user_id', $user->id)->first();
        if ($balance) {
            if ($balance->remaining_days < $diff) {
                $this->flash('warning', 'You have less remaining days');
                return $this->redirect(route('admin.applyleave'), navigate: true);
            }
        }
        Leave::create([
            'type_id' => $this->type_id,
            'type' => $this->typen,
            'reason' => $this->reason,
            'from' => $this->from,
            'to' => $this->to,
            'user_id' => $this->user_id,
            'status' => 'Approved',
        ]);

        $leave_type = LeaveType::find($this->type_id);

        $userleaveBalance = UserLeaveBalance::where('user_id', $this->user_id)
            ->where('leave_type_id', $this->type_id)
            ->first();
        $entitlement = LeaveEntitlement::where('user_id', $this->user_id)->where('leave_type_id', $leave_type->id)->first();

        if (!$userleaveBalance) {

            if ($entitlement) {
                UserLeaveBalance::create([
                    'user_id' => $this->user_id,
                    'leave_type_id' => $this->type_id,
                    'remaining_days' => $entitlement->days,

                ]);
            } else {
                UserLeaveBalance::create([
                    'user_id' => $this->user_id,
                    'leave_type_id' => $this->type_id,
                    'remaining_days' => $leave_type->days,

                ]);
            }
        }
        $admin = User::whereIn('role_id', [1, 2])->get();
        $username = User::where('id', $user->id)->first();
        $typename = LeaveType::where('id', $this->type_id)->first();
        $leave = (object)[
            'type' => $typename->name,
            'reason' => $this->reason,
            'from' => $this->from,
            'to' => $this->to,
            'user' => $username->name,
        ];
        foreach ($admin as $admin) {
            $email = $admin->email;
            Mail::to($email)->send(new LeaveMail($leave));
        }

        $this->flash('success', 'Leave Applied Successfully');
        return $this->redirect(route('admin.leave'), navigate: true);
    }

    public function handleSelectedUser($selectedOptionId)
    {
        $this->user_id = $selectedOptionId;
        $this->find = User::where('id', $selectedOptionId)->first();
        $userId = $this->user_id;
        $user = $this->find;
        if ($userId) {
            $userLeaveBalances = UserLeaveBalance::where('user_id', $userId)->get();

            foreach ($this->type as $leavetype) {
                $balance = $userLeaveBalances->where('leave_type_id', $leavetype->id)->first();
                $entitlement = LeaveEntitlement::where('user_id', $userId)->where('leave_type_id', $leavetype->id)->first();
                if ($balance) {
                    $this->remainingDays1[$leavetype->id] = [
                        'name' => $leavetype->name,
                        'days' => $balance->remaining_days,
                    ];
                } else if ($entitlement) {
                    $this->remainingDays1[$leavetype->id] = [
                        'name' => $leavetype->name,
                        'days' => $entitlement->days,
                    ];
                } else {
                    $this->remainingDays1[$leavetype->id] = [
                        'name' => $leavetype->name,
                        'days' => $leavetype->days,
                    ];
                }
            }
        }
    }

    public function handleSelectedType($selectedOptionId)
    {
        $this->selected_type = $selectedOptionId;
    }

    public function hello()
    {
        $this->to = $this->from;
    }
}
