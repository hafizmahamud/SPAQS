<!DOCTYPE HTML>
@extends('sisdant::layouts.master')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}" />
<div class="pagetitle">
    <h1>Permohonan Nombor Perolehan</h1>
    @if (config('boilerplate.frontend_breadcrumbs'))
    @include('frontend.includes.partials.breadcrumbs')
    @endif
</div><!-- End Page Title -->
<div class="spanner">
    <div id="wait">
      <img src={{url('spaqs/assets/img/loader.gif')}} width="100%" /><br>
    </div>
  </div>

<form id="myForm" autocomplete="off" method="post" action="{{ url('/sisdant/savepermohonandraf') }}"
    enctype="multipart/form-data" style="padding: 10px;">
    @csrf
    <section class="section">
        <div class="card">
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-lg-6">
                        <label class=" form-label">Jenis Iklan</label><a style="color: red;">*</a>
                        <div>
                            <select class="form-select" name="jenis_iklan" id="jenis_iklan" required>
                                <option value="">Sila Pilih</option>
                                @foreach ($jenisiklan as $iklan)
                                <option value="{{ $iklan->id }}">{{ $iklan->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <label class=" form-label">Tahun Perolehan</label><a style="color: red;">*</a>
                        <div>
                            <select class="form-select" aria-label="Default select example" id="tahun" name="tahun"
                                required>
                                <option value="">Sila Pilih</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-lg-6">
                        <label class=" form-label">Kategori Perolehan</label><a style="color: red;">*</a>
                        <div>
                            <select class="form-select" name="perolehan" id="perolehan" required>
                                <option value="">Sila Pilih</option>
                                @foreach ($perolehan as $per)
                                <option value="{{ $per->id }}">{{ $per->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div style="padding-top: 15px;">
                            <label class="form-label">Jenis Perolehan</label><a id="style_jenis_tender"
                                style="color: red;">*</a>
                            <div>
                                <select class="form-select" name="tender" id="tender" disabled required>
                                    <option value="">Sila Pilih</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <label for="inputPassword" class=" form-label">Tajuk</label><a style="color: red;">*</a>
                        <div>
                            <textarea class="form-control" name="tajuk" id="tajuk" style="height: 120px" onkeyup="
                          var start = this.selectionStart;
                          var end = this.selectionEnd;
                          this.value = this.value.toUpperCase();
                          this.setSelectionRange(start, end);" required></textarea>
                        </div>
                    </div>

                    <div class="row mb-3">
                      <div class="col-lg-6">
                          <label class="form-label">Muat Naik</label><a id="style_muat_naik" style="color: red;" hidden>*</a>
                          <i class="bi bi-info-circle-fill"></i>
                            <span class="tooltip-text" style="font-weight: bold; margin-right:400px;">
                                <a style="font-size: 12px; font-weight: bold; border-radius: 10px; color: black;display: inline-block; cursor: pointer; text-align: left;">
                                    i. Hanya fail .pdf sahaja <br>
                                    ii. Saiz tidak melebihi 10MB</a><br>
                            </span>
                          <div class="row mb-3" id="muatnaik">
                              <div class="col-lg-4">
                                  <input for="upload" type="button" class="btn btn-outline-primary"
                                      value="Dokumen Iklan" onclick="document.getElementById('upload').click();"
                                      style="width: 100%;" />
                                  <input type="file" id="upload" name="file_upload" style="display:none;" onchange="handleFileSelect(event)"
                                      accept=".pdf">
                              </div>
                              <div class="col-lg-8">
                                  <div id="selectedFiles" name="selectedFiles" style="color: #0d6efd;"></div>
                              </div>
                          </div>
                            <div class="row mb-3" id="muatturun">
                                <div class="col-lg-1" style="margin-left: 22px">
                                    <i class="mdi mdi-minus-circle" style="color: red; font-size:22px; cursor: pointer;"
                                      onclick="deletelist({{ $data->id_perolehan }})"
                                      data-id="{{ $data->id_perolehan }}"></i>
                                </div>
                                <div class="col-lg-8" style="margin-left: -28px; margin-top: 7px;">
                                    <a href='/{{ $data->dokumen_muatnaik }}' target="_blank">{{ $data->nama_dokumen }}</a>
                                </div>
                            </div>
                      </div>
                      <div class="col-lg-6">
                          <div>
                            <label for="inputDate" class=" form-label" style="margin-left: 10px ; margin-top: 10px;">Tarikh Jangka Iklan</label>
                            <a style="color: red;">*</a>
                            <i class="bi bi-info-circle-fill"></i>
                                <span class="tooltip-text" style="font-weight: bold; margin-right:400px;">
                                    <a style="font-size: 12px; font-weight: bold; border-radius: 10px; color: black;display: inline-block; cursor: pointer; text-align: left;">
                                        Tarikh jangka iklan mestilah dalam lingkungan 60 hari.<br>
                                </span>
                          </div>
                            <div>
                                <input type="date" name="tarikh_iklan" id="datePicker" class="form-control" required
                                    style="margin-left: 10px; width:658px;">
                            </div>
                        </div>
                      </div>
                    </div>

                <div class="row mb-3">
                    <div class="col-lg-6">
                        <label class="form-label">Platform Iklan</label><a style="color: red;">*</a>
                        <div>
                          @if ($data->kategori_iklan_id == 1)
                            <input type="radio" id="kat_iklan1" name="kat_iklan" value="1" checked="checked">
                            <label for="kat_iklan" style="margin-right: 10px;">ePerolehan</label>

                            <input type="radio" id="kat_iklan2" name="kat_iklan" value="2">
                            <label for="kat_iklan" style="margin-right: 10px;">Portal JPS</label>
                          @else
                            <input type="radio" id="kat_iklan1" name="kat_iklan" value="1">
                            <label for="kat_iklan" style="margin-right: 10px;">ePerolehan</label>

                            <input type="radio" id="kat_iklan2" name="kat_iklan" value="2" checked="checked">
                            <label for="kat_iklan" style="margin-right: 10px;">Portal JPS</label>
                          @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="button-form">
            <button class="btn btn-primary" id="hantar" name="hantar" type="submit" value="hantar"
                style="width: 150px;">Hantar</button>
            <button class="btn btn-success" id="draf" name="simpan" type="submit" value="draf"
                style="width: 150px;">Simpan</button>
            <button class="btn btn-outline-danger" style="width: 150px; margin-right: 10px;"
                onclick="deletepermohonandraf();">Padam</button>
            <a id="deletedraf" href="{{ url('/sisdant/deletepermohonandraf',['id'=>$data->id_perolehan]) }}">
                <button class="btn btn-outline-primary" style="width: 150px; " onclick="history.back()">Kembali</button>
                <input class="form-control" type="text" id="status" name="status" style="display:none;">
                <input class="form-control" type="text" id="id_perolehan" name="id_perolehan" style="display:none;">
        </div>
    </section>
</form>

<script src={{ Module::asset('sisdant:js/3_3_1_jquery.min.js') }}></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        $('.nav-list a').removeClass('active');
    }, false);

    $("document").ready(function () {
        var local = window.location.origin;
        var url = "/sisdant";
        $('.link[href="' + url + '"]').addClass('active');
    });

</script>
<script>
    // year
    let dateDropdown = document.getElementById('tahun');
    let currentYear = new Date().getFullYear();
    let nextYear = new Date().getFullYear() + 1;
    while (currentYear <= nextYear) {
        let dateOption = document.createElement('option');
        dateOption.text = currentYear;
        dateOption.value = currentYear;
        dateDropdown.add(dateOption);
        currentYear += 1;
    }
    // end year

    //select current value
    var data = @json($data);


    $(document).ready(function () {
        $("#jenis_iklan").val(data.jenis_iklan_id);
        $("#perolehan").val(data.kategori_perolehan_id);
        $("#tajuk").val(data.tajuk_perolehan);
        $("#datePicker").val(data.tarikh_jangka_iklan);
        $("#tahun").val(data.tahun_perolehan);
        $("#id_perolehan").val(data.id_perolehan);



        if (data.jenis_tender_id) {
            var tender = @json($tender);
            document.getElementById("tender").disabled = false;
            for (let index = 0; index < tender.length; index++) {
                var z = document.createElement("option");
                z.setAttribute("value", tender[index].id);
                var t = document.createTextNode(tender[index].nama);
                z.appendChild(t);
                document.getElementById("tender").appendChild(z);
            }
            $("#tender").val(data.jenis_tender_id);
        }

        if (data.upload_iklan == true) {
            document.getElementById("style_muat_naik").hidden = false;
        }


    });

    //select current value
    var data = @json($data);
        //select current value
        var data = @json($data);

        // condition for muat naik draf iklan
        if (data.dokumen_muatnaik == null || data.dokumen_muatnaik == '') {
            document.getElementById("muatturun").hidden = true;
            document.getElementById("muatnaik").hidden = false;
        } else {
            document.getElementById("muatturun").hidden = false;
            document.getElementById("muatnaik").hidden = true;
        }

        // delete uploaded file
    function deletelist(id) {

      var token = $("meta[name='csrf-token']").attr("content");

      $.ajax({
          url: "deletefiledraf/" + id,
          type: 'post',
          data: {
              "id": id,
              "_token": token,
          },
          success: function () {
              document.getElementById("muatturun").hidden = true;
              document.getElementById("muatnaik").hidden = false;

          }
      });
    }

    // show file name
    var selDiv = "";
    document.addEventListener("DOMContentLoaded", init, false);

    function init() {
        document.querySelector('#upload').addEventListener('change', handleFileSelect, false);
        selDiv = document.querySelector("#selectedFiles");
    }

    function handleFileSelect(e) {
        var ul = document.createElement('ul');
        if (!e.target.files) return;
        selDiv.innerHTML = "";
        var files = e.target.files;
        for (var i = 0; i < files.length; i++) {
            var count = i;
            var li = document.createElement('li');
            li.setAttribute('id', 'file' + i);
            var f = files[i];
            li.innerHTML = f.name;
            ul.appendChild(li);
        }
        document.getElementById('selectedFiles').appendChild(ul);
        document.getElementById('hantar').disabled = false;
        document.getElementById('draf').disabled = false;
    }
    // end file



    // dropdown jenis perolehan
    $('#jenis_iklan').change(function () {
        var id = $(this).val();
        $.ajax({
            url: '/sisdant/kategoriperolehan/' + id,
            type: 'get',
            dataType: 'json',
            beforeSend: function () {
              $("#wait").css("display", "block");
              $("div.spanner").addClass("show");
            },
            complete: function () {
              $("#wait").css("display", "none");
              $("div.spanner").removeClass("show");
            },
            success: function (response) {
                var len = response[0].length;
                document.getElementById("tender").disabled = true;
                document.getElementById("perolehan").disabled = false;
                $("#perolehan").empty();
                $("#tender").empty();
                $("#perolehan").append("<option value=''>Sila Pilih</option>");
                for (var i = 0; i < len; i++) {
                    var id = response[0][i].id;
                    var name = response[0][i].nama
                    $("#perolehan").append("<option value='" + id + "'>" + name + "</option>");
                }
            }
        });
    });
    // end dropdown jenis perolehan

    // dropdown jenis perolehan
    $('#perolehan').change(function () {
        var jenisperolehan = $(this).val();
        var jenisiklan = document.getElementById("jenis_iklan").value;
        if($("#perolehan option:selected").text() == "KERJA")
          {
            $('#kat_iklan2').prop("checked", true);
          } else {
            $('#kat_iklan1').prop("checked", true);
          }
        $.ajax({
            url: '/sisdant/kategoritender',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                'jenisperolehan': jenisperolehan,
                'jenisiklan': jenisiklan
            },
            type: 'post',
            dataType: 'json',
            beforeSend: function () {
              $("#wait").css("display", "block");
              $("div.spanner").addClass("show");
            },
            complete: function () {
              $("#wait").css("display", "none");
              $("div.spanner").removeClass("show");
            },
            success: function (response) {
                var len = response[0].length;
                $("#tender").empty();
                if (len) {
                    $("#upload_file").val("false");
                    document.getElementById("tender").disabled = false;
                    document.getElementById("style_muat_naik").hidden = true;
                    document.getElementById("style_jenis_tender").hidden = false;
                    document.getElementById("tender").required = true;
                    $("#tender").append("<option value=''>Sila Pilih</option>");
                    for (var i = 0; i < len; i++) {
                        var id = response[0][i].id;
                        var name = response[0][i].nama
                        $("#tender").append("<option value='" + id + "'>" + name + "</option>");
                    }
                } else {
                    document.getElementById("tender").disabled = true;
                    document.getElementById("style_jenis_tender").hidden = true;
                    document.getElementById("tender").required = false;
                    if (response[1][0].upload_iklan == true) {
                        $("#upload_file").val("true");
                        document.getElementById("style_muat_naik").hidden = false;


                    }
                }
            }
        });
    });
    // end dropdown jenis perolehan

    // dropdown jenis tender
    $('#tender').change(function () {
        var jenistender = $(this).val();
        var jenisiklan = document.getElementById("jenis_iklan").value;
        var jenisperolehan = document.getElementById("perolehan").value;

        $.ajax({
            url: '/sisdant/jenistender',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                'jenistender': jenistender,
                'jenisperolehan': jenisperolehan,
                'jenisiklan': jenisiklan
            },
            type: 'post',
            dataType: 'json',
            success: function (response) {
                if (response[0][0].upload_iklan == true) {
                    $("#upload_file").val("true");
                    document.getElementById("style_muat_naik").hidden = false;
                } else {
                    $("#upload_file").val("false");
                    document.getElementById("style_muat_naik").hidden = true;

                }
            }
        });
    });
    // end dropdown jenis tender

    // tarikh min and max
    var today = new Date();
    var later = new Date();
    today = new Date(today.setDate(today.getDate() + 1)).toISOString().split('T')[0];
    later = new Date(later.setDate(later.getDate() + 61)).toISOString().split('T')[0];
    document.getElementsByName("tarikh_iklan")[0].setAttribute('min', today);
    document.getElementsByName("tarikh_iklan")[0].setAttribute('max', later);

    // value tarikh iklan
    var now1 = new Date();
    var now = new Date(now1.setDate(now1.getDate() + 1));
    var day = ("0" + now.getDate()).slice(-2);
    var month = ("0" + (now.getMonth() + 1)).slice(-2);
    var today1 = now.getFullYear() + "-" + (month) + "-" + (day);
    $('#datePicker').val(today1);
    //end tarikh

    // bila hantar
    // bila hantar
    $("form").submit(function (event) {
        event.preventDefault();
        $("#upload").each(function() {
            if($(this).val() == "" && data.dokumen_muatnaik == '') {
                Swal.fire({
                    icon: 'error',
                    text: 'Sila Muat Naik Dokumen Iklan'
                })
            }
        });


        if (document.activeElement.value == 'hantar') { // kalau hantar
            document.getElementById('status').value = document.activeElement.value;
            var check = document.getElementById('hantar').value;
            document.getElementById('status').value = check;
            Swal.fire({
                title: "Adakah Anda Pasti Untuk Menghantar Permohonan ?",
                showCancelButton: true,
                confirmButtonText: 'Ya',
                cancelButtonText: 'Tidak',
                reverseButtons: true,
                icon: 'question'
            }).then((result) => {
                if (result.value) {
                    $("#wait").css("display", "block");
                    $("div.spanner").addClass("show");
                    document.getElementById("myForm").submit();
                } else {
                    document.getElementById('hantar').disabled = false;
                    document.getElementById('draf').disabled = false;
                }
            });
        } else if (document.activeElement.value == 'draf') { // kalau batal
            document.getElementById('status').value = document.activeElement.value;
            var check = document.getElementById('draf').value;
            document.getElementById('status').value = check;
            Swal.fire({
                title: "Adakah Anda Pasti Untuk Menyimpan Permohonan ?",
                showCancelButton: true,
                confirmButtonText: 'Ya',
                cancelButtonText: 'Tidak',
                reverseButtons: true,
                icon: 'question'
            }).then((result) => {
                if (result.value) {
                    $("#wait").css("display", "block");
                    $("div.spanner").addClass("show");
                    document.getElementById("myForm").submit();
                } else {
                    document.getElementById('hantar').disabled = false;
                    document.getElementById('draf').disabled = false;
                }
            });
        }
    });

    function deletepermohonandraf(id) {
        Swal.fire({
            title: "Adakah Anda Pasti Untuk Memadam Permohonan ?",
            showCancelButton: true,
            confirmButtonText: 'Ya',
            cancelButtonText: 'Tidak',
            reverseButtons: true,
            icon: 'question'
        }).then((result) => {
            if (result.value) {
                document.getElementById("deletedraf").click();
            } else {
                document.getElementById('hantar').disabled = false;
                document.getElementById('draf').disabled = false;
            }
        });
    }

</script>
<style>
    .form-label {
        font-weight: bold;
    }

</style>


@endsection
