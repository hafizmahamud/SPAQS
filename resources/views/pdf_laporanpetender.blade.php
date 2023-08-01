<!DOCTYPE html>
<html>
<head>
    <style>
        .noBorder {
            border:solid 1px !important;
            width: 100%;
        }
        .firstColumn {
            border:solid 1px !important;
            width: 30px;
            margin-bottom: 10px;
        }
        .secondColumn {
            border:solid 1px !important;
            width: 90px;
            margin-bottom: 10px;
        }
        .jawatanColumn {
            border:solid 1px !important;
            width: 100px;
            margin-bottom: 10px;
        }
        .thirdColumn {
            border:solid 1px !important;
            width: 45px;
            margin-bottom: 10px;
        }
        th{
            border:solid 1px !important;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <font size="13" face="Arial">
        <title>LAPORAN PETENDER SEMASA</title> 
    </font>
    <br><br>
    <font size="8" face="Arial" >
    <table class="noBorder">
        <tr>
            <th class="firstColumn">No.</th>
            <th class="secondColumn">No Syarikat</th>
            <th class="secondColumn">Nama Syarikat</th>
            <th class="secondColumn" style="text-align: center">Minat</th>
            <th class="secondColumn" style="text-align: center">Masuk</th>
            <th class="secondColumn" style="text-align: center">Menang</th>
        </tr>
        @foreach ($petender as $petender2)
        <tr>
            <td class="firstColumn">{{ $bil = $bil + 1 }}</td>
            <td class="secondColumn">{{ $petender2['no_syarikat'] }}</td>
            <td class="secondColumn">{{ $namaSyarikat[$petender2['no_syarikat']]['nama_syarikat'] }}</td>
            <td class="secondColumn" style="text-align: center">{{ $petender2['count'] }}</td>
            <td class="secondColumn" style="text-align: center">{{ $countMasuk[$petender2['no_syarikat']] }}</td>
            <td class="secondColumn" style="text-align: center">{{ $countKeputusan[$petender2['no_syarikat']] }}</td>


        </tr>
        @endforeach
    </table>
    </font>

</body>
</html>