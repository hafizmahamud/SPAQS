@inject('model', '\App\Models\SenaraiAlamat')

@extends('backend.layouts.app')

@section('title', __('Kemaskini Alamat'))

@section('content')
    <x-forms.patch :action="route('admin.auth.alamat.update', $alamat)">
        <x-backend.card>
            <x-slot name="header">
                <span style="font-weight: bold;"> @lang('Kemaskini Alamat') </span>
            </x-slot>

            <x-slot name="headerActions">
                <x-utils.link class="card-header-action" :href="route('admin.auth.alamat.index')" :text="__('Kembali')" />
            </x-slot>

            <x-slot name="body">
                <div class="form-group row">
                    <label for="jenis_alamat" class="col-md-2 col-form-label">@lang('Jenis Alamat')</label>

                    <div class="col-md-10">
                        <input type="text" id="jenis_alamat" name="jenis_alamat" class="form-control" value="{{ old('jenis_alamat') ?? $alamat->jenis_alamat }}" maxlength="255" required/>
                    </div>
                </div><!--form-group-->

                <div class="form-group row">
                    <label for="alamat" class="col-md-2 col-form-label">@lang('Alamat')</label>

                    <div class="col-md-10">
                        <input type="text" name="alamat" id="alamat" class="form-control" value="{{ old('alamat') ?? $alamat->alamat }}" maxlength="255" required />
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
            $('#jenis_alamat').keyup(function(){
                $(this).val($(this).val().toUpperCase());
            });
        });

        $(document).ready(function(){
            $('#alamat').keyup(function(){
                $(this).val($(this).val().toUpperCase());
            });
        });
    </script>
@endsection
