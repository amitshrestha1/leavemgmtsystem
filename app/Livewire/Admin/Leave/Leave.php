<?php

namespace App\Livewire\Admin\Leave;

use App\Livewire\Admin\LeaveType\LeaveType;
use App\Mail\LeaveResultMail;
use App\Models\Holiday;
use App\Models\Leave as ModelsLeave;
use App\Models\SelectedMode;
use App\Models\UserLeaveBalance;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Leave extends Component
{
    use LivewireAlert;
    #[Layout('layout.admin-app')]
    public $leaves = [];
    public $leave;
    public $delete_id;
    public $get_id;
    public $reject_id;
    protected $listeners = ['DeleteConfirm' => 'deleteLeave', 'show-delete-button' => 'deleteConfirmation','show-buttons' => 'get', 'approve-leave' => 'approveLeave','reject-leave'=>'rejectLeave'];

    public function mount()
    {
        if (Auth()->user()->role_id == '1') {
            $this->leaves = ModelsLeave::all();
        } else {
            $this->leaves = ModelsLeave::where('user_id', Auth()->user()->id)->get();
        }
    }

    public function render()
    {
        return view('livewire.admin.leave.leave');
    }

    public function deleteConfirmation($id)
    {
        $this->delete_id = $id;
    }

    public function deleteLeave(ModelsLeave $leave)
    {
        $leave = ModelsLeave::where('id', $this->delete_id)->first();
        $leave->delete();
        $this->flash('success', 'Leave Deleted Successfully');
        return $this->redirect(route('admin.leave'), navigate: true);
    }

    public function approveLeave($approvekey)
    {
        $this->get_id = $approvekey;
        $leave = ModelsLeave::where('id', $this->get_id)->first();
        if ($leave) {
            $startDate = Carbon::parse($leave->from);
            $endDate = Carbon::parse($leave->to);
            $diffindays = $startDate->diffInDays($endDate) + 1;
            // Count Days 
            $daysapplied = [];
            while ($startDate->lte($endDate)) {
                // Add the current day's name to the array
                $daysapplied[] = $startDate->englishDayOfWeek;

                // Move to the next day
                $startDate->addDay();
            }
            // dd($daysapplied);
            $holidaymode = SelectedMode::where('status', '1')->get();
            foreach ($holidaymode as $selectedmode) {
                $modes[] = $selectedmode->holidaymode->mode;
            }
            $matchedDays = array_intersect($modes, $daysapplied);
            $weekholiday = count($matchedDays);
            // Find Holidays
            $holidays = Holiday::where(function ($query) use ($leave) {
                $query->where('date', '>=', $leave->from)
                    ->where('date', '<=', $leave->to);
            })->pluck('date');
            $dayNames = [];
            foreach ($holidays as $holidayDate) {
                $dayName = Carbon::parse($holidayDate)->format('l'); // Assuming Carbon is used for date manipulation
                $dayNames[] = $dayName;
            }
            $holidaycount = count($holidays);
            $matched_holidays = array_intersect($matchedDays, $dayNames);
            $count_matched = count($matched_holidays);
            if ($count_matched) {
                $final_count = $holidaycount - $count_matched;
                $diff = $diffindays - $weekholiday -  $final_count;
            } else {
                $diff = $diffindays - $weekholiday -  $holidaycount;
            }
            $userLeaveBalance = UserLeaveBalance::where('user_id', $leave->user_id)
                ->where('leave_type_id', $leave->type_id)
                ->first();
            if (
                $leave->status !== "Approved" &&
                $leave->status !== "Rejected" &&
                $userLeaveBalance &&
                $userLeaveBalance->remaining_days >= $diff
            ) {
                $leave->status = "Approved";
                if ($leave->type == "Half Leave") {
                    $userLeaveBalance->remaining_days = $userLeaveBalance->remaining_days - 0.5;
                    $userLeaveBalance->save();
                } else {

                    // Subtract the approved leave days from the user's leave balance
                    $userLeaveBalance->remaining_days = $userLeaveBalance->remaining_days - $diff;
                    $userLeaveBalance->save();
                }
                $leave->save();
                Mail::to($leave->user->email)->send(new LeaveResultMail($leave));

                $this->flash('success', 'Leave Approved Successfully');
                return $this->redirect(route('admin.leave'), navigate: true);
            } elseif ($leave->status == "Rejected" | $leave->status == "Approved") {
                if ($leave->status == "Approved") {
                    $this->flash('error', 'Leave Already Approved');
                } else {
                    $this->flash('error', 'Leave Already Rejected');
                }

                return $this->redirect(route('admin.leave'), navigate: true);
            } else {
                $this->flash('error', "You don't have enough days");
                return $this->redirect(route('admin.leave'), navigate: true);
            }
        }
        return $this->redirect(route('admin.leave'), navigate: true);
    }

    public function rejectLeave($rejectkey)
    {
        $this->reject_id = $rejectkey;
        $leave = ModelsLeave::where('id', $this->reject_id)->first();
        if ($leave) {
            if ($leave->status !== "Approved" && $leave->status !== "Rejected") {
                $leave->status = "Rejected";
                $leave->save();
                Mail::to($leave->user->email)->send(new LeaveResultMail($leave));
                $this->flash('success', 'Leave Rejected Successfully');
                return $this->redirect(route('admin.leave'), navigate: true);
            } else if ($leave->status == "Rejected") {

                $this->flash('error', 'Leave Already Rejected');
                return $this->redirect(route('admin.leave'), navigate: true);
            } else {
                $this->flash('error', 'Leave Already Approved');
                return $this->redirect(route('admin.leave'), navigate: true);
            }
        }

        return $this->redirect(route('leave.list'), navigate: true);
    }

    public function refreshtable()
    {
        $this->mount();
    }
}
