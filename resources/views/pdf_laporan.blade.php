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
            width: 75px;
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
    @if ($tarikhm != "")
        <title>SENARAI DAFTAR PEROLEHAN {{date('d/m/Y', strtotime($tarikhm))}} - {{date('d/m/Y', strtotime($tarikhA))}}</title>
    @else
        <title>SENARAI DAFTAR PEROLEHAN SEMASA</title> 
    @endif
    </font>
    <br><br>
    <font size="8" face="Arial" >
    <table class="noBorder">
        <tr>
            <th class="firstColumn">No.</th>
            <th class="secondColumn">Negeri</th>
            <th class="secondColumn">Bahagian</th>
            <th class="secondColumn">No Perolehan</th>
            <th class="secondColumn">Tajuk</th>
            <th class="secondColumn">Nama Pemohon</th>
            <th class="secondColumn">Jenis Iklan</th>
            <th class="secondColumn">Kategori Perolehan</th>
            <th class="secondColumn">Jenis Perolehan</th>
            <th class="thirdColumn">Tahun Perolehan</th>
            <th class="secondColumn">Tarikh Kemaskini</th>
            <th class="thirdColumn">Status</th>
        </tr>
        @foreach ($detail as $details)
        <tr>
            <td class="firstColumn">{{ $bil = $bil + 1 }}</td>
            <td class="secondColumn">{{ $details->negeri['negeri'] }}</td>
            <td class="secondColumn">{{ $details->section['bahagian'] }}</td>
            <td class="secondColumn">{{ $details->no_perolehan }}</td>   
            <td class="secondColumn">{{ $details->tajuk_perolehan }}</td>
            <td class="secondColumn">{{ $details->users['name'] }}</td>
            <td class="secondColumn">{{ $details->matrikIklan['jenisIklan']['nama'] }}</td>
            <td class="secondColumn">{{ $details->matrikIklan['kategoriPerolehan']['nama'] }}</td>
            <td class="secondColumn">{{ $details->matrikIklan['jenisTender']['nama'] }}</td>
            <td class="thirdColumn">{{ $details->tahun_perolehan }}</td>
            <td class="secondColumn">{{ date('d/m/Y', strtotime($details->updated_at)) }}</td>
            <td class="thirdColumn">{{ strtoupper($details->status) }}</td>

        </tr>
        @endforeach
    </table>
    </font>

</body>
</html>