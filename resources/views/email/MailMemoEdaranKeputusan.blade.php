@component('mail::message')

Merujuk perkara di atas adalah dimaklumkan terdapat Memo Edaran Keputusan yang memerlukan perhatian.

Bersama-sama emel ini disertakan pautan ke dokumen berikut untuk tindakan selanjutnya.

<span style="display: inline;">

@component('mail::button', ['url' => $dataP1 ])
Muat turun Memo Edaran Keputusan MLP
@endcomponent

</span>

Terima Kasih,<br>
{{ config('app.name') }}
@endcomponent
