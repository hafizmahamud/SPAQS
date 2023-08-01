@extends('backend.layouts.app')

@section('title', __('Kod Bidang'))

@section('content')
    <x-forms.patch :action="route('admin.auth.subBidang.update', $subBidang)">
        <x-backend.card>
            <x-slot name="header">
                <span style="font-weight: bold;"> {{$bidang -> kod}} : {{$bidang -> bidang}} </span>
            </x-slot>

            <x-slot name="headerActions">
                <x-utils.link class="card-header-action" :href="route('admin.auth.bidang.edit', $subBidang->bidang_id)" :text="__('Kembali')" />
            </x-slot>

            <x-slot name="body">
                <div>
                    <div class="form-group row">
                        <label for="kod" class="col-md-2 col-form-label">@lang('Kod')</label>

                        <div class="col-md-10">
                            <input type="number" name="kod" class="form-control" placeholder="{{ __('KOD') }}" value="{{ old('kod') ?? $subBidang->kod }}" maxlength="100" required disabled/>
                        </div>
                    </div><!--form-group-->

                    <div class="form-group row">
                        <label for="sub_bidang" class="col-md-2 col-form-label">@lang('Sub Bidang')</label>

                        <div class="col-md-10">
                            <input type="text" name="sub_bidang" class="form-control" onkeyup="this.value = this.value.toUpperCase();" placeholder="{{ __('SUB BIDANG') }}" value="{{ old('sub_bidang') ?? $subBidang->sub_bidang }}" maxlength="255" required />
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
