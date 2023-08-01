@if ($loop->index == 0)
<button class="btn btn-primary" id="btnJana" style="float: right; margin-bottom:10px;"  onclick="submitForm(event)" disabled>Jana Surat</button>
<div class="spanner">
    <div id="wait"><img src={{url('spaqs/assets/img/loader.gif')}} width="100%" /><br>
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
        <input type="checkbox" id="idTender" onclick="clickEvent(event)" value="{{$row->iklan_perolehan_id}}">
    </x-livewire-tables::bs4.table.cell>

</div>
<style>
    .spanner, .overlay {
      opacity: 100!important;
    }

    input.form-control {
        margin-left: 1px;
    }
</style>
<script>
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

        $.ajax({
            url: '/awas/suratLanjutan/pdf',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: { 'dataID': dataID, 'fulldate': fulldate },
            type: 'post',
            datatype: 'json',
            beforeSend: function () {
                $("#wait").css("display", "block");
                $("div.spanner").addClass("show");
            },
            success: function (response) {

                if (response.status == "Done") {
                    window.open('/storage/dokumenKASA/Surat Mohon Lanjut Sah Laku Tender - '+ fulldate +'.pdf');
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

