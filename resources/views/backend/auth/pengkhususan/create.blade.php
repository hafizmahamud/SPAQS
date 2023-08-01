@inject('model', '\Modules\Sisdant\Models\SubBidang')

@extends('backend.layouts.app')

@section('title', __('Tambah Kod Bidang'))

@section('content')
    <x-forms.post :action="route('admin.auth.pengkhususan.store')">
        <x-backend.card>
            <x-slot name="header">
                <span style="font-weight: bold;"> {{$kelas -> kod}} : {{$kelas -> kelas}} </span>
            </x-slot>

            <x-slot name="headerActions">
                <x-utils.link class="card-header-action" :href="route('admin.auth.kelas.edit', $kelas -> id)" :text="__('Kembali')" />
            </x-slot>

            <x-slot name="body">
                <div>

                    <div class="form-group row">
                        <label for="kod" class="col-md-2 col-form-label">@lang('Kod')</label>

                        <div class="col-md-1">
                            <label for="kod" class="col-form-label">{{$kelas -> kod}}</label>
                        </div>
                        <div class="col-md-1" style="margin-left:-60px">
                            <input type="text" name="kod" style="width: 60px" class="form-control" onkeypress="return /[0-9]/i.test(event.key)" maxlength="2" placeholder="{{ __('KOD') }}" value="{{ old('kod') }}" required />
                        </div>
                    </div><!--form-group-->

                    <div class="form-group row">
                        <label for="pengkhususan" class="col-md-2 col-form-label">@lang('Pengkhususan')</label>

                        <div class="col-md-10">
                            <input type="text" name="pengkhususan" class="form-control" onkeyup="this.value = this.value.toUpperCase();" placeholder="{{ __('PENGKHUSUSAN') }}" value="{{ old('pengkhususan') }}" maxlength="255" required />
                        </div>
                    </div><!--form-group-->
                    <div class="form-group row" hidden>
                        <label for="kelas_id" class="col-md-2 col-form-label">@lang('Kelas ID')</label>

                        <div class="col-md-10">
                            <input type="number" name="kelas_id" class="form-control" value="{{$kelas -> id}}" maxlength="255" required />
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
