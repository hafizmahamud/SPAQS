@extends('backend.layouts.app')

@section('title', __('Change Password for :name', ['name' => $user->name]))

@section('content')
    <x-forms.patch :action="route('admin.auth.user.change-password.update', $user)">
        <x-backend.card>
            <x-slot name="header">
                @lang('Change Password for :name', ['name' => $user->name])
            </x-slot>

            <x-slot name="headerActions">
                <x-utils.link class="card-header-action" :href="route('admin.auth.user.index')" :text="__('Cancel')" />
            </x-slot>

            <x-slot name="body">
                <div class="form-group row">
                    <label for="password" class="col-md-2 col-form-label">@lang('Password')</label>

                    <div class="col-md-4">
                        <input type="password" name="password" id="password" class="form-control" placeholder="{{ __('Password') }}" maxlength="100" required autocomplete="new-password" />
                    </div>
                    <span class="togglePassword" onclick="show('password')"><i class="bi bi-eye-fill"></i></span>
                </div><!--form-group-->

                <div class="form-group row">
                    <label for="password_confirmation" class="col-md-2 col-form-label">@lang('Password Confirmation')</label>
                    <div class="col-md-4">
                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="{{ __('Password Confirmation') }}" maxlength="100" required autocomplete="new-password" />
                    </div>
                    <span class="togglePassword" onclick="show('password_confirmation')"><i class="bi bi-eye-fill"></i></span>
                </div><!--form-group-->
                
            </x-slot>

            <x-slot name="footer">
                <button class="btn btn-sm btn-primary float-right" type="submit">@lang('Update')</button>
            </x-slot>
        </x-backend.card>
    </x-forms.patch>
@endsection
<style>
    .bi-eye-fill::before {
        margin-top: 10.5px;
        margin-left: -9px;
        font-size: 15px;
    }

    i {
        cursor: pointer;
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