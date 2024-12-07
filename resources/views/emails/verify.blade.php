@component('mail::message')
# Verifica tu correo electrónico

Haz clic en el botón para verificar tu dirección de correo electrónico.

@component('mail::button', ['url' => $url])
Verificar Email
@endcomponent

Gracias,<br>
{{ config('app.name') }}
@endcomponent
