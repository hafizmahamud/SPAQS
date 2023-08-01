<!DOCTYPE HTML>
@extends('awas::layouts.master')

@section('content')
      <div class="pagetitle">
        <h1>Dokumen Butiran SST</h1>
        @if (config('boilerplate.frontend_breadcrumbs'))
          @include('frontend.includes.partials.breadcrumbs')
        @endif
      </div><!-- End Page Title -->
        <section class="section">
            <div class="card" style="border-radius: 25px;">
                <form method="post" action="{{ url('/awas/dokumenSST')}}"  enctype="multipart/form-data">
                    @method('PATCH')
                    @csrf
                    <div class="card-body">
                        <div class="card-body-template">
                            <div class="row mb-3" style="margin-bottom: -70px">
                                <div class="col-lg-6">
                                    <label class="form-label" style="font-weight: bold;">Templat Surat Setuju terima</label>
                                    <div class="row mb-3">
                                    @if($template != NULL)
                                        <label style="color: blue;"><a href='/awas/file/{{ $template->name }}'>{{ $template->name }}</a></label><br>
                                    @endif
                                    </div>
                                </div>

                                <div class="col-lg-6" style="margin-bottom: -70px">
                                    <label class=" form-label" style="font-weight: bold;">Muat Naik Surat Setuju terima</label>
                                    <div class="row mb-3">
                                            <div class="col-lg-3">
                                                <input for="upload" type="button" class="btn btn-outline-primary" value="Muat Naik"
                                                    onclick="document.getElementById('upload').click();" style="width: 100%;" />
                                                <input class="form-control" type="file" id="upload" name="file_upload"
                                                    style="display:none;" accept=".pdf">
                                                <input class="form-control" type="text" id="upload_file" name="upload_file"
                                                    style="display:none;">
                                                <input type="text" name="penilaian_id" value="{{$iklan->id}}" hidden>
                                            </div>
                                            <div class="col-lg-6">
                                                <div id="selectedFiles" name="selectedFiles" style="color: #0d6efd;"></div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div>
                                                @if($iklan->dokumenSST->isEmpty())
                                                    <button class="btn btn-success" id="simpan" name="simpan" type="submit" value="simpan" style="width: 70%;">Simpan</button>
                                                @else
                                                    <button class="btn btn-success" id="simpan" name="simpan" type="submit" value="simpan" style="width: 70%;">Kemaskini</button>
                                                @endif
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body-template">
                            <h6 class="card-title" style="color:black; font-weight: bold">Surat Setuju Terima</h6>
                            <div class="row">
                                <div class="col-5">
                                    <p class="text-right" style="font-weight:normal">No. Tender / Kontrak</p>
                                </div>
                                <div class="col-5">
                                    <p class="text-left">{{$iklan->iklanPerolehan->mohonNoPerolehan['no_perolehan']}}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-5">
                                    <p class="text-right" style="font-weight:normal">Rujukan Agensi</p>
                                </div>
                                <div class="col-5">
                                    <p class="text-left">{{$iklan->no_rujukan}}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-5">
                                    <p class="text-right" style="font-weight:normal">Nama Syarikat</p>
                                </div>
                                <div class="col-5">
                                    @if($iklan->borangDaftarMinat == NULL)
                                        <p class="text-left">{{$iklan['nama_syarikat']}}</p>
                                    @else
                                        <p class="text-left">{{$iklan->borangDaftarMinat->lawatanTapak['name_syarikat']}}</p>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-5">
                                    <p class="text-right" style="font-weight:normal">Alamat Syarikat</p>
                                </div>
                                <div class="col-5">
                                @if($iklan->borangDaftarMinat == NULL)
                                    <p class="text-left">{{$iklan['alamat']}}</p>
                                    <p class="text-left">{{$iklan['alamat2']}}</p>
                                    <p class="text-left">{{$iklan['alamat3']}}</p>
                                    <p class="text-left">{{$iklan['poskod']}}, {{$iklan['bandar']}}, {{$iklan['negeri']}}</p>
                                @else
                                    <p class="text-left">{{$iklan->borangDaftarMinat->lawatanTapak['alamat']}}</p>
                                    <p class="text-left">{{$iklan->borangDaftarMinat->lawatanTapak['alamat2']}}</p>
                                    <p class="text-left">{{$iklan->borangDaftarMinat->lawatanTapak['alamat3']}}</p>
                                    <p class="text-left">{{$iklan->borangDaftarMinat->lawatanTapak['poskod']}}, {{$iklan->borangDaftarMinat->lawatanTapak['bandar']}}, {{$iklan->borangDaftarMinat->lawatanTapak['negeri']}}</p>
                                @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-5">
                                    <p class="text-right" style="font-weight:normal">Tajuk Tender</p>
                                </div>
                                <div class="col-5">
                                    <p class="text-left">{{$iklan->iklanPerolehan->mohonNoPerolehan['tajuk_perolehan']}}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-5">
                                    <p class="text-right" style="font-weight:normal">Harga Kontrak (RM)</p>
                                </div>
                                <div class="col-5">
                                    <p class="text-left">{{$iklan->harga}}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-5">
                                    <p class="text-right" style="font-weight:normal">Tempoh Siap Kerja Yang Ditenderkan</p>
                                </div>
                                <div class="col-5">
                                    <p class="text-left">{{$iklan->tempoh}}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-5">
                                    <p class="text-right" style="font-weight:normal">Bon Pelaksanaan Yang Tidak Boleh Dibatalkan (RM)</p>
                                </div>
                                <div class="col-5">
                                    <p class="text-left">{{ $nilai_bon }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-5">
                                    <p class="text-right" style="font-weight:normal">Polisi Insurans Tangungan Awam (RM)</p>
                                </div>
                                <div class="col-5">
                                    <p class="text-left"> {{$nilai_polisi}} </p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-5">
                                    <p class="text-right" style="font-weight:normal">Bilangan Peserta PROTEGE</p>
                                </div>
                                <div class="col-5">
                                    <p class="text-left">{{$protege}} peserta</p>
                                </div>
                            </div>
                        </div>

                        <div class="card-body-template">
                            <h6 class="card-title" style="color:black; font-weight: bold">Butiran Kontrak</h6>
                            <div class="row">
                                <div class="col-5">
                                    <p class="text-right" style="font-weight:normal">Tajuk Tender</p>
                                </div>
                                <div class="col-5">
                                    <p class="text-left">{{$iklan->iklanPerolehan->mohonNoPerolehan['tajuk_perolehan']}}</p>
                                </div>
                            </div>
                            @if($iklan->iklanPerolehan['status_iklan_id'] != 7)
                                <h6 class="card-title" style="color:black; font-weight: bold; font-size: 15px">Pendaftaran Dengan Lembaga Pembangunan Industri Pembinaan Malaysia (CIDB) Di Bawah Perakuan Pendaftaran Kontraktor</h6>
                                <div class="row">
                                    <div class="col-5">
                                        <p class="text-right" style="font-weight:normal">Nombor Pendaftaran</p>
                                    </div>
                                    <div class="col-5">
                                        <p class="text-left">{{$iklan->borangDaftarMinat['no_cidb']}}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-5">
                                        <p class="text-right" style="font-weight:normal">Tempoh Sah Laku</p>
                                    </div>
                                    <div class="col-5">
                                        <p class="text-left">{{\Carbon\Carbon::parse($iklan->borangDaftarMinat['tarikh_tamat_cidb'])->format('d/m/Y')}}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-5">
                                        <p class="text-right" style="font-weight:normal">Gred</p>
                                    </div>
                                    <div class="col-5">
                                        <p class="text-left">{{$iklan->iklanPerolehan->grade['nama']}}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-5">
                                        <p class="text-right" style="font-weight:normal">Kategori</p>
                                    </div>
                                    <div class="col-5">
                                    @if($kelas->isEmpty())
                                            <p class="text-left">Tiada</p>
                                    @else
                                        @foreach ($kelas as $indexKey =>$d)
                                            <p class="text-left">{{$d->kelas['kod']}} - {{$d->kelas['kelas']}}</p>
                                        @endforeach
                                    @endif
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-5">
                                        <p class="text-right" style="font-weight:normal">Pengkhususan</p>
                                    </div>
                                    <div class="col-5">
                                    @if($pengkhususan->isEmpty())
                                            <p class="text-left">Tiada</p>
                                    @else
                                        @foreach ($pengkhususan as $indexKey =>$d)
                                            <p class="text-left">({{$d->kelas['kod']}}) : {{$d->khusus['kod']}}- {{$d->khusus['pengkhususan']}}</p>
                                        @endforeach
                                    @endif
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-5">
                                        <p class="text-right" style="font-weight:normal">Sijil Pendaftaran CIDB</p>
                                    </div>
                                    <div class="col-5">
                                        <p class="text-left"><a href='/{{ $iklan->borangDaftarMinat["doc_sijil_cidb_path"] }}'
                                            target="_blank">{{ $iklan->borangDaftarMinat["doc_sijil_cidb_nama"] }}</a></p>
                                    </div>
                                </div>
                                @if($iklan->borangDaftarMinat["doc_sijil_kebenaran_khas_path"])
                                <div class="row">
                                    <div class="col-5">
                                        <p class="text-right" style="font-weight:normal">Sijil Kebenaran Khas</p>
                                    </div>
                                    <div class="col-5">
                                        <p class="text-left"><a href='/{{ $iklan->borangDaftarMinat["doc_sijil_kebenaran_khas_path"] }}'
                                            target="_blank">{{ $iklan->borangDaftarMinat["doc_sijil_kebenaran_khas_nama"] }}</a></p>
                                    </div>
                                </div>
                                @endif
                                <h6 class="card-title" style="color:black; font-weight: bold; font-size: 15px">Pendaftaran Dengan Lembaga Pembangunan Industri Pembinaan Malaysia (CIDB) Di Bawah Sijil Perolehan Kerja Kerajaan</h6>
                                <div class="row">
                                    <div class="col-5">
                                        <p class="text-right" style="font-weight:normal">Nombor Pendaftaran</p>
                                    </div>
                                    <div class="col-5">
                                        <p class="text-left">{{$iklan->borangDaftarMinat['no_sijil_spkk']}}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-5">
                                        <p class="text-right" style="font-weight:normal">Tempoh Sah Laku Sijil</p>
                                    </div>
                                    <div class="col-5">
                                        <p class="text-left">{{\Carbon\Carbon::parse($iklan->borangDaftarMinat['tarikh_tamat_spkk'])->format('d/m/Y')}}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-5">
                                        <p class="text-right" style="font-weight:normal">Gred</p>
                                    </div>
                                    <div class="col-5">
                                        <p class="text-left">{{$iklan->iklanPerolehan->grade['nama']}}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-5">
                                        <p class="text-right" style="font-weight:normal">Kategori</p>
                                    </div>
                                    <div class="col-5">
                                    @if($kelas->isEmpty())
                                            <p class="text-left">Tiada</p>
                                    @else
                                        @foreach ($kelas as $indexKey =>$d)
                                            <p class="text-left">{{$d->kelas['kod']}} - {{$d->kelas['kelas']}}</p>
                                        @endforeach
                                    @endif
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-5">
                                        <p class="text-right" style="font-weight:normal">Pengkhususan</p>
                                    </div>
                                    <div class="col-5">
                                    @if($pengkhususan->isEmpty())
                                            <p class="text-left">Tiada</p>
                                    @else
                                        @foreach ($pengkhususan as $indexKey =>$d)
                                            <p class="text-left">({{$d->kelas['kod']}}) : {{$d->khusus['kod']}}- {{$d->khusus['pengkhususan']}}</p>
                                        @endforeach
                                    @endif
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-5">
                                        <p class="text-right" style="font-weight:normal">Sijil Pendaftaran CIDB</p>
                                    </div>
                                    <div class="col-5">
                                    <p class="text-left"><a href='/{{ $iklan->borangDaftarMinat["doc_sijil_spkk_path"] }}'
                                            target="_blank">{{ $iklan->borangDaftarMinat["doc_sijil_spkk_nama"] }}</a></p>
                                    </div>
                                </div>
                                <h6 class="card-title" style="color:black; font-weight: bold; font-size: 15px">Pendaftaran Dengan Pusat Khidmat Kontraktor (PKK) (Sijil Bumiputera)</h6>
                                <div class="row">
                                    <div class="col-5">
                                        <p class="text-right" style="font-weight:normal">Nombor Pendaftaran</p>
                                    </div>
                                    <div class="col-5">
                                        <p class="text-left">{{$iklan->borangDaftarMinat['no_sijil_sij_bumiputera']}}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-5">
                                        <p class="text-right" style="font-weight:normal">Tempoh Sah Laku Sijil</p>
                                    </div>
                                    <div class="col-5">
                                        <p class="text-left">{{\Carbon\Carbon::parse($iklan->borangDaftarMinat['tarikh_tamat_sij_bumiputera'])->format('d/m/Y')}}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-5">
                                        <p class="text-right" style="font-weight:normal">Gred Kontraktor</p>
                                    </div>
                                    <div class="col-5">
                                        <p class="text-left">{{$iklan->iklanPerolehan->grade['nama']}}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-5">
                                        <p class="text-right" style="font-weight:normal">Sijil Pendaftaran Sijil Bumiputera</p>
                                    </div>
                                    <div class="col-5">
                                        <p class="text-left"><a href='/{{ $iklan->borangDaftarMinat["doc_sijil_sij_bumiputera_path"] }}'
                                            target="_blank">{{ $iklan->borangDaftarMinat["doc_sijil_sij_bumiputera_nama"] }}</a></p>
                                    </div>
                                </div>
                            @else
                                <h6 class="card-title" style="color:black; font-weight: bold; font-size: 15px">Kementerian Kewangan Malaysia (MOF)</h6>
                                <div class="row">
                                    <div class="col-5">
                                        <p class="text-right" style="font-weight:normal">Gred</p>
                                    </div>
                                    <div class="col-5">
                                        <p class="text-left">{{$iklan->iklanPerolehan->grade['nama']}}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-5">
                                        <p class="text-right" style="font-weight:normal">Kod Bidang</p>
                                    </div>
                                    <div class="col-5">
                                    @if($bidang->isEmpty())
                                            <p class="text-left">Tiada</p>
                                    @else
                                        @foreach ($bidang as $indexKey =>$d)
                                            <p class="text-left">{{$d->bidang['kod']}} - {{$d->bidang['bidang']}}</p>
                                        @endforeach
                                    @endif
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-5">
                                        <p class="text-right" style="font-weight:normal">Sub Bidang</p>
                                    </div>
                                    <div class="col-5">
                                    @if($subbidang->isEmpty())
                                            <p class="text-left">Tiada</p>
                                    @else
                                        @foreach ($subbidang as $indexKey =>$d)
                                            <p class="text-left">({{$d->bidang['kod']}}) : {{$d->subbidang['kod']}}- {{$d->subbidang['sub_bidang']}}</p>
                                        @endforeach
                                    @endif
                                    </div>
                                </div>
                            @endif
                            @if(!$tajuk_pukonsa->isEmpty())
                                <h6 class="card-title" style="color:black; font-weight: bold; font-size: 15px">Pendaftaran Dengan Pusat Pendaftaran Kontraktor Kerja, Bekalan Perkhidmatan Negeri Sabah (PUKONSA)</h6>
                                @if($iklan->iklanPerolehan['status_iklan_id'] != 7)
                                    <div class="row">
                                        <div class="col-5">
                                            <p class="text-right" style="font-weight:normal">Nombor Pendaftaran</p>
                                        </div>
                                        <div class="col-5">
                                            <p class="text-left">{{ $iklan->borangDaftarMinat['no_sijil_pukonsa'] }}</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-5">
                                            <p class="text-right" style="font-weight:normal">Tempoh Sah Laku Sijil</p>
                                        </div>
                                        <div class="col-5">
                                            <p class="text-left">{{\Carbon\Carbon::parse($iklan->borangDaftarMinat['tarikh_tamat_pukonsa'])->format('d/m/Y')}}</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-5">
                                            <p class="text-right" style="font-weight:normal">Gred Kontraktor</p>
                                        </div>
                                        <div class="col-5">
                                            <p class="text-left"></p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-5">
                                            <p class="text-right" style="font-weight:normal">Kepala</p>
                                        </div>
                                        <div class="col-5">
                                        @if($tajuk_pukonsa->isEmpty())
                                                <p class="text-left">Tiada</p>
                                        @else
                                            @foreach ($tajuk_pukonsa as $indexKey =>$d)
                                                <p class="text-left">{{$d->kelas['tajuk']}} - {{$d->kelas['keterangan']}}</p>
                                            @endforeach
                                        @endif
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-5">
                                            <p class="text-right" style="font-weight:normal">Sub Kepala</p>
                                        </div>
                                        <div class="col-5">
                                        @if($tajuk_subtajuk_pukonsa->isEmpty())
                                                <p class="text-left">Tiada</p>
                                        @else
                                            @foreach ($tajuk_subtajuk_pukonsa as $indexKey =>$d)
                                                <p class="text-left">({{$d->kelas['tajuk']}}) :  {{$d->khusus['tajuk_kecil']}} - {{$d->khusus['keterangan']}}</p>
                                            @endforeach
                                        @endif
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-5">
                                            <p class="text-right" style="font-weight:normal">Sijil Pendaftaran PUKONSA</p>
                                        </div>
                                        <div class="col-5">
                                            <p class="text-left"><a href='/{{ $iklan->borangDaftarMinat["doc_sijil_pukonsa_path"] }}'
                                                target="_blank">{{ $iklan->borangDaftarMinat["doc_sijil_pukonsa_nama"] }}</a></p>
                                        </div>
                                    </div>
                                @else
                                    <div class="row">
                                        <div class="col-5">
                                            <p class="text-right" style="font-weight:normal">Kepala</p>
                                        </div>
                                        <div class="col-5">
                                        @if($tajuk_pukonsa->isEmpty())
                                                <p class="text-left">Tiada</p>
                                        @else
                                            @foreach ($tajuk_pukonsa as $indexKey =>$d)
                                                <p class="text-left">{{$d->kelas['tajuk']}} - {{$d->kelas['keterangan']}}</p>
                                            @endforeach
                                        @endif
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-5">
                                            <p class="text-right" style="font-weight:normal">Sub Kepala</p>
                                        </div>
                                        <div class="col-5">
                                        @if($tajuk_subtajuk_pukonsa->isEmpty())
                                                <p class="text-left">Tiada</p>
                                        @else
                                            @foreach ($tajuk_subtajuk_pukonsa as $indexKey =>$d)
                                                <p class="text-left">({{$d->kelas['tajuk']}}) :  {{$d->khusus['tajuk_kecil']}} - {{$d->khusus['keterangan']}}</p>
                                            @endforeach
                                        @endif
                                        </div>
                                    </div>
                                @endif
                            @endif
                            @if(!$tajuk_upkj->isEmpty())
                                <h6 class="card-title" style="color:black; font-weight: bold; font-size: 15px">Pendaftaran Dengan Unit Pendaftaran Kontraktor Dan Juruperunding, Pejabat Setiausaha Kewangan Negeri Sarawak (UPKJ)</h6>
                                @if($iklan->iklanPerolehan['status_iklan_id'] != 7)
                                    <div class="row">
                                        <div class="col-5">
                                            <p class="text-right" style="font-weight:normal">Nombor Pendaftaran</p>
                                        </div>
                                        <div class="col-5">
                                            <p class="text-left">{{ $iklan->borangDaftarMinat['no_sijil_upkj'] }}</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-5">
                                            <p class="text-right" style="font-weight:normal">Tempoh Sah Laku Sijil</p>
                                        </div>
                                        <div class="col-5">
                                            <p class="text-left">{{\Carbon\Carbon::parse($iklan->borangDaftarMinat['tarikh_tamat_upkj'])->format('d/m/Y')}}</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-5">
                                            <p class="text-right" style="font-weight:normal">Gred Kontraktor</p>
                                        </div>
                                        <div class="col-5">
                                            <p class="text-left"></p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-5">
                                            <p class="text-right" style="font-weight:normal">Kod Bidang</p>
                                        </div>
                                        <div class="col-5">
                                        @if($tajuk_upkj->isEmpty())
                                                <p class="text-left">Tiada</p>
                                        @else
                                            @foreach ($tajuk_upkj as $indexKey =>$d)
                                                <p class="text-left">{{$d->kelas['tajuk']}} - {{$d->kelas['keterangan']}}</p>
                                            @endforeach
                                        @endif
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-5">
                                            <p class="text-right" style="font-weight:normal">Sijil Pendaftaran UPKJ</p>
                                        </div>
                                        <div class="col-5">
                                            <p class="text-left"><a href='/{{ $iklan->borangDaftarMinat["doc_sijil_upkj_path"] }}'
                                                target="_blank">{{ $iklan->borangDaftarMinat["doc_sijil_upkj_nama"] }}</a></p>
                                        </div>
                                    </div>
                                @else
                                    <div class="row">
                                        <div class="col-5">
                                            <p class="text-right" style="font-weight:normal">Kod Bidang</p>
                                        </div>
                                        <div class="col-5">
                                        @if($tajuk_upkj->isEmpty())
                                                <p class="text-left">Tiada</p>
                                        @else
                                            @foreach ($tajuk_upkj as $indexKey =>$d)
                                                <p class="text-left">{{$d->kelas['tajuk']}} - {{$d->kelas['keterangan']}}</p>
                                            @endforeach
                                        @endif
                                        </div>
                                    </div>
                                @endif
                            @endif
                            <h6 class="card-title" style="color:black; font-weight: bold; font-size: 15px">Harga Dan Tempoh Kontrak</h6>
                            <div class="row">
                                <div class="col-5">
                                    <p class="text-right" style="font-weight:normal">Harga Tender (RM)</p>
                                </div>
                                <div class="col-5">
                                    <p class="text-left">{{$iklan->harga}}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-5">
                                    <p class="text-right" style="font-weight:normal">Harga Kontrak (RM)</p>
                                </div>
                                <div class="col-5">
                                    <p class="text-left">{{$iklan->harga}}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-5">
                                    <p class="text-right" style="font-weight:normal">Tempoh Kontrak</p>
                                </div>
                                <div class="col-5">
                                    <p class="text-left">{{$iklan->tempoh}}</p>
                                </div>
                            </div>
                            <h6 class="card-title" style="color:black; font-weight: bold; font-size: 15px">Bon Pelaksanaan</h6>
                            <div class="row">
                                <div class="col-5">
                                    <p class="text-right" style="font-weight:normal">Kadar Bon Pelaksanaan</p>
                                </div>
                                <div class="col-5">
                                    <p class="text-left"> 5% </p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-5">
                                    <p class="text-right" style="font-weight:normal">Formula Bon Pelaksanaan</p>
                                </div>
                                <div class="col-5">
                                    <p class="text-left">5% x Harga Kontrak</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-5">
                                    <p class="text-right" style="font-weight:normal">Nilai Bon Pelaksanaan (RM)</p>
                                </div>
                                <div class="col-5">
                                    <p class="text-left">{{ $nilai_bon }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-5">
                                    <p class="text-right" style="font-weight:normal">Tempoh Sah Laku</p>
                                </div>
                                <div class="col-5">
                                    <p class="text-left">{{$sah_laku}} bulan</p>
                                </div>
                            </div>
                            <h6 class="card-title" style="color:black; font-weight: bold; font-size: 15px">Polisi Insurans Tanggungan Awam</h6>
                            <div class="row">
                                <div class="col-5">
                                    <p class="text-right" style="font-weight:normal">Nilai Polisi (RM) </p>
                                </div>
                                <div class="col-5">
                                    <p class="text-left">{{$nilai_polisi}}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-5">
                                    <p class="text-right" style="font-weight:normal">Tempoh Perlindungan</p>
                                </div>
                                <div class="col-5">
                                    @if($minggu == 0)
                                    <p class="text-left">{{$bulan}} bulan {{$hari}} hari</p>
                                    @else
                                    <p class="text-left">{{$bulan}} bulan {{$minggu}} minggu {{$hari}} hari</p>
                                    @endif
                                </div>
                            </div>
                            <h6 class="card-title" style="color:black; font-weight: bold; font-size: 15px">Kenaan <em>Liquidated & Ascertained Damages (LAD)</em></h6>
                            <div class="row">
                                <div class="col-5">
                                    <p class="text-right" style="font-weight:normal">Formula</p>
                                </div>
                                <div class="col-5">
                                    <p class="text-left"><u>BLR setahun</u><br>
                                            365 hari </p>
                                </div>
                            </div>
                            <h6 class="card-title" style="color:black; font-weight: bold; font-size: 15px">Professional Training And Education For Growing Entrepreneurs (PROTEGE)
                            <i class="bi bi-info-circle-fill"></i>
                                    <span class="tooltip-text" style="right: auto !important;top: auto !important; margin-top: -40px !important; margin-left: 10px !important;">
                                        <a style="font-size: 12px; border-radius: 10px; color: black;display: inline-block; cursor: pointer; text-align: center;">
                                            <p style="font-weight: bold"><u>Formula</u></p> <br>
                                            <p><u>1% X Harga Kontrak*</u><br>
                                            RM 24,000**</p>
                                        </a><br>
                                    </span>
                            </h6>
                            <div class="row">
                                <div class="col-5">
                                    <p class="text-right" style="font-weight:normal">Tertakluk Kepada Pelaksanaan Program PROTEGE</p>
                                </div>
                                <div class="col-5">
                                    <p class="text-left"> Ya / Tidak</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-5">
                                    <p class="text-right" style="font-weight:normal">Bilangan Minimum Peserta PROTEGE</p>
                                </div>
                                <div class="col-5">
                                    <p class="text-left">{{$protege}} peserta</p>
                                </div>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
        </section>
      <style>
        .d-md-flex {
            display: flex!important;
            margin-bottom: 50px;
        }

        .mb-3 {
            margin-top: 10px!important;
            margin-bottom: 50px!important;
        }

        .text-muted {
          margin-left: 10px;
        }
        p {
            margin-top: 0;
            margin-bottom: 6px !important;
        }
      </style>
      <script src={{ Module::asset('sisdant:js/3_3_1_jquery.min.js') }}></script>
      <script>
        document.addEventListener('DOMContentLoaded', function() {
            $('.nav-list a').removeClass('active');
            }, false);

        $("document").ready(function(){
                var local = window.location.origin;
                var url = "/awas/senarai_petender_berjaya";
                $('.link[href="'+url+'"]').addClass('active');
            });
    </script>
    <script>
        // show file name
        document.getElementById('simpan').disabled = true;
        var selDiv = "";
        document.addEventListener("DOMContentLoaded", init, false);

        function init() {
            document.querySelector('#upload').addEventListener('change', handleFileSelect, false);
            selDiv = document.querySelector("#selectedFiles");
        }

        function handleFileSelect(e) {
            var ul = document.createElement('ul');
            if (!e.target.files) return;
            selDiv.innerHTML = "";
            var files = e.target.files;
            if (files.length != 0){
                for (var i = 0; i < files.length; i++) {
                    var count = i;
                    var li = document.createElement('li');
                    li.setAttribute('id', 'file' + i);
                    var f = files[i];
                    li.innerHTML = f.name;
                    ul.appendChild(li);
                }
                document.getElementById('selectedFiles').appendChild(ul);
                document.getElementById('simpan').disabled = false;
            } else {
                document.getElementById('simpan').disabled = true;
            }
        }
        // end file

    </script>
@endsection



