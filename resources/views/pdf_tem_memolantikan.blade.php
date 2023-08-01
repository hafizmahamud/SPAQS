<!DOCTYPE html>
<html>

<head>
    <title>Template Memo Pelantikan Penilaian</title>
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
            <td style="width:100px; text-align: left;"><img src="{!! $memo_surat !!}"></td>
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
    <br>
    <table>
        <tr>
            <td class="firstColumn">Kepada</td>
            <td class="secondColumn">:</td>
            <td class="thirdColumn">xx</td>
        </tr>
        <tr>
            <td class="firstColumn"></td>
            <td class="secondColumn"></td>
            <td class="thirdColumn">Ketua Penolong Pengarah</td>
        </tr>
        <tr>
            <td class="firstColumn"></td>
            <td class="secondColumn"></td>
            <td class="thirdColumn">Bahagian Ukur Bahan Dan Pengurusan Kontrak</td>
        </tr>
        <tr>
            <td class="firstColumn"></td>
            <td class="secondColumn">:</td>
            <td class="thirdColumn">xx</td>
        </tr>
        <tr>
            <td class="firstColumn"></td>
            <td class="secondColumn"></td>
            <td class="thirdColumn">Penolong Pengarah</td>
        </tr>
        <tr>
            <td class="firstColumn"></td>
            <td class="secondColumn"></td>
            <td class="thirdColumn">Bahagian Ukur Bahan Dan Pengurusan Kontrak</td>
        </tr>
        <tr>
            <td class="firstColumn">Daripada</td>
            <td class="secondColumn">:</td>
            <td class="thirdColumn">Pengarah, Bahagian Ukur Bahan Dan Pengurusan Kontrak</td>
        </tr>
        <tr>
            <td class="firstColumn">Perkara</td>
            <td class="secondColumn">:</td>
            <td class="thirdColumn">Perlantikan Ahli Jawatankuasa Penilaian Tender</td>
        </tr>
        <tr>
            <td class="firstColumn">Tender</td>
            <td class="secondColumn">:</td>
            <td class="thirdColumn"><u> JPS/IP/xx/xx/xxxx</u></td>
        </tr>
        <tr>
            <td class="firstColumn"></td>
            <td class="secondColumn"></td>
            <td class="thirdColumn">Projek xx</td>
        </tr>
        <tr>
            <td class="firstColumn">No. Rujukan</td>
            <td class="secondColumn">:</td>
            <td class="thirdColumn">(xx) P.P.S (s) 15/2011 Jld. xx</td>
        </tr>
        <tr>
            <td class="firstColumn">Tarikh</td>
            <td class="secondColumn">:</td>
            <td class="thirdColumn">xx {!! $tarikh !!}</td>
        </tr>
    </table>
    <hr>
    <div style="text-align: justify;">{!! $text_1 !!}</div>
    <p style="text-align: justify;">{!! $text_2 !!} xx (xx) hari {!! $text_3 !!} <b>xx/xx/2021 sehingga xx/xx/2021.</b></p>
    <label style="text-align: justify;">3. Bersama-sama ini disertakan dokumen berikut untuk tindakan selanjutnya:-
        <ol type="i">
            <li>Borang Tindakan Kerja Penyediaan Laporan Penilaian Tender.</li>
            <li>Surat Akuan Perlantikan Ahli Jawatankuasa Penilaian Tender.</li>
            <li>Surat Akuan Selesai Tugas Ahli Jawatankuasa Penilaian Tender.</li>
            <li>Jadual Tender, Anggaran Jabatan & Semakan Dokumen Wajib.</li>
        </ol></label>
    <label>4. Sila kembalikan Borang Tindakan Kerja Penyediaan Laporan Penilaian Tender yang telah lengkap diisi kepada
        Urusetia Tender untuk tujuan rekod.</label>
    @if ($text_4 != null)
        <p>{!! $text_4 !!}</p>
    @endif
    <label>Sekian, terima kasih.</label><br><br>

    @foreach($moto as $moto)
        <b>{!! $moto !!}</b><br>
    @endforeach

    <p style="">{!! $sym !!}</p>
    <br />
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="{!! $tanda_tangan !!}" style="width:90px;"/>
    <p><b>( {!! $nama !!} )</b></p>
</body>

</html>

<style>
    .headline {
        width:280px;
        font-size:9px;
        font-family: Berlin Sans FB;
    }
    .firstColumn {
        font-family: Arial, Helvetica, sans-serif;
        font-size: 11px;
        font-weight: bold;
        width: 75px;
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

    p {
        font-family: Arial, Helvetica, sans-serif;
        font-size: 11px;
    }

    label {
        font-family: Arial, Helvetica, sans-serif;
        font-size: 11px;
    }

    li {
        font-family: Arial, Helvetica, sans-serif;
        font-size: 11px;
    }

</style>
