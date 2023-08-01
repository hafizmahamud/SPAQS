<!DOCTYPE html>
<html>
<head>
    <title>Cover Dokumen</title>
</head>

<body>
    <p style="font-family: Arial, Helvetica, sans-serif;
    position:absolute;
    top: -20px;
    right:0;
    padding:3px;
    font-family: Arial, Helvetica, sans-serif;
    font-weight: bold;">
    {{ $no_siri }}</p>

    <br><br><br>

    <div style="text-align: center;">
        <img src={{ url($jata) }} alt="" width="150" height="110">
    </div><br>

    <h2 style="text-align: center;" class="serif">KERAJAAN MALAYSIA</h2><br>
    <h2 style="text-align: center;" class="serif">JABATAN PENGAIRAN DAN SALIRAN  MALAYSIA</h2><br>
    <h2 style="text-align: center;" class="serif">DOKUMEN TENDER</h2><br>
    <h2 style="text-align: center;" class="serif">UNTUK</h2><br>
    <div style="width:100%">
        <div style="float:left; width:5%">
        </div>
        <div style="float:left; width:90%">
            <h2 style="text-align: center;" class="serif">{{ $nama_perolehan }}</h2>
        </div>
        <div style="float:left; width:5%">
        </div>
    </div><br>
    <div style="clear:both; text-align: center; bottom: 300px;">
        <h2 class="serif"> NO TENDER : {{ $no_perolehan }}</h2>
    </div>

    <br><br><br>

    <div style="position: fixed; bottom: 180px; width:100%">
        <div style="float:left; width:35%">
            <img src={{ url("spaqs/assets/img/Logo_JPS.png") }} alt="" width="150" height="110" style="float: right; margin-right:5%">
        </div>
        <div style="float:left; width:60%; font-weight: bold;" >
            <p class="serif">KETUA PENGARAH <br> JABATAN PENGAIRAN DAN SALIRAN  MALAYSIA <br> JALAN SULTAN SALAHUDDIN <br> 50626 KUALA LUMPUR</p>
        </div>
        <div style="float:left; width:15%">
        </div>
    </div>
</body>
</html>

<style>
p.serif {
    font-family: Arial, Helvetica, sans-serif;
}

h2.serif {
    font-family: Arial, Helvetica, sans-serif;
}

</style>