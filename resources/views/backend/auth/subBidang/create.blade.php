@inject('model', '\Modules\Sisdant\Models\SubBidang')

@extends('backend.layouts.app')

@section('title', __('Tambah Kod Bidang'))

@section('content')
    <x-forms.post :action="route('admin.auth.subBidang.store')">
        <x-backend.card>
            <x-slot name="header">
                <span style="font-weight: bold;"> {{$bidang -> kod}} : {{$bidang -> bidang}} </span>
            </x-slot>

            <x-slot name="headerActions">
                <x-utils.link class="card-header-action" :href="route('admin.auth.bidang.edit', $bidang -> id)" :text="__('Kembali')" />
            </x-slot>

            <x-slot name="body">
                <div>

                    <div class="form-group row">
                        <label for="kod" class="col-md-2 col-form-label">@lang('Kod')</label>

                        <div class="col-md-1">
                            <label for="kod" class="col-form-label">{{$bidang -> kod}}</label>
                        </div>
                        <div class="col-md-1" style="margin-left:-60px">
                            <input type="text" name="kod" style="width: 60px" class="form-control" onkeypress="return /[0-9]/i.test(event.key)" maxlength="2" placeholder="{{ __('KOD') }}" value="{{ old('kod') }}" required />
                        </div>
                    </div><!--form-group-->

                    <div class="form-group row">
                        <label for="subBidang" class="col-md-2 col-form-label">@lang('Sub Bidang')</label>

                        <div class="col-md-10">
                            <input type="text" name="subBidang" class="form-control" onkeyup="this.value = this.value.toUpperCase();" placeholder="{{ __('SUB BIDANG') }}" value="{{ old('subBidang') }}" maxlength="255" required />
                        </div>
                    </div><!--form-group-->
                    <div class="form-group row" hidden>
                        <label for="bidang_id" class="col-md-2 col-form-label">@lang('Bidang ID')</label>

                        <div class="col-md-10">
                            <input type="number" name="bidang_id" class="form-control" value="{{$bidang -> id}}" maxlength="255" required />
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
