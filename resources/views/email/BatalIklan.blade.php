@component('mail::message')
<p>Assalamualaikum dan Salam Sejahtera.</p>



Tuan/Puan,



<p>Adalah dimaklumkan bahawa nombor perolehan {{ $data["no_perolehan"] }}  telah dibatalkan.</p>




<p>(Emel makluman ini dijana secara automatik oleh Sistem SPAQS)</p>


Terima Kasih,<br>
{{ config('app.name') }}
@endcomponent
