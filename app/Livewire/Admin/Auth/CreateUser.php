<?php

namespace App\Livewire\Admin\Auth;

use App\Models\Department;
use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\Features\SupportNavigate\SupportNavigate;
use Livewire\WithFileUploads;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;

class CreateUser extends Component
{
    use LivewireAlert;
    use WithFileUploads;
    #[Layout('layout.admin-app')]

    public $name, $email, $password, $password_confirmation, $image;
    public $department_id=null;
    public $role_id = null;

    public $department = [];
    public $role = [];

    protected $rules = [
        'email' => 'required|unique:users',
        'password' => 'required|min:8|max:24|confirmed',
        'password_confirmation' => 'required',
        // 'image' => 'mimes:jpeg,png,jpg,gif|max:2048',
        'name' => 'required|unique:users',
        'department_id' => 'required',
        'role_id'=>'required'
    ];


    public function mount()
    {
        $this->department = Department::all();
        $this->role = Role::where('name','!=','SuperAdmin')->get();
    }

    public function create_user()
    {
        $validated = $this->validate();
        if($this->image){
           $imagePath= $this->image->store('profile','public');
           $validated['image'] = $imagePath;
        }
        $user =User::create($validated);
        $role_id = $this->role_id;
        $role = Role::where('id',$role_id)->first();
        $user->assignRole($role);



        $this->flash('success', 'Account Created Successfully');
        return $this->redirect(route('admin.user'), navigate: true);
    }

    public function render()
    {
        return view('livewire.admin.auth.create-user');
    }
}
