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
        <title>LAPORAN PENILAI SEMASA</title> 
    </font>
    <br><br>
    <font size="8" face="Arial" >
    <table class="noBorder">
        <tr>
            <th class="firstColumn">No.</th>
            <th class="secondColumn">Nama Pegawai</th>
            <th class="secondColumn">Email</th>
            <th class="secondColumn">Bahagian</th>
            <th class="secondColumn">Negeri</th>
            <th class="thirdColumn">Penilai 1</th>
            <th class="thirdColumn">Penilai 2</th>
        </tr>
        @foreach ($detail as $details)
        <tr>
            <td class="firstColumn">{{ $bil = $bil + 1 }}</td>
            <td class="secondColumn">{{ $details['name'] }}</td>
            <td class="secondColumn">{{ $details['email'] }}</td>
            @if ($details['section_id'] != null)
                <td class="secondColumn">{{ $details->section['bahagian'] }}</td>
            @else
                <td class="secondColumn"> </td>
            @endif
            <td class="secondColumn">{{ $details->negeri['negeri'] }}</td>
            <td class="thirdColumn">{{ $details->Penilai1->count() }}</td>   
            <td class="thirdColumn">{{ $details->Penilai2->count() }}</td>


        </tr>
        @endforeach
    </table>
    </font>

</body>
</html>