@extends('backend.layouts.app')

@section('title', __('Kemaskini Sub Kelas Pukonsa'))

@section('content')
    <x-forms.patch :action="route('admin.auth.subKelasPukonsa.update', $subKelasPukonsa)">
        <x-backend.card>
            <x-slot name="header">
                <span style="font-weight: bold;"> {{$kelasPukonsa -> tajuk}} : {{$kelasPukonsa -> keterangan}}  </span>
            </x-slot>

            <x-slot name="headerActions">
                <x-utils.link class="card-header-action" :href="route('admin.auth.pukonsa.edit', $subKelasPukonsa->tajuk_id)" :text="__('Kembali')" />
            </x-slot>

            <x-slot name="body">
                <div>
                    <div class="form-group row">
                        <label for="kod" class="col-md-2 col-form-label">@lang('Tajuk Kecil')</label>

                        <div class="col-md-10">
                            <input type="text" name="tajuk_kecil" class="form-control" onkeyup="this.value = this.value.toUpperCase();" placeholder="{{ __('TAJUK KECIL') }}" value="{{ old('tajuk_kecil') ?? $subKelasPukonsa->tajuk_kecil }}" maxlength="255" required disabled/>
                        </div>
                    </div><!--form-group-->

                    <div class="form-group row">
                        <label for="sub_bidang" class="col-md-2 col-form-label">@lang('Sub Bidang')</label>

                        <div class="col-md-10">
                            <input type="text" name="keterangan" class="form-control" onkeyup="this.value = this.value.toUpperCase();" placeholder="{{ __('KETERANGAN') }}" value="{{ old('keterangan') ?? $subKelasPukonsa->keterangan }}" maxlength="255" required />
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
