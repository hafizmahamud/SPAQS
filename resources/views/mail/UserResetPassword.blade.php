@component('mail::message')
# Set Semula Kata Laluan

Anda menerima e-mel ini kerana kami menerima permintaan penetapan semula kata laluan untuk akaun anda.

@component('mail::button', ['url' => config('app.url') . '/password/reset/' . $token . '?email=' . $email])
Set Semula Kata Laluan
@endcomponent

Pautan tetapan semula kata laluan ini akan tamat dalam 60 minit.

Sekiranya anda tidak meminta penetapan semula kata laluan, tindakan selanjutnya tidak diperlukan.


Terima Kasih,<br>
{{ config('app.name') }}
@endcomponent
