@inject('model', '\App\Models\Negeri')

@extends('backend.layouts.app')

@section('title', __('Tambah Negeri'))

@section('content')
    <x-forms.post :action="route('admin.auth.negeri.store')">
        <x-backend.card>
            @if ($logged_in_user->isAdmin())
                <x-slot name="header">
                    <span style="font-weight: bold;">Tambah Pejabat JPS</span>
                </x-slot>

                <x-slot name="headerActions">
                    <x-utils.link class="card-header-action" :href="route('admin.auth.negeri.index')" :text="__('Kembali')" />
                </x-slot>

                <x-slot name="body">
                    <div class="form-group row">
                        <label for="singkatan" class="col-md-2 col-form-label">@lang('Singkatan')</label>

                        <div class="col-md-10">
                            <input type="text" id="singkatan" name="singkatan" class="form-control"  value="{{ old('singkatan') }}" maxlength="50" required />
                        </div>
                    </div><!--form-group-->
                    <div class="form-group row">
                        <label for="negeri" class="col-md-2 col-form-label">Pejabat JPS</label>

                        <div class="col-md-10">
                            <input type="text" id="negeri" name="negeri" class="form-control"  value="{{ old('negeri') }}" maxlength="255" required />
                        </div>
                    </div><!--form-group-->

                    <div class="form-group row">
                        <label for="negeri" class="col-md-2 col-form-label">Alamat</label>

                        <div class="col-md-10">
                            <textarea name="alamat" id="alamat" class="form-control" required style="height: 150px;"></textarea>
                        </div>
                    </div>
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
            $('#negeri').keyup(function(){
                $(this).val($(this).val().toUpperCase());
            });
        });
    </script>
@endsection
