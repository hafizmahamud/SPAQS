<!DOCTYPE HTML>
@extends('frontend.layouts.app')

@section('title', __('Dashboard'))

@section('content')
    <main id="main" class="main" style="margin-top: 0;margin-left: 0;margin-right: 0;">
        <div class="content">
            <div class="item">
                <a onclick="checkSisdant()">
                    <img src="spaqs/assets/img/DAFTAR PEROLEHAN.png" alt="">
                    <div class="text" >
                        <div class="text-inner">
                            {{-- Sistem Pendaftaran Nombor<br> Tender Sebutharga --}}
                        </div>
                    </div>
                </a>
            </div>
            <div class="item">
                <a onclick="checkTunas()">
                    <img src="spaqs/assets/img/IKLAN PEROLEHAN.png" alt="">
                        <div class="text" >
                            <div class="text-inner">
                            {{-- Unit Tender & Sistem Pengiklanan --}}
                        </div>
                    </div>
                </a>
            </div>
            <div class="item">
                <a onclick="checkAwas()">
                    <img src="spaqs/assets/img/PEMANTAUAN TENDER.png" alt="">
                    <div class="text">
                            <div class="text-inner">
                            {{-- Sistem Pengawasan Tender --}}
                            </div>
                    </div>
                </a>
            </div>
        </div>
    </main>
@endsection
@section('js')
    <style>
    .swal2-close {
        border-color : white !important;
    }
    </style>
    <script src={{ Module::asset('sisdant:js/3_3_1_jquery.min.js') }}></script>
    <script>
        var sisdant = @json($sisdant);
        var tunas = @json($tunas);
        var awas = @json($awas);

        $( document ).ready(function() {
                Swal.fire({
                    title: '<strong style="font-size: 20px; margin-bottom: 30px">MAKLUMAN</strong>',
                    html:
                        '<p style="margin-top: -10px">Anda mempunyai <b style="color: blue; font-size: 20px">' + sisdant +'</b> tugasan di DAFTAR PEROLEHAN </p><br>' +
                        '<p style="margin-top: -10px">Anda mempunyai <b style="color: deepskyblue ; font-size: 20px">' + tunas + '</b> tugasan di IKLAN PEROLEHAN </p><br>' +
                        '<p style="margin-top: -10px">Anda mempunyai <b style="color: navy ; font-size: 20px">' + awas + ' </b> tugasan di PEMANTAUAN TENDER</p> <br>',
                    showCancelButton: false,
                    showConfirmButton: false,
                    showCloseButton: true
                })
        });
    </script>

    <script>
        var user = @json(auth()->user());
        var role = user.roles;

        function checkSisdant() {
            var count = 0 ;
            for (let i = 0; i < role.length; i++) {
                if(role[i].name == "PELAKSANA" || role[i].name  == "PENGESAH NOMBOR PEROLEHAN") {
                    count = 1;
                }
            }

            if(count == 1) {
                window.location.href="/sisdant";
            } else {
                Swal.fire({
                    icon: 'error',
                    text: 'Tiada akses Daftar Perolehan.',
                    showConfirmButton: false,
                    timer: 2000,
                    width: 350
                })
            }
        }

        function checkTunas() {
            var count = 0 ;
            for (let i = 0; i < role.length; i++) {
                if(role[i].name == "PENGIKLAN" ) {
                    count = 1;
                    break;
                } else if(role[i].name  == "PENYARING PETENDER"  ) {
                    count = 2;
                    break;
                } else if(role[i].name  == "PENDAFTAR JADUAL HARGA"  ) {
                    count = 3;
                }
            }

            if(count == 1) {
                window.location.href="/tunas";
            } else if (count == 2) {
                window.location.href="/tunas/senaraiiklanbelumtutup";
            } else if (count == 3) {
                window.location.href="/tunas/iklan-telah-tutup";
            } else {
                Swal.fire({
                    icon: 'error',
                    text: 'Tiada akses Iklan Perolehan.',
                    showConfirmButton: false,
                    timer: 2000,
                    width: 350
                })
            }
        }

        function checkAwas() {
            var count = 0 ;
            for (let i = 0; i < role.length; i++) {
                if(role[i].name == "PENDAFTAR PENILAI" || role[i].name  == "PEGAWAI PENILAI 1" || role[i].name  == "PEGAWAI PENILAI 2" || role[i].name  =="PENDAFTAR KEPUTUSAN LP" || role[i].name  =="PENYEDIA DOKUMEN" ) {
                    count = 1;
                }
            }

            if(count == 1) {
                window.location.href="/awas";
            } else {
                Swal.fire({
                    icon: 'error',
                    text: 'Tiada akses Pemantauan Tender.',
                    showConfirmButton: false,
                    timer: 2000,
                    width: 350
                })
            }
        }

    </script>
@endsection
<style>
    .alert-danger{
        position: absolute !important;
    }
    .alert-success{
        position: absolute !important;
    }
    .alert-warning{
        position: absolute !important;
    }
</style>
