@component('mail::message')
    <h1>Hello {{$leave->user->name}},</h1>
    <h2>Leave Details:</h2><br>
    <p>Leave Type: {{$leave->types->name}}</p>
    <p>Leave Reason: {{$leave->reason}}</p>
    <p>From: {{$leave->from}}</p>
    <p>To: {{$leave->to}}</p><br>
    <h2>Your Leave has been {{$leave->status}}!</h2>
    {{ config('app.name') }}
@endcomponent