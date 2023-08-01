@extends('frontend.layouts.app')

@section('title', __('Register'))

@section('content')
<main
    style="background: url(spaqs/assets/img/login_background.png) no-repeat center center fixed;background-size: cover;">
    <div class="container">

        <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center"
                        style="width: 45%;">

                        <div class="d-flex justify-content-center">
                            <a href="index.html" class="logo d-flex align-items-center w-auto">
                                <img src="spaqs/assets/img/Logo_JPS.png" alt="">
                            </a>
                        </div>
                        <div class="d-flex justify-content-center">
                            <span class="title-login d-none d-lg-block">JABATAN PENGAIRAN DAN SALIRAN MALAYSIA</span>
                        </div>
                        <!-- End Logo -->

                        <div class="mb-3">

                            <div class="card-body">

                                <div>
                                    <h5 class="card-title-login text-center">PENDAFTARAN AKAUN</h5>
                                </div>

                                <form action="{{ route('frontend.auth.register') }}" class="row g-3 needs-validation"
                                    method="POST">
                                    @csrf
                                    <div class="col-12">
                                        <div class="input-group has-validation">
                                            <input type="text" name="name" id="name" class="form-control-login"
                                                value="{{ old('name') }}" placeholder="{{ __('Nama Penuh') }}"
                                                maxlength="100" required autofocus autocomplete="name"
                                                title="Sila masukan nama pengguna."
                                                oninvalid="this.setCustomValidity('Sila masukan nama pengguna.')" />
                                            <span class="invalid-feedback">{{ $errors->first('name') }}</span>
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="input-group has-validation">
                                            <input type="text" name="ic_no" id="ic_no"
                                                onkeypress="return /[0-9]/i.test(event.key)" class="form-control-login"
                                                value="{{ old('ic_no') }}"
                                                placeholder="{{ __('Nombor Kad Pengenalan') }}" required
                                                autocomplete="ic_no" maxlength="12"
                                                title="Sila masukan nombor kad pengenalan."
                                                oninvalid="this.setCustomValidity('Sila masukan nombor kad pengenalan.')"
                                                oninput="setCustomValidity('')" />
                                            <span class="invalid-feedback">{{ $errors->first('ic_no') }}</span>
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="input-group has-validation">
                                            <input type="email" name="email" id="email" class="form-control-login"
                                                placeholder="{{ __('E-mel') }}" value="{{ old('email') }}"
                                                maxlength="255" required autocomplete="email"
                                                title="Sila masukan alamat e-mel yang sah."
                                                oninvalid="this.setCustomValidity('Sila masukan alamat e-mel yang sah.')"
                                                oninput="setCustomValidity('')" />
                                            <span class="invalid-feedback">{{ $errors->first('email') }}</span>
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="input-group-login">
                                            <input type="password" id="password" name="password"
                                                class="form-control-login" placeholder="{{ __('Kata Laluan') }}"
                                                aria-label="password" aria-describedby="basic-addon1"
                                                style="border-radius: 5px 0px 0px 5px;" maxlength="100" required
                                                autocomplete="new-password" title="Sila masukan kata laluan."
                                                oninvalid="this.setCustomValidity('Sila masukan kata laluan.')"
                                                oninput="setCustomValidity('')">
                                            <span class="input-group-text-login" onclick="show('password')"
                                                id="display1"><i class="ri-eye-fill"></i></span>
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="input-group-login">
                                            <input type="password" id="password_confirmation"
                                                name="password_confirmation" class="form-control-login"
                                                placeholder="{{ __('Pengesahan Kata Laluan') }}" aria-label="password"
                                                aria-describedby="basic-addon1" style="border-radius: 5px 0px 0px 5px;"
                                                maxlength="100" required autocomplete="new-password"
                                                title="Sila sahkan kata laluan."
                                                oninvalid="this.setCustomValidity('Sila sahkan kata laluan.')"
                                                oninput="setCustomValidity('')">
                                            <span class="input-group-text-login" onclick="show('password_confirmation')"
                                                id="display2"><i class="ri-eye-fill"></i></span>
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <select class="form-select form-control-login" name="negeri_id" id="negeri_id"
                                            placeholder="Negeri/Pejabat" title="Sila pilih negeri/pejabat."
                                            oninvalid="this.setCustomValidity('Sila pilih negeri/pejabat.')"
                                            oninput="setCustomValidity('')" required>
                                            <option value="">Negeri/Pejabat</option>
                                            @foreach($listnegeri as $negeri)
                                            <option value="{{$negeri->id}}">{{$negeri->negeri}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-6" id="bahagian" style="display:none">
                                        <select class="form-select form-control-login" name="section_id" id="section_id"
                                            placeholder="Bahagian" title="Sila pilih bahagian."
                                            oninvalid="this.setCustomValidity('Sila pilih bahagian.')"
                                            oninput="setCustomValidity('')">
                                            <option value="">Bahagian</option>
                                        </select>
                                    </div>

                                    <div class="col-12">
                                        <i class="bi bi-info-circle-fill"
                                            style="float: left; margin-top: -127px; margin-left: -20px; font-size: 13px;"></i>
                                        <span class="tooltip-text"
                                            style="font-weight: bold; margin-top: -135px; margin-right: 580px;"
                                            data-tooltip-position="left">
                                            <a class="text-left" style="cursor: pointer; color: black;">
                                                Format Nombor Kad Pengenalan </a><br>
                                            <a class="text-left" style="font-weight: bold; color: black;">
                                                12 digit tanpa simbol "-"
                                            </a>
                                        </span>
                                        <button class="btn btn-warning w-100" type="submit">Daftar</button>
                                        <i class="bi bi-info-circle-fill"
                                            style="float: right; margin-top: -82px; margin-right: -20px; font-size: 13px;"></i>
                                        <span class="tooltip-text"
                                            style="font-weight: bold; margin-top: -120px; margin-right: -330px;"
                                            data-tooltip-position="right">
                                            <a class="text-left" style="cursor: pointer; color: black;">
                                                Format Kata Laluan</a><br>
                                            <a class="text-left" style="font-weight: bold;">
                                                <ol style="list-style-type:lower-roman">
                                                    <li style="color: black;">Mengikut standard ISO format ISMS</li>
                                                    <li style="color: black;">Mengandungi minimum 8 aksara</li>
                                                    <li style="color: black;">Mengandungi huruf kecil</li>
                                                    <li style="color: black;">Mengandungi huruf besar</li>
                                                    <li style="color: black;">Mengandungi minimum satu (1) nombor</li>
                                                    <li style="color: black;">Mengandungi minimum satu (1) simbol</li>
                                                </ol>
                                            </a>
                                        </span>
                                    </div>

                                    <div class="col-12 text-center">
                                        <x-utils.link :href="route('frontend.auth.login')"
                                            :active="activeClass(Route::is('frontend.auth.login'))"
                                            :text="__('Kembali')" class="text-center" style="color: white;" />
                                    </div>

                                    <div class="col-12 text-center">
                                        <x-utils.link :href="route('frontend.auth.password.request')"
                                            :text="__('Lupa Kata Laluan')" class="text-center" style="color: white;" />
                                    </div>

                                    @if(count($errors))
                                    <div class="form-group">
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach($errors->all() as $error)
                                                <li>{{$error}}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                    @endif
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </section>

    </div>
    <div class="footer">
        <p>@lang('Copyright') &copy; JPS (SPAQS) 2021</p>
    </div>
</main>

@endsection

<style>
    select {
        display: inline-block;
    }

    ::-ms-reveal {
        display: none;
    }

    ::placeholder {
        color: #2F4F4F !important;
    }

    .form-control-login {
        background-color: #F5FFFA !important;
        color: #2F4F4F !important;
    }

    .footer {
        position: fixed;
        left: 0;
        bottom: 0;
        color: white;
        text-align: center;
        border: none !important;
    }

</style>
<script src={{ Module::asset('sisdant:js/3_3_1_jquery.min.js') }}></script>
<script>
    $(document).ready(function () {
        $('#negeri_id').on('change', function () {
            var negeri = $('#negeri_id option:selected').val();
            $.ajax({
                url: '/register/pejabat',
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
                    $("#section_id").empty();
                    if (len) {
                        $("#bahagian").show();
                        $("#section_id").append("<option value=''>Bahagian</option>");
                        for (var i = 0; i < len; i++) {
                            var id = response[0][i].id;
                            var name = response[0][i].bahagian;
                            $("#section_id").append("<option value='" + id + "'>" + name +
                                "</option>");
                        }
                    } else {

                        $("#bahagian").hide();

                    }
                }
            });
        });
    });

</script>

<script>
    var nameInput = document.querySelector('#name');
    if (nameInput) {
        nameInput.addEventListener('input', function () {
            nameInput.value = nameInput.value.toUpperCase();
        })
    };

    function show(password) {
        var a = document.getElementById(password);
        if (a.type === "password") {
            a.type = "text";

        } else {
            a.type = "password";

        }
    }

</script>
