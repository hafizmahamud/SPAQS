@inject('model', '\App\Domains\Auth\Models\User')

@extends('backend.layouts.app')

@section('title', __('Update Role'))

@section('content')
<x-forms.patch :action="route('admin.auth.role.update', $role)">
    <x-backend.card>
        <x-slot name="header">
            <span style="font-weight: bold;"> @lang('Update Role') </span>
        </x-slot>

        <x-slot name="headerActions">
            <x-utils.link class="card-header-action" :href="route('admin.auth.role.index')" :text="__('Kembali')" />
        </x-slot>

        <x-slot name="body">
            <div x-data="{userType : '{{ $role->type }}'}">
                <div class="form-group row">
                    <label for="name" class="col-md-2 col-form-label">@lang('Type')</label>

                    @if($role->type === 'user')
                    <div class="col-md-10">
                        <input type="text" name="type" class="form-control" value="@lang('User')" required readonly />
                    </div>
                    @else
                    <div class="col-md-10">
                        <input type="text" name="type" class="form-control" value="@lang('Administrator')" required readonly />
                    </div>
                    @endif
                </div>
                <!--form-group-->

                <div class="form-group row">
                    <label for="name" class="col-md-2 col-form-label">@lang('Name')</label>

                    <div class="col-md-10">
                        <input type="text" name="name" class="form-control" placeholder="{{ __('Name') }}"
                            value="{{ old('name') ?? $role->name }}" maxlength="100" required readonly />
                    </div>
                </div>
                <!--form-group-->

                <div class="form-group row">
                    <label for="description" class="col-md-2 col-form-label">@lang('Role Description')<a
                            style="color: red;">*</a></label>
                    <div class="col-md-10">
                        <textarea class="form-control" name="description" placeholder="{{ __('Role Description') }}"
                            maxlength="200" rows="5" cols="33"
                            oninvalid="this.setCustomValidity('Sila Isi Ruangan Huraian Peranan')"
                            oninput="this.setCustomValidity('')" onkeyup="var start = this.selectionStart;
                            var end = this.selectionEnd;
                            this.value = this.value.toUpperCase();
                            this.setSelectionRange(start, end);"
                            required="required">{{ old('description') ?? $role->description }}</textarea>
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
