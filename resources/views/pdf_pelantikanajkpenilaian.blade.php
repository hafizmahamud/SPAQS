<!DOCTYPE html>
<html>

<head>
    <title>Memo Pelantikan Penilai</title>
</head>

<body>
    <div>
        <img src="{!! $jata_negara !!}" style="width:18%; float: left;" />
        <img src="{!! $memo_surat !!}" style="width:18%; float: right;" />
            <p class="header">{!! $jabatanBM !!} </p><br>
            <p class="headerEn">{!! $jabatanEN !!} </p><br>
            <p class="header">{!! $kementerianBM !!} </p><br>
            <p class="headerEn">{!! $kementerianEN !!} </p><br>
            <p class="header">{!! $alamat !!} </p><br>
            <br>
            <p class="headerInfo">{!! $laman_web !!}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tel: {!! $no_tel!!}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Faks: {!! $no_fax !!}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Email: {!! $email !!}</p>
    </div>

    <hr>

    <table class="noBorder">
        <tr>
            <td class="firstColumn">Kepada</td>
            <td class="secondColumn">:</td>
            <td class="thirdColumn">{!! $penilai_1 !!}</td>
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
            <td class="thirdColumn">{!! $penilai_2 !!}</td>
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
            <td class="thirdColumn"><u>{!! $no_perolehan !!}</u></td>
        </tr>
        <tr>
            <td class="firstColumn"></td>
            <td class="secondColumn"></td>
            <td class="thirdColumn">{!! $nama_tender !!}</td>
        </tr>
        <tr>
            <td class="firstColumn">No. Rujukan</td>
            <td class="secondColumn">:</td>
            <td class="thirdColumn">{!! $no_rujukan !!}</td>
        </tr>
        <tr>
            <td class="firstColumn">Tarikh</td>
            <td class="secondColumn">:</td>
            <td class="thirdColumn">{!! $tarikh_mula_memo !!}</td>
        </tr>
    </table>

    <hr>

    <p>{!! $text_1 !!}</p>
    <p>{!! $text_2 !!} {!! $daytext !!} ({!! $hari !!}) hari {!! $text_3 !!} <b>{!! $tarikhmula !!} sehingga {!!
            $tarikhakhir !!}.</b></p>
    <p>3. Bersama-sama ini disertakan dokumen berikut untuk tindakan selanjutnya:-
        <ol type="i">
            <li>Borang Tindakan Kerja Penyediaan Laporan Penilaian Tender.</li>
            <li>Surat Akuan Perlantikan Ahli Jawatankuasa Penilaian Tender.</li>
            <li>Surat Akuan Selesai Tugas Ahli Jawatankuasa Penilaian Tender.</li>
            <li>Jadual Tender, Anggaran Jabatan & Semakan Dokumen Wajib.</li>
        </ol>
        <p>4. Sila kembalikan Borang Tindakan Kerja Penyediaan Laporan Penilaian Tender yang telah lengkap diisi kepada
            Urusetia Tender untuk tujuan rekod.</p>
        @if ($text_4 != null)
        <p>{!! $text_4 !!}</p>
        <p>Sekian, terima kasih.</p>
        <p><b>"{!! $moto_1 !!}"</b></p>
        <p><b>"{!! $moto_2 !!}"</b></p>
        <p>{!! $sym !!}</p>
        <br />
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="{!! $tanda_tangan !!}" style="width:15%" />
        <p><b>( {!! $nama !!} )</b></p>
        @else
        <p>Sekian, terima kasih.</p>
        <p><b>"{!! $moto_1 !!}"</b></p>
        <p><b>"{!! $moto_2 !!}"</b></p>
        <p>{!! $sym !!}</p>
        <br />
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="{!! $tanda_tangan !!}" style="width:15%" />
        <p><b>( {!! $nama !!} )</b></p>
        @endif
</body>

</html>

<style>
    .firstColumn {
        font-family: Arial, Helvetica, sans-serif;
        font-size: 11px;
        font-weight: bold;
    }

    .secondColumn {
        font-family: Arial, Helvetica, sans-serif;
        font-size: 11px;
        font-weight: bold;
    }

    .thirdColumn {
        font-family: Arial, Helvetica, sans-serif;
        font-size: 11px;
        font-weight: bold;
    }

    p {
        font-family: Arial, Helvetica, sans-serif;
        font-size: 11px;
    }

    li {
        font-family: Arial, Helvetica, sans-serif;
        font-size: 11px;
    }

    p.header {
        font-family: Arial, Helvetica, sans-serif;
        font-size: 11px;
        display: inline;
        margin-left: 12px !important;
    }

    p.headerEn {
        font-family: Arial, Helvetica, sans-serif;
        font-style: italic;
        font-size: 11px;
        display: inline;
        margin-left: 12px !important;
    }

    p.headerInfo {
        font-family: Arial, Helvetica, sans-serif;
        font-size: 11.5px;
        display: inline;
        text-align: center;
        margin-left: 12px !important;
    }
</style>
