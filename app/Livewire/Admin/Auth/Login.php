<?php

namespace App\Livewire\Admin\Auth;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Layout;

class Login extends Component
{
    use LivewireAlert;
    #[Layout('layout.login-app')]
    public $email, $password;
    public function login()
    {
        $validatedDate = $this->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt(['email' => $this->email, 'password' => $this->password])) {
            $this->flash('success', 'Login Successfull');
            return $this->redirect(route('admin.dashboard'), navigate: true);
        } else {
            $this->flash('error', 'Wrong Credentials');
            return $this->redirect(route('login'), navigate: true);
        }
    }

    public function render()
    {
        return view('livewire.admin.auth.login');
    }
}
