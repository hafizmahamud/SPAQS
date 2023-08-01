@component('mail::message')
<p>Assalamualaikum dan Salam Sejahtera.</p>

Tuan/Puan,

<p>Dukacita dimaklumkan bahawa Pendaftaran Tender bagi {{ $data["tajuk_perolehan"] }} [{{ $data["no_perolehan"] }}] adalah </p><p style="font-weight:bold"> TIDAK BERJAYA.</p>

<p>(Emel makluman ini dijana secara automatik oleh Sistem SPAQS)</p>

Terima Kasih,<br>
{{ config('app.name') }}
@endcomponent
