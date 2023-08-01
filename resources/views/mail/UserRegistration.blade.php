@component('mail::message')
# Permohonan Pendaftaran SPAQS

Merujuk perkara di atas adalah dimaklumkan terdapat permohonan pendaftaran pengguna baru bagi SPAQS.

Berikut adalah maklumat pendaftaran pemohon:

Nama: {{ $name }} <br />
No IC: {{ $ic_no }} <br />
Email: {{ $email }} <br />

@component('mail::button', ['url' => config('app.url') . $url])
Aktifkan Pengguna
@endcomponent

Terima Kasih,<br>
{{ config('app.name') }}
@endcomponent
