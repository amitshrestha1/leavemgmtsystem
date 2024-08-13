@component('mail::message')
    <h1>Hello Admin,</h1>
    <h2>{{ $leave->user }} has applied for a leave</h2>
    <p>Leave Type: {{ $leave->type}}</p>
    <p>Reason: {{ $leave->reason }}</p>
    <p>From: {{ $leave->from }}</p>
    <p>To: {{ $leave->to }}</p>
    <p>Thank you!</p><br>
    {{ config('app.name') }}
@endcomponent
