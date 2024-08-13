<?php

namespace App\Livewire\Admin\Dashboard;

use App\Models\Department;
use App\Models\Leave;
use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\Layout;


class Dashboard extends Component
{
    #[Layout('layout.admin-app')]
    public $leaves = [];
    public $countleaves;
    public $countdepartment;
    public $countstaff;
    

    public function mount(){
        if (Auth()->user()->role->name=='SuperAdmin'||Auth()->user()->role->name=='Admin') {
            $this->leaves = Leave::all();
            $this->countleaves = Leave::count();
            $this->countdepartment = Department::count();
            $this->countstaff = User::whereHas('role',function($query){
                $query->where('name','Staff');
            })->count();
        }
        else{
            $this->leaves = Leave::where('user_id',Auth()->user()->id)->get();
            $this->countleaves = Leave::where('user_id',Auth()->user()->id)->count();
        }
    }

    public function render()
    {
        return view('livewire.admin.dashboard.dashboard');
    }
}
