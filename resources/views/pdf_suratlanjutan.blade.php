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
                {!! $jabatan_Bm !!}<br>
                <i>{!! $jabatan_En !!}</i><br>
                {!! $kementerian_Bm !!}<br>
                <i>{!! $kementerian_En !!}</i><br>
                @foreach($alamatH as $alamat)
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
    <div>
        <b>SULIT<br>
        SEGERA DENGAN TANDATANGAN</b>
    </div>
    <div>
        @foreach($alamatsl as $alamat)
        {!! $alamat !!}<br>
        @endforeach
        <b>{!! $up !!}</b>
    </div>
    <p>{!! $gelaran !!}</p>
    <div><b>{!! $tajuk !!}</b><hr></div>
    <div>Dengan segala hormatnya perkara di atas adalah dirujuk.</div>
    <div style="text-align: justify;">{!!  $teks_1 !!}</div>
    @if ($teks_2 != null)
        <div style="text-align: justify;">{!! $teks_2 !!}</div>
    @endif
    <div>Sekian, terima kasih.</div><br>
    @foreach($moto as $moto)
        <b>{!! $moto !!}</b><br>
    @endforeach
    <div>{!! $frasa_akhir !!}</div>
    <br>
    <br>
    <br>
    <br>
    <div>
        <b>( {!! $nama_pegawai !!} )</b><br>
        {!! $jawatan_pegawai !!}<br>
        Bahagian Ukur Bahan dan Pengurusan Kontrak<br>
        b.p Ketua Pengarah<br>
        Jabatan Pengairan dan Saliran Malaysia<br>
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
