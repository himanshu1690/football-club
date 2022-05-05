@component('mail::message')
# Welcome, {{ $user->name }}

Your account created successfully.<br>
Your password : <strong>{{ $tempPassword }}</strong>

@component('mail::button', ['url' => route('login')])
Click Here To Login
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
