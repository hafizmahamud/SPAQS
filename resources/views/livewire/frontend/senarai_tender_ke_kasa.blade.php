@if ($loop->index == 0)
<button class="btn btn-primary" id="btnJana" data-toggle="modal" data-backdrop="false" href="#myModal1" style="float: right; margin-bottom:10px;" disabled>Jana Surat</button>

<div class="spanner">
    <div id="wait"><img src={{url('spaqs/assets/img/loader.gif')}} width="100%" /><br>
    </div>
</div>

<div class="modal" id="myModal1">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 400px;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title w-100 text-center">Naskah Salinan Kertas Perakuan</h5>
                <div class="pull-right">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
            <div class="container">
                <div class="modal-body">
                    <div class="row mb-3">
                        <label for="naskah" style="font-weight: bold;" class="col-md col-form-label">Jumlah Naskah Salinan<a style="color: red;">*</a></label>
                        <div class="col-sm-4">
                            <input type="number" class="form-control" style="margin-left: -40px;" min="1" max="20" name="naskah"
                                id="naskah" onchange="success()" required />
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" name="hantar" type="submit" id="hantar" value="hantar"
                    onclick="submitForm(event)" disabled>Jana Surat</button>
            </div>
        </div>
    </div>

</div>
@endif
<div>
    <x-livewire-tables::bs4.table.cell>
        {{ $loop->index + 1}}
    </x-livewire-tables::bs4.table.cell>

    <x-livewire-tables::bs4.table.cell>
        {{$row->mohonNoPerolehan->negeri['negeri']}}
    </x-livewire-tables::bs4.table.cell>

    <x-livewire-tables::bs4.table.cell>
        <a style="color: blue">{{$row->mohonNoPerolehan->no_perolehan}}</a> <br>
        {{$row->mohonNoPerolehan->tajuk_perolehan}}
    </x-livewire-tables::bs4.table.cell>

    <x-livewire-tables::bs4.table.cell>
        {{\Carbon\Carbon::parse($row->tarikh_waktu_tutup)->format('d/m/Y')}}
    </x-livewire-tables::bs4.table.cell>

    <x-livewire-tables::bs4.table.cell>
        @if($row->tarikh_kemaskini_penilaian == null)
        Belum Dikemaskini
        @else
        {{\Carbon\Carbon::parse($row->tarikh_kemaskini_penilaian)->format('d/m/Y')}}
        @endif
    </x-livewire-tables::bs4.table.cell>

    <x-livewire-tables::bs4.table.cell>
        <input type="checkbox" id="idTender" onclick="clickEvent(event)" name="suratKASA[]" value="{{$row->iklan_perolehan_id}}">
    </x-livewire-tables::bs4.table.cell>

</div>
<style>
    .spanner, .overlay {
        opacity: 100!important;
    }

    .modal {
        background-color: rgb(190, 190, 190, 0.8);
    }

    .form-control {
        margin-left: -60px; 
        width: 60px;
    }

    input.form-control {
        margin-left: 1px;
    }
</style>
<script>

    function success() {
        var naskah = document.getElementById("naskah").value;

        if (naskah) {
            document.getElementById('hantar').disabled = false;
        } else {
            document.getElementById('hantar').disabled = true;
        }
    }

    var ids = [];

    function clickEvent(e) {
        var checkBox = document.getElementById("idTender");
        ids.push(e.target.value);

        if (checkBox.checked == true) {
            document.getElementById('btnJana').disabled = false;
        } else {
            ids.splice(0);
        }

        if (ids.length == 0) {
            document.getElementById('btnJana').disabled = true;
        }

    }

    function submitForm(event) {

        var today = new Date();
        var year = today.getFullYear();
        var month = today.getMonth() + 1;
        var day = today.getDate();
        var hour = today.getHours();
        var min = today.getMinutes();
        var sec = today.getSeconds();

        if (month < 10)
            month = '0' + month.toString();
        if (day < 10)
            day = '0' + day.toString();
        if (hour < 10)
            hour = '0' + hour.toString();
        if (min < 10)
            min = '0' + min.toString();
        if (sec < 10)
            sec = '0' + sec.toString();

        var fulldate = year + '' + month + '' + day + '' + hour + '' + min + '' + sec;
        var dataID = ids;
        var naskah = document.getElementById("naskah").value;

        $.ajax({
            url: '/awas/suratPerakuan/pdf',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: { 'dataID': dataID,  'naskah': naskah, 'fulldate': fulldate },
            type: 'post',
            datatype: 'json',
            beforeSend: function () {
                $("#wait").css("display", "block");
                $("div.spanner").addClass("show");
            },
            success: function (response) {

                if (response.status == "Done") {
                    window.open('/storage/dokumenKASA/Surat Hantar Dokumen Ke KASA - '+ fulldate +'.pdf');
                }
                Swal.fire({
                    icon: 'success',
                    text: 'Surat Berjaya Dijana',
                    showConfirmButton: false,
                    timer: 5000,
                    width: 350
                })
                $("#wait").css("display", "none");
                window.location.reload();
            },
        });
    }

</script>
