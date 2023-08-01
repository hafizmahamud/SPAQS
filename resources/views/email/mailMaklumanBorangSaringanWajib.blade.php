@component('mail::message')
<p>Assalamualaikum dan Salam Sejahtera.</p>

Tuan/Puan,

<p>Merujuk perkara di atas adalah dimaklumkan terdapat penghantaran borang saringan wajib bagi projek tersebut:</p>

Tajuk Projek: {{ $data["tajuk_perolehan"] }} <br />
No Perolehan Projek:  {{ $data["no_perolehan"] }} <br />

Berikut adalah maklumat petender:

Nama Syarikat:  {{ $data["nama_syarikat"] }}  <br />
No Syarikat:  {{ $data["no_syarikat"] }}  <br />

<p>(Emel makluman ini dijana secara automatik oleh Sistem SPAQS)</p>


@component('mail::button', ['url' => $data["link"] ])
Lihat Maklumat Petender
@endcomponent

Terima Kasih,<br>
{{ config('app.name') }}
@endcomponent
