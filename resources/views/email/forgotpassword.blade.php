@component('mail::message')
    <p>Hello {{$user->name}}</p>
    <p>Your forgot password link is below!</p>
@component('mail::button',['url'=>url('reset/'.$user->remember_token)])
Reset Your Password
@endcomponent
<p>Thank you!</p><br>
{{config('app.name')}}
@endcomponent