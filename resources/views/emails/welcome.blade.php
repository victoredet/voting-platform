@component('mail::message')
# Hello {{$user['name']}} to our site

It's such a pleasure to have you over with us. Please click on the button below to verify your account and proceed with all our offers

@component('mail::button', ['url' => config('app.url').'/api/email/'.$user['id']])
Verify Email
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
