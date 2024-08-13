<?php

namespace App\Livewire\Admin\Auth;

use App\Models\Department;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithFileUploads;

class EditUser extends Component
{
    use WithFileUploads;
    use LivewireAlert;
    public User $user;
    public $name, $email, $password, $id, $image;
    public $department_id = null;
    public $role_id = null;
    public $password_confirmation;
    public $department = [];
    public $role = [];
    protected $listeners = ['admin-edituser'=>'render'];



    public function mount(User $user, Department $department)
    {
        $this->user = $user;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->image = $user->image;
        $this->department_id = $user->department_id;
        $this->role_id = $user->role_id;
        $this->department = Department::all();
        $this->role = Role::where('name','!=','SuperAdmin')->get();
    }


    public function render()
    {
        return view('livewire.admin.auth.edit-user');
    }

    public function updateUser()
    {
        $user = User::findOrFail($this->user->id);

        // Prepare data for updating
        $userData = [
            'name' => $this->name,
            'email' => $this->email,
            'department_id' => $this->department_id,
            'role_id'=> $this->role_id
        ];

        // Check if a new password is provided
        if (!empty($this->password)) {
            $userData['password'] = bcrypt($this->password);
        }

        // Check if a new image is provided
        if ($this->image && $this->image !== $user->image) {
            // Delete the old image if it exists
            if ($user->image) {
                Storage::disk('public')->delete($user->image);
            }

            // Store the new image
            $imagePath = $this->image->store('profile', 'public');

            // Update the user with the new image path
            $userData['image'] = $imagePath;
        }

        // Update the user with the prepared data
        $user->update($userData);

        $this->flash('success', 'User Updated Successfully');
        return $this->redirect('/user', navigate: true);
    }

}
