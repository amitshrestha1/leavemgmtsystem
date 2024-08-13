<?php

namespace App\Livewire\Admin\HolidayMode;

use App\Models\HolidayMode as ModelsHolidayMode;
use App\Models\SelectedMode;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;


class HolidayMode extends Component
{
    use LivewireAlert;
    #[Layout('layout.admin-app')]
    public $modes=[];
    public $selected_modes=[];
    public $display_selected_mode;

    public function mount(){
        $this->modes= ModelsHolidayMode::all();
        $this->display_selected_mode = SelectedMode::where('status','1')->get();
    }

    public function render()
    {
        return view('livewire.admin.holiday-mode.holiday-mode');
    }

    public function select()
    {
        $this->selected_modes;
        SelectedMode::truncate();
        foreach ($this->selected_modes as $modes) {
            SelectedMode::create([
                'mode_id'=>$modes,
                'status'=> true,
            ]);
        }
        $this->flash('success','Mode Applied Successfully');
        return $this->redirect(route('admin.mode'),navigate:true);
        
    }
}
