<!DOCTYPE html>
<html>

<head>
    <style>
        .noBorder {
            border: none !important;
            font-weight: bold;
            width: 100%;
        }

        .firstColumn {
            width: 75px;
            margin-bottom: 10px;
        }

        .secondColumn {
            width: 10px;
            margin-bottom: 10px;

        }

        .thirdColumn {
            width: 1000px;
            margin-left: 40px;
            margin-bottom: 10px;
            height: 15px;
        }

        /* Image Header */
        * {
            box-sizing: border-box;
        }

        .column {
            float: left;
            width: 33.33%;
            /* padding: 5px; */
        }

        /* Clearfix (clear floats) */
        .row::after {
            content: "";
            clear: both;
            display: table;
        }

    </style>
    <title>Template Memo Perlantikan Penilai</title>
    <hr>
</head>

<body>

    <div class="row" style="width: 80%;">
        <div class="column">
            <img src="{{ url("spaqs/assets/img/jata-negara.png") }}" style="width:25%; content-align: center;">
        </div>
        <div class="column">
            <p style="font-size: 25px; font-weight: bolder;">BAHAGIAN UKUR BAHAN & PENGURUSAN KONTRAK <br>
              Tingkat 2, Ibu Pejabat JPS Malaysia <br>
              Jalan Sultan Salahuddin, 50626 Kuala Lumpur <br>
              Fax: 03 - 2693 5278           Tel: 03-26161521
            </p>
        </div>
        <div class="column">
            <img src="{{ url("spaqs/assets/img/memo.png") }}"" style="width:25%; padding-bottom: 15px;">
        </div>
    </div>
    

    <hr>

    <font size="10" face="Arial">
        <table class="noBorder">
            <tr>
                <td class="firstColumn">Kepada</td>
                <td class="secondColumn">:</td>
                <td class="thirdColumn">XXXX</td>
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
                <td class="thirdColumn">XXXX</td>
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
                <td class="thirdColumn"><u>{{!! $no_perolehan !!}}</u></td>
            </tr>
            <tr>
                <td class="firstColumn"></td>
                <td class="secondColumn"></td>
                <td class="thirdColumn">{{!! $nama_tender !!}}</td>
            </tr>
            <tr>
                <td class="firstColumn">No. Rujukan</td>
                <td class="secondColumn">:</td>
                <td class="thirdColumn">(xx) P.P.S (s) 15/2011 Jld. xx</td>
            </tr>
            <tr>
                <td class="firstColumn">Tarikh</td>
                <td class="secondColumn">:</td>
                <td class="thirdColumn">xx Ogos 2022</td>
            </tr>
        </table>

        <hr>
    </font>
    <font size="10" face="Arial">
        <p>{{!! $text_1 !!}}</p>
        <p>{{!! $text_2 !!}} tiga puluh (30) hari {{!! $text_3 !!}} <b>{{!! $tarikh_akhir_jual !!}} sehingga {{!! $tarikh_serah_dokumen_penilaian !!}}</b></p>
        <p>3. Bersama-sama ini disertakan dokumen berikut untuk tindakan selanjutnya:-
            <ol type="i">
                <li>Borang Tindakan Kerja Penyediaan Laporan Penilaian Tender.</li>
                <li>Surat Akuan Perlantikan Ahli Jawatankuasa Penilaian Tender.</li>
                <li>Surat Akuan Selesai Tugas Ahli Jawatankuasa Penilaian Tender.</li>
                <li>Jadual Tender, Anggaran Jabatan & Semakan Dokumen Wajib.</li>
            </ol>
        </p>
        <p>4. Sila kembalikan Borang Tindakan Kerja Penyediaan Laporan Penilaian Tender yang telah lengkap diisi kepada
            Urusetia Tender untuk tujuan rekod.</p>
        <p>Sekian, terima kasih.</p>
        <p>{{!! $moto_1 !!}}</p>
        <p>“Warga Berintegriti, Organisasi Berkualiti”</p>
        <p>{{!! $sym !!}}</p>

        <br>
        <br>
    </font>

</body>

</html>
