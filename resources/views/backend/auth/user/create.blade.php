@inject('model', '\App\Domains\Auth\Models\User')

@extends('backend.layouts.app')

@section('title', __('Create User'))

@section('content')
    <x-forms.post :action="route('admin.auth.user.store')">
        <x-backend.card>
            <x-slot name="header">
                @lang('Create User')
            </x-slot>

            <x-slot name="headerActions">
                <x-utils.link class="card-header-action" :href="route('admin.auth.user.index')" :text="__('Cancel')" />
            </x-slot>

            <x-slot name="body">
                <div x-data="{userType : '{{ $model::TYPE_USER }}'}">
                    <div class="form-group row">
                        <label for="name" class="col-md-2 col-form-label">@lang('Type')</label>

                        <div class="col-md-10">
                            <select name="type" class="form-control" required x-on:change="userType = $event.target.value">
                                <option value="{{ $model::TYPE_USER }}">@lang('User')</option>
                                <option value="{{ $model::TYPE_ADMIN }}">@lang('Administrator')</option>
                            </select>
                        </div>
                    </div><!--form-group-->

                    <div class="form-group row">
                        <label for="name" class="col-md-2 col-form-label">@lang('Name')</label>

                        <div class="col-md-10">
                            <input type="text" name="name" class="form-control" placeholder="{{ __('Name') }}" value="{{ old('name') }}" maxlength="100" required />
                        </div>
                    </div><!--form-group-->

                    <div class="form-group row">
                        <label for="email" class="col-md-2 col-form-label">@lang('E-mail Address')</label>

                        <div class="col-md-10">
                            <input type="email" name="email" class="form-control" placeholder="{{ __('E-mail Address') }}" value="{{ old('email') }}" maxlength="255" required />
                        </div>
                    </div><!--form-group-->

                    <div class="form-group row">
                        <label for="password" class="col-md-2 col-form-label">@lang('Password')</label>
                        <div class="col-md-10">
                            <div class="input-group-login">
                                <input type="password" name="password" id="password"  class="form-control-login" placeholder="{{ __('Password') }}" maxlength="100" required autocomplete="new-password" style="border-radius: 5px 0px 0px 5px;"/>
                                <span class="input-group-text-login" onclick="show('password')" id="display1"><i class="fa fa-eye"></i></span>
                            </div>
                        </div>
                    </div><!--form-group-->

                    <div class="form-group row">
                        <label for="password_confirmation" class="col-md-2 col-form-label">@lang('Password Confirmation')</label>

                        <div class="col-md-10">
                            <div class="input-group-login">
                                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control-login" placeholder="{{ __('Password Confirmation') }}" maxlength="100" required autocomplete="new-password" style="border-radius: 5px 0px 0px 5px;"/>
                                <span class="input-group-text-login" onclick="show('password_confirmation')" id="display2"><i class="fa fa-eye"></i></span>
                            </div>
                        </div>
                    </div><!--form-group-->

                    <div class="form-group row">
                        <label for="active" class="col-md-2 col-form-label">@lang('Active')</label>

                        <div class="col-md-10">
                            <div class="form-check">
                                <input name="active" id="active" class="form-check-input" type="checkbox" value="1" {{ old('active', true) ? 'checked' : '' }} />
                            </div><!--form-check-->
                        </div>
                    </div><!--form-group-->
<!--
                    <div x-data="{ emailVerified : false }">
                        <div class="form-group row">
                            <label for="email_verified" class="col-md-2 col-form-label">@lang('E-mail Verified')</label>

                            <div class="col-md-10">
                                <div class="form-check">
                                    <input
                                        type="checkbox"
                                        name="email_verified"
                                        id="email_verified"
                                        value="1"
                                        class="form-check-input"
                                        x-on:click="emailVerified = !emailVerified"
                                        {{ old('email_verified') ? 'checked' : '' }} />
                                </div>
                            </div>
                        </div>

                        <div x-show="!emailVerified">
                            <div class="form-group row">
                                <label for="send_confirmation_email" class="col-md-2 col-form-label">@lang('Send Confirmation E-mail')</label>

                                <div class="col-md-10">
                                    <div class="form-check">
                                        <input
                                            type="checkbox"
                                            name="send_confirmation_email"
                                            id="send_confirmation_email"
                                            value="1"
                                            class="form-check-input"
                                            {{ old('send_confirmation_email') ? 'checked' : '' }} />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
-->

                    <div class="form-group row">
                        <label for="negeri_id" class="col-md-2 col-form-label">@lang('Negeri')</label>

                        <div class="col-6">
                            <select class="form-select form-control-login" name="negeri_id" id="negeri_id"
                                placeholder="Negeri" title="Sila pilih negeri."
                                oninvalid="this.setCustomValidity('Sila pilih negeri.')"
                                oninput="setCustomValidity('')" required>
                                <option value="">Negeri</option>
                                @foreach($listnegeri as $negeri)
                                <option value="{{$negeri->id}}">{{$negeri->negeri}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row" id="bahagian" style="display:none">
                        <label for="section_id" class="col-md-2 col-form-label">@lang('Pejabat')</label>

                        <div class="col-6" id="bahagian">
                            <select class="form-select form-control-login" name="section_id" id="section_id"
                                placeholder="Bahagian" title="Sila pilih bahagian."
                                oninvalid="this.setCustomValidity('Sila pilih bahagian.')"
                                oninput="setCustomValidity('')">
                                <option value="">Bahagian</option>
                            </select>
                        </div>
                    </div>

                    @include('backend.auth.includes.roles')

                    @if (!config('boilerplate.access.user.only_roles'))
                        @include('backend.auth.includes.permissions')
                    @endif

                   
                </div>
            </x-slot>

            <x-slot name="footer">
                <button class="btn btn-sm btn-primary float-right" type="submit">@lang('Create User')</button>
            </x-slot>
        </x-backend.card>
    </x-forms.post>
    <style>

        .form-control-login {
            background-color: #F5FFFA !important;
            color:#2F4F4F !important;
        }

        .form-control-login {
            display: block;
            width: 100%;
            padding: .375rem .75rem;
            font-size: 14px;
            font-weight: 400 !important;
            line-height: 1.5;
            color: #212529 !important;
            background-color: #fff !important;
            background-clip: padding-box;
            border: 1px solid #ced4da;
            appearance: none;
            border-radius: 5px;
            transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
        }

        .form-control-login::placeholder {
            opacity: 0.7 !important;
            color: #212529 !important;
        }

        .input-group-login {
            position: relative;
            display: flex;
            flex-wrap: wrap;
            align-items: stretch;
            width: 100%;
        }

        .input-group-login > .form-control-login, .input-group > .form-select {
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
    </style>
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
    $(document).ready(function () {
        $('#negeri_id').on('change', function () {
            var negeri = $('#negeri_id option:selected').val();
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
@endsection
