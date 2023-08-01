@php
$iklan = \Modules\Sisdant\Models\JenisIklan::select('nama', 'id')->get();
$kategori = \Modules\Sisdant\Models\KategoriPerolehan::select('nama', 'id')->get();
$tender = \Modules\Sisdant\Models\JenisTender::select('nama', 'id')->get();
@endphp
@extends('backend.layouts.app')


@section('title', __('Tambah Matrik Iklan'))

@section('content')
    <x-forms.post :action="route('admin.auth.iklan.simpan_matrik')">
        <x-backend.card>
            <x-slot name="header">
            <span style="font-weight: bold;"> @lang('Tambah Matrik Iklan') </span>
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
                                <option value="" {{'' ? 'selected' : '' }}>Sila Pilih </option>
                                @foreach ($iklan as $v)
                                    <option value="{{ $v->id }}">{{ $v->nama}}</option>
                                    @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="name" class="col-md-2 col-form-label">@lang('Kategori Perolehan')</label>

                        <div class="col-md-10">
                            <select name="kategori_perolehan_id" class="form-control" required x-on:change="userType = $event.target.value">
                                <option value="" {{'' ? 'selected' : '' }}>Sila Pilih </option>
                                @foreach ($kategori as $v)
                                    <option value="{{ $v->id }}">{{ $v->nama}}</option>
                                    @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="name" class="col-md-2 col-form-label">@lang('Jenis Tender')</label>
                        <div class="col-md-10">
                            <select name="jenis_tender_id" class="form-control" x-on:change="userType = $event.target.value">
                                <option value="" {{'' ? 'selected' : '' }}>Sila Pilih </option>
                                @foreach ($tender as $v)
                                    <option value="{{ $v->id }}">{{ $v->nama}}</option>
                                    @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="name" class="col-md-2 col-form-label">@lang('Muatnaik Dokumen Iklan')</label>
                        <div class="col-md-10">
                            <select name="upload_iklan" class="form-control" required x-on:change="userType = $event.target.value">
                                <option value="" {{'' ? 'selected' : '' }}>Sila Pilih </option>
                                <option value="t" >YA</option>
                                <option value="f" >TIDAK </option>
                            </select>
                        </div>
                    </div>
                </div>
            </x-slot>

            <x-slot name="footer">
                <button class="btn btn-sm btn-primary float-right" type="submit">@lang('Tambah')</button>
            </x-slot>
        </x-backend.card>
    </x-forms.post>
@endsection
