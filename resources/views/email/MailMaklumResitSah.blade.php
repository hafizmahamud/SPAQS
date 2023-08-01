@component('mail::message')
<p>Assalamualaikum dan Salam Sejahtera.</p>

Tuan/Puan,

<p>Sukacita dimaklumkan bahawa resit bagi {{ $data["tajuk_perolehan"] }} [{{ $data["no_perolehan"] }}] adalah sah.</p>


@foreach($arrayTender as  $indexKey =>$arrayTender)
@component('mail::button', ['url' => $arrayTender])
Muat Turun Dokumen Tender {{$indexKey+1}}
@endcomponent
@endforeach

@foreach($arrayAddendum as  $indexKey =>$arrayAddendum)
@component('mail::button', ['url' => $arrayAddendum ])
Muat Turun Dokumen Tambahan {{$indexKey+1}}
@endcomponent
@endforeach

<p>(Emel makluman ini dijana secara automatik oleh Sistem SPAQS)</p>

Terima Kasih,<br>
{{ config('app.name') }}
@endcomponent
