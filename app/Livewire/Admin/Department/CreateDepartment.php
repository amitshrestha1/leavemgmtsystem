<?php

namespace App\Livewire\Admin\Department;

use App\Models\Department;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;


class CreateDepartment extends Component
{
    use LivewireAlert;
    #[Layout('layout.admin-app')]
    public $name;
    public function create_department(){
        $validated = $this->validate([
            'name' => 'required|unique:departments',
        ]);
        Department::Create([
            'name' =>$this->name,
        ]);
        $this->flash('success', 'Department Created Successfully');
        return $this->redirect('/department',navigate:true);
    }
    public function render()
    {
        return view('livewire.admin.department.create-department');
    }
}
