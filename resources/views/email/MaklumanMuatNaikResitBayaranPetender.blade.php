@component('mail::message')
<p>Assalamualaikum dan Salam Sejahtera.</p>

Tuan/Puan,

<p>Resit bayaran bagi {{ $data["tajuk_perolehan"] }} [{{ $data["no_perolehan"] }}] telah diterima pada {{ $data["masa_upload"] }}.</p><br>
<p>Sila tunggu pengesahan daripada Pentadbir sistem.</p>

<p>(Emel makluman ini dijana secara automatik oleh Sistem SPAQS)</p>

Terima Kasih,<br>
{{ config('app.name') }}
@endcomponent
