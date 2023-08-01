@component('mail::message')

<p>Assalamualaikum dan Salam Sejahtera.</p>

Tuan/Puan,

@if ($jenisLawatanTapak != 'TIDAK_WAJIB')
<p> Borang lawatan tapak anda telah berjaya dihantar.Dibawah adalah no siri kehadiran dan link daftar borang saringan wajib untuk rujukan tuan/puan. </p>
<br>
<p style="font-size: 18px;" >No Siri Kehadiran: <b>{{$no_siri}} </b> </p>

@component('mail::button', ['url' => $borang_daftar ])
Borang Saringan Wajib
@endcomponent

Sila isi borang saringan wajib sebelum jam 12 tengah malam.
@endif

@if ($jenisLawatanTapak == 'TIDAK_WAJIB')
<p> Borang pendaftaran kontraktor anda telah berjaya dihantar.Dibawah adalah no siri kehadiran dan link daftar borang saringan wajib untuk rujukan tuan/puan. </p>
<br>
<p style="font-size: 18px;" >No Siri Kehadiran: <b>{{$no_siri}} </b> </p>

@component('mail::button', ['url' => $borang_daftar ])
Borang Saringan Wajib
@endcomponent

Sila isi borang saringan wajib sebelum {{ $dateBukaIklanAddTwoDays }} jam 12 tengah malam.
@endif
<br>
<br>
Terima Kasih,<br>
{{ config('app.name') }}

@endcomponent