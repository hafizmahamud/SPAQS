<div>
    <section class="section" style="margin-top: -20px">
    @if($iklantutup->isEmpty())
    @else
        <div class="container">
            <div class="row">
                <div class="col-2">
                    <p class="text-right" style="font-weight:bold; font-size:12px">Negeri</p>
                </div>
                <div class="col-10">
                    <p class="text-left" style="font-size:12px">{{$iklantutup[0]->mohonNoPerolehan->negeri['negeri']}}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-2">
                <p class="text-right" style="font-weight:bold; font-size:12px">No Tender</p>
                </div>
                <div class="col-10">
                <p class="text-left" style="font-size:12px">{{$iklantutup[0]->mohonNoPerolehan['no_perolehan']}}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-2">
                <p class="text-right" style="font-weight:bold; font-size:12px">Tajuk Projek</p>
                </div>
                <div class="col-10">
                <p class="text-left" style="font-size:12px">{{$iklantutup[0]->mohonNoPerolehan['tajuk_perolehan']}}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-2">
                <p class="text-right" style="font-weight:bold; font-size:12px">Tarikh Tutup</p>
                </div>
                <div class="col-10">
                <p class="text-left" style="font-size:12px">{{\Carbon\Carbon::parse($iklantutup[0]-> tarikh_waktu_tutup)->format('d/m/Y')}}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-2">
                <p class="text-right" style="font-weight:bold; font-size:12px">Jenis Iklan</p>
                </div>
                <div class="col-10">
                <p class="text-left" style="font-size:12px">{{$iklantutup[0]->mohonNoPerolehan->matrikIklan->jenisIklan['nama']}}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-2">
                <p class="text-right" style="font-weight:bold; font-size:12px">Kategori Perolehan</p>
                </div>
                <div class="col-10">
                <p class="text-left" style="font-size:12px">{{$iklantutup[0]->mohonNoPerolehan->matrikIklan->kategoriPerolehan['nama']}}</p>
                </div>
            </div>
        </div>
    @endif
    </section>
    <section class="section" style="margin-top: 20px">
        <div class="card">
            <div class="card-body">
            <div>
                <table class="table table-striped" id="example">
                    <thead>
                        <tr>
                            <th style="width: 150px; color: black; font-size:12px" class="text-center"> Rujukan
                                <a wire:click.prevent="sortBy('rujukan')" role="button" href="#" style="color: black;">
                                    @include('tunas::layouts.sort-icon', ['field' => 'rujukan'])
                                </a>
                            </th>
                            <th style="width: 200px;color: black; font-size:12px" class="text-center">Syarikat
                                <a wire:click.prevent="sortBy('syarikat_id')" role="button" href="#" style="color: black;">
                                    @include('tunas::layouts.sort-icon', ['field' => 'syarikat_id'])
                                </a>
                            </th>
                            <th style="width: 200px;color: black; font-size:12px" class="text-left">Harga (RM)
                                <a wire:click.prevent="sortBy('harga')" role="button" href="#" style="color: black;">
                                    @include('tunas::layouts.sort-icon', ['field' => 'harga'])
                                </a>
                            </th>
                            <th colspan="2" style="width:150px;color: black; font-size:12px" class="text-center">Tempoh
                                <a wire:click.prevent="sortBy('tempoh')" role="button" href="#" style="color: black;">
                                    @include('tunas::layouts.sort-icon', ['field' => 'tempoh'])
                                </a>
                            </th>
                            <th style="width: 200px;color: black; font-size:12px" class="text-center">Catatan
                                <a wire:click.prevent="sortBy('catatan')" role="button" href="#" style="color: black;">
                                    @include('tunas::layouts.sort-icon', ['field' => 'catatan'])
                                </a>
                            </th>
                        </tr>
                    </thead>
                    <tbody id="myTable">
                        @if( $jadualHarga->isEmpty())
                            <tr id='tiada'>
                                <td colspan="12" class="text-center" style="font-size:12px">Tiada Data</td>
                            </tr>
                        @else
                            @foreach ($jadualHarga as $jadual)
                            <tr>
                                <td class="text-center" style="font-size:12px">{{$jadual->rujukan}} / {{$jadualT}}</td>
                                <td class="text-center" style="font-size:12px">{{$jadual->syarikat['nama_syarikat']}}</td>
                                <td class="text-right" style="font-size:12px">{{$jadual->harga}}</td>
                                <td class="text-right" style="font-size:12px">{{$jadual->tempoh}}</td>
                                <td class="text-left" style="font-size:12px">{{$jadual->bulan_minggu}}</td>
                                <td class="text-left justify" style="font-size:12px">{{$jadual->catatan}}</td>
                            </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
                <div class="row" style="float:right; margin-top:20px">
                    <div class="col" style="float:right">
                        {{ $jadualHarga->links() }}
                    </div>
                </div>
            </div>

            </div>
        </div>
    </section>
</div>
