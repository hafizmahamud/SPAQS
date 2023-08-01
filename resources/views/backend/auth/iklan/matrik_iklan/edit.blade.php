@php
$iklan = \Modules\Sisdant\Models\JenisIklan::select('nama', 'id')->get();
$kategori = \Modules\Sisdant\Models\KategoriPerolehan::select('nama', 'id')->get();
$tender = \Modules\Sisdant\Models\JenisTender::select('nama', 'id')->get();
@endphp
@inject('model', '\Modules\Sisdant\Models\JenisIklan')
@inject('model', '\Modules\Sisdant\Models\KategoriPerolehan')

@extends('backend.layouts.app')

@section('title', __('Kemaskini Kategori Perolehan'))

@section('content')
    <x-forms.patch :action="route('admin.auth.iklan.update_matrik_iklan', $matrikIklan)">
        <x-backend.card>
            <x-slot name="header">
            <span style="font-weight: bold;"> @lang('Kemaskini Matrik Iklan') </span>
            </x-slot>

            <x-slot name="headerActions">
                <x-utils.link class="card-header-action" :href="route('admin.auth.iklan.matrik_iklan')" :text="__('Kembali')" />
            </x-slot>

            <x-slot name="body">
                <div>
                    <div class="form-group row">
                        <label for="name" class="col-md-2 col-form-label">@lang('Jenis Iklan')</label>

                        <div class="col-md-10">
                            <select name="jenis_iklan_id" class="form-control" required x-on:change="userType = $event.target.value">
                                @foreach ($iklan as $v)
                                    <option value="{{ $v->id }}" {{ $matrikIklan->jenis_iklan_id == $v->id ? 'selected' : '' }}>{{ $v->nama}}</option>
                                    @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="name" class="col-md-2 col-form-label">@lang('Kategori Iklan')</label>

                        <div class="col-md-10">
                            <select name="kategori_perolehan_id" class="form-control" required x-on:change="userType = $event.target.value">
                                @foreach ($kategori as $v)
                                    <option value="{{ $v->id }}" {{ $matrikIklan->kategori_perolehan_id == $v->id ? 'selected' : '' }}>{{ $v->nama}}</option>
                                    @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="name" class="col-md-2 col-form-label">@lang('Jenis Tender')</label>

                        <div class="col-md-10">
                            <select name="jenis_tender_id" class="form-control" x-on:change="userType = $event.target.value">
                                <option value="" {{$matrikIklan->jenis_tender_id == '' ? 'selected' : '' }}>Sila Pilih </option>
                                @foreach ($tender as $v)
                                    <option value="{{ $v->id }}" {{ $matrikIklan->jenis_tender_id == $v->id ? 'selected' : '' }}>{{ $v->nama}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="name" class="col-md-2 col-form-label">@lang('Muatnaik Dokumen Iklan')</label>

                        <div class="col-md-10">
                            <select name="upload_iklan" class="form-control" required x-on:change="userType = $event.target.value">
                                    <option value="t" {{ $matrikIklan->upload_iklan == 1 ? 'selected' : '' }}> YA </option>
                                    <option value="f" {{ $matrikIklan->upload_iklan == 0 ? 'selected' : '' }}> TIDAK </option>
                            </select>
                        </div>
                    </div>
                </div>

            </x-slot>

            <x-slot name="footer">
                <button class="btn btn-sm btn-success float-right" type="submit">@lang('Simpan')</button>
            </x-slot>
        </x-backend.card>
    </x-forms.patch>
@endsection
