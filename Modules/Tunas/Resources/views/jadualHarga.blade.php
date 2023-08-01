<!DOCTYPE HTML>
@extends('tunas::layouts.master')

@section('content')
      <div class="pagetitle">
        <h1>Jadual Harga</h1>
        @if (config('boilerplate.frontend_breadcrumbs'))
          @include('frontend.includes.partials.breadcrumbs')
        @endif
      </div><!-- End Page Title -->
      <div class="spanner">
          <div id="wait"
              style="display:none; position:fixed; top:25%; left:35%; padding:2px; z-index: 1000;"><img
                  src={{url('spaqs/assets/img/loader.gif')}} width="100%" /><br></div>
      </div>
      <section class="section" style="margin-top: 20px">
          <div class="container">
                <div class="row">
                  <div class="col-2">
                    <p class="text-right" style="font-weight:bold">Negeri</p>
                  </div>
                  <div class="col-10">
                    <p class="text-left">{{$iklantutup->mohonNoPerolehan->negeri['negeri']}}</p>
                  </div>
                </div>
                <div class="row">
                  <div class="col-2">
                    <p class="text-right" style="font-weight:bold">No Tender</p>
                  </div>
                  <div class="col-10">
                    <p class="text-left">{{$iklantutup->mohonNoPerolehan['no_perolehan']}}</p>
                  </div>
                </div>
                <div class="row">
                  <div class="col-2">
                    <p class="text-right" style="font-weight:bold">Tajuk Projek</p>
                  </div>
                  <div class="col-10">
                    <p class="text-left">{{$iklantutup->mohonNoPerolehan['tajuk_perolehan']}}</p>
                  </div>
                </div>
                <div class="row">
                  <div class="col-2">
                    <p class="text-right" style="font-weight:bold">Tarikh Tutup</p>
                  </div>
                  <div class="col-10">
                    <p class="text-left">{{\Carbon\Carbon::parse($iklantutup-> tarikh_waktu_tutup)->format('d/m/Y')}}</p>
                  </div>
                </div>
                <div class="row">
                  <div class="col-2">
                    <p class="text-right" style="font-weight:bold">Jenis Iklan</p>
                  </div>
                  <div class="col-10">
                    <p class="text-left">{{$iklantutup->mohonNoPerolehan->matrikIklan->jenisIklan['nama']}}</p>
                  </div>
                </div>
                <div class="row">
                  <div class="col-2">
                    <p class="text-right" style="font-weight:bold">Kategori Perolehan</p>
                  </div>
                  <div class="col-10">
                    <p class="text-left">{{$iklantutup->mohonNoPerolehan->matrikIklan->kategoriPerolehan['nama']}}</p>
                    <input type="text" name="iklanID" id="iklanID" value="{{$iklantutup->id}}" hidden>
                  </div>
                </div>
          </div>
      </section>
      <section class="section" style="margin-top: 20px">
        <div class="card">
              <div class="card-body">
                <!-- Table with stripped rows -->
                <livewire:tunas::jadual-harga.jadualharga :id="$iklantutup->id" />
                <!-- End Table with stripped rows -->
                <div class="button-form" style="margin-top:30px; margin-bottom:-20px;">
                  @if($iklantutup->jadual_harga_status == 'SELESAI')
                    @if( $jadualHarga->isEmpty())
                      <button class="btn btn-primary" form="jadual_harga" id="hantar" name="hantar" type="button" value="hantar" onclick="iklankan('kemaskini')" style="width: 10%;" disabled>Kemaskini</button>
                    @else
                      <button class="btn btn-primary" form="jadual_harga" id="hantar" name="hantar" type="button" value="hantar" onclick="iklankan('kemaskini')" style="width: 10%;">Kemaskini</button>
                    @endif
                    <button class="btn btn-outline-success"  id="myBtn" style="width: 10%; margin-right: 10px;">Semak</button>
                  @else
                    @if( $jadualHarga->isEmpty())
                      <button class="btn btn-primary" form="jadual_harga" id="hantar" name="hantar" type="button" value="hantar" onclick="iklankan('iklankan')" style="width: 10%;" disabled>Pamer</button>
                      <button class="btn btn-outline-primary" form="jadual_harga" id="draf" name="simpan" type="submit" value="draf" style="width: 10%;" disabled>Simpan</button>
                    @else
                      <button class="btn btn-primary" form="jadual_harga" id="hantar" name="hantar" type="button" value="hantar" onclick="iklankan('iklankan')" style="width: 10%;">Pamer</button>
                      <button class="btn btn-outline-primary" form="jadual_harga" id="draf" name="simpan" type="submit" value="draf" style="width: 10%;">Simpan</button>
                    @endif
                    <button class="btn btn-outline-success"  id="myBtn" style="width: 10%; margin-right: 10px;">Semak</button>
                  @endif
                </div>

              </div>
              <!-- The Modal -->
              <div id="myModal" class="modal">

                <!-- Modal content -->
                <div class="modal-content">
                  <div class="modal-header d-block">
                      <button type="button" class="close float-right" style="margin-right: 5px;" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" style="font-size:30px">&times;</span>
                      </button>
                  </div>
                  <div class="modal-body">
                      <livewire:tunas::jadual-harga.modal-jadualharga :id="$iklantutup->id" />
                  </div>
                </div>

              </div>
              <!-- END The Modal -->

        </div>
      </section>
      <style>
        .table th, .table td {
              padding: 0.75rem;
              vertical-align: top;
              border-top: 0px !important;
        }
        .table>:not(caption)>*>* {
            padding: 0.5rem 0.5rem;
            background-color: var(--bs-table-bg);
            border-bottom-width: 0px !important;
            box-shadow: inset 0 0 0 9999px var(--bs-table-accent-bg);
        }
        p {
            margin-top: 0;
            margin-bottom: 0rem !important;
        }

        .modal-header {
            border-bottom: 0px !important;
        }

        /* The Modal (background) */
        .modal {
          display: none; /* Hidden by default */
          position: fixed; /* Stay in place */
          z-index: 1; /* Sit on top */
          padding-top: 60px; Location of the box
          left: 0;
          top: 0;
          width: 100%; /* Full width */
          height: 100%; /* Full height */
          overflow: auto; /* Enable scroll if needed */
          background-color: rgb(0,0,0); /* Fallback color */
          background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
        }

        /* Modal Content */
        .modal-content {
          background-color: #fefefe;
          margin: auto;
          width: 70% !important;
          border: 1px solid #888;
          width: 80%;
        }

        /* The Close Button */
        .close {
          color: #aaaaaa;
          float: right;
          font-size: 28px;
          font-weight: bold;
        }

        .close:hover,
        .close:focus {
          color: #000;
          text-decoration: none;
          cursor: pointer;
        }

        table {
          width: 100%;
        }
        thead, tbody tr {
          display: table;
          width: 100%;
          table-layout: fixed;
        }
        tbody {
          display: block;
          overflow-y: auto;
          table-layout: fixed;
          max-height: 200px;
        }
        .spanner, .overlay {
            opacity: 50!important;
        }
      </style>
      <script src={{ Module::asset('sisdant:js/3_3_1_jquery.min.js') }}></script>
      <script src={{ Module::asset('sisdant:js/jquery.mask.min.js') }}></script>
      <script>
        document.addEventListener('DOMContentLoaded', function() {
          $('.nav-list a').removeClass('active');
        }, false);

        $("document").ready(function(){
              var local = window.location.origin;
              var url = local + "/tunas/iklan-telah-tutup";
          $('.link[href="'+url+'"]').addClass('active');
        });
      </script>

      <script>
            var iklan = @json($iklantutup);
            document.getElementById('tambah').disabled = true;

            function success (){
              var syarikat = document.getElementById('syarikat').value;
              var harga = document.getElementById('harga').value;
              var tempoh = document.getElementById('tempoh').value;
              var bulan = document.getElementById('bulan').value;

              if (syarikat == '' || harga == '' || tempoh == '' || bulan == ''){
                document.getElementById('tambah').disabled = true;
              } else {
                document.getElementById('tambah').disabled = false;
              }
            }

            function req ()  {
              var inputs_text, index, row;
              var count = 0;


              inputs_text = document.querySelectorAll('#jadualH input');
              for (index = 0; index < inputs_text.length; ++index) {
                  if(inputs_text[index].value == '' && inputs_text[index].id != 'catatan') {
                    console.log(inputs_text[index].id);
                      count++;
                  }
              }

              inputs_text = document.querySelectorAll('#jadualH select');
              for (index = 0; index < inputs_text.length; ++index) {
                  if(inputs_text[index].value == '') {
                      count++;
                  }
              }

              if( count > 0 ){
                if(iklan.jadual_harga_status == 'TINDAKAN' || iklan.jadual_harga_status == 'DRAF') {
                  document.getElementById('hantar').disabled = true;
                  document.getElementById('draf').disabled = true;
                } else {
                  document.getElementById('hantar').disabled = true;
                }
              } else {
                if(iklan.jadual_harga_status == 'TINDAKAN' || iklan.jadual_harga_status == 'DRAF') {
                  document.getElementById('hantar').disabled = false;
                  document.getElementById('draf').disabled = false;
                } else {
                  document.getElementById('hantar').disabled = false;
                }
              }
            }

            $('#tambah').click( function() {
                $("#wait").css("display", "block");
                $("div.spanner").addClass("show");
                var syarikat = document.getElementById('syarikat').value;
                var harga = document.getElementById('harga').value;
                var tempoh = document.getElementById('tempoh').value;
                var bulan = document.getElementById('bulan').value;
                var catatan = document.getElementById('catatan').value;
                var id = document.getElementById('iklanID').value;

                var data = {
                    syarikat: syarikat,
                    harga: harga,
                    tempoh: tempoh,
                    bulan: bulan,
                    catatan: catatan,
                  }
                $.ajax({
                      url: '/tunas/iklan-telah-tutup/jadual-harga/tambah/' + id,
                      type: 'post',
                      headers: {
                          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                      },

                      data: data,
                      success: function (response) {
                          Swal.fire({
                              icon: 'success',
                              text: 'Rekod Berjaya Ditambah.',
                              showConfirmButton: false,
                              timer: 5000,
                              width: 350
                          })
                          window.location.reload();
                      }
                });
            });

            $('#draf').click( function() {
              $("#wait").css("display", "block");
              $("div.spanner").addClass("show");
            });

            function padam(id){
              Swal.fire({
                  title: 'Adakah anda pasti untuk memadamkan rekod ini ?',
                  showCancelButton: true,
                  confirmButtonText: 'Ya',
                  cancelButtonText: 'Tidak',
                  reverseButtons: true,
                  icon: 'warning'
              }).then((result) => {
                  if (result.value) {
                    $("#wait").css("display", "block");
                    $("div.spanner").addClass("show");
                    $.ajax({
                      url: '/tunas/iklan-telah-tutup/jadual-harga/padam/' + id,
                      type: 'get',
                      dataType: 'json',
                      success: function (response) {
                        Swal.fire({
                            icon: 'success',
                            text: 'Rekod berjaya dipadam.',
                            showConfirmButton: false,
                            timer: 5000,
                            width: 350
                        })
                        window.location.reload();
                      }
                    });
                  }
              });

            }

            function iklankan (id) {
                  Swal.fire({
                      title: 'Adakah anda pasti untuk '+ id + ' jadual harga ?',
                      showCancelButton: true,
                      confirmButtonText: 'Ya',
                      cancelButtonText: 'Tidak',
                      reverseButtons: true,
                      icon: 'warning'
                  }).then((result) => {
                      if (result.value) {
                        $("#wait").css("display", "block");
                        $("div.spanner").addClass("show");
                          document.getElementById("tindakan").value = id;
                          document.getElementById("jadual_harga").submit();
                      }
                  });
            }

            // Get the modal
            var modal = document.getElementById("myModal");

            // Get the button that opens the modal
            var btn = document.getElementById("myBtn");

            // Get the <span> element that closes the modal
            var span = document.getElementsByClassName("close")[0];

            // When the user clicks the button, open the modal
            btn.onclick = function() {
              modal.style.display = "block";
            }

            // When the user clicks on <span> (x), close the modal
            span.onclick = function() {
              modal.style.display = "none";
            }

            // When the user clicks anywhere outside of the modal, close it
            window.onclick = function(event) {
              if (event.target == modal) {
                modal.style.display = "none";
              }
            }

      </script>
@endsection




