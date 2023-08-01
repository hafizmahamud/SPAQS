<!DOCTYPE html>
<html>

<head>
    <title>Template Surat Edaran Keputusan MLP</title>
</head>

<body>
    <table>
        <tr>
            <td style="width:90px; text-align: left;"><img src="{!! $jata_negara !!}"></td>
            <td style="width:10px;"></td>
            <td class="headline">
                {!! $jabatanBM !!}<br>
                <i>{!! $jabatanEN !!}</i><br>
                {!! $kementerianBM !!}<br>
                <i>{!! $kementerianEN !!}</i><br>
                @foreach($alamats as $alamat)
                {!! $alamat !!}<br>
                @endforeach
            </td>
        </tr>
        <tfoot>
            <tr>
                <td style="width:110px; font-size:8px; font-family: Berlin Sans FB;">{!! $laman_web !!}</td>
                <td style="width:100px; font-size:8px; font-family: Berlin Sans FB;">Tel: {!! $no_tel !!}</td>
                <td style="width:150px; font-size:8px; font-family: Berlin Sans FB;">Faks: {!! $no_fax !!}</td>
                <td style="font-size:8px; font-family: Berlin Sans FB;">Email: {!! $email !!}</td>
            </tr>
        </tfoot>
    </table>
    <hr>
    <p>
    <b>SULIT</b><br>
    <div>
    Pengarah <br>
    XXXXXX XXXXXXXXXX XXXXXX,<br>
    XXXXXXXXXX XXXX,<br>
    XXXXXXXX,<br>
    XXXX XXXXXX XXXX XXXXX.
    </div>
    <div>{!! $title !!},</div>
    <br>
    <b>KEPUTUSAN LEMBAGA PEROLEHAN {!! $kementerian !!} BIL.XX/2021</b>
    <hr><br>
    <div>Dengan hormatnya perkara di atas adalah dirujuk.</div>
    <div style="text-align: justify;">{!! $text_1 !!}xxxxx {!! $text_2 !!}</div>
    <div><b>PERKHIDMATAN XXX (JPS/P/SAB/XX/XX/XXX)</b></div>
    <div style="text-align: justify;">3.	Sila semak setiap butiran dalam Kertas Keputusan tersebut, <b>sekiranya terdapat sebarang pembetulan dan memerlukan pindaan,</b>
        sila maklumkan secara rasmi kepada pihak Urusetia Lembaga Perolehan {!! $kementerian !!}.</div>
    <div style="text-align: justify;">4.	Pihak tuan diingatkan agar Surat Setuju Terima (SST) / Cadangan Teknikal dan Kewangan (CTK) dikeluarkan dalam tempoh tujuh (7)
         hari daripada tarikh surat ini.</div>
    @if ($text_3 != null)
        <div style="text-align: justify;">{!! $text_3 !!}</div>
    @endif
    <br>
    <label>Sekian, untuk makluman dan tindakan pihak {!! $title !!} selanjutnya.</label>
    <p>
    @foreach($moto as $moto)
        <b>{!! $moto !!}</b><br>
    @endforeach
    <br>
    <label>{!! $sym !!}</label>
    <br><br><br>
    ...............................................<br>
    <label><b>({!! $nama !!})</b></label><br>
    {!! $jawatan !!}<br>
    Bahagian Ukur Bahan dan Pengurusan Kontrak<br>
    Jabatan Pengairan Dan Saliran Malaysia<br>

</body>

</html>

<style>
    .headline {
        width:280px;
        font-size:9px;
        font-family: Berlin Sans FB;
    }

    p {
        font-family: Arial, Helvetica, sans-serif;
        font-size: 11px;
    }

    label {
        font-family: Arial, Helvetica, sans-serif;
        font-size: 11px;
    }

</style>
