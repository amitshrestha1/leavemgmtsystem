<?php

namespace App\Livewire\Admin\LeaveType;

use App\Models\LeaveType;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class CreateLeaveType extends Component
{
    use LivewireAlert;
    public $name, $days;

    public function render()
    {
        return view('livewire.admin.leave-type.create-leave-type');
    }

    public function createType(){
        $validated= $this->validate([
            'name'=>'required|unique:leave_types',
        ]);
        LeaveType::create([
            'name' => $this->name,
        ]);
        $this->flash('success','Leave Type Created Successfully');
        return $this->redirect('/type', navigate: true);
    }
}
