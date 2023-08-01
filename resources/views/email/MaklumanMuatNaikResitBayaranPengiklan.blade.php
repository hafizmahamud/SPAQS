@component('mail::message')
<p>Assalamualaikum dan Salam Sejahtera.</p>

Tuan/Puan,

<p>Merujuk perkara di atas, terdapat satu resit bayaran telah dimuat naik bagi:</p> <br>

Tajuk: <strong>{{ $data["tajuk_perolehan"] }}</strong><br />
No Perolehan: <strong>{{ $data["no_perolehan"] }}</strong><br />

Berikut adalah maklumat petender:

Nama Syarikat:  <strong>{{ $data["nama_syarikat"] }}</strong>  <br />
No Syarikat:  <strong>{{ $data["no_syarikat"] }}</strong>  <br />

<p>(Emel makluman ini dijana secara automatik oleh Sistem SPAQS)</p>

@component('mail::button', ['url' => $data["link"] ])
Pautan Pengesahan Resit Bayaran
@endcomponent

Terima Kasih,<br>
{{ config('app.name') }}
@endcomponent
