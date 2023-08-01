<x-forms.patch :action="route('frontend.auth.password.change')">
    <div class="form-group row">
        <label for="current_password" class="col-md-2 col-form-label text-md-right">@lang('Current Password')</label>

        <div class="col-md-9">
            <div class="input-group-login">
                <input type="password" name="current_password" class="form-control-account" id="current_password" placeholder="{{ __('Current Password') }}" maxlength="100" autocomplete="current-password" required autofocus />
                <span class="input-group-text-login" onclick="show('current_password')" id="display1"><i class="fa fa-eye"></i></span>
            </div>
        </div>
    </div><!--form-group-->

    <div class="form-group row">
        <label for="password" class="col-md-2 col-form-label text-md-right">@lang('New Password')</label>

        <div class="col-md-9">
            <div class="input-group-login">
                <input type="password" name="password" class="form-control-account" id="new-password" placeholder="{{ __('New Password') }}" autocomplete="new-password" maxlength="100" required />
                <span class="input-group-text-login" onclick="show('new-password')" id="display1"><i class="fa fa-eye"></i></span>
            </div>
        </div>
    </div><!--form-group-->

    <div class="form-group row">
        <label for="password_confirmation" class="col-md-2 col-form-label text-md-right">@lang('New Password Confirmation')</label>

        <div class="col-md-9">
            <div class="input-group-login">
                <input type="password" name="password_confirmation" class="form-control-account" id="password_confirmation" placeholder="{{ __('New Password Confirmation') }}" autocomplete="new-password" maxlength="100" required />
                <span class="input-group-text-login" onclick="show('password_confirmation')" id="display1"><i class="fa fa-eye"></i></span>
            </div>
        </div>
    </div><!--form-group-->

    <div class="form-group row mb-0" style="margin-top:50px">
        <div class="col-md-12 text-right">
            <button class="btn btn-sm btn-primary float-right" type="submit">@lang('Update Password')</button>
        </div>
    </div><!--form-group-->
</x-forms.patch>
