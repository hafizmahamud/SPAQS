@inject('model', '\App\Models\TemplatSST')
@extends('backend.layouts.app')

@section('title', __('Muat Naik Templat Borang SST'))

@section('content')
    <x-forms.post :action="route('admin.auth.sst.update')" enctype="multipart/form-data">
        <x-backend.card>
            <x-slot name="header">
                <span style="font-weight: bold;"> @lang('Muat Naik Templat Borang SST') </span>
            </x-slot>
            <x-slot name="body">
                <div class="row mb-3"  style="padding-bottom: 80px;">
                    <div class="col-lg-2">
                        <label class="form-label">@lang('Template Borang SST')</label>
                    </div>
                    {{-- <textarea name="name" id="name" class="form-control" required style="height: 60px;">{{ $data->name }}</textarea> --}}

                    <div class="col-lg-10">
                        @if($data != NULL)
                        <div class="btn-div" style="margin-top: 10px;">
                            <label style="color: blue;"><a href='sst/file/{{ $data->name }}'>{{ $data->name }}</a></label><br>
                            <label>
                                <input type="file" class="file-submit" accept="doc,.docx" class="form-control" name="path" id="path">
                            </label>
                        </div>
                        @else
                        <div class="col-md-10">
                            <div class="btn-div" style="margin-top: 10px;">
                                <label>
                                    <input type="file" class="file-submit" accept=".doc,.docx" class="form-control" name="path" id="path">
                                </label>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </x-slot>

            <x-slot name="footer">
                <button class="btn btn-sm btn-success float-right" type="submit">@lang('Simpan')</button>
            </x-slot>
        </x-backend.card>
    </x-forms.post>

@endsection
