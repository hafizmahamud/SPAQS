@component('mail::message')
<p>Assalamualaikum dan Salam Sejahtera.</p>

Tuan/Puan,

<p>Sukacita dimaklumkan bahawa Pendaftaran Tender bagi {{ $data["tajuk_perolehan"] }} [{{ $data["no_perolehan"] }}] adalah </p><p style="font-weight:bold">BERJAYA.</p>

Dilampirkan dokumen-dokumen berkaitan untuk proses selanjutnya.

@component('mail::button', ['url' => $data["coverDokumen"] ])
Cover Dokumen
@endcomponent

@if($data["dokumenIklan"] != "")
@component('mail::button', ['url' => $data["dokumenIklan"] ])
Dokumen Iklan
@endcomponent
@endif

Bagi urusan Dokumen Tender, sila ambil di kaunter: <br>
{{ $data["alamat"] }}


<p>(Emel makluman ini dijana secara automatik oleh Sistem SPAQS)</p>


Terima Kasih,<br>
{{ config('app.name') }}
@endcomponent
