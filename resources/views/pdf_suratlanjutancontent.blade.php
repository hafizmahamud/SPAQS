<!DOCTYPE html>
<html>
<hr>
<body>
    <p class="title"><b>KELULUSAN TEMPOH SAH LAKU TENDER KEPADA PENGERUSI LEMBAGA PEROLEHAN KEMENTERIAN
            ALAM SEKITAR DAN AIR</b></p><br>
        <br>
        <br>
        <table>
            <tr>
                <td class="header1">NO.</td>
                <td class="header2">NAMA PROJEK</td>
                <td class="header3">TEMPOH</td>
                <td class="header4">BILANGAN PERMOHONAN</td>
                <td class="header5">JUSTIFIKASI PELANJUTAN</td>
                <td class="header6">KEPUTUSAN</td>
            </tr>
            @foreach ($maklumat_tender as $maklumat_tender)
            <tr>
                <td class="column1"><div style="font-size: 10pt;">&nbsp;</div>{!! $bil = $bil + 1 !!}.</td>
                <td class="column2">{!! $maklumat_tender->tajuk_perolehan !!}<br>(NO. TENDER : {!!
                    $maklumat_tender->no_perolehan !!})</td>
                <td class="column3">{!! $maklumat_tender->tempoh_sah_laku !!} hari mulai dari
                    {!!\Carbon\Carbon::parse($maklumat_tender->tarikh_waktu_tutup)->format('d.m.Y')!!} –
                    {!!\Carbon\Carbon::parse($maklumat_tender->tarikh_waktu_tutup)->addDays($maklumat_tender->tempoh_sah_laku)->format('d.m.Y')!!}
                </td>
                <td class="column4"><div style="font-size: 6pt;">&nbsp;&nbsp;</div>Permohonan kali pertama</td>
                <td class="column5"><div style="font-size: 6pt;">&nbsp;&nbsp;</div>Dalam proses penyediaan kertas perakuan</td>
                <td class="column6"><div style="font-size: 6pt;">&nbsp;&nbsp;</div>Setuju/Tidak Setuju*</td>
            </tr>
            @endforeach
        </table>
        <p class="notes">* Nota: Potong mana yang tidak berkenaan</p>
        <br>
        <br>
        <br>
        <br>
        <p class="dot">……………………………………………………
        </p>
        <p class="ksu">
            {!! $nama_pelulus !!}<br>{!! $jawatan !!}<br>{!! $kementerian !!}<br>Tarikh : &nbsp;&nbsp;&nbsp;&nbsp; {!! $bulan_tahun !!}</p>
</body>

</html>

<style>
    table, th, td {
      border: 1px solid black;
      border-collapse: collapse;
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
        width: 240px; 
        text-align: center; 
        font-weight: bold; 
        font-size: 11px;
    }

    .header3 {
        font-family: Arial, Helvetica, sans-serif; 
        text-align: center;
        width: 110px; 
        font-weight: bold; 
        font-size: 11px;
    }

    .header4 {
        font-family: Arial, Helvetica, sans-serif; 
        text-align: center;
        width: 120px; 
        font-weight: bold; 
        font-size: 11px;
    }

    .header5 {
        font-family: Arial, Helvetica, sans-serif; 
        text-align: center;
        width: 180px; 
        font-weight: bold; 
        font-size: 11px;
    }

    .header6 {
        font-family: Arial, Helvetica, sans-serif; 
        text-align: center;
        width: 90px; 
        font-weight: bold; 
        font-size: 11px;
    }

    p.dot {
        font-weight: bolder; 
        font-style: italic; 
        text-align: center; 
        font-size: 12px;
    }

    p.title {
        font-family: Arial, Helvetica, sans-serif; 
        text-align: center; 
        font-size: 11px;
    }

    p.notes {
        font-size: 11px;
        font-weight: bold; 
        font-style: italic;
        text-align: right; 
    }

    p.ksu {
        font-family: Arial, Helvetica, sans-serif; 
        font-weight: bolder; 
        text-align: center; 
        font-size: 12px;
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
    }

    .column6 {
        font-family: Arial, Helvetica, sans-serif;
        font-size: 11px;
        height: 20px;
        text-align: center;
    }
    </style>