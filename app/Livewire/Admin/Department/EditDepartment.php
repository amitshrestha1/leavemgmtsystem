<?php

namespace App\Livewire\Admin\Department;

use App\Models\Department;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class EditDepartment extends Component
{
    use LivewireAlert;
    public Department $department;
    public $name;
    public function mount(Department $department)
    {
        $this->department = $department;
        $this->name = $department->name;
    }

    public function render()
    {
        return view('livewire.admin.department.edit-department');
    }

    public function updateDepartment()
    {
        $id = $this->department->id;
        $validated = $this->validate([
            'name' => 'required|unique:departments,name,' . $id,
        ]);
        $this->department->update($validated);
        $this->flash('success', 'Edited Successfully');
        return $this->redirect('/department', navigate: true);
    }

    public function cancel(){
        return $this->redirect('/department', navigate: true);
    }
}
