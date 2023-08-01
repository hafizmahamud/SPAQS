@component('mail::message')
<p>Assalamualaikum dan Salam Sejahtera.</p>

Tuan/Puan,

<p>Sukacita dimaklumkan bahawa terdapat Penambahan Dokumen bagi:</p>
Tajuk : <strong>{{ $data["tajuk_perolehan"] }}</strong>
No Perolehan : <strong>{{ $data["no_perolehan"] }}</strong>

Dilampirkan dokumen-dokumen berkaitan untuk proses selanjutnya.

<p>(Emel makluman ini dijana secara automatik oleh Sistem SPAQS)</p>

@foreach($arrayAddendum as  $indexKey =>$arrayAddendum)
@component('mail::button', ['url' => $arrayAddendum])
Muat Turun Dokumen Tambahan {{$indexKey+1}}
@endcomponent
@endforeach

Terima Kasih,<br>
{{ config('app.name') }}
@endcomponent
