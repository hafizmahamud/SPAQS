<!DOCTYPE HTML>
@extends('awas::layouts.master')

@section('content')
<div class="pagetitle">
    <h1>Akaun Saya</h1>
    @if (config('boilerplate.frontend_breadcrumbs'))
        @include('frontend.includes.partials.breadcrumbs')
    @endif
</div>
<section class="section">
    <ul style="width: 30%;" class="nav nav-tabs d-flex" id="myTabjustified" role="tablist" style="background: white!important;">
        <li class="nav-item flex-fill" role="presentation" style="width: 50%;">
            <button class="nav-link w-100 active" id="home-tab" data-bs-toggle="tab"
                data-bs-target="#my-profile" type="button" role="tab" aria-controls="my-profile-tab"
                aria-selected="true">Akaun Saya</button>
        </li>
        <li class="nav-item flex-fill" role="presentation" style="width: 50%;">
            <button class="nav-link w-100" id="profile-tab" data-bs-toggle="tab"
                data-bs-target="#password" type="button" role="tab" aria-controls="password-tab"
                aria-selected="false">Kata Laluan</button>
        </li>
    </ul>
    <div class="tab-content pt-2" id="myTabjustifiedContent" style="padding-top: 0px!important;">
        <div class="tab-pane fade pt-3 show active" id="my-profile" role="tabpanel" aria-labelledby="my-profile-tab">
            <div class="card">
                <div style="margin-top: 25px">
                @include('frontend.user.account.tabs.profile')
                </div>
            </div>
        </div><!--tab-profile-->

        @if (! $logged_in_user->isSocial())
            <div class="tab-pane fade pt-3" id="password" role="tabpanel" aria-labelledby="password-tab">
                <div class="card">
                    <div style="margin-top: 25px">
                        @include('frontend.user.account.tabs.password')
                </div>
            </div>
            </div><!--tab-password-->
        @endif
    </div><!--tab-content-->
</section>

@endsection
<style>

    .table>:not(caption)>*>* {
        padding: 0.75rem !important;
        background-color: var(--bs-table-bg);
        border-bottom-width: 1px;
        box-shadow: inset 0 0 0 9999px var(--bs-table-accent-bg);
    }

    .table-hover>tbody>tr:hover>* {
        --bs-table-accent-bg: rgb(221 214 214 / 8%) !important;
    }

    .form-control-account {
        display: block;
        width: 100%;
        padding: .375rem .75rem;
        font-size: 14px;
        font-weight: 400 !important;
        line-height: 1.5;
        color: #212529 !important;
        background-color: #fff !important;
        background-clip: padding-box;
        border: 1px solid #ced4da !important;
        appearance: none;
        border-radius: 5px 0px 0px 5px;
        transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
    }

    .input-group-login {
        position: relative;
        display: flex;
        flex-wrap: wrap;
        align-items: stretch;
        width: 100%;
    }

    .input-group-login > .form-control-account, .input-group > .form-select {
        position: relative;
        flex: 1 1 auto;
        width: 1%;
        min-width: 0;
    }

    .input-group-text-login {
        display: flex;
        align-items: center;
        padding: .375rem .75rem;
        font-size: 1rem;
        font-weight: 400;
        line-height: 1.5;
        color: #ffffff;
        text-align: center;
        white-space: nowrap;
        background-color: #9797974f;
        border-radius: 0px 5px 5px 0px;
    }

    .form-control-account::placeholder {
        opacity: 0.7 !important;
        color: #212529 !important;
    }

    .form-control-account:focus {
        color: #212529;
        background-color: #fff;
        border-color: #86b7fe;
        outline: 0;
        box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
    }

</style>
<script src={{ Module::asset('sisdant:js/3_3_1_jquery.min.js') }}></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    var user = @json($user);

    function tindakan (action) {
        if (action == "inputnama") {
            document.getElementById('namatr').style.display="none";
            document.getElementById('inputnama').style.display="table-row";
            document.getElementById('binputbahagian').style.display="block";
            hideClass();
        } else if (action == "nama") {
            document.getElementById('namatr').style.display="table-row";
            document.getElementById('inputnama').style.display="none";
            showClass();
            data();
        } else if (action == "inputic") {
            document.getElementById('ictr').style.display="none";
            document.getElementById('inputic').style.display="table-row";
            document.getElementById('binputbahagian').style.display="block";
            hideClass();
        } else if (action == "ic") {
            document.getElementById('ictr').style.display="table-row";
            document.getElementById('inputic').style.display="none";
            showClass();
            data();
        } else if (action == "inputnegeri") {
            document.getElementById('negeritr').style.display="none";
            document.getElementById('inputnegeri').style.display="table-row";
            document.getElementById('bahagiantr').style.display="none";
            document.getElementById('binputbahagian').style.display="none";
            document.getElementById('inputbahagian').style.display="table-row";
            hideClass();
        } else if (action == "negeri") {
            document.getElementById('negeritr').style.display="table-row";
            document.getElementById('inputnegeri').style.display="none";
            document.getElementById('bahagiantr').style.display="table-row";
            document.getElementById('inputbahagian').style.display="none";
            showClass();
            data();
        } else if (action == "inputbahagian") {
            document.getElementById('bahagiantr').style.display="none";
            document.getElementById('inputbahagian').style.display="table-row";
            document.getElementById('binputbahagian').style.display="block";
            hideClass();
        } else if (action == "bahagian") {
            document.getElementById('bahagiantr').style.display="table-row";
            document.getElementById('inputbahagian').style.display="none";
            showClass();
            data();
        } else if (action == "inputjawatan") {
            document.getElementById('jawatantr').style.display="none";
            document.getElementById('inputjawatan').style.display="table-row";
            document.getElementById('binputbahagian').style.display="block";
            hideClass();
        } else if (action == "jawatan") {
            document.getElementById('jawatantr').style.display="table-row";
            document.getElementById('inputjawatan').style.display="none";
            showClass();
            data();
        }
    }

    function hideClass () {
        var divsToHide = document.getElementsByClassName("bi bi-pencil-square"); //divsToHide is an array
        for(var i = 0; i < divsToHide.length; i++){
            divsToHide[i].style.display = "none";
        }
    }

    function showClass () {
        var divsToHide = document.getElementsByClassName("bi bi-pencil-square"); //divsToHide is an array
        for(var i = 0; i < divsToHide.length; i++){
            divsToHide[i].style.display = "block";
        }
    }

    function data () {
        document.getElementById('nama').value = user.name;
        document.getElementById('no_kad_pengenalan').value = user.ic_no;
        if (document.getElementById('negeri').value != 16) {
            var negeri = user.negeri_id;
            $.ajax({
                url: '/profile/pejabat',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    'negeri': user.negeri_id
                },
                type: 'post',
                dataType: 'json',
                success: function (response) {
                    var len = response[0].length;
                    $("#bahagian").empty();
                    if (len) {
                        $("#bahagian").append("<option value=''>Sila Pilih</option>");
                        for (var i = 0; i < len; i++) {
                            var id = response[0][i].id;
                            var name = response[0][i].bahagian;

                            if( negeri == user.negeri_id && id == user.section_id) {
                                $("#bahagian").append("<option value='" + id + "' selected>" + name +
                                    "</option>");
                            } else {
                                $("#bahagian").append("<option value='" + id + "'>" + name +
                                    "</option>");
                            }
                        }
                    }
                }
            });

        }
        document.getElementById('negeri').value = user.negeri_id;
        document.getElementById('jawatan').value = user.jawatan;

    }

    $(document).ready(function () {

        $('#negeri').on('change', function () {
            console.log('INI');
            var negeri = $('#negeri option:selected').val();
            $.ajax({
                url: '/profile/pejabat',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    'negeri': negeri
                },
                type: 'post',
                dataType: 'json',
                success: function (response) {
                    var len = response[0].length;
                    $("#bahagian").empty();
                    if (len) {
                        $("#inputbahagian").show();
                        $("#bahagian").append("<option value=''>Sila Pilih</option>");
                        for (var i = 0; i < len; i++) {
                            var id = response[0][i].id;
                            var name = response[0][i].bahagian;

                            if( negeri == user.negeri_id && id == user.section_id) {
                                $("#bahagian").append("<option value='" + id + "' selected>" + name +
                                    "</option>");
                            } else {
                                $("#bahagian").append("<option value='" + id + "'>" + name +
                                    "</option>");
                            }
                        }
                    } else {
                        $("#bahagian").append("<option value=''>Tiada bahagian</option>");

                    }
                }
            });
        });
    });

    function save (actions) {
        document.getElementById("action").value = actions;
        document.getElementById("profileForm").submit();
    }



</script>
<script>
    function show(password) {
        var a = document.getElementById(password);
        if (a.type === "password") {
            a.type = "text";
        } else {
            a.type = "password";
        }
    }
</script>
