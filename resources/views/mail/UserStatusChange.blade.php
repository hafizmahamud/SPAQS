@component('mail::message')
# Status Permohonan Pendaftaran

Merujuk perkara di atas adalah dimaklumkan akaun SPAQS anda telah diaktifkan.


@component('mail::button', ['url' => config('app.url') . $url])
Log Masuk
@endcomponent

Terima Kasih,<br>
{{ config('app.name') }}
@endcomponent
