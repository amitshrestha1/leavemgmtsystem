<?php

namespace App\Livewire\Admin\Auth;

use App\Models\Department;
use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithPagination;

class Users extends Component
{   
    use LivewireAlert;
    #[Layout('layout.admin-app')]
    // public $users = [];
    // public $departments = [];
    public $delete_id;
    protected $listeners = ['DeleteConfirm'=>'deleteUser','show-delete-button'=>'deleteConfirmation'];

    // public function mount()
    // {
    //     // $this->users=User::where('usertype','staff')->get();
    //     // $this->departments = Department::all();
    // }

    public function render()
    {
        return view('livewire.admin.auth.users');
    }
    public function deleteConfirmation($id){
        $this->delete_id = $id;
    }
    public function deleteUser()
    {
        $user = User::where('id',$this->delete_id)->first();
        $user->delete();
        $this->flash('success','User Deleted Successfully');
        return $this->redirect('/user',navigate:true);
    }
}
