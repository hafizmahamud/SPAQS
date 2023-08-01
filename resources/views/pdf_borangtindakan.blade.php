<!DOCTYPE html>
<html>

<head>
    <title>Borang Tindakan</title>
</head>

<body>

    <h3 style="text-align: center; font-family: Arial, Helvetica, sans-serif;">BORANG TINDAKAN</h3>
    <h3 style="text-align: center; font-family: Arial, Helvetica, sans-serif;">KERJA PENYEDIAAN LAPORAN PENILAIAN TENDER
    </h3>

    <table style="width: 70%;">
        <tr>
            <td class="firstColumn">Tajuk Tender</td>
            <td class="secondColumn">:</td>
            <td class="thirdColumn">{!! $nama_tender !!}</td>
        </tr>
        <tr>
            <td class="firstColumn">No. Tender</td>
            <td class="secondColumn">:</td>
            <td class="thirdColumn">{!! $no_perolehan !!}</td>
        </tr>
    </table>
    <br />
    <br />
    <table border="1" style="width:100%">
        <tr>
            <td class="column1">1.</td>
            <td class="column2">Tarikh Iklan</td>
            <td class="column3">{!! $tarikh_iklan !!}</td>
            <td class="column4"></td>
        </tr>
        <tr>
            <td class="column1">2.</td>
            <td class="column2">Tarikh Tutup Tender</td>
            <td class="column3">{!! $tarikh_tutup !!}</td>
            <td class="column4"></td>
        </tr>
        <tr>
            <td class="column1">3.</td>
            <td class="column2">Tarikh Surat Lantikan Untuk Penilaian</td>
            <td class="column3">{!! $tarikh_surat_lantikan_penilaian !!}</td>
            <td class="column4"></td>
        </tr>
        <tr>
            <td class="column1">4.</td>
            <td class="column2">Tarikh Terima Dokumen Tender</td>
            <td class="column3">{!! $tarikh_sah_laku !!}</td>
            <td class="column4"></td>
        </tr>
        <tr>
            <td class="column1">5.</td>
            <td class="column2">Tarikh Siap Penilaian</td>
            <td class="column3"></td>
            <td class="column4"></td>
        </tr>
        <tr>
            <td class="column1">6.</td>
            <td class="column2">Tempoh Sedia LT</td>
            <td class="column3">&nbsp;{!! $hari !!} hari bekerja</td>
            <td class="column4"></td>
        </tr>
        <tr>
            <td class="column1">7.</td>
            <td class="column2">Tarikh Ketua Jabatan Tandatangan Perakuan</td>
            <td class="column3"></td>
            <td class="column4"></td>
        </tr>
        <tr>
            <td class="column1">8.</td>
            <td class="column2">Tarikh Kemuka ke Urusetia KATS</td>
            <td class="column3"></td>
            <td class="column4"></td>
        </tr>
        <tr>
            <td class="column1">9.</td>
            <td class="column2">Tarikh Terima Keputusan Lembaga Perolehan</td>
            <td class="column3"></td>
            <td class="column4"></td>
        </tr>
        <tr>
            <td class="column1">10.</td>
            <td class="column2">Tarikh Siap Penyediaan SST</td>
            <td class="column3"></td>
            <td class="column4"></td>
        </tr>
        <tr>
            <td class="column1">11.</td>
            <td class="column2">Tarikh kemuka SST Kepada Pegawai Diberikuasa</td>
            <td class="column3"></td>
            <td class="column4"></td>
        </tr>
        <tr>
            <td class="column1">12.</td>
            <td class="column2">Tarikh Tandatangan Surat SetujuTerima</td>
            <td class="column3"></td>
            <td class="column4"></td>
        </tr>
    </table>
</body>

</html>

<style>
    .firstColumn {
        font-family: Arial, Helvetica, sans-serif;
    }

    .secondColumn {
        font-family: Arial, Helvetica, sans-serif;
    }

    .thirdColumn {
        font-family: Arial, Helvetica, sans-serif;
    }

    .column1 {
        font-family: Arial, Helvetica, sans-serif;
        width: 5%;
        text-align: center; 
        height: 50px;
    }

    .column2 {
        font-family: Arial, Helvetica, sans-serif;
        width: 55%;
        height: 50px;
    }

    .column3 {
        font-family: Arial, Helvetica, sans-serif;
        width: 20%;
        height: 50px;
        text-align: center;
    }

    .column4 {
        font-family: Arial, Helvetica, sans-serif;
        width: 20%;
        height: 50px;
    }

</style>
