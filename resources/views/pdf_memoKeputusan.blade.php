<!DOCTYPE html>
<html>

<head>
    <title>Template Memo Edaran Keputusan MLP</title>
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
            <td style="width:100px; text-align: left;"><img src="{!! $memo !!}"></td>

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
    <b>SULIT</b><br>
    <table>
        <tr>
            <td class="firstColumn">KEPADA</td>
            <td class="secondColumn">:</td>
            <td class="thirdColumn">PENGARAH<br>BAHAGIAN {!!$bahagian!!}</td>
        </tr>
        <tr><td></td><td></td><td></td></tr>
        <tr>
            <td class="firstColumn">DARIPADA</td>
            <td class="secondColumn">:</td>
            <td class="thirdColumn">PENGARAH<br>BAHAGIAN UKUR BAHAN DAN PENGURUSAN KONTRAK</td>
        </tr>
        <tr><td></td><td></td><td></td></tr>
        <tr>
            <td class="firstColumn">NO. RUJUKAN</td>
            <td class="secondColumn">:</td>
            <td class="thirdColumn"> {!! $rujukan !!}  </td>
        </tr>
        <tr><td></td><td></td><td></td></tr>
        <tr>
            <td class="firstColumn">TARIKH</td>
            <td class="secondColumn">:</td>
            <td class="thirdColumn">{!! $tarikh !!}</td>
        </tr>
        <tr><td></td><td></td><td></td></tr>
        <tr>
            <td class="firstColumn">PERKARA</td>
            <td class="secondColumn">:</td>
            <td class="thirdColumn">KEPUTUSAN LEMBAGA PEROLEHAN {!! $kementerian1 !!} BIL.{!! $bil !!}</td>
        </tr>
    </table>
    <br>
    <hr>
    <label>Dengan hormatnya perkara di atas adalah dirujuk.</label><br>
    <div>2.	Bersama-sama ini disertakan keputusan Mesyuarat Lembaga Perolehan {!! $kementerian !!} Bil.{!! $bil !!} bagi kertas perolehan berikut:</div>
    <br>
    <b style="font-size: 11px; text-align: justify;">{!! $tajuk_perolehan !!} ({!! $no_perolehan !!})</b><br>
    <div>3.	Sila semak setiap butiran dalam Kertas Keputusan tersebut, <b>sekiranya terdapat sebarang pembetulan dan memerlukan pindaan</b>,
        sila maklumkan secara rasmi kepada pihak Urusetia Lembaga Perolehan {!! $kementerian1 !!}.</div>
    <div>{!! $text_1 !!}</div>
    <div>5.	Pihak {!! $title !!} diingatkan agar Surat Setuju Terima (SST) / Cadangan Teknikal dan Kewangan (CTK) dikeluarkan dalam tempoh tujuh (7) hari
        daripada tarikh surat ini. Sila muatnaik keputusan dalam sistem MyGPIS.</div>
    <div>Sekian, untuk makluman dan tindakan pihak {!! $title !!} selanjutnya.</div>
    @if ($text_3 != null)
        <div>{!! $text_3 !!}</div>
    @endif
    <p>
    @foreach($moto as $moto)
        <b>{!! $moto !!}</b><br>
    @endforeach
    <br>
    <label>{!! $sym !!}</label>
    <br><br>
    <img src="{!! $tanda_tangan !!}" style="width:90px;" /><br>
    <label><b>({!! $nama !!})</b></label>

</body>

</html>

<style>
    .headline {
        width:280px;
        font-size:9px;
        font-family: Berlin Sans FB;
    }

    div {
        font-family: Arial, Helvetica, sans-serif;
        font-size: 11px;
        text-align: justify;
    }

    p {
        font-family: Arial, Helvetica, sans-serif;
        font-size: 11px;
    }

    label {
        font-family: Arial, Helvetica, sans-serif;
        font-size: 11px;
    }

    .firstColumn {
        font-family: Arial, Helvetica, sans-serif;
        font-size: 11px;
        font-weight: bold;
        width: 85px;
        margin-bottom: 10px;
    }

    .secondColumn {
        font-family: Arial, Helvetica, sans-serif;
        font-size: 11px;
        font-weight: bold;
        width: 15px;
        margin-bottom: 10px;
    }

    .thirdColumn {
        font-family: Arial;
        font-size: 11px;
        font-weight: bold;
        margin-left: 40px;
        width: 1000px;
    }

</style>
