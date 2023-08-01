@extends('backend.layouts.app')

@section('title', __('Kod kelas'))

@section('content')
    <x-forms.patch :action="route('admin.auth.pengkhususan.update', $pengkhususan)">
        <x-backend.card>
            <x-slot name="header">
                <span style="font-weight: bold;"> {{$kelas -> kod}} : {{$kelas -> kelas}} </span>
            </x-slot>

            <x-slot name="headerActions">
                <x-utils.link class="card-header-action" :href="route('admin.auth.kelas.edit', $pengkhususan->kelas_id)" :text="__('Kembali')" />
            </x-slot>

            <x-slot name="body">
                <div>
                    <div class="form-group row">
                        <label for="kod" class="col-md-2 col-form-label">@lang('Kod')</label>

                        <div class="col-md-10">
                            <input type="text" name="kod" class="form-control" onkeyup="this.value = this.value.toUpperCase();" placeholder="{{ __('KOD') }}" value="{{ old('kod') ?? $pengkhususan->kod }}" maxlength="100" required disabled/>
                        </div>
                    </div><!--form-group-->

                    <div class="form-group row">
                        <label for="pengkhususan" class="col-md-2 col-form-label">@lang('Pengkhususan')</label>

                        <div class="col-md-10">
                            <input type="text" name="pengkhususan" class="form-control" onkeyup="this.value = this.value.toUpperCase();" placeholder="{{ __('PENGKHUSUSAN') }}" value="{{ old('pengkhususan') ?? $pengkhususan->pengkhususan }}" maxlength="255" required />
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
