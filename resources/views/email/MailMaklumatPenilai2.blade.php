@component('mail::message')
# Notifikasi Penilaian Laporan Tender 

Merujuk perkara di atas adalah dimaklumkan terdapat penilaian tender yang memerlukan perhatian.

Bersama-sama emel ini disertakan pautan ke dokumen berikut untuk tindakan selanjutnya.

<span style="display: inline;">

@component('mail::button', ['url' => $dataP2["memo_lantikan"] ])
Memo Lantikan
@endcomponent

@component('mail::button', ['url' => $dataP2["borang_tindakan"] ])
Borang Tindakan
@endcomponent

@component('mail::button', ['url' => $dataP2["surat_akuan_pelantikan"] ])
Surat Akuan Pelantikan
@endcomponent

@component('mail::button', ['url' => $dataP2["surat_akuan_selesai_tugas"] ])
Surat Akuan Selesai Tugas
@endcomponent

</span>

Terima Kasih,<br>
{{ config('app.name') }}
@endcomponent
