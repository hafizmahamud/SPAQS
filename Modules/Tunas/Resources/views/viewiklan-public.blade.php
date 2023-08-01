<!DOCTYPE HTML>
@extends('tunas::layouts.masterIklan')

<div style="background-color:white; padding:5px;">
    <img id="logo" src="/img/Logo_JPS.png" alt="" style="display:block; margin-left:auto; margin-right:auto; width:10%;"><br>
    <p id="text-logo" style=" text-align:center; font-size:30px; ">JABATAN PENGAIRAN DAN SALIRAN MALAYSIA
    </p>
</div>
<body>
    <main id="main-template" class="main-template" >
        <section class="section">
            <div style="font-weight: bold; text-align:center;">
                <h4>Kenyataan Tender</h4>
                <h5>Tender adalah dipelawa daripada kontraktor-kontraktor yang berdaftar dengan Lembaga Pembangunan Industri Pembinaan Malaysia/ PUKONSA/ UPKJ/ Kementerian Kewangan dalam Gred, Kategori, Pengkhususan dan jenis pendaftaran yang berkaitan serta masih dibenarkan membuat tawaran buat masa ini bagi kerja/bekalan berikut </h5>
                <br>
            </div>
            <div class="card">
                <div class="card-body">
                    <div>
                        <table class="table table-condensed">
                            <thead >
                            <tr >
                                <td style="border-top: none; width:14%;">Pejabat Yang Memanggil Tender</td>
                                <td style="border-top: none; width:16%;">No Tender/Projek</td>
                                <td style="border-top: none; width:14%;">Taraf/Jenis Syarikat</td>
                                <td style="border-top: none; width:14%;">Syarat Pendaftaran</td>
                                <td style="border-top: none; width:14%;">Tempat dan Tarikh Dokumen Mulai Dijual</td>
                                <td style="border-top: none; width:14%;">Harga Dokumen & Bayaran Atas Nama</td>
                                <td style="border-top: none; width:14%;">Tempat, Tarikh & Waktu Tender</td>
                            </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td >{{ $mohon->negeri['negeri'] }}<br>@if($mohon->section['bahagian']){{ $mohon->section['bahagian']  }} @endif</td>
                                    <td><strong>{{$mohon->no_perolehan}}</strong>
                                        <br><br>
                                        {{$mohon->tajuk_perolehan}}
                                    </td>
                                    <td>Bumiputera<br><br><strong>DAN</strong><br><br>100% Syarikat Milik Tempatan(T1)</td>
                                    <td>Berdaftar dengan CIDB
                                        <br><br><strong>DAN</strong>
                                        <br><br>Memegang Perakuan Syarikat Pendaftaran Kontraktor(PPK), Sijil Perolehan Kerja (SPKK) dan Sijil Taraf Bumiputera Yang Masih Sah yang dikeluarkan oleh Kementerian Pembangunan Usahawan Malaysia
                                        <br><br><strong>DAN</strong>
                                        <br><br>Gred: {{  substr($data->grade['nama'], 0, 2) }}
                                        <br>Kategori: @foreach ($getPengkhususan as $key => $khusus) @if($key ==  count($getPengkhususan)-1 ){{ $khusus->kod }} @else {{ $khusus->kod }}, @endif @endforeach
                                        <br>Pengkhususan : @foreach ($getkelas as $key => $kelas)  @if($key ==  count($getkelas)-1  ){{ $kelas->kod }} @else{{ $kelas->kod }}, @endif @endforeach
                                        @if(count($data_pukonsa) > 0)
                                            <br><br><strong>DAN</strong><br><br>
                                            @foreach ($data_pukonsa as $key => $datapukonsa)
                                                PUKONSA {{$datapukonsa[$key]->kelas['tajuk']}}
                                                @foreach($datapukonsa as $key => $datap)<br>
                                                    - {{$datap->khusus['tajuk_kecil']}}
                                                @endforeach
                                                <br><br>
                                            @endforeach
                                        @endif

                                        @if(count($data_upkj) > 0)
                                            <strong>DAN</strong><br>
                                            @foreach ($data_upkj as $key => $dataupkj)
                                                @foreach($dataupkj as $key => $datap)
                                                    @if($key == 0)
                                                    <br>UPKJ {{$datap->kelas['tajuk']}}<br>
                                                    @endif
                                                    - {{$datap->khusus['tajuk_kecil']}}<br>
                                                @endforeach
                                            @endforeach
                                            <br><br>
                                        @endif





                                    </td>
                                    <td>{{ $data->pejabatLapor['alamat'] }}
                                        <br><br><strong>{{ $tarikh_keluar_iklan }} ({{$hari_keluar_iklan}})</strong> hingga <strong>{{ $tarikh_waktu_tutup }}  ({{$hari_waktu_tutup}})</strong>
                                        <br><br>Isnin-Khamis<br>Jam 8.30pagi - 12.30tgh<br>Jam 2.30ptg - 4.30 ptg
                                        <br><br>Jumaat<br>Jam 8.30pagi - 12.15tgh<br>Jam 2.45ptg - 4.30 ptg
                                        <br>
                                        <br>
                                    </td>
                                    <td>
                                        @if($data->harga_dokumen)
                                            RM {{$data->harga_dokumen}}
                                            <br><br>{{$data->bayarKepada['nama']}}
                                        @else
                                        RM {{$data->harga_dokumen}} (Tiada Bayaran)
                                        @endif

                                    </td>
                                    <td>{{$data->petiTender['alamat']}}
                                        <br><br><strong>{{ $tarikh_waktu_tutup }}  ({{$hari_waktu_tutup}})</strong>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div>
                        @if($data->lawatan_tapak == "WAJIB")
                            <h4  style="text-align:center;">Taklimat / Lawatan Tapak Tender Diwajibkan</h4>
                        @else
                            <h4  style="text-align:center;">Borang Saringan Petender Diwajibkan</h4>
                        @endif
                        <h5>1.  Petender boleh melawat sendiri Tapak berkenaan bagi membantu syarikat mendapatkan maklumat yang lebih tepat dan mengetahui keadaan Tapak bagi
                            menyediakan tawaran tender.
                            <br>
                            2.  Sekiranya Petender mahu melawat sendiri Tapak berkenaan, amalan perjarakan sosial, penggunaan sanitizer dan pemakaian pelitup muka perlu diteruskan.
                            <br>
                            3.  Rakaman video/ slaid / taklimat Tender dan Projek akan dipaparkan di laman sesawang rasmi JPS  (https://water.gov.my) untuk diakses oleh semua petender yang berminat sepanjang tempoh tender mulai {{ $tarikh_keluar_iklan }}
                            <br>
                            @if($data->lawatan_tapak != "TIDAK_WAJIB" || $data->taklimat_tender != "TIDAK_WAJIB")
                            4. Sila klik pautan<a class="btn btn-primary" href="{{$data->lokasi_tapak}}" target="_blank">ini</a> untuk menyertai taklimat tender/ lawatan tapak.
                            @else
                            4. Tiada lawatan tapak/taklimat tender.
                            @endif
                            <br>
                            @if($data->lawatan_tapak == "TIDAK_WAJIB")
                            5.  Pautan borang pendaftaran kontraktor :<a class="btn btn-primary" href="{{config('app.url').'/kehadiranlawatantapak'.'/'.$data->id}}" target="_blank">klik sini</a>
                            @endif

                        </h5>
                    </div>
                </div>
            </div>
            <h5 style="font-weight:bold;" >Dokumen Meja Tender boleh disemak dan dokumen tender boleh diperolehi di pejabat-pejabat berkenaan semasa waktu pejabat.</h5>
            <br>
            <h5>** Petender yang ingin memasuki tender dikehendaki mengisi Borang Saringan Wajib yang akan diterima melalui emel petender terlebih dahulu. Sila semak emel untuk tindakan selanjutnya.</h5>
                {{-- Dokumen Tender hanya akan dikeluarkan kepada Pemilik syarikat atau Wakil bertauliah berserta perakuan/-sijil ASAL Sijil Perakuan Pendaftaran (PKK) dan
                SPKK / PUKONSA dan Sijil Taraf Bumiputera yang dikeluarkan oleh Bahagian Pembangunan Kontraktor dan Usahawan , Kementerian Pembangunan
                Usahawan Malaysia</h5> --}}
        </section>
    </main>
</body>

