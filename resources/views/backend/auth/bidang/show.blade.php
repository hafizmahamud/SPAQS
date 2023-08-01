@extends('backend.layouts.app')

@section('title', __('View User'))

@section('content')
    <x-forms.patch :action="route('admin.auth.bidang.update', $bidang)">
        <x-backend.card>
            <x-slot name="header">
                <span style="font-weight: bold;"> @lang('Kemaskini Kod Bidang') </span>
            </x-slot>

            <x-slot name="headerActions">
                <x-utils.link class="card-header-action" :href="route('admin.auth.bidang.index')" :text="__('Kembali')" />
            </x-slot>

            <x-slot name="body">
                <div>
                    <div class="form-group row">
                        <label for="kod" class="col-md-2 col-form-label">@lang('Kod')</label>

                        <div class="col-md-10">
                            <input type="number" name="kod" class="form-control" placeholder="{{ __('KOD') }}" value="{{ old('kod') ?? $bidang->kod }}" maxlength="100" required disabled/>
                        </div>
                    </div><!--form-group-->

                    <div class="form-group row">
                        <label for="bidang" class="col-md-2 col-form-label">@lang('Bidang')</label>

                        <div class="col-md-10">
                            <input type="text" name="bidang" class="form-control" onkeyup="this.value = this.value.toUpperCase();" placeholder="{{ __('BIDANG') }}" value="{{ old('bidang') ?? $bidang->bidang }}" maxlength="255" required />
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
