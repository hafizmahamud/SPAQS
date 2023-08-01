<!DOCTYPE HTML>
@extends('tunas::layouts.master')
@section('content')
<div class="pagetitle">
    <h1>Maklumat Petender</h1>
    @if (config('boilerplate.frontend_breadcrumbs'))
    @include('frontend.includes.partials.breadcrumbs')
    @endif

</div><!-- End Page Title -->

<body>
    <main id="main-template" class="main-template" >
        <div class="spanner">
            <div id="wait">
              <img src={{url('spaqs/assets/img/loader.gif')}} width="100%" /><br>
            </div>
          </div>

        <section class="section">
            <div style="padding-bottom: 10px;">
            </div>
            @if(config('boilerplate.access.captcha.saringan_wajib'))
                <div class="row">
                </div>
            @endif
                <div class="card" style="border-radius: 25px;">
                    <div class="card-body">
                        <div class="card-body-template">
                            <div class="row mb-3">
                                <div class="col-lg-6" >
                                    <label class=" form-label">Nama Syarikat Petender</label>
                                    <div>
                                        <input type="text" class="form-control" value="{{$getBorangDaftar->nama_syarikat}}" readonly>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <label class=" form-label">No. Telefon</label>
                                    <div>
                                        <input type="text" class="form-control" value="{{$getBorangDaftar->telno_fon}}" readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                            <div class="col-lg-6" >
                                <label class=" form-label">Nama Pegawai Syarikat Yang Ditauliahkan</label>
                                <div>
                                    <input type="text" class="form-control" value="{{$getBorangDaftar->nama_pegawai}}" readonly>
                                </div>
                            </div>

                            <div class="col-lg-6" >
                                <label class=" form-label">No Faks</label>
                                <div>
                                    <input type="text" class="form-control" value="{{$getBorangDaftar->telno_fax}}" readonly>
                                </div>
                            </div>
                            </div>

                            <div class="row mb-3">
                            <div class="col-lg-6">
                                <label class=" form-label">Jawatan</label>
                                <div>
                                    <input type="text" class="form-control" value="{{ $jawatan->jawatan}}" readonly>
                                </div>
                                <br>
                                <label class="form-label">E-mel Rasmi</label>
                                <div>
                                    <input type="text" class="form-control" value="{{$getBorangDaftar->emel_rasmi}}" readonly>
                                </div>
                            </div>
                                <div class="col-lg-6" >
                                    <label  class="form-label">Alamat Syarikat</label>
                                    <div style="margin-top:1%">
                                        <input type="text" class="form-control" value="{{$getBorangDaftar->alamat_syarikat}}" readonly>
                                    </div>
                                    <div style="margin-top:1%">
                                    <input type="text" class="form-control" value="{{$jawatan->alamat2}}" readonly>
                                    </div>
                                    <div style="margin-top:1%">
                                    <input type="text" class="form-control" value="{{$jawatan->alamat3}}" readonly>
                                    </div>
                                    <div style="margin-top:1%">
                                    <input type="text" class="form-control" value="{{$jawatan->poskod}}, {{$jawatan->bandar}} {{$jawatan->negeri}}" readonly>
                                    </div>
                                </div>
                            </div>

                        </div>

                        {{-- <div class="card-body-template" id="mof">
                            <div class="row mb-3">
                                <div class="col-lg-6" >
                                    <label class=" form-label">No. Sijil Pendaftaran Kementerian Kewangan (MOF)</label>
                                    <div>
                                        <input type="text" class="form-control" value="{{$getBorangDaftar->no_mof}}" readonly>
                                        </div>
                                </div>

                                <div class="col-lg-6" >
                                    <label class=" form-label">Tarikh Tamat Pendaftaran MOF</label>
                                    <div>
                                        <input type="text" class="form-control" value="{{\Carbon\Carbon::parse($getBorangDaftar->tarikh_tamat_mof)->format('d/m/Y')}}" readonly>
                                        </div>
                                </div>
                            </div>

                            <div class="row mb-3">

                                <div class="col-lg-6">
                                    <label class=" form-label">Kod dan Subbidang</label>
                                    <div>
                                        @foreach($getbidang as $t)
                                            <input type="checkbox" disabled
                                            @foreach($getBorangDaftar->kod_sub_bidang_mof as $tg)
                                            {{ ($t->id == $tg)? 'checked disabled' : ''}}
                                            @endforeach >
                                            <span>{{$t->kod}} - {{$t->sub_bidang}}</span></label><br>
                                        @endforeach
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <label class="form-label">Sijil Pendaftaran MOF</label>
                                    <div class="row mb-3">
                                        <div class="col-lg-8" id="muatturun">
                                            <a href='/{{ $getBorangDaftar->doc_sijil_mof_path }}'
                                                target="_blank">{{ $getBorangDaftar->doc_sijil_mof_nama }}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> --}}

                        @if ($borang_daftar->bahagian_5 == true)
                        <div class="card-body-template" id="cidb">
                            <div class="row mb-3">
                                <div class="col-lg-6" >
                                    <label class=" form-label">No. Sijil Pendaftaran CIDB</label>
                                    <div>
                                    <input type="text" class="form-control" value="{{$getBorangDaftar->no_cidb}}" readonly>
                                    </div>
                                </div>

                                <div class="col-lg-6" >
                                    <label class=" form-label">Tarikh Tamat Pendaftaran CIDB</label>
                                    <div>
                                    <input type="text" class="form-control" value="{{\Carbon\Carbon::parse($getBorangDaftar->tarikh_tamat_cidb)->format('d/m/Y')}}" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-lg-6">
                                    <label class=" form-label">Gred</label>
                                    <select class="form-select" name="gred" id="gred" disabled>
                                        @foreach ($grade as $gred)
                                            <option value="{{ $gred->id }}" {{ ( $gred->id == $getBorangDaftar->grade_id) ? 'selected' : '' }}>{{ $gred->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
    
                                <div class="col-lg-6">
                                    <label class="form-label">Sijil Pendaftaran CIDB</label>
                                    <div class="row mb-3">
                                        <div class="col-lg-8" id="muatturun">
                                            <a href='/{{ $getBorangDaftar->doc_sijil_cidb_path }}'
                                                target="_blank">{{ $getBorangDaftar->doc_sijil_cidb_nama }}</a>
                                        </div>
                                    </div>
    
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-lg-6">
                                    <label class=" form-label">Kelas dan Pengkhususan CIDB</label>
                                    <div>
                                        @foreach($getkelas as $t)
                                            <input type="checkbox" disabled
                                            @foreach($getBorangDaftar->kelas_pengkhususan_cidb as $tg)
                                            {{ ($t->id == $tg)? 'checked disabled' : ''}}
                                            @endforeach >
                                            <span>{{$t->kod}} - {{$t->pengkhususan}}</span></label><br>
                                        @endforeach
                                    </div>
                                </div>
    
                                <div class="col-lg-6">
                                    <label class=" form-label">Sijil Kebenaran Khas</label>
                                    <div class="row mb-3">
                                        @if($getBorangDaftar->doc_sijil_kebenaran_khas_nama)
                                        <div class="col-lg-8" id="muatturun">
                                            <a href='/{{ $getBorangDaftar->doc_sijil_kebenaran_khas_path }}'
                                                target="_blank">{{ $getBorangDaftar->doc_sijil_kebenaran_khas_nama }}</a>
                                        </div>
                                        @else
                                        <div class="col-lg-8" id="muatturun">
                                            <a>TIDAK BERKENAAN</a>
                                        </div>
                                        @endif
                                    </div>
                                    </div>
                                </div>

                        </div>
                        @endif

                        @if($borang_daftar->bahagian_1 == true)
                        <div class="card-body-template" id="spkk">
                            <div class="row mb-3">
                                <div class="col-lg-6" >
                                    <label class=" form-label">No. Sijil Pendaftaran Perolehan Kerja Kerajaan (SPKK)</label>
                                    <div>
                                        <input type="text" class="form-control" value="{{$getBorangDaftar->no_sijil_spkk}}" readonly>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <label class=" form-label">Sijil Pendaftaran SPKK</label>
                                    <div class="row mb-3">
                                        <div class="col-lg-8" id="muatturun">
                                            <a href='/{{ $getBorangDaftar->doc_sijil_spkk_path }}'
                                                target="_blank">{{ $getBorangDaftar->doc_sijil_spkk_nama }}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-lg-6" >
                                    <label class=" form-label">Tarikh Tamat Pendaftaran SPKK</label>
                                    <div>
                                        <input type="text" class="form-control" value="{{\Carbon\Carbon::parse($getBorangDaftar->tarikh_tamat_spkk)->format('d/m/Y')}}" readonly>
                                    </div>
                                </div>
                            </div>

                        </div>
                        @endif

                        @if($borang_daftar->bahagian_3 == true)
                        <div class="card-body-template" id="pukonsa">
                            <div class="row mb-3">
                                <div class="col-lg-6" >
                                    <label class=" form-label">No. Sijil Pendaftaran PUKONSA</label>
                                    <div>
                                        <input type="text" class="form-control" value="{{$getBorangDaftar->no_sijil_pukonsa}}" readonly>
                                    </div>
                                </div>
                                <div class="col-lg-6" >
                                    <label class=" form-label">Tarikh Tamat Pendaftaran Pukonsa</label>
                                    <div>
                                        <input type="text" class="form-control" value="{{\Carbon\Carbon::parse($getBorangDaftar->tarikh_tamat_pukonsa)->format('d/m/Y')}}" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-lg-6">
                                    <label class=" form-label">Kelas dan Pengkhususan Pukonsa</label>
                                    <div>
                                        @foreach($getPukonsa as $t)
                                            <input type="checkbox" disabled
                                            @foreach($getBorangDaftar->gred_kontraktor_pukonsa as $tg)
                                            {{ ($t->id == $tg)? 'checked disabled' : ''}}
                                            @endforeach >
                                            <span>{{$t->tajuk_besar}} - {{$t->tajuk_kecil}}</span></label><br>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <label class=" form-label">Sijil Pendaftaran PUKONSA</label>
                                    <div class="row mb-3">
                                        <div class="col-lg-8" id="muatturun">
                                            <a href='/{{ $getBorangDaftar->doc_sijil_pukonsa_path }}'
                                                target="_blank">{{ $getBorangDaftar->doc_sijil_pukonsa_nama }}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        @endif

                        @if($borang_daftar->bahagian_7 == true)
                        <div class="card-body-template" id="upkj">
                            <div class="row mb-3">
                                <div class="col-lg-6" >
                                    <label class=" form-label">No. Sijil Pendaftaran UPKJ</label>
                                    <div>
                                        <input type="text" name="no_UPKJ" class="form-control" value="{{$getBorangDaftar->no_sijil_upkj}}" readonly>
                                    </div>
                                </div>
                                <div class="col-lg-6" >
                                    <label class=" form-label">Tarikh Tamat Pendaftaran UPKJ</label>
                                    <div>
                                        <input type="text" class="form-control" value="{{\Carbon\Carbon::parse($getBorangDaftar->tarikh_tamat_upkj)->format('d/m/Y')}}" readonly>
                                    </div>
                                </div>
                            </div>
    
                            <div class="row mb-3">
                                <div class="col-lg-6">
                                    <label class=" form-label">Kelas dan Pengkhususan UPKJ</label>
                                    <div>
                                        @foreach($getUpkj as $t)
                                            <input type="checkbox" disabled
                                            @foreach($getBorangDaftar->gred_kontraktor_upkj as $tg)
                                            {{ ($t->id == $tg)? 'checked disabled' : ''}}
                                            @endforeach >
                                            <span>{{$t->tajuk_besar}} - {{$t->tajuk_kecil}}</span></label><br>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <label class=" form-label">Sijil Pendaftaran UPKJ</label>
                                    <div class="row mb-3">
                                        <a href='/{{ $getBorangDaftar->doc_sijil_upkj_path }}'
                                            target="_blank">{{ $getBorangDaftar->doc_sijil_upkj_nama }}</a>
                                    </div>
                                </div>
                            </div>

                        </div>
                        @endif

                        @if($borang_daftar->bahagian_2 == true)
                        <div class="card-body-template" id="taraf_bumiputera">
                            <div class="row mb-3">
                                <div class="col-lg-6" >
                                    <label class=" form-label">No. Sijil Pendaftaran Taraf Bumiputera</label>
                                    <div>
                                        <input type="text" class="form-control" value="{{$getBorangDaftar->no_sijil_sij_bumiputera}}" readonly>
                                    </div>
                                </div>
    
                                <div class="col-lg-6" >
                                    <label class=" form-label">Sijil Taraf Bumiputera</label>
                                    <div class="row mb-3">
                                        <div class="col-lg-8" id="muatturun">
                                            <a href='/{{ $getBorangDaftar->doc_sijil_sij_bumiputera_path }}'
                                                target="_blank">{{ $getBorangDaftar->doc_sijil_sij_bumiputera_nama }}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-lg-6" >
                                    <label class=" form-label">Tarikh Tamat pendaftaran Sijil Taraf Bumiputera</label>
                                    <div>
                                        <input type="text" class="form-control" value="{{\Carbon\Carbon::parse($getBorangDaftar->tarikh_tamat_sij_bumiputera)->format('d/m/Y')}}" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div style="margin: 10px;">
                            @endif

                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" value="true" id="rememberMe"  checked disabled>
                                <label class="form-check-label" for="rememberMe" style="color: black;">
                                    <b>PENGAKUAN:</b> Kami mengaku bahawa semua maklumat dan data yang kami berikan melalui Borang  ini adalah semuanya benar dan kami telah mengambil maklum dan sedar akan tindakan yang boleh diambil oleh Kerajaan terhadap kami dan/atau tender kami, sekiranya mana-mana maklumat dan data yang kami berikan itu didapati tidak benar dan palsu.
                                </label>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
                @if($getBorangDaftar['resit_path'])
                    <div class="card" style="border-radius: 25px;" id="resit">
                        <div class="card-body">
                            <div class="card-body-template">
                                <div class="col-lg-6">
                                    <label class=" form-label">Resit</label>
                                    <div class="row mb-3">
                                        <div class="col-lg-8" id="muatturun">
                                            <a href='/{{ $getBorangDaftar->resit_path }}' target="_blank">{{ $getBorangDaftar->resit }}</a>
                                        </div>
                                    </div>
                                </div>
                            <div>
                        </div>
                    </div>
                @endif

                <form id="myForm" autocomplete="off" method="post" action="{{ url('/tunas/saringpetender') }}" enctype="multipart/form-data"
                @if($getBorangDaftar->status_petender == 'dalam proses')
                style="padding: 10px;">
                    @csrf
                    <div class="button-form">
                        <button class="btn btn-primary" type="text" name="tindakan" value="berjaya" style="width: 10%;">Berjaya</button>
                        <button class="btn btn-danger" type="text" name="tindakan" value="gagal" style="width: 10%;">Gagal</button>
                        <button class="btn btn-primary-kembali" type="text" name="tindakan" value="kembali" style="width: 10%; margin-right: 10px;" onclick="history.back()">Kembali</button>
                        <input class="form-control" type="text" id="status" name="status" style="display:none;">
                        <input class="form-control" type="text" name="iklan_perolehan_id" value="{{$iklan_perolehan->id}}" style="display:none;">
                        <input class="form-control" type="text" name="mohon_no_perolehan_id" value="{{$iklan_perolehan->mohon_no_perolehan_id}}" style="display:none;">
                        <input class="form-control" type="text" name="borang_saringan_id" value="{{$getBorangDaftar->id}}" style="display:none;">
                        <input class="form-control" type="text" name="jenis_tender" value="{{$jenisTender}}" style="display:none;">
                        <input class="form-control" type="text" name="cover_dokumen" value="{{$getBorangDaftar->cover_dokumen}}" style="display:none;">
                        <input class="form-control" type="text" name="cover_dokumen_path" value="{{$getBorangDaftar->cover_dokumen_path}}" style="display:none;">
                        <input class="form-control" type="text" name="dokumen_iklan" value="{{$dokumenIklan}}" style="display:none;">
                        @if($dokumenTender != null)
                        <input class="form-control" type="text" name="dokumen_tender" value="{{$dokumenTender->dokumen}}" style="display:none;">
                        @endif
                        @if($dokumenAddendum != null)
                        <input class="form-control" type="text" name="dokumen_addendum" value="{{$dokumenAddendum->dokumen}}" style="display:none;">
                        @endif
                    </div>
                @else
                    <div class="button-form">
                        <button class="btn btn-primary-kembali" type="text" name="tindakan" value="kembali" style="width: 10%; margin-right: 10px;" onclick="history.back()">Kembali</button>
                    </div>
                @endif


        </section>
    </form>


    </main><!-- End #main -->

  </body>
<script>

$('form').submit(function(e){
        e.preventDefault();
        if(document.activeElement.value == 'gagal'){
        document.getElementById('status').value = document.activeElement.value;
        Swal.fire({
            title: "Adakah Anda Pasti Untuk Tidak Meluluskan Petender Ini?",
            showCancelButton: true,
            confirmButtonText: 'Ya',
            cancelButtonText: 'Tidak',
            reverseButtons: true,
            icon: 'question'
        }).then((result) => {
            if (result.value) {
                document.getElementById("myForm").submit();
                $("#wait").css("display", "block");
                $("div.spanner").addClass("show");
            }
        });
        }
        else if(document.activeElement.value == 'berjaya'){
            document.getElementById('status').value = document.activeElement.value;
            Swal.fire({
                title: "Adakah Anda Pasti Untuk Meluluskan Petender Ini?",
                showCancelButton: true,
                confirmButtonText: 'Ya',
                cancelButtonText: 'Tidak',
                reverseButtons: true,
                icon: 'question'
            }).then((result) => {
                if (result.value) {
                    document.getElementById("myForm").submit();
                    $("#wait").css("display", "block");
                    $("div.spanner").addClass("show");
                }
            });
        }
        });

    document.addEventListener('DOMContentLoaded', function() {
        $('.nav-list a').removeClass('active');
    }, false);

    $("document").ready(function(){
            var local = window.location.origin;
            var url = "/tunas/senaraiiklanbelumtutup";
            $('.link[href="'+url+'"]').addClass('active');
        });

</script>
<style>
    .customSwalBtn{
		background-color: #0d6efd;
        border-left-color: #0d6efd;
        border-right-color: #0d6efd;
        border: 0;
        border-radius: 3px;
        box-shadow: none;
        color: #fff;
        cursor: pointer;
        font-size: 17px;
        font-weight: 500;
        margin: 30px 5px 0px 5px;
        padding: 10px 32px;
	}

    .customSwalBtn-batal{
		background-color: #fd0d0d;
        border-left-color: #fd0d0d;
        border-right-color: #fd0d0d;
        border: 0;
        border-radius: 3px;
        box-shadow: none;
        color: #fff;
        cursor: pointer;
        font-size: 17px;
        font-weight: 500;
        margin: 30px 5px 0px 5px;
        padding: 10px 32px;
	}
</style>

@endsection
