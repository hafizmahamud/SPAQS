@extends('backend.layouts.app')

@section('title', __('View User'))

@section('content')
    <x-forms.patch :action="route('admin.auth.announcement.update', $announcement)">
        <x-backend.card>
            <x-slot name="header">
                <span style="font-weight: bold;"> @lang('Kemaskini Pengumuman') </span>
            </x-slot>

            <x-slot name="headerActions">
                <x-utils.link class="card-header-action" :href="route('admin.auth.announcement.index')" :text="__('Kembali')" />
            </x-slot>

            <x-slot name="body">
                <div>
                    <div class="form-group row">
                        <label for="kod" class="col-md-2 col-form-label">@lang('Pengumuman')</label>

                        <div class="col-md-10">
                            <textarea type="text" name="makluman" rows ="3" class="form-control" placeholder="{{ __('MAKLUMAN') }}" onkeyup="this.value = this.value.toUpperCase();" maxlength="255" required>{{$announcement->message}}</textarea>
                        </div>
                    </div><!--form-group-->

                    <div class="form-group row">
                        <label for="bidang" class="col-md-2 col-form-label">@lang('Tarikh Mula')</label>

                        <div class="col-md-10">
                            @if ($announcement->starts_at)
                                <input type="date" name="starts_at" class="form-control" placeholder="{{ __('TARIKH MULA') }}" value="{{ old('starts_at') ?? date('Y-m-d', strtotime($announcement->starts_at)) }}" maxlength="255" />
                            @else
                                <input type="date" name="starts_at" class="form-control" placeholder="{{ __('TARIKH MULA') }}" value="{{ old('starts_at') }}" maxlength="255" />
                            @endif
                        </div>
                    </div><!--form-group-->

                    <div class="form-group row">
                        <label for="bidang" class="col-md-2 col-form-label">@lang('Tarikh Akhir')</label>

                        <div class="col-md-10">
                        @if ($announcement->ends_at)
                            <input type="date" name="ends_at" class="form-control" placeholder="{{ __('TARIKH MULA') }}" value="{{ old('ends_at') ?? date('Y-m-d', strtotime($announcement->ends_at)) }}" maxlength="255" />
                        @else
                            <input type="date" name="ends_at" class="form-control" placeholder="{{ __('TARIKH MULA') }}" value="{{ old('ends_at') }}" maxlength="255" />
                        @endif
                        </div>
                    </div><!--form-group-->
                    <div class="form-group row">
                        <label for="bidang" class="col-md-2 col-form-label">@lang('Jenis')</label>

                        <div class="col-md-10">
                        <select class="form-control" size="1" id="type" name="type" required>
                            <option value="">SILA PILIH</option>
                            <option id="info" value="info" style="background-color: #D6EBFF;">INFO - BIRU</option>
                            <option id="success" value="success" style="background-color: #D5F1DE;">SUCCESS - HIJAU</option>
                            <option id="warning" value="warning" style="background-color: #FEEFD0;">WARNING - KUNING</option>
                            <option id="danger" value="danger" style="background-color: #FADDDD;">DANGER - MERAH</option>
                        </select></td>
                        </div>
                    </div><!--form-group-->
                    <div class="form-group row">
                        <label for="bidang" class="col-md-2 col-form-label">@lang('Aktifkan')</label>

                        <div class="col-md-10">
                            <input type="text" id="tp" name="tp" value="{{$announcement->type}}" hidden>
                            <input type="text" id="ac" name="ac" value="{{$announcement->enabled}}" hidden>
                            <input style="margin-top:12px" type="checkbox" id="active" name="active" value="t">
                        </div>
                    </div><!--form-group-->
                </div>
            </x-slot>

            <x-slot name="footer">
                <button class="btn btn-sm btn-success float-right" type="submit">@lang('Simpan')</button>
            </x-slot>
        </x-backend.card>
    </x-forms.patch>

    <script>
        var type = document.getElementById('tp').value;
        var active = document.getElementById('ac').value;

        if(type == 'info'){
            document.getElementById('info').selected = true;
        } else if (type == 'success') {
            document.getElementById('success').selected = true;
        } else if (type == 'danger') {
            document.getElementById('danger').selected = true;
        } else if (type == 'warning') {
            document.getElementById('warning').selected = true;
        }

        if (active == '1') {
            document.getElementById('active').checked = true;
        } else {
            document.getElementById('active').checked = false;
        }

    </script>
@endsection
