@inject('model', '\App\Models\Negeri')

@extends('backend.layouts.app')

@section('title', __('Kemaskini Negeri'))

@section('content')
    <x-forms.patch :action="route('admin.auth.negeri.update', $negeri)">
        <x-backend.card>
            <x-slot name="header">
                <span style="font-weight: bold;"> @lang('Kemaskini Negeri') </span>
            </x-slot>

            <x-slot name="headerActions">
                <x-utils.link class="card-header-action" :href="route('admin.auth.negeri.index')" :text="__('Kembali')" />
            </x-slot>

            <x-slot name="body">
                <div class="form-group row">
                    <label for="singkatan" class="col-md-2 col-form-label">@lang('Singkatan')</label>

                    <div class="col-md-10">
                        <input type="text" name="singkatan" class="form-control" value="{{ old('singkatan') ?? $negeri->singkatan }}" maxlength="50" disabled/>
                    </div>
                </div><!--form-group-->

                <div class="form-group row">
                    <label for="negeri" class="col-md-2 col-form-label">@lang('Pejabat JPS')</label>

                    <div class="col-md-10">
                        <input type="text" name="negeri" id="negeri" class="form-control" value="{{ old('negeri') ?? $negeri->negeri }}" maxlength="255" required />
                    </div>
                </div><!--form-group-->

                <div class="form-group row">
                    <label for="negeri" class="col-md-2 col-form-label">@lang('Alamat')</label>

                    <div class="col-md-10">
                        <textarea name="alamat" id="alamat" class="form-control" required style="height: 150px;">{{ $negeri->alamat }}</textarea>
                    </div>
                </div>
            </x-slot>

            <x-slot name="footer">
                <button class="btn btn-sm btn-success float-right" type="submit">@lang('Simpan')</button>
            </x-slot>
        </x-backend.card>
    </x-forms.patch>
    <script>
        $(document).ready(function(){
            $('#negeri').keyup(function(){
                $(this).val($(this).val().toUpperCase());
            });
        });
    </script>
@endsection
