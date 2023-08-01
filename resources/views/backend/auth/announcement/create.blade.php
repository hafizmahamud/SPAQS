@inject('model', '\Modules\Sisdant\Models\Bidang')

@extends('backend.layouts.app')

@section('title', __('Tambah Pengumuman'))

@section('content')
    <x-forms.post :action="route('admin.auth.announcement.store')">
        <x-backend.card>
            <x-slot name="header">
                <span style="font-weight: bold;"> @lang('Tambah Pengumuman') </span>
            </x-slot>

            <x-slot name="headerActions">
                <x-utils.link class="card-header-action" :href="route('admin.auth.announcement.index')" :text="__('Kembali')" />
            </x-slot>

            <x-slot name="body">
                <div>

                    <div class="form-group row">
                        <label for="kod" class="col-md-2 col-form-label">@lang('Pengumuman')</label>

                        <div class="col-md-10">
                            <textarea type="text" name="makluman" rows ="3" class="form-control" onkeyup="this.value = this.value.toUpperCase();" placeholder="{{ __('MAKLUMAN') }}" value="{{ old('makluman') }}" maxlength="255" required></textarea>
                        </div>
                    </div><!--form-group-->

                    <div class="form-group row">
                        <label for="bidang" class="col-md-2 col-form-label">@lang('Tarikh Mula')</label>

                        <div class="col-md-10">
                            <input type="date" name="starts_at" class="form-control" placeholder="{{ __('TARIKH MULA') }}" value="{{ old('starts_at') }}" maxlength="255" />
                        </div>
                    </div><!--form-group-->
                    <div class="form-group row">
                        <label for="bidang" class="col-md-2 col-form-label">@lang('Tarikh Akhir')</label>

                        <div class="col-md-10">
                            <input type="date" name="ends_at" class="form-control" placeholder="{{ __('TARIKH AKHIR') }}" value="{{ old('ends_at') }}" maxlength="255" />
                        </div>
                    </div><!--form-group-->
                    <div class="form-group row">
                        <label for="bidang" class="col-md-2 col-form-label">@lang('Jenis')</label>

                        <div class="col-md-10">
                        <select class="form-control" size="1" id="type" name="type" required>
                            <option value="">SILA PILIH</option>
                            <option value="info" style="background-color: #D6EBFF;">INFO - BIRU</option>
                            <option value="success" style="background-color: #D5F1DE;">SUCCESS - HIJAU</option>
                            <option value="warning" style="background-color: #FEEFD0;">WARNING - KUNING</option>
                            <option value="danger" style="background-color: #FADDDD;">DANGER - MERAH</option>
                        </select></td>
                        </div>
                    </div><!--form-group-->
                    <div class="form-group row">
                        <label for="bidang" class="col-md-2 col-form-label">@lang('Aktifkan')</label>

                        <div class="col-md-10">
                            <input style="margin-top:12px" type="checkbox" id="active" name="active" value="t">
                        </div>
                    </div><!--form-group-->
                </div>
            </x-slot>

            <x-slot name="footer">
                <button class="btn btn-sm btn-primary float-right" type="submit">@lang('Tambah')</button>
            </x-slot>
        </x-backend.card>
    </x-forms.post>
@endsection
