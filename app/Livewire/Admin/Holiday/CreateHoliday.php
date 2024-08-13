<?php

namespace App\Livewire\Admin\Holiday;

use App\Models\Holiday;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;


class CreateHoliday extends Component
{
    use LivewireAlert;
    public $name, $date;

    public function render()
    {
        return view('livewire.admin.holiday.create-holiday');
    }

    public function createHoliday(){
        $validated= $this->validate([
            'name'=>'required|unique:holidays',
            'date'=>'required|date|unique:holidays'
        ]);
        Holiday::create([
            'name'=>$this->name,
            'date'=>$this->date
        ]);
        $this->flash('success', 'Holiday Created Successfully');
        return $this->redirect(route('admin.holiday'),navigate:true);   
    }
}
