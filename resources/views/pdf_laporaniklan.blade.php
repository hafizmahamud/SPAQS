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
            width: 40px;
            margin-bottom: 10px;
        }
        .secondColumn {
            border:solid 1px !important;
            width: 75px;
            margin-bottom: 10px;
        }
        .thirdColumn {
            border:solid 1px !important;
            width: 100px;
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
    @if ($tarikhm != "")
        <title>SENARAI IKLAN PEROLEHAN {{date('d/m/Y', strtotime($tarikhm))}} - {{date('d/m/Y', strtotime($tarikhA))}}</title>
    @else
        <title>SENARAI IKLAN PEROLEHAN SEMASA</title> 
    @endif
    </font>
    <br><br>
    <font size="8" face="Arial" >
    <table class="noBorder">
        <tr>
            <th class="firstColumn">No.</th>
            <th class="secondColumn">Negeri</th>
            <th class="thirdColumn">No Perolehan</th>
            <th class="secondColumn">Tajuk</th>
            <th class="secondColumn">Tarikh Iklan</th>
            <th class="secondColumn">Tarikh Tutup</th>
            <th class="secondColumn">Jenis Iklan</th>
            <th class="secondColumn">Kategori Perolehan</th>
            <th class="secondColumn">Jenis Perolehan</th>
            <th class="secondColumn">Status</th>
        </tr>
        @foreach ($detail as $details)
        <tr>
            <td class="firstColumn">{{ $bil = $bil + 1 }}</td>
            <td class="secondColumn">{{ $details->mohonNoPerolehan->negeri['negeri'] }}</td>
            <td class="thirdColumn">{{ $details->mohonNoPerolehan['no_perolehan'] }}</td>
            <td class="secondColumn">{{ $details->mohonNoPerolehan['tajuk_perolehan']  }}</td>   
            <td class="secondColumn">{{ date('d/m/Y', strtotime($details->tarikh_keluar_iklan))}}</td>
            <td class="secondColumn">{{ date('d/m/Y', strtotime($details->tarikh_waktu_tutup))}}</td>
            <td class="secondColumn">{{ $details->mohonNoPerolehan->matrikIklan->jenisIklan['nama'] }}</td>
            <td class="secondColumn">{{ $details->mohonNoPerolehan->matrikIklan->kategoriPerolehan['nama'] }}</td>
            <td class="secondColumn">{{ $details->mohonNoPerolehan->matrikIklan->jenisTender['nama'] }}</td>
            <td class="secondColumn">{{ $details->statusIklan['status'] }}</td>

        </tr>
        @endforeach
    </table>
    </font>

</body>
</html>