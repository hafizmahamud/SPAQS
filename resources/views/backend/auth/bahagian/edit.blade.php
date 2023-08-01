@inject('model', '\App\Models\Pejabat')

@extends('backend.layouts.app')

@section('title', __('Kemaskini Bahagian'))

@section('content')
    <x-forms.patch :action="route('admin.auth.bahagian.update', $bahagian)">
        <x-backend.card>
            <x-slot name="header">
                <span style="font-weight: bold;"> @lang('Kemaskini Bahagian') </span>
            </x-slot>

            <x-slot name="headerActions">
                <x-utils.link class="card-header-action" :href="route('admin.auth.negeri.bahagian', $bahagian->negeri_id)" :text="__('Kembali')" />
            </x-slot>

            <x-slot name="body">
                <div class="form-group row">
                    <label for="singkatan" class="col-md-2 col-form-label">@lang('Singkatan')</label>

                    <div class="col-md-10">
                        <input type="text" name="singkatan" class="form-control" value="{{ old('singkatan') ?? $bahagian->singkatan }}" maxlength="100" disabled />
                    </div>
                </div><!--form-group-->

                <div class="form-group row">
                    <label for="bahagian" class="col-md-2 col-form-label">@lang('Bahagian')</label>

                    <div class="col-md-10">
                        <input type="text" name="bahagian" id="bahagian" class="form-control" value="{{ old('bahagian') ?? $bahagian->bahagian }}" maxlength="255" required />
                    </div>
                </div><!--form-group-->
            </x-slot>

            <x-slot name="footer">
                <button class="btn btn-sm btn-success float-right" type="submit">@lang('Simpan')</button>
            </x-slot>
        </x-backend.card>
    </x-forms.patch>
    <script>
        $(document).ready(function(){
            $('#bahagian').keyup(function(){
                $(this).val($(this).val().toUpperCase());
            });
        });
    </script>
@endsection
