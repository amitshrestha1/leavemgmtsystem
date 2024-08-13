<?php

namespace App\Livewire\Admin\Auth;

use App\Models\User;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Layout;
use Livewire\Component;

class ResetPassword extends Component
{
    use LivewireAlert;
    #[Layout('layout.login-app')]
    public $token;
    public $password, $password_confirmation, $user;

    public function mount($token)
    {
        $this->token = $token;
    }

    public function reset_password()
    {
        $user = User::where('remember_token',$this->token)->first();
        $validated = $this->validate([
            'password'=>'required|min:8|max:24|same:password_confirmation',
            'password_confirmation'=>'required'
        ]);
        $user->update($validated);
        $this->flash("success","Password Reset Successfull!");
        return $this->redirect(route('login'),navigate:true);
    }

    public function render()
    {
        return view('livewire.admin.auth.reset-password');
    }
}
