@component('mail::message')
<p>Assalamualaikum dan Salam Sejahtera.</p>

Tuan/Puan,

<p>Dukacita dimaklumkan bahawa resit yang dimuat naik bagi {{ $data["tajuk_perolehan"] }} [{{ $data["no_perolehan"] }}] <strong>DIBATALKAN<strong>.</p>


@if($data["status_resit"] == "gagal" )
Sila muat naik resit baharu di pautan yang disediakan.
@endif

<p>(Emel makluman ini dijana secara automatik oleh Sistem SPAQS)</p>

@if($data["status_resit"] == "gagal" )
@component('mail::button', ['url' => $data["link"] ])
Pautan Muat Naik Resit Pembayaran
@endcomponent
@endif

Terima Kasih,<br>
{{ config('app.name') }}
@endcomponent
