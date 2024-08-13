<?php

namespace App\Livewire\Admin\Auth;

use App\Mail\SendForgotPasswordMail;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Illuminate\Support\Str;
class ForgotPasswordEmail extends Component
{
    use LivewireAlert;
    #[Layout('layout.login-app')]
    public $email;
    public $user;
    public function SendMail()
    {
        $user = User::where('email',$this->email)->first();
        if(!$user)
        {
            $this->flash("error","Email not found");
            return $this->redirect(route('admin.sendlink'),navigate:true);
        }
        else{
            $user->remember_token = Str::random(40);
            $user->save();
            Mail::to($this->email)->send(new SendForgotPasswordMail($user));   
            $this->flash("success","Password Reset Email Sent");        
            return $this->redirect(route('admin.sendlink'),navigate:true);
        }
    }

    public function render()
    {
        return view('livewire.admin.auth.forgot-password-email');
    }
}
