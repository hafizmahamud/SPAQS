<x-forms.patch :action="route('frontend.user.profile.update')">
    <div class="form-group row">
        <label for="name" class="col-md-2 col-form-label text-md-right">@lang('Name')</label>

        <div class="col-md-9">
            <input type="text" name="name" class="form-control"
                placeholder="{{ __('Name Penuh') }}" value="{{ old('name') ?? $logged_in_user->name }}"
                onkeydown="return /[a-zA-Z,@, ]/i.test(event.key)"
                title="Sila masukan nama pengguna."
                oninvalid="this.setCustomValidity('Sila masukan nama pengguna.')"
                oninput="setCustomValidity('')"
                required autofocus autocomplete="name" />
        </div>
    </div><!--form-group-->

    <div class="form-group row">
        <label for="name" class="col-md-2 col-form-label text-md-right">No Kad Pengenalan</label>

        <div class="col-md-9">
            <input type="text" name="ic_no" class="form-control"
                onkeypress="return /[0-9]/i.test(event.key)"
                maxlength="12"
                title="Sila masukan nombor kad pengenalan."
                oninvalid="this.setCustomValidity('Sila masukan nombor kad pengenalan.')"
                oninput="setCustomValidity('')"
                placeholder="{{ __('No Kad Pengenalan') }}" value="{{ old('ic_no') ?? $logged_in_user->ic_no }}"
                required autofocus autocomplete="name" />
        </div>
    </div><!--form-group-->

    <div class="form-group row">
        <label for="name" class="col-md-2 col-form-label text-md-right">Negeri</label>

        <div class="col-md-9">
            <select class="form-select" name="negeri_id" id="negeri_id"
                placeholder="Negeri" title="Sila pilih negeri."
                oninvalid="this.setCustomValidity('Sila pilih negeri.')"
                oninput="setCustomValidity('')" required>
                <option value="">Negeri</option>
                @foreach($listnegeri as $negeri)
                    @if($logged_in_user->negeri_id == $negeri->id)
                    <option value="{{$negeri->id}}" selected>{{$negeri->negeri}}</option>
                    @else
                    <option value="{{$negeri->id}}">{{$negeri->negeri}}</option>
                    @endif
                @endforeach
            </select>
        </div>
    </div><!--form-group-->

    <div class="form-group row" id="bahagian" style="display:none">
        <label for="name" class="col-md-2 col-form-label text-md-right">Bahagian</label>

        <div class="col-md-9">
            <select class="form-select" name="section_id" id="section_id"
                placeholder="Bahagian" title="Sila pilih bahagian."
                oninvalid="this.setCustomValidity('Sila pilih bahagian.')"
                oninput="setCustomValidity('')">
                <option value="">Bahagian</option>
                @foreach($listpejabat as $pejabat)
                    @if($logged_in_user->section_id == $pejabat->id)
                    <option value="{{$pejabat->id}}" selected>{{$pejabat->bahagian}}</option>
                    @else
                    <option value="{{$pejabat->id}}">{{$pejabat->bahagian}}</option>
                    @endif
                @endforeach
            </select>
        </div>
    </div><!--form-group-->



    <div class="form-group row mb-0" style="margin-top:50px">
        <div class="col-md-12 text-right">
            <button class="btn btn-sm btn-primary float-right" type="submit">@lang('Update')</button>
        </div>
    </div><!--form-group-->
</x-forms.patch>
