<!DOCTYPE html>
<html>
<head>
    <title>QR Code - {{ $no_perolehan }} </title>
</head>

<body>


    <br><br><br>
    <img src={{ url($jata) }} alt="" height="80" style="margin-left:35%; margin-top:-10%;">
    <img src={{ url("spaqs/assets/img/Logo_JPS.png") }} height="80" style="margin-left:5%;"><br>


    <h4 style="text-align: center; margin-top:-1%;" class="serif">JABATAN PENGAIRAN DAN SALIRAN  MALAYSIA</h4><br>
    <h4 style="text-align: center; margin-top:-2%;" class="serif">SILA IMBAS KOD QR UNTUK MENDAFTAR BORANG SARINGAN WAJIB / LAWATAN TAPAK</h4><br>
    <h4 style="text-align: center; margin-top:-3%;" class="serif">BAGI</h4><br>
    <div style="clear:both; text-align: center; margin-top:-2%; ">
        <h3 style="text-align: center; margin-top:-2%; " class="serif">{{ $nama_perolehan }}</h3>
        <h3 class="serif"> NO TENDER : {{ $no_perolehan }}</h3>
        @if ($jenisLawatanTapak != "TIDAK_WAJIB") {{--WAJIB / ONLINE--}}
        <h3 class="serif"> TARIKH : {{ $tarikh }} ({{ $masa_start}} - {{$masa_end}} )</h3>
        @else
        <h3 class="serif"> TARIKH : {{ $tarikh }} ( {{ $masa_start}} ) - {{ $tarikh_akhir }} ( 11:59 pm )</h3>
        @endif
    </div>
    <br>

    <div style="position: fixed; text-align: center; width:100%  margin-top:-10%;">
        <div >
            <img src="data:image/png;base64, {!! base64_encode(QrCode::size(200)->generate($url)) !!} " width="580" >
        </div>
    </div>
</body>
</html>

<style>

/* * {
    font-size: 16px;
} */

p.serif {
    font-family: Arial, Helvetica, sans-serif;
}

h3.serif {
    font-family: Arial, Helvetica, sans-serif;
}

h4.serif {
    font-family: Arial, Helvetica, sans-serif;
}

</style>