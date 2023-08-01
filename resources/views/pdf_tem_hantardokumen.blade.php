<!DOCTYPE html>
<html>

<head>
    <title>Template  Surat Hantar Dokumen Ke KASA</title>
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
    <b>SEGERA DENGAN TANGAN</b><br>
    <div>
        @foreach($add_SU as $add_SU)
            {!! $add_SU !!}<br>
        @endforeach
        <b>{!! $up !!}</b>
    </div>

    <div>{!! $title !!}</div>
    <div><b><u>{!! $tajuk !!}</u></b></div>
    <div>Dengan segala hormatnya perkara di atas adalah dirujuk.</div>
    <div>{!! $text_1 !!} xxxx (x) {!! $text_2 !!}</div>
    @if ($text_3 != null)
        <div>
            {!! $text_3 !!}<br>
        </div>
    @endif

    <div>Sekian, terima kasih.</div>
    <div>
    @foreach($moto as $moto)
        <b>{!! $moto !!}</b><br>
    @endforeach
    </div>
    <div>{!! $sym !!}</div>
    <br><br><br>
    <div>
        <b>({!! $nama !!})</b><br>
        {!! $jawatan !!}<br>
        Bahagian Ukur Bahan dan Pengurusan Kontrak<br>
        b.p Ketua Pengarah<br>
        Ibu Pejabat JPS Malaysia<br>
    </div>

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
