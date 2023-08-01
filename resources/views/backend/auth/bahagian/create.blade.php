@inject('model', '\App\Models\Pejabat')

@extends('backend.layouts.app')

@section('title', __('Tambah Bahagian'))

@section('content')
    <x-forms.post :action="route('admin.auth.bahagian.store')">
        <x-backend.card>
            @if ($logged_in_user->isAdmin())
                <x-slot name="header">
                    <span style="font-weight: bold;"> {{$negeri->singkatan}} : {{$negeri->negeri}} </span>
                </x-slot>

                <x-slot name="headerActions">
                    <x-utils.link class="card-header-action" :href="route('admin.auth.negeri.bahagian', $negeri)" :text="__('Kembali')" />
                </x-slot>

                <x-slot name="body">
                    <div class="form-group row">
                        <label for="singkatan" class="col-md-2 col-form-label">@lang('Singkatan')</label>

                        <div class="col-md-10">
                            <input type="text" id="singkatan" name="singkatan" class="form-control"  value="{{ old('singkatan') }}" maxlength="50" required />
                        </div>
                    </div><!--form-group-->
                    <div class="form-group row">
                        <label for="bahagian" class="col-md-2 col-form-label">@lang('Bahagian')</label>

                        <div class="col-md-10">
                            <input type="text" id="bahagian" name="bahagian" class="form-control"  value="{{ old('bahagian') }}" maxlength="255" required />
                        </div>
                    </div><!--form-group-->
                    <div class="form-group row" hidden>
                        <label for="negeri_id" class="col-md-2 col-form-label">@lang('Negeri')</label>

                        <div class="col-md-10">
                            <input type="text" id="negeri_id" name="negeri_id" class="form-control"  value="{{$negeri->id}}" maxlength="255" required />
                        </div>
                    </div><!--form-group-->
                </x-slot>

                <x-slot name="footer">
                    <button class="btn btn-sm btn-primary float-right" type="submit">@lang('Tambah')</button>
                </x-slot>
            @endif
        </x-backend.card>
    </x-forms.post>
    <script>
        $(document).ready(function(){
            $('#singkatan').keyup(function(){
                $(this).val($(this).val().toUpperCase());
            });
        });

        $(document).ready(function(){
            $('#bahagian').keyup(function(){
                $(this).val($(this).val().toUpperCase());
            });
        });
    </script>
@endsection
