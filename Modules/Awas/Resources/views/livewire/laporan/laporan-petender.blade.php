{{-- <div wire:loading>
    Loading...
</div> --}}
<div>
    @if($petender)
        <button id="exportcsv" class="btn btn-success btn-sm" wire:click="export()" style="float: right; padding: 1 3 1 3!important; margin-left: 4px; margin-bottom: 5px;" data-toggle="tooltip" data-placement="top" title="Muat Turun Laporan">
            <i  class="mdi mdi-file-excel" style="font-size: 25px; cursor: pointer; display: contents;"></i>
        </button>
        <button id="exportpdf" class="btn btn-danger btn-sm" wire:click="exportPDF()" style="float: right; padding: 1 3 1 3!important; margin-right:10px;" data-toggle="tooltip" data-placement="top" title="Muat Turun Laporan">
            <i  class="mdi mdi-file-pdf" style="font-size: 25px; cursor: pointer; display: contents;"></i>
        </button>
    @endif
    <div wire:loading>
        Loading...
    </div>
</div>
<table class="table table-striped" id="laporan-petender">
    <thead style="margin-top:30px">
        <tr>
            <th style="width: 8%;">Bil
                <a role="button" href="#" style="color: black; font-size:12px">
                    @include('tunas::layouts.sort-icon', ['field' => 'id'])
                </a>
            </th>
            <th style="width: 130px;">No Syarikat
                <a role="button" href="#" style="color: black; font-size:12px">
                </a>
            </th>
            <th style="width: 130px;">Nama Syarikat
                <a role="button" href="#" style="color: black; font-size:12px">
                </a>
            </th>
            <th style="width: 130px; text-align: center">Minat
                <a role="button" href="#" style="color: black; font-size:12px">
                </a>
            </th>
            <th style="width: 130px; text-align: center">Masuk
                <a role="button" href="#" style="color: black; font-size:12px">
                </a>
            </th>
            <th style="width: 130px; text-align: center">Menang
                <a role="button" href="#" style="color: black; font-size:12px">
                </a>
            </th>
        </tr>
    </thead>
    <tbody id="myTable" style="max-height: 400px !important;">
        @foreach ($petender as $petenderData)
        <tr>
            <td>{{ $loop->index + 1}}</td>
            <td>{{$petenderData['no_syarikat']}}</td>
            <td>{{$namaSyarikat[$petenderData['no_syarikat']]['nama_syarikat']}}</td>
            <td style="text-align: center">{{$petenderData['count']}}</td>
            <td style="text-align: center">{{$countMasuk[$petenderData['no_syarikat']]}}</td>
            <td style="text-align: center">{{$countKeputusan[$petenderData['no_syarikat']]}}</td>
        </tr>
        @endforeach
    </tbody>
</table>


