<?php

namespace App\Livewire\Admin\Calendar;

use App\Models\Holiday;
use App\Models\Leave;
use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Calendar extends Component
{
    public $holidayevent = '';
    public $leaveevent = '';
    public $users = '';
    public function mount()
    {
        $this->holidayevent = Holiday::all();
        $this->leaveevent = Leave::with('user')->with('types')->get();
        $this->users = User::where('id', Auth()->user()->id)->with('role')->get();
    }

    public function render()
    {
        return view('livewire.admin.calendar.calendar');
    }
}
