@extends('backend.layouts.app')

@section('title', __('Kemaskini Kelas Pukonsa'))

@section('content')
    <x-forms.patch :action="route('admin.auth.pukonsa.update', $kelasPukonsa)">
        <x-backend.card>
            <x-slot name="header">
                <span style="font-weight: bold;"> @lang('Kemaskini Kelas Pukonsa') </span>
            </x-slot>

            <x-slot name="headerActions">
                <x-utils.link class="card-header-action" :href="route('admin.auth.pukonsa.index')" :text="__('Kembali')" />
            </x-slot>

            <x-slot name="body">
                <div>
                    <div class="form-group row">
                        <label for="kod" class="col-md-2 col-form-label">@lang('Tajuk')</label>

                        <div class="col-md-10">
                            <input type="text" name="tajuk" class="form-control" onkeyup="this.value = this.value.toUpperCase();" placeholder="{{ __('TAJUK') }}" value="{{ old('tajuk') ?? $kelasPukonsa->tajuk }}" maxlength="255" required disabled/>
                        </div>
                    </div><!--form-group-->

                    <div class="form-group row">
                        <label for="bidang" class="col-md-2 col-form-label">@lang('Keterangan')</label>

                        <div class="col-md-10">
                            <input type="text" name="keterangan" class="form-control" onkeyup="this.value = this.value.toUpperCase();" placeholder="{{ __('KETERANGAN') }}" value="{{ old('keterangan') ?? $kelasPukonsa->keterangan }}" maxlength="255" required />
                        </div>
                    </div><!--form-group-->
                </div>
            </x-slot>

            <x-slot name="footer">
                <button class="btn btn-sm btn-success float-right" type="submit">@lang('Simpan')</button>
            </x-slot>
        </x-backend.card>
    </x-forms.patch>
@endsection
