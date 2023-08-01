<x-forms.patch :action="route('frontend.user.profile.update')" id="profileForm">
    <table class="table table-hover">
            <tbody id="profile">
                <tr>
                    <th>Peranan</th>
                    <td>{!! $logged_in_user->roles_label !!}</td>
                </tr>

                <tr id="namatr">
                    <th>@lang('Name')</th>
                    <td>
                        {{ $logged_in_user->name }}
                        <i style="float:right; margin-right: 50px; cursor: pointer;" class="bi bi-pencil-square" aria-hidden="true" onclick="tindakan('inputnama')"></i>
                    </td>
                </tr>

                <tr id="inputnama" style="display: none">
                    <th>@lang('Name')</th>
                    <td>
                        <input id="nama" type="text" name="nama" class="form-control" style="width:70%"
                            placeholder="{{ __('Name Penuh') }}" value="{{ old('nama') ?? $logged_in_user->name }}"
                            onkeydown="return /[a-zA-Z,@, ]/i.test(event.key)"
                            title="Sila masukan nama pengguna."
                            oninvalid="this.setCustomValidity('Sila masukan nama pengguna.')"
                            oninput="setCustomValidity('')"
                            required autofocus autocomplete="nama"  />
                        <input id="action" type="text" name="action" hidden>
                        <button class="btn btn-success" type="button" value="simpan"
                            style="width: 150px; margin-top: -58px; margin-left: 72%;" onclick="save('nama')">Simpan</button>
                        <i style="float:right; margin-right: 50px; cursor: pointer; margin-top: -22px" class="bi bi-x-lg" aria-hidden="true" onclick="tindakan('nama')"></i>
                    </td>
                </tr>

                <tr id="ictr">
                    <th>No Kad Pengenalan</th>
                    <td>
                    @if($logged_in_user->ic_no)
                        {{ $logged_in_user->ic_no }}
                    @else
                        -
                    @endif
                        <i style="float:right; margin-right: 50px; cursor: pointer;" class="bi bi-pencil-square" aria-hidden="true" onclick="tindakan('inputic')"></i>
                    </td>
                </tr>

                <tr id="inputic" style="display: none">
                    <th>No Kad Pengenalan</th>
                    <td>
                        <input type="text" id="no_kad_pengenalan" name="no_kad_pengenalan" class="form-control" style="width:70%"
                            onkeypress="return /[0-9]/i.test(event.key)"
                            maxlength="12"
                            title="Sila masukan nombor kad pengenalan."
                            oninvalid="this.setCustomValidity('Sila masukan nombor kad pengenalan.')"
                            oninput="setCustomValidity('')"
                            placeholder="{{ __('No Kad Pengenalan') }}" value="{{ old('no_kad_pengenalan') ?? $logged_in_user->ic_no }}"
                            autofocus autocomplete="no_kad_pengenalan" />
                        <button class="btn btn-success" type="button" value="simpan"
                            style="width: 150px; margin-top: -58px; margin-left: 72%;" onclick="save('ic')">Simpan</button>
                        <i style="float:right; margin-right: 50px; cursor: pointer; margin-top: -22px" class="bi bi-x-lg" aria-hidden="true" onclick="tindakan('ic')"></i>
                    </td>
                </tr>

                <tr>
                    <th>@lang('E-mail Address')</th>
                    <td>{{ $logged_in_user->email }}</td>
                </tr>

                <tr id="negeritr">
                    <th>Negeri</th>
                    <td>
                        {{ $logged_in_user->negeri['negeri'] }}
                        <i  style="float:right; margin-right: 50px; cursor: pointer;" class="bi bi-pencil-square" aria-hidden="true" onclick="tindakan('inputnegeri')"></i>
                    </td>
                </tr>

                <tr id="inputnegeri" style="display: none">
                    <th>Negeri</th>
                    <td>
                        <select class="form-select" name="negeri" id="negeri" style="width:70%"
                            placeholder="Negeri" title="Sila pilih negeri."
                            oninvalid="this.setCustomValidity('Sila pilih negeri.')"
                            oninput="setCustomValidity('')">
                            <option value="">Negeri</option>
                            @foreach($listnegeri as $negeri)
                                @if($logged_in_user->negeri_id == $negeri->id)
                                <option value="{{$negeri->id}}" selected>{{$negeri->negeri}}</option>
                                @else
                                <option value="{{$negeri->id}}">{{$negeri->negeri}}</option>
                                @endif
                            @endforeach
                        </select>
                        <i style="float:right; margin-right: 50px; cursor: pointer; margin-top: -22px" class="bi bi-x-lg" aria-hidden="true" onclick="tindakan('negeri')"></i>
                    </td>
                </tr>


                <tr id="bahagiantr">
                    <th>Bahagian</th>
                        <td>
                        @if($logged_in_user->section_id)
                            {{ $logged_in_user->section['bahagian'] }}
                        @else
                            -
                        @endif
                        </td>
                </tr>

                <tr id="inputbahagian" style="display: none">
                    <th>Bahagian</th>
                        <td>
                            <select class="form-select" name="bahagian" id="bahagian" style="width:70%"
                                placeholder="Bahagian" title="Sila pilih bahagian."
                                oninvalid="this.setCustomValidity('Sila pilih bahagian.')"
                                oninput="setCustomValidity('')">
                                <option value=""></option>
                                @foreach($listpejabat as $pejabat)
                                    @if($logged_in_user->section_id == $pejabat->id)
                                    <option value="{{$pejabat->id}}" selected>{{$pejabat->bahagian}}</option>
                                    @else
                                    <option value="{{$pejabat->id}}">{{$pejabat->bahagian}}</option>
                                    @endif
                                @endforeach
                            </select>
                            <button class="btn btn-success" type="button" value="simpan"
                                style="width: 150px; margin-top: -58px; margin-left: 72%;" onclick="save('bahagian')">Simpan</button>
                        <i id="binputbahagian" style="float:right; margin-right: 50px; cursor: pointer; margin-top: -22px" class="bi bi-x-lg" aria-hidden="true" onclick="tindakan('bahagian')"></i>
                        </td>
                </tr>

                <tr id="jawatantr">
                    <th>Jawatan</th>
                    <td>
                    @if($logged_in_user->jawatan)
                        {{ $logged_in_user->jawatan }}
                    @else
                        -
                    @endif
                        <i style="float:right; margin-right: 50px; cursor: pointer;" class="bi bi-pencil-square" aria-hidden="true" onclick="tindakan('inputjawatan')"></i>
                    </td>
                </tr>

                <tr id="inputjawatan" style="display: none">
                    <th>Jawatan</th>
                    <td>
                        <input id="jawatan" type="text" name="jawatan" class="form-control" style="width:70%"
                            placeholder="{{ __('Jawatan') }}" value="{{ old('jawatan') ?? $logged_in_user->jawatan }}"
                            title="Sila masukan jawatan anda."
                            oninvalid="this.setCustomValidity('Sila masukan jawatan anda.')"
                            oninput="setCustomValidity('')"
                            required autofocus autocomplete="jawatan"  />
                        <button class="btn btn-success" type="button" value="simpan"
                            style="width: 150px; margin-top: -58px; margin-left: 72%;" onclick="save('jawatan')">Simpan</button>
                        <i style="float:right; margin-right: 50px; cursor: pointer; margin-top: -22px" class="bi bi-x-lg" aria-hidden="true" onclick="tindakan('jawatan')"></i>
                    </td>
                </tr>


                @if ($logged_in_user->isSocial())
                    <tr>
                        <th>@lang('Social Provider')</th>
                        <td>{{ ucfirst($logged_in_user->provider) }}</td>
                    </tr>
                @endif

                <tr>
                    <th>Tarikh Akaun Dibuka</th>
                    <td>{{\Carbon\Carbon::parse($logged_in_user->created_at)->format('d/m/Y')}} ({{ $logged_in_user->created_at->diffForHumans() }})</td>
                </tr>

                <tr>
                    <th>Tarikh Kemaskini</th>
                    <td>{{\Carbon\Carbon::parse($logged_in_user->updated_at)->format('d/m/Y')}} ({{ $logged_in_user->updated_at->diffForHumans() }})</td>
                </tr>
            </tbody>
    </table>
</x-forms.patch>
