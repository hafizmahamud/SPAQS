<!DOCTYPE html>
<html>

<head>
    <title>Template Surat Akuan Pelantikan</title>
</head>

<body>
    <h2>{{ $tajuk }}</h2>

    <table>
        <tr>
            <td>
                Saya, &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>{!! $nama !!}</b>
            </td>
            <td>
                No. Kad Pengenalan &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>xxxxxxxxxxx</b>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                {!! $pengenalan !!}
            </td>
        </tr>
    </table>

    <p>{!! $isi1 !!}</p>

    <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>PROJEK xxxx    </b></p>
    <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>JPS/IP/xx/xx/xxxx</b></p>

    <p>{!! $isi2 !!}</p>
    <p>{!! $isi3 !!}</p>
    <p>{!! $isi4 !!}</p>
    <p>{!! $isi5 !!}</p>
    <p>{!! $isi6 !!}</p>

    @if ($isi7 != null)
        <p>{!! $isi7 !!}</p>
    @endif
    <p></p>
    <table>
        <tr>
            <td class="firstColumn">Nama</td>
            <td class="secondColumn">:</td>
            <td class="thirdColumn">{!! $nama !!}</td>
        </tr>
        <tr>
            <td class="firstColumn">No. Kad Pengenalan
                (Awam/Tentera/Polis)
                </td>
            <td class="secondColumn">:</td>
            <td class="thirdColumn"></td>
        </tr>
        <tr>
            <td class="firstColumn">Tandatangan</td>
            <td class="secondColumn">:</td>
            <td class="thirdColumn"></td>
        </tr>
        <tr>
            <td class="firstColumn">Jawatan</td>
            <td class="secondColumn">:</td>
            <td class="thirdColumn"></td>
        </tr>
        <tr>
            <td class="firstColumn">Tarikh</td>
            <td class="secondColumn">:</td>
            <td class="thirdColumn"></td>
        </tr>
    </table>
</body>

</html>

<style>
    h2 {
        text-align: center;
    }

    p {
        font-family: Arial, Helvetica, sans-serif;
        font-size: 11px;
    }

    .firstColumn {
        font-family: Arial, Helvetica, sans-serif;
        font-size: 11px;
        width: 130px;
    }

    .secondColumn {
        font-family: Arial, Helvetica, sans-serif;
        font-size: 11px;
        width: 15px;
    }

    .thirdColumn {
        font-family: Arial;
        font-size: 11px;
        font-weight: bold;
        margin-left: 40px;
        width: 1000px;
    }

</style>
