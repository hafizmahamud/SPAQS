@extends('frontend.layouts.app')

@section('title', __('Reset Password'))

@section('content')

<main style="background: url(/spaqs/assets/img/login_background.png) no-repeat center center fixed; background-size: cover;">
    <div class="container">
        <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">
                        <div class="mb-3">
                            <div class="card-body">
                                <div>
                                    <h5 class="card-title-login text-center">SET SEMULA KATA LALUAN</h5>
                                    <i class="bi bi-info-circle-fill" style="float: right; margin-top: -40px; margin-right: -24px; font-size: 12px;"></i>
                                    <span class="tooltip-text" style="font-weight: bold; margin-right: -300px;"
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
                                <x-forms.post :action="route('frontend.auth.password.update')"
                                    class="row g-3 needs-validation" autocomplete="off">
                                    {!! csrf_field() !!}
                                    <input type="hidden" name="token" value="{{ $token }}" />

                                    <div class="col-12">
                                        <div class="input-group-login" hidden>
                                            <input type="email" name="email" id="email" class="form-control"
                                                placeholder="{{ __('Alamat E-Mel') }}"
                                                value="{{ $email ?? old('email') }}" maxlength="255" required autofocus
                                                autocomplete="email" />
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="input-group-login">
                                            <input type="password" id="password" name="password"
                                                class="form-control-login" placeholder="{{ __('Kata Laluan Baharu') }}"
                                                style="border-radius: 5px 0px 0px 5px;" maxlength="100" required
                                                autocomplete="password" title="Sila masukan kata laluan."
                                                oninvalid="this.setCustomValidity('Sila masukan kata laluan.')"
                                                oninput="setCustomValidity('')">
                                            <span class="input-group-text-login" onclick="show('password')"
                                                id="display1"><i class="ri-eye-fill"></i></span>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="input-group-login">
                                            <input type="password" id="password_confirmation"
                                                name="password_confirmation" class="form-control-login"
                                                placeholder="{{ __('Pengesahan Kata Laluan Baharu') }}"
                                                style="border-radius: 5px 0px 0px 5px;" maxlength="100" required
                                                autocomplete="new-password" title="Sila sahkan kata laluan."
                                                oninvalid="this.setCustomValidity('Sila sahkan kata laluan.')"
                                                oninput="setCustomValidity('')">
                                            <span class="input-group-text-login" onclick="show('password_confirmation')"
                                                id="display2"><i class="ri-eye-fill"></i></span>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <button class="btn btn-warning w-100" type="submit">Set Semula</button>
                                    </div>

                                    <div class="col-12 text-center">
                                        <x-utils.link :href="route('frontend.auth.login')"
                                            :active="activeClass(Route::is('frontend.auth.login'))"
                                            :text="__('Halaman Utama')" class="text-center" style="color: white;" />
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
                                </x-forms.post>
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

    ul.dot {
        list-style-type: circle;
    }

    .bi-info-circle-fill::before {
        margin-left: -40px;
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

<script>
    var nameInput = document.querySelector('#name');
    nameInput.addEventListener('input', function () {
        nameInput.value = nameInput.value.toUpperCase();
    });

    function show(password) {
        var a = document.getElementById(password);
        if (a.type === "password") {
            a.type = "text";

        } else {
            a.type = "password";

        }
    }

</script>
