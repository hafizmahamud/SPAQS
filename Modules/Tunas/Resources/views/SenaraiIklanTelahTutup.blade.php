<!DOCTYPE HTML>
@extends('tunas::layouts.masterIklan')
@section('title', __('SENARAI IKLAN DIBUKA'))

@section('content')
  <div class="container">
      <div class="pagetitle">
        <div class="row">
          <div class="col-11">
            <img src="/spaqs/assets/img/Logo_JPS.png" width="150" height="110" style="display:block; margin-left:auto; margin-right:auto;">
          </div>
        </div>
        <div class="row">
          <div class="col-9">
            <h5 class="text-right" style="color:#696969; font-size:30px; margin-top: 10px; font-weight:bold">JABATAN PENGAIRAN DAN SALIRAN MALAYSIA</h5>
          </div>
        </div>
        <h1 style="color:black; font-size:20px; margin-top:30px">Senarai Iklan Telah Tutup</h1>
      </div>
      <section class="section">
          <div class="card">
            <div class="card-body">
                  <b>Carian Mengikut Projek:</b>
                  <livewire:tunas::senarai-iklan-telah-tutup.senarai-iklan-telah-tutup/>
            </div>
            <!-- The Modal -->
            <div id="myModal" class="modal">

              <!-- Modal content -->
              <div class="modal-content">
                <div class="modal-header d-block">
                    <button type="button" class="close float-right" style="margin-right: 5px;" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" style="font-size:40px">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                  <livewire:tunas::senarai-jadual-harga.senarai-jadual-harga/>
                </div>
              </div>
            </div>
            <!-- END The Modal -->
          </div>
      </section>
  </div>
      <style>
        .d-md-flex {
            display: flex!important;
            margin-bottom: 20px;
        }

        .mb-3 {
            margin-top: 10px!important;
            margin-bottom: 50px!important;
        }

        p {
            margin-top: 0;
            margin-bottom: 0rem !important;
        }

        .text-muted {
          margin-left: 10px;
        }
        .bi-question-circle-fill::before {
            float: right;
            margin-right: -4%;
            margin-bottom: 20px;
            margin-top: 40px;
        }

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

        .modal-header {
            border-bottom: 0px !important;
        }

        .mb-3 {
            margin-top: 0px!important;
            margin-bottom: 0px!important;
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
      </style>
      <script src={{ Module::asset('sisdant:js/3_3_1_jquery.min.js') }}></script>
      <script>
          function jadualharga(id){
              Livewire.emit('iklanPerolehan', id);
              modal.style.display = "block";
          }

          // Get the <span> element that closes the modal
          var span = document.getElementsByClassName("close")[0];

          // Get the modal
          var modal = document.getElementById("myModal");

          // When the user clicks on <span> (x), close the modal
          span.onclick = function() {
            modal.style.display = "none";
            Livewire.emit('iklanPerolehan', '');
          }

          // When the user clicks anywhere outside of the modal, close it
          window.onclick = function(event) {
            if (event.target == modal) {
              modal.style.display = "none";
              Livewire.emit('iklanPerolehan', '');
            }
          }
      </script>
@endsection
