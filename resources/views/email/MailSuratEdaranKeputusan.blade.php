@component('mail::message')

Merujuk perkara di atas adalah dimaklumkan terdapat Surat Edaran Keputusan ML yang memerlukan perhatian.

Bersama-sama emel ini disertakan pautan ke dokumen berikut untuk tindakan selanjutnya.

<span style="display: inline;">

@component('mail::button', ['url' => $dataP1 ])
Muat turun Surat Edaran Keputusan MLP
@endcomponent

</span>

Terima Kasih,<br>
{{ config('app.name') }}
@endcomponent
