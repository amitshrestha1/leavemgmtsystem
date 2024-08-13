<?php

namespace App\Livewire\Admin\Auth;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;


class Logout extends Component
{   
    use LivewireAlert;
    public function logout()
    {
        Auth::logout();
        $this->flash('success', 'Logged Out!');
        return redirect()->route('login');
    }
    public function render()
    {
        return view('livewire.admin.auth.logout');
    }
}
