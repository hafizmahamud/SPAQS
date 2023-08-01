<!DOCTYPE HTML>
@extends('sisdant::layouts.master')

@section('content')
      <meta name="csrf-token" content="{{ csrf_token() }}" />
      <div class="pagetitle">
        <h1>Sah Permohonan Baharu</h1>
        @if (config('boilerplate.frontend_breadcrumbs'))
          @include('frontend.includes.partials.breadcrumbs')
        @endif
      </div><!-- End Page Title -->
      <div class="spanner">
        <div id="wait">
          <img src={{url('spaqs/assets/img/loader.gif')}} width="100%" /><br>
        </div>
      </div>

      <form autocomplete="off" id="myForm" method="post" action="{{ url('/sisdant/sahpermohonan') }}" enctype="multipart/form-data" style="padding: 10px;">
        @csrf
        <section class="section">
          <div class="card">
                    <div class="card-body">
                      <div class="row mb-3">
                        <div class="col-lg-6">
                        <label class=" form-label">Nombor Perolehan</label>
                            <div>
                                <input class="form-control" type="text" id="noperolehan" name="noperolehan"  readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                      <div class="col-lg-6">
                        <label class=" form-label">Jenis Iklan</label><a style="color: red;">*</a>
                        <div>
                            <select class="form-select" name="jenis_iklan" id="jenis_iklan">
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
                            <select class="form-select" aria-label="Default select example" id="tahun" name="tahun" >
                            <option value="" >Sila Pilih</option>
                            </select>
                        </div>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <div class="col-lg-6">
                        <label class=" form-label">Kategori Perolehan</label><a style="color: red;">*</a>
                        <div>
                            <select class="form-select" name="perolehan" id="perolehan" >
                            <option value="" >Sila Pilih</option>
                                @foreach ($perolehan as $per)
                                <option value="{{ $per->id }}">{{ $per->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div style="padding-top: 15px;">
                          <label class="form-label">Jenis Perolehan</label><a id="style_jenis_tender" style="color: red;">*</a>
                          <div>
                              <select class="form-select" name="tender" id="tender" disabled>
                              </select>
                          </div>
                        </div>
                      </div>
                      <div class="col-lg-6">
                      <label for="inputPassword" class=" form-label">Tajuk</label><a style="color: red;">*</a>
                      <div>
                          <textarea class="form-control" name="tajuk" id="tajuk"  style="height: 120px" onkeyup="
                          var start = this.selectionStart;
                          var end = this.selectionEnd;
                          this.value = this.value.toUpperCase();
                          this.setSelectionRange(start, end);" ></textarea>
                      </div>
                      </div>

                    </div>

                    <div class="row mb-3">
                      <div class="col-lg-6">
                          <label class="form-label">Fail</label><a id="style_muatnaik" style="color: red;" hidden>*</a>
                          <div class="row mb-3" id="style_muat_naik" hidden>
                            <div class="col-lg-4">
                              <input for="upload" type="button" class="btn btn-outline-primary" value="Dokumen Iklan"onclick="document.getElementById('upload').click();" style="width: 100%;" />
                              <input class="form-control" type="file" id="upload" name="file_upload" style="display:none;" accept=".pdf" >
                            </div>
                            <div class="col-lg-8">
                              <a id="checkfile" href='/{{ $data->dokumen_muatnaik }}' target="_blank">
                                {{ $data->nama_dokumen }}
                              </a>
                              <div id="selectedFiles" name="selectedFiles" style="color: #0d6efd;"></div>
                            </div>
                          </div>
                          <div class="row mb-3" id="style_muat_naik1" hidden>
                            <a style="border: 1px solid #4762f2; border-radius: 0.25rem; line-height: 1.5; margin-left: 10px; width: 40%; padding: 0.375rem 1rem;">
                                Tiada fail yang dimuat naik
                            </a>
                          </div>

                        </div>
                      <div class="col-lg-6">
                        <label for="inputDate" class=" form-label">Tarikh Jangka Iklan</label><a style="color: red;">*</a>
                        <div>
                            <input type="date" name="tarikh_iklan" id="tarikh_iklan" class="form-control" >

                        </div>
                      </div>
                    </div>
                    <div class="row mb-3">
                      <div class="col-lg-6">
                          <label class="form-label">Platform Iklan</label><a style="color: red;">*</a>
                          <div>
                            @foreach($dataKategoriIklan as $key => $value)
                            <label><input type="radio" id="kat_iklan{{ $value->id }}" name="kategori_iklan" value="{{ $value->id }}"  {{ $data->kategoriIklan['id'] == $value->id ? 'checked' : ''}}>&nbsp{{ $value->nama }}&nbsp&nbsp&nbsp</label>
                            @endforeach
                          </div>
                        </div>
                      <div class="col-lg-6">
                      </div>
                    </div>


              </div>
            </div>
            <div class="button-form">
              <button class="btn btn-primary" id="hantar" name="hantar" type="submit"  value="hantar" style="width: 10%;">Sah</button>
              <button class="btn btn-outline-danger" id="draf" name="simpan" type="submit" value="batal" style="width: 10%;">Batal</button>
              <button class="btn btn-outline-primary"  style="width: 10%;" onclick="history.back()">Kembali</button>
              <input class="form-control" type="text" id="status" name="status" style="display:none;">
              <input class="form-control" type="text" id="id_perolehan" name="id_perolehan" style="display:none;">
              <input class="form-control" type="text"  name="id_running_no" id="id_running_no" style="display:none;">
              <input class="form-control" type="text" name="justifikasi" id="justifikasi"  style="display:none;">
              <input class="form-control" type="file"  name="dokumen"  id="dokumen" accept=".pdf" style="display:none;">
            </div>

        </section>
      </form>

      <script src={{ Module::asset('sisdant:js/3_3_1_jquery.min.js') }}></script>
      <script>
        document.addEventListener('DOMContentLoaded', function() {
          $('.nav-list a').removeClass('active');
        }, false);

        $("document").ready(function(){
              var local = window.location.origin;
              var url = "/sisdant/pengesah";
          $('.link[href="'+url+'"]').addClass('active');
        });
      </script>
      <script>

        // year
        let dateDropdown = document.getElementById('tahun');
        let currentYear = new Date().getFullYear();
        let nextYear = new Date().getFullYear()+1;
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

        $( document ).ready(function() {
            $("#jenis_iklan").val(data.jenis_iklan_id);
            $("#perolehan").val(data.kategori_perolehan_id);
            $("#tajuk").val(data.tajuk_perolehan);
            $("#tarikh_iklan").val(data.tarikh_jangka_iklan);
            $("#tahun").val(data.tahun_perolehan);
            $("#id_perolehan").val(data.id_perolehan);

            if(data.upload_iklan == true) {
                document.getElementById("style_muatnaik").hidden = false;
            } else {
              document.getElementById("style_muatnaik").hidden = true;
            }

            if(data.dokumen_muatnaik == "") {
              document.getElementById("style_muat_naik1").hidden = false;
            } else {
              document.getElementById("style_muat_naik").hidden = false;
            }

            var section_id = data.section_id;
            var jenis_iklan_id = data.jenis_iklan_id;
            var kategori_perolehan_id = data.kategori_perolehan_id;
            var negeri_id = data.negeri_id;
            var tahun_perolehan = data.tahun_perolehan;

            $.ajax({
              url: '/sisdant/getnoperolehan',
              headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
              data: {'section_id': section_id, 'jenis_iklan_id': jenis_iklan_id, 'kategori_perolehan_id': kategori_perolehan_id, 'negeri_id': negeri_id, 'tahun_perolehan': tahun_perolehan},
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
              success: function(response){
                document.getElementById("noperolehan").value = response[0];
                document.getElementById("id_running_no").value = response[1];

              }
            });

        });
        function upload() {
          document.getElementById('dokumen').click();
        }

        // show file name
        var selDiv = "";
        document.addEventListener("DOMContentLoaded", init, false);

        function init() {
          document.querySelector('#dokumen').addEventListener('change', handleFileSelect, false);
          selDiv = document.querySelector("#selectedFiles_dokumen");
        }

        function handleFileSelect(e) {
          // var ul=document.createElement('ul');
          if(!e.target.files) return;
          document.getElementById('selectedFiles').innerHTML = "";
          var files = e.target.files;
          for(var i=0; i<files.length; i++) {
            var count = i;
            var li=document.createElement('a');
            li.setAttribute('id','file'+i);
            var f = files[i];
            li.innerHTML= f.name;
            // ul.appendChild(li);
          }
          document.getElementById('selectedFiles').appendChild(li);

        }
        // end file

        // tarikh min and max
        var today = new Date();
        var later = new Date();
            today = new Date(today.setDate(today.getDate() + 1)).toISOString().split('T')[0];
            later = new Date(later.setDate(later.getDate() + 61)).toISOString().split('T')[0];
        document.getElementsByName("tarikh_iklan")[0].setAttribute('min', today );
        document.getElementsByName("tarikh_iklan")[0].setAttribute('max', later );
        //end tarikh


        $('form').submit(function(e){
          e.preventDefault();
          if(document.activeElement.value == 'batal'){ // kalau hantar
            document.getElementById('status').value = document.activeElement.value;
            Swal.fire({
                title: "Adakah Anda Pasti Untuk Membatalkan Permohonan ?",
                html: "<label class='form-label'>Justifikasi :</label><br><textarea class='form-control' id='input_justifikasi' style='height: 120px'></textarea><br><input type='button' class='btn btn-outline-primary' value='Muat Naik Dokumen' onclick='upload()' style='width:100%;'/><div id='selectedFiles_dokumen' name='selectedFiles_dokumen' style='width:100%; margin-top:5%;'></div>",
                showCancelButton: true,
                confirmButtonText: 'Ya',
                cancelButtonText: 'Tidak',
                reverseButtons: true,
                preConfirm: () => {
                  if (document.getElementById('input_justifikasi').value) {
                    // Handle return value
                  } else {
                    Swal.showValidationMessage('Isi justifikasi')
                  }
                }
            }).then((result) => {
                if (result.value) {
                  document.getElementById("justifikasi").value = document.getElementById("input_justifikasi").value ;
                  document.getElementById("myForm").submit();
                } else {
                  document.getElementById('hantar').disabled = false;
                  document.getElementById('batal').disabled = false;
                }
            });
          }
          else if(document.activeElement.value == 'hantar'){ // kalau batal
            document.getElementById('status').value = document.activeElement.value;
            Swal.fire({
                title: "Adakah Anda Pasti Untuk Mengesahkan Permohonan ?",
                showCancelButton: true,
                confirmButtonText: 'Ya',
                cancelButtonText: 'Tidak',
                reverseButtons: true,
                icon: 'question'
            }).then((result) => {
                if (result.value) {
                  document.getElementById("myForm").submit();
                } else {
                  document.getElementById('hantar').disabled = false;
                  document.getElementById('batal').disabled = false;
                }
            });
          }
        });

        function function_noperolehan() {
          var tahun_p = document.getElementById('tahun').value;
          var jenisperolehan = document.getElementById("perolehan").value;
          var jenisiklan = document.getElementById("jenis_iklan").value;
          var section = data.section_id;
          var negeri = data.negeri_id;
          $.ajax({
              url: '/sisdant/getnoperolehan',
              headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
              data: {'section_id': section, 'jenis_iklan_id': jenisiklan, 'kategori_perolehan_id': jenisperolehan, 'negeri_id': negeri, 'tahun_perolehan': tahun_p},
              type: 'post',
              dataType: 'json',
              success: function(response){
                document.getElementById("noperolehan").value = response[0];
                document.getElementById("id_running_no").value = response[1];
              },
            error: function(xhr, status, error){
              function_noperolehan();
            }
            });
        }

         // dropdown jenis perolehan
         $('#jenis_iklan').change(function(){
          var id = $(this).val();
          $.ajax({
            url: '/sisdant/kategoriperolehan/'+id,
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
            success: function(response){
              var len = response[0].length;
              document.getElementById("tender").disabled = true;
              document.getElementById("perolehan").disabled = false;
              $("#tender").empty();
              $("#perolehan").empty();
              $("#noperolehan").val("");
              $("#perolehan").append("<option value=''>Sila Pilih</option>");
              for( var i = 0; i<len; i++){
                var id = response[0][i].id;
                var name = response[0][i].nama
                $("#perolehan").append("<option value='"+id+"'>"+name+"</option>");
              }
            }
          });
        });
        // end dropdown jenis perolehan

        // dropdown jenis perolehan
        $('#perolehan').change(function(){
          var jenisperolehan = $(this).val();
          if($("#perolehan option:selected").text() == "KERJA")
          {
            $('#kat_iklan2').prop("checked", true);
          } else {
            $('#kat_iklan1').prop("checked", true);
          }
          var jenisperolehan = document.getElementById("perolehan").value;
          var jenisiklan = document.getElementById("jenis_iklan").value;
          var section = data.section_id;
          var negeri = data.negeri_id;
          var tahun = document.getElementById('tahun').value;
          $.ajax({
            url: '/sisdant/kategoritenderwithperolehan',
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {'jenisperolehan': jenisperolehan, 'jenisiklan': jenisiklan,'negeri': negeri, 'section':section, 'tahun':tahun},
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
            success: function(response){
              var len = response[0].length;
              $("#tender").empty();
              document.getElementById('noperolehan').value = response[2];
              if(len) {
                document.getElementById("tender").disabled = false;
                document.getElementById("style_muat_naik").hidden = false;
                document.getElementById("style_muat_naik1").hidden = true;
                document.getElementById("style_jenis_tender").hidden = false;
                document.getElementById("tender").required = true;
                $("#tender").append("<option value=''>Sila Pilih</option>");
                for( var i = 0; i<len; i++){
                  var id = response[0][i].id;
                  var name = response[0][i].nama
                  $("#tender").append("<option value='"+id+"'>"+name+"</option>");
                }
                if(response[1][0].upload_iklan == true) {
                  document.getElementById("style_muatnaik").hidden = false;
                }
              } else {
                document.getElementById("tender").disabled = true;
                document.getElementById("style_jenis_tender").hidden = true;
                document.getElementById("tender").required = false;
                document.getElementById("style_muat_naik").hidden = false;
                if(response[1][0].upload_iklan == true) {
                  document.getElementById("style_muatnaik").hidden = true;
                }
              }
            },
            error: function(xhr, status, error){
              function_noperolehan();
            }
          });
        });
        // end dropdown jenis perolehan

        // dropdown jenis tender
        $('#tender').change(function(){
          var jenistender = $(this).val();
          var jenisiklan = document.getElementById("jenis_iklan").value;
          var jenisperolehan = document.getElementById("perolehan").value;

          $.ajax({
            url: '/sisdant/jenistender',
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {'jenistender': jenistender, 'jenisperolehan': jenisperolehan, 'jenisiklan': jenisiklan},
            type: 'post',
            dataType: 'json',
            success: function(response){
              if(response[0][0].upload_iklan == true) {
                document.getElementById("style_muatnaik").hidden = true;
              } else{
                document.getElementById("style_muatnaik").hidden = false;
              }
            }
          });
        });
        // end dropdown jenis tender

        // show file name
        var uploadfail = "";
        document.addEventListener("DOMContentLoaded", init_upload, false);

        function init_upload() {
          document.querySelector('#upload').addEventListener('change', handleFileSelect_upload, false);
          uploadfail = document.querySelector("#selectedFiles");
        }

        function handleFileSelect_upload(e) {
          var ul=document.createElement('ul');
          if(!e.target.files) return;
          uploadfail.innerHTML = "";
          var files = e.target.files;
          for(var i=0; i<files.length; i++) {
            var count = i;
            var li=document.createElement('li');
            li.setAttribute('id','file'+i);
            var f = files[i];
            li.innerHTML= f.name;
            ul.appendChild(li);
          }
          document.getElementById('checkfile').style.display ="none";
          document.getElementById('selectedFiles').appendChild(ul);
          document.getElementById('hantar').disabled = false;
          document.getElementById('draf').disabled = false;
        }
        // end file

        $('#tahun').change(function(){
          var jenisperolehan = document.getElementById("perolehan").value;
          var jenisiklan = document.getElementById("jenis_iklan").value;
          var section = data.section_id;
          var negeri = data.negeri_id;
          var tahun = document.getElementById('tahun').value;
          $.ajax({
            url: '/sisdant/kategoritenderwithperolehan',
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {'jenisperolehan': jenisperolehan, 'jenisiklan': jenisiklan,'negeri': negeri, 'section':section, 'tahun':tahun},
            type: 'post',
            dataType: 'json',
            success: function(response){
              document.getElementById('noperolehan').value = response[2];
            },
            error: function(xhr, status, error){
              function_noperolehan();
            }
          });
        });

      </script>
      <style>
        .form-label{
          font-weight: bold;
        }
      </style>


@endsection
