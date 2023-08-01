@component('mail::message')
<p>Assalamualaikum dan Salam Sejahtera.</p>



Tuan/Puan,



<p>Adalah dimaklumkan bahawa nombor perolehan {{ $data["no_perolehan"] }}  telah diiklankan.</p>





<p>(Emel makluman ini dijana secara automatik oleh Sistem SPAQS)</p>

@if ($data["link_lawatantapak"] != '')
@component('mail::button', ['url' => config('app.url') . $data["link_lawatantapak"] ])
Pautan Lawatan Tapak
@endcomponent
@endif

Terima Kasih,<br>
{{ config('app.name') }}
@endcomponent
