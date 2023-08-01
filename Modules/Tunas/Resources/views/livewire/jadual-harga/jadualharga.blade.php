<div>
    <table class="table table-striped" id="jadual">
        <thead style="margin-top:30px">
            <tr>
                <th style="width: 8%;">Rujukan
                    <a wire:click.prevent="sortBy('rujukan')" role="button" href="#" style="color: black; font-size:12px">
                        @include('tunas::layouts.sort-icon', ['field' => 'rujukan'])
                    </a>
                </th>
                <th style="width: 130px;">Syarikat
                    <a wire:click.prevent="sortBy('syarikat_id')" role="button" href="#" style="color: black; font-size:12px">
                        @include('tunas::layouts.sort-icon', ['field' => 'syarikat_id'])
                    </a>
                </th>
                <th style="width: 80px;">Harga (RM)
                    <a wire:click.prevent="sortBy('harga')" role="button" href="#" style="color: black; font-size:12px">
                        @include('tunas::layouts.sort-icon', ['field' => 'harga'])
                    </a>
                </th>
                <th style="width: 25%;">Tempoh
                    <a wire:click.prevent="sortBy('tempoh')" role="button" href="#" style="color: black;">
                        @include('tunas::layouts.sort-icon', ['field' => 'tempoh'])

                    </a>
                </th>
                <th style="width: 120px;">Catatan
                    <a wire:click.prevent="sortBy('catatan')" role="button" href="#" style="color: black;">
                        @include('tunas::layouts.sort-icon', ['field' => 'catatan'])

                    </a>
                </th>
                <th style="width: 100px;">Jumlah : {{$jadulHargaCount}} rujukan</th>
            </tr>
        </thead>
        <tbody id="myTable" style="max-height: 400px !important;">
        @if(strpos(url()->full(), 'page=1') !== false || strpos(url()->full(), 'page') == false)
            <tr>
                <td style="width: 8%;"></td>
                <td style="width: 130px;"><select class="form-select" size="1" id="syarikat" name="syarikat" onchange="success()" required>
                <option value="">Sila Pilih</option>
                @foreach ($syarikat as $syar)
                    <option value="{{$syar->id}}">{{$syar->nama_syarikat}}</option>
                @endforeach
                </select></td>
                <td style="width: 80px;"><input class="form-control" type="text" id="harga" name="harga" data-mask="0, 000, 000, 000, 000, 000, 000.00" data-mask-reverse="true" onkeyup="success()" required></td>
                <td style="width: 25%;"><input class="form-control" type="text" id="tempoh" name="tempoh" style="width:70px !important; display: unset !important" maxlength="3" onkeypress="return /[0-9]/i.test(event.key)" onchange="success()" required>
                <select class="form-select" id="bulan" name="bulan" style="width:120px; display: unset !important" onchange="success()" required>
                    <option value="">Sila Pilih</option>
                    <option value="BULAN">BULAN</option>
                    <option value="MINGGU">MINGGU</option>
                </select>
                </td>
                <td style="width: 120px;"><input class="form-control" type="text" onkeyup="this.value = this.value.toUpperCase();"  id="catatan" name="catatan"></td>
                <td class="text-center" style="width: 100px;">
                <button class="btn btn-primary" form="jadual_harga" id="tambah" name="tambah" type="button">Daftar</button>
                </td>
            </tr>
            <tr>
            <td colspan="12" class="text-center"></td>
            </tr>
        @endif
        @if( $jadualHarga->isEmpty())
        @else
        <form method="post" action="{{ url('/tunas/iklan-telah-tutup/jadual-harga/hantar')}}"  id="jadual_harga">
            @method('PATCH')
            @csrf
            @foreach ($jadualHarga as $jadual)
            <tr id="jadualH">
                <td class="text-center" style="vertical-align: middle; width: 8%;">{{$jadual->rujukan}}</td>
                <td style="width: 130px;"><input class="form-control" type="text" id="syarikat" name="jadual_harga[{{$loop->index}}][syarikat_id]" value="{{$jadual->syarikat['nama_syarikat']}}" disabled></td>
                <td style="width: 80px;"><input class="form-control" type="text" id="harga" data-mask="0, 000, 000, 000, 000, 000, 000.00" data-mask-reverse="true" name="jadual_harga[{{$loop->index}}][harga]" value="{{$jadual->harga}}" onkeyup="req()" required></td>
                <td hidden><input class="form-control" type="text" id="id" name="jadual_harga[{{$loop->index}}][id]" value="{{$jadual->id}}" required></td>
                <td style="width: 25%;"><input class="form-control" type="text" id="tempoh" name="jadual_harga[{{$loop->index}}][tempoh]" maxlength="3" onkeypress="return /[0-9]/i.test(event.key)" value="{{$jadual->tempoh}}"style="width:70px !important; display: unset !important" onchange="req()" required>
                <select class="form-select" id="bulan" name="jadual_harga[{{$loop->index}}][bulan]" style="width:120px; display: unset !important" onchange="req()" required>
                    <option value="">Sila Pilih</option>
                    @if( $jadual->bulan_minggu == 'BULAN')
                    <option value="BULAN" selected>BULAN</option>
                    <option value="MINGGU">MINGGU</option>
                    @elseif( $jadual->bulan_minggu == 'MINGGU')
                    <option value="BULAN" selected>BULAN</option>
                    <option value="MINGGU">MINGGU</option>
                    @endif
                </select>
                </td>
                <td style="width: 120px;"><input class="form-control" type="text" id="catatan" name="jadual_harga[{{$loop->index}}][catatan]" onkeyup="this.value = this.value.toUpperCase();"  value="{{$jadual->catatan}}"></td>
                <td class="text-center" style="width: 100px;">
                <a href="#"  onclick="padam('{{$jadual->id}}')"><i class="mdi mdi-minus-circle" style="font-size: 24px; color: red;" ></i></a>
                </td>
            </tr>
            @endforeach
            <input type="number" id="iklan_perolehan_id" name="iklan_perolehan_id" value="{{$iklan_perolehan_id}}" hidden>
            <input type="text" id="tindakan" name="tindakan" hidden>
        </form>
        @endif
        </tbody>
    </table>
    <div class="row">
        <div class="col">
            {{ $jadualHarga->links() }}
        </div>
    </div>
</div>
