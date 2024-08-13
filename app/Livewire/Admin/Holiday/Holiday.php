<?php

namespace App\Livewire\Admin\Holiday;

use App\Models\Holiday as ModelsHoliday;
use App\Models\HolidayMode;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;


class Holiday extends Component
{
    use LivewireAlert;
    #[Layout('layout.admin-app')]
    public $holidays = [];
    public $delete_id;
    protected $listeners = ['DeleteConfirm'=>'deleteHoliday','show-delete-button'=>'deleteConfirmation'];
    

    public function mount()
    {
        $this->holidays = ModelsHoliday::all();
    }

    public function render()
    {
        return view('livewire.admin.holiday.holiday');
    }

    public function deleteConfirmation($id)
    {
        $this->delete_id = $id;
    }

    public function deleteHoliday(ModelsHoliday $holiday)
    {
        $holiday = ModelsHoliday::where('id',$this->delete_id)->first();
        $holiday->delete();
        $this->flash('success', 'Holiday Deleted Successfully');
        return $this->redirect(route('admin.holiday'), navigate: true);
    }
}
