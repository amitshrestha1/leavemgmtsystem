<?php

namespace App\Livewire\Components;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Navbar extends Component
{
    use LivewireAlert;
    public $currenttime;
    public $user;

    public function mount(){
        $this->currenttime = now();
        $this->user = User::where('id',Auth()->user()->id)->first();

    }
    public function render()
    {
        return view('livewire.components.navbar');
    }

    public function logout()
    {
        Auth::logout();
        $this->flash('success', 'Logged Out!');
        return redirect()->route('login');
    }
}
