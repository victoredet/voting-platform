@component('mail::message')
# Hello to our site

It's such a pleasure to have you over with us. Please click on the button below to verify your account and proceed with all our offers

@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
