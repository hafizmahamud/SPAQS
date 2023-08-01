@component('mail::message')
# Makluman Pendaftaran Pengguna Baru

Merujuk perkara di atas adalah dimaklumkan akaun SPAQS anda telah dicipta. Sila log masuk ke SPAQS dengan password dibawah,
dan ubah kata laluan anda segera.


Alamat Email: {{ $mailto }} <br />
Kata Laluan: <b> {{ $password }} </b>


@component('mail::button', ['url' => config('app.url') . $url])
Log Masuk
@endcomponent

Terima Kasih,<br>
{{ config('app.name') }}
@endcomponent
