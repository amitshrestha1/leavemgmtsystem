<?php

namespace App\Livewire\Admin\Department;

use App\Models\Department;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Departments extends Component
{   
    use LivewireAlert;
    #[Layout('layout.admin-app')]
    public $departments = [];
    public $delete_id;
    protected $listeners = ['DeleteConfirm'=>'deleteDepartment','show-delete-button'=>'deleteConfirmation'];

    // public function mount(){
    // $this->departments = Department::all();
    // }
    public function render()
    {
        return view('livewire.admin.department.departments');
    }

    public function deleteConfirmation($id){
        $this->delete_id = $id;
    }

    public function deleteDepartment(){
        $department = Department::where('id',$this->delete_id)->first();
        $department->delete();
        $this->flash('success', 'Department Deleted Successfully');
        return $this->redirect('/department',navigate:true);
    }
}
