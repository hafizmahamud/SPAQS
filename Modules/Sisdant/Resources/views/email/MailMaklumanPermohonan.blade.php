@component('mail::message')
<p>Assalamualaikum dan Salam Sejahtera.</p>

Tuan/Puan,

<p>Terdapat satu permohonan nombor perolehan baharu. Sila layari butang di bawah untuk tindakan selanjutnya.</p>

@component('mail::button', ['url' => config('app.url') . $url])
Permohonan baharu
@endcomponent

Terima Kasih,<br>
{{ config('app.name') }}
@endcomponent
