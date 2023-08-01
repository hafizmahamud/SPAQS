<!DOCTYPE html>
<html>

<body>
    <p class="title"><b>SENARAI KERTAS PERTIMBANGAN TENDER UNTUK PERTIMBANGAN<br>
            LEMBAGA PEROLEHAN KASA</b><br>
            <br>
            JABATAN: <b><u>JABATAN PENGAIRAN DAN SALIRAN</u></b></p><br>
    <br>
    <br>
    <p class="subTitle"><b><u>KERTAS PERAKUAN TENDER KERJA</u></b></p><br>
    <br>
    <table>
        <tr>
            <td class="header1"><div style="font-size: 18pt;">&nbsp;&nbsp;</div>BIL</td>
            <td class="header2"><div style="font-size: 18pt;">&nbsp;&nbsp;</div>TAJUK PEROLEHAN / PROJEK</td>
            <td class="header3"><div style="font-size: 7pt;">&nbsp;</div>BEKALAN / KERJA / PERKHIDMATAN</td>
            <td class="header4"><div style="font-size: 11pt;">&nbsp;&nbsp;</div>MENGURUS / PEMBANGUNAN</td>
            <td class="header5"><div style="font-size: 10pt;">&nbsp;&nbsp;</div>TARIKH MULA IKLAN</td>
            <td class="header6"><div style="font-size: 7pt;">&nbsp;</div>TARIKH TUTUP TENDER</td>
            <td class="header7">TARIKH TAMAT SAH LAKU TENDER</td>
            <td class="header8"><div style="font-size: 17pt;">&nbsp;&nbsp;</div>TINDAKAN</td>
        </tr>
        @foreach ($data_tender as $data_tender)
        <tr>
            <td class="column1"><div style="font-size: 10pt;">&nbsp;</div>{!! $bil = $bil + 1 !!}.</td>
            <td class="column2">{!! $data_tender->no_perolehan !!}<br>
                {!! $data_tender->tajuk_perolehan !!}</td>
            <td class="column3"><div style="font-size: 10pt;">&nbsp;</div>KERJA</td>
            <td class="column4"></td>
            <td class="column5"><div style="font-size: 10pt;">&nbsp;</div>{!!\Carbon\Carbon::parse($data_tender->tarikh_keluar_iklan)->format('d.m.Y')!!}</td>
            <td class="column6"><div style="font-size: 10pt;">&nbsp;</div>{!!\Carbon\Carbon::parse($data_tender->tarikh_waktu_tutup)->format('d.m.Y')!!}</td>
            <td class="column7"><div style="font-size: 10pt;">&nbsp;</div>{!!\Carbon\Carbon::parse($data_tender->tarikh_akhir_jual)->format('d.m.Y')!!}</td>
            <td class="column8"></td>
        </tr>
        @endforeach
    </table>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<table class="tableContact">
            <tr>
                <td class="data1">&nbsp;&nbsp;&nbsp;Nama Urusetia di Jabatan yang boleh dihubungi</td>
                <td class="data">Pn Suliana binti Shukor & Pn Siti Shazwani binti Noor Azahar</td>
            </tr>
            <tr>
                <td class="data1">&nbsp;&nbsp;&nbsp;No telefon bimbit</td>
                <td class="data">019-7066985 (Pn Suliana) 013-7388269 (Pn Shazwani)</td>
            </tr>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</table>
</body>

</html>
<style>
    table,
    th,
    td {
        border: 1px solid black;
        border-collapse: collapse;
    }

    p.title {
        text-align: center;
        font-size: 11px;
    }

    p.subTitle {
        text-align: left;
        font-size: 11px;
    }

    .header1 {
        font-family: Arial, Helvetica, sans-serif;
        text-align: center;
        width: 30px; 
        font-weight: bold;
        font-size: 11px;
    }

    .header2 {
        font-family: Arial, Helvetica, sans-serif;
        text-align: center;
        width: 230px; 
        font-weight: bold;
        font-size: 11px;
    }

    .header3 {
        font-family: Arial, Helvetica, sans-serif;
        text-align: center;
        width: 105px; 
        font-weight: bold;
        font-size: 11px;
    }

    .header4 {
        font-family: Arial, Helvetica, sans-serif;
        text-align: center;
        width: 105px; 
        font-weight: bold;
        font-size: 11px;
    }

    .header5 {
        font-family: Arial, Helvetica, sans-serif;
        text-align: center;
        width: 80px; 
        font-weight: bold;
        font-size: 11px;
    }

    .header6 {
        font-family: Arial, Helvetica, sans-serif;
        text-align: center;
        width: 80px; 
        font-weight: bold;
        font-size: 11px;
    }

    .header7 {
        font-family: Arial, Helvetica, sans-serif;
        text-align: center;
        width: 80px; 
        font-weight: bold;
        font-size: 11px;
    }

    .header8 {
        font-family: Arial, Helvetica, sans-serif;
        text-align: center;
        width: 80px; 
        font-weight: bold;
        font-size: 11px;
    }

    .data {
        font-family: Arial, Helvetica, sans-serif;
        font-size: 11px;
        text-align: center;
        height: 12px;
    }

    .data1 {
        font-family: Arial, Helvetica, sans-serif;
        font-size: 11px;
        text-align: left;
        height: 12px;
    }

    .column1 {
        font-family: Arial, Helvetica, sans-serif;
        font-size: 11px;
        text-align: center;
        height: 20px;
    }

    .column2 {
        font-family: Arial, Helvetica, sans-serif;
        text-align: left;
        font-size: 11px;
        height: 20px;
    }

    .column3 {
        font-family: Arial, Helvetica, sans-serif;
        font-size: 11px;
        height: 20px;
        text-align: center;
    }

    .column4 {
        font-family: Arial, Helvetica, sans-serif;
        font-size: 11px;
        height: 20px;
        text-align: center;
    }

    .column5 {
        font-family: Arial, Helvetica, sans-serif;
        font-size: 11px;
        height: 20px;
        text-align: center;
        vertical-align: middle;
    }

    .column6 {
        font-family: Arial, Helvetica, sans-serif;
        font-size: 11px;
        height: 20px;
        text-align: center;
        vertical-align: middle;
    }

    .column7 {
        font-family: Arial, Helvetica, sans-serif;
        font-size: 11px;
        height: 20px;
        text-align: center;
        vertical-align: middle;
    }

    .column8 {
        font-family: Arial, Helvetica, sans-serif;
        font-size: 11px;
        height: 20px;
        text-align: center;
    }

    .info {
        font-family: Arial, Helvetica, sans-serif;
        font-size: 11px;
        font-weight: bold;
        text-align: left;
        width: 10%;
        padding: 8px;
        border: 1px solid black;
    }

    .content {
        font-family: Arial, Helvetica, sans-serif;
        font-size: 11px;
        text-align: center;
        width: 10%;
        height: 12px;
        border: 1px solid black;
    }

    .tableContact {
        width: 90%;
        margin-left: auto;
        margin-right: auto;
    }

</style>
