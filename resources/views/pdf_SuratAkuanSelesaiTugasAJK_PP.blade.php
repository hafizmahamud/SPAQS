<!DOCTYPE html>
<html>

<head>
    <title>Surat Akuan Selesai Tugas</title>
</head>

<body>

    <h3 style="text-align: center; font-family: Arial, Helvetica, sans-serif;">{!! $tajukSST1 !!}</h3>
    <h3 style="text-align: center; font-family: Arial, Helvetica, sans-serif;">{!! $tajukSST2 !!}</h3>
    <br />
    <ul>
        <li>Saya, <b>{!! $nama !!}</b> No. Kad Pengenalan <b>{!! $no_ic !!}</li>
        <li>{!! $pengenalan !!}</li>
    </ul>
    <ol style="list-style: none;">
    @if ($isi_6 != null) 
        <li>{!! $isi_1 !!}</li>
            <p>&nbsp;&nbsp;<b>{!! $nama_tender !!}</b></p>
            <p>&nbsp;&nbsp;<b>{!! $no_perolehan !!}</b></p>
        <li>{!! $isi_2 !!}</li>
        <br />
        <li>{!! $isi_3 !!}</li> <br />
        <li>{!! $isi_4 !!}</li> <br />
        <li>{!! $isi_5 !!}</li> <br />
        <li>{!! $isi_6 !!}</li> <br />
    @else
        <li>{!! $isi_1 !!}</li>
            <p>&nbsp;&nbsp;<b>{!! $nama_tender !!}</b></p>
            <p>&nbsp;&nbsp;<b>{!! $no_perolehan !!}</b></p>
        <li>{!! $isi_2 !!}</li>
        <br />
        <li>{!! $isi_3 !!}</li> <br />
        <li>{!! $isi_4 !!}</li> <br />
        <li>{!! $isi_5 !!}</li> <br />
    @endif
    </ol>

    <table class="noBorder">
        <tr>
            <td class="firstColumn">Nama</td>
            <td class="secondColumn">&nbsp;:</td>
            <td class="thirdColumn">&nbsp;<b>{!! $nama !!}</b></td>
        </tr>
        <tr>
            <td class="firstColumn">No Kad Pengenalan<br>(Awam/Tentera/Polis)</td>
            <td class="secondColumn">&nbsp;:</td>
            <td class="thirdColumn">&nbsp;<b>{!! $no_ic !!}</b></td>
        </tr>
        <tr>
            <td class="firstColumn">
                <br>
                <br>
                <br>Tandatangan
            </td>
            <td class="secondColumn">
                <br>
                <br>
                <br>&nbsp;:
            </td>
            <td class="thirdColumn"></td>
        </tr>
        @if ($jawatan != null) 
        <tr>
            <td class="firstColumn">Jawatan</td>
            <td class="secondColumn">&nbsp;:</td>
            <td class="thirdColumn">{!! $jawatan !!}</td>
        </tr>
        @else
        <tr>
            <td class="firstColumn">Jawatan</td>
            <td class="secondColumn">&nbsp;:</td>
            <td class="thirdColumn"></td>
        </tr>
        @endif
        <tr>
            <td class="firstColumn">Tarikh</td>
            <td class="secondColumn">&nbsp;:</td>
            <td class="thirdColumn"></td>
        </tr>
    </table>
</body>

</html>

<style>
    .noBorder {
        margin-left: 37px;
    }

    .firstColumn {
        font-family: Arial, Helvetica, sans-serif;
    }

    .secondColumn {
        font-family: Arial, Helvetica, sans-serif;
    }

    .thirdColumn {
        font-family: Arial, Helvetica, sans-serif;
    }

    p {
        font-family: Arial, Helvetica, sans-serif;
    }

    li {
        font-family: Arial, Helvetica, sans-serif;
    }

    ul {
        list-style-type: none;
    }

</style>
