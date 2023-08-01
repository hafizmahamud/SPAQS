<!DOCTYPE html>
<html lang="{{ htmlLang() }}" @langrtl dir="rtl" @endlangrtl>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="refresh" content="{{ config('session.lifetime') * 60 }}">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>{{ appName() }} | @yield('title')</title>
  <meta name="description" content="@yield('meta_description', appName())">
  <meta name="author" content="@yield('meta_author', 'Plisca')">
  @yield('meta')

    @stack('before-styles')

    <link href="{{ mix('css/frontend.css') }}" rel="stylesheet">
    <link rel="stylesheet" href={{ Module::asset('sisdant:css/style.css') }}>
    <livewire:styles />
    @stack('after-styles')

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href={{ url("spaqs/assets/vendor/bootstrap/css/bootstrap.min.css") }} rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href={{ url("spaqs/assets/css/style.css") }} rel="stylesheet">
      <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
</head>
    <div style="background-color:white; padding:5px;">
        <img id="logo" src="/img/Logo_JPS.png" alt="" style="display:block; margin-left:auto; margin-right:auto; width:10%;"><br>
        <p id="text-logo" style=" text-align:center; font-size:30px; ">JABATAN PENGAIRAN DAN SALIRAN MALAYSIA
        </p>
    </div>

<body>
  <main id="main-template" class="main-template" >
    <section class="section">
      <div style="padding-bottom: 10px;">
          <h5 class="saringanwajib-title"><b>TAJUK PROJEK : {{$noperolehan->tajuk_perolehan}}<b></h5>
          <h4 class="saringanwajib-text"><b>NOMBOR PEROLEHAN PROJEK : {{$noperolehan->no_perolehan}}<b></h4>
            @if ($iklan->lawatan_tapak!='TIDAK_WAJIB')
            <h4 class="saringanwajib-text" >Arahan:</h4>
            <h4 class="saringanwajib-text" style="text-align: justify;">1. Borang Hadir Tapak ini perlu diisi oleh kontraktor yang berminat untuk menyertai tender dan hanya satu borang dibenarkan untuk diisi bagi setiap syarikat.</h4>
            <h4 class="saringanwajib-text" >2. Tarikh tutup pengisian borang adalah pada <label id="tarikhLawatanTapakDMY" name="tarikhLawatanTapakDMY">{{ $tarikhLawatanTapakDMY }}</label> pada jam {{ $waktuLaporHIA }} hingga {{ $endtime }}.</h4>
            @else
            <h4 class="saringanwajib-text" >Arahan:</h4>
            <h4 class="saringanwajib-text" style="text-align: justify;">1. Borang Hadir Tapak ini perlu diisi oleh kontraktor yang berminat untuk menyertai tender dan hanya satu borang dibenarkan untuk diisi bagi setiap syarikat.</h4>
            <h4 class="saringanwajib-text" >2. Tarikh pengisian borang adalah selama 3 hari bermula pada <label>{{ $tarikhMula }}</label> pada jam {{ $waktuLaporHIA }} hingga {{ $tarikhTutup }} jam 11.59 tengah malam.</h4>
            @endif</div>
      <div style="padding: 20px 0 10px 0; ">
          @if ($iklan->lawatan_tapak=='TIDAK_WAJIB')
          <h4 style="font-weight:bold;">Pendaftaran Kontraktor</h4>
          @else
          <h4 style="font-weight:bold;">Kehadiran Lawatan Tapak</h4>
          @endif
      </div>
      <div class="spanner">
        <div id="wait">
          <img src={{url('spaqs/assets/img/loader.gif')}} width="100%" /><br>
        </div>
      </div>
      <form id="form__submit" action="{{ url('/kehadiranlawatantapak/simpan') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="card" style="border-radius: 25px;">
          <div class="card-body">
            <div class="card-body-template">
              <div class="row mb-3">
                <div class="col-lg-6" >
                    <label class=" form-label" for="no_syarikat" name="no_syarikat">Nombor CIDB Syarikat</label>
                    <div>
                        <input type="text" class="form-control" id="no_syarikat" name="no_syarikat"  readonly >
                    </div>
                </div>

                <div class="col-lg-6">
                    <label class=" form-label" for="notel" name="notel">No. Telefon</label>
                    <label style="color:red;font-size: 20px;" mut>*</label>
                    <div>
                        <input type="text" class="form-control" id="notel" name="notel" type="number" minlength="10" maxlength="11" onkeypress="javascript:return isNumber(event)" onchange="success()" required >
                    </div>
                </div>
              </div>

              <div class="row mb-3">
                <div class="col-lg-6" >
                    <label class=" form-label" for="nama_syarikat" name="nama_syarikat">Nama Syarikat Petender</label>
                    <label style="color:red;font-size: 20px;" mut>*</label>
                    <div>
                      <input type="text" class="form-control" id="name_syarikat" name="name_syarikat" onkeyup="this.value = this.value.toUpperCase();" onchange="success()" required  >
                    </div>
                </div>

                <div class="col-lg-6" >
                    <label class=" form-label" for="nofax" name="nofax">No Faks</label>
                    <label style="color:red;font-size: 20px;" mut>*</label>
                    <div>
                        <input type="text" class="form-control" id="nofax" name="nofax" type="number" minlength="9" maxlength="10" onkeypress="javascript:return isNumber(event)" onchange="success()" required >
                    </div>
                </div>
              </div>

              <div class="row mb-3">
                <div class="col-lg-6">
                  <label class=" form-label" for="nama_pegawai_ditauliah" name="nama_pegawai_ditauliah">Nama Pegawai Syarikat Yang Ditauliahkan<label style="color:red;font-size: 20px;" mut>*</label></label>
                    <div>
                        <input type="text" class="form-control" id="nama_pegawai_ditauliah" name="nama_pegawai_ditauliah" onkeyup="this.value = this.value.toUpperCase();" onchange="success()" required >
                    </div>
                  <br>
                  <label class=" form-label" for="jawatan" name="jawatan">Jawatan</label>
                  <label style="color:red;font-size: 20px;" mut>*</label>
                  <div>
                      <input type="text" class="form-control" id="jawatan" name="jawatan" onkeyup="this.value = this.value.toUpperCase();" onchange="success()" required >
                  </div>
                  <br>
                  <label class="form-label" for="emel" name="emel">E-mel Rasmi</label>
                  <label style="color:red;font-size: 20px;" mut>*</label>
                  <div>
                      <input type="email" class="form-control" id="emel" name="emel" class="col-50" onchange="success()" required >
                  </div>
                </div>
                <div class="col-lg-6" >
                  <label class=" form-label" for="alamat" name="alamat">Alamat Syarikat</label>
                  <label style="color:red;font-size: 20px;" mut>*</label>
                  <div style="margin-top:1%">
                    <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Alamat 1" class="col-50" onkeyup="this.value = this.value.toUpperCase();" onchange="success()" required >
                  </div>
                  <div style="margin-top:1%">
                    <input type="text" class="form-control" id="alamat2" name="alamat2" placeholder="Alamat 2" class="col-50" onkeyup="this.value = this.value.toUpperCase();" onchange="success()"  required>
                  </div>
                  <div style="margin-top:1%">
                    <input type="text" class="form-control" id="alamat3" name="alamat3" placeholder="Alamat 3" class="col-50" onkeyup="this.value = this.value.toUpperCase();" onchange="success()"  >
                  </div>
                  <div style="margin-top:4%">
                    <div>
                    <input type="text" class="form-control" id="bandar" name="bandar" placeholder="Bandar" onkeyup="this.value = this.value.toUpperCase();" onchange="success()" required  >
                    </div>
                  </div>
                  <div style="display: inline-block; margin-top:3%">
                    <input type="text" class="form-control" id="poskod" name="poskod" placeholder="Poskod" type="number" minlength="5" maxlength="5" onkeypress="javascript:return isNumber(event)" onchange="success()" required  >
                  </div>
                  <div style="display: inline-block; margin-top:3%;">
                    <select class="form-select" name="negeri" id="negeri" required>
                      <option value="" >Sila Pilih Negeri</option>
                      <option value="JOHOR" >JOHOR</option>
                      <option value="KEDAH" >KEDAH</option>
                      <option value="KELANTAN" >KELANTAN</option>
                      <option value="KUALA LUMPUR" >KUALA LUMPUR</option>
                      <option value="LABUAN" >LABUAN</option>
                      <option value="MELAKA" >MELAKA</option>
                      <option value="NEGERI SEMBILAN" >NEGERI SEMBILAN</option>
                      <option value="PAHANG" >PAHANG</option>
                      <option value="PULAU PINANG" >PULAU PINANG</option>
                      <option value="PERAK" >PERAK</option>
                      <option value="PERLIS" >PERLIS</option>
                      <option value="PUTRAJAYA" >PUTRAJAYA</option>
                      <option value="SABAH" >SABAH</option>
                      <option value="SARAWAK" >SARAWAK</option>
                      <option value="SELANGOR" >SELANGOR</option>
                      <option value="TERENGGANU" >TERENGGANU</option>
                      <option value="LAIN-LAIN" >LAIN-LAIN</option>
                    </select>
                  </div>
              </div>
                @if(config('boilerplate.access.captcha.hadir_tapak'))
                  <div class="row">
                    <div class="col">
                      @captcha
                      <input type="hidden" class="g-recaptcha" name="captcha_status" value="true" />
                    </div>
                  </div>
                @endif
                <input type="text" id="id" name="id" value="{{$id}}" hidden>
              </div>
            </div>
            <p class="div1">
              <input class="form-check-input" type="checkbox" id="checkbox" name="checkbox" onchange="success()" required>
              <label class="saringanwajib-text" for="rememberMe" style="color: black;"><b>PENGAKUAN:</b> Kami mengaku bahawa semua maklumat dan data yang kami berikan melalui borang ini adalah semuanya benar dan kami telah mengambil maklum dan sedar akan tindakan yang boleh diambil oleh Kerajaan terhadap kami dan/atau tender kami, sekiranya mana-mana maklumat dan data yang kami berikan itu didapati tidak benar dan palsu.</label>
            </p>
            </p>
          </div>
        </div>
        <div class="button-form" style="margin-bottom: 100px;">
          <button class="btn btn-primary" style="border-radius: 12px;" id="hantar" name="hantar" onchange="updateKehadiran()" disabled>HANTAR</button>
        </div>
      </form>
    </section>
  </main><!-- End #main -->
</body>
@stack('before-scripts')
    <script src="{{ mix('js/manifest.js') }}"></script>
    <script src="{{ mix('js/vendor.js') }}"></script>
    <script src="{{ mix('js/backend.js') }}"></script>
    <livewire:scripts />
@stack('after-scripts')

<script src={{ Module::asset('sisdant:js/3_3_1_jquery.min.js') }}></script>

<script type="text/javascript">

  function isNumber(evt){
    var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))
      return false;

    return true;
  }

  $(document).ready(function() {

    var tarikhtutupiklan = @json("$tarikhLawatanTapakMDY");
    var todaydate = @json("$date_now");
    var current = new Date();
    var timenow = current.getHours() + ":" + current.getMinutes();
    var starttime = @json("$waktuLaporHIS");
    var endtime = @json("$endtime1");
    var time1Date = new Date(tarikhtutupiklan + " " + starttime);
    var time2Date = new Date(tarikhtutupiklan + " " + endtime);
    var jenisLawatanTapak = @json("$iklan->lawatan_tapak");
    var today = @json($today);
    var tarikhMula = @json($tarikhMula)+ " " + starttime;
    var tarikhTutup = @json($tarikhTutup)+ " " + "23:59:59";

    if (jenisLawatanTapak != "TIDAK_WAJIB") { // WAJIB | ONLINE
      if (current <= time1Date) {
          Swal.fire({
            text: 'Lawatan tapak/taklimat tender belum bermula.',
            icon: 'error',
            showConfirmButton: false,
            allowOutsideClick: false,
            allowEscapeKey: false
          });
      } else if (current >= time2Date) {
        Swal.fire({
          text: 'Lawatan tapak/taklimat tender telah tamat.',
          icon: 'error',
          showConfirmButton: false,
          allowOutsideClick: false,
          allowEscapeKey: false
        });
      } else {
        Swal.fire({
          title: 'Borang Lawatan Tapak/ Taklimat Tender',
          html: "<br><label class='form-label'>Nombor CIDB Syarikat :</label><br><input type='text' id='no_cidb' onkeyup='this.value = this.value.toUpperCase();' class='form-control'><br>",
          confirmButtonText: 'Semak',
          showLoaderOnConfirm: true,
          allowOutsideClick: false,
          preConfirm: function (login) {
              if (document.getElementById('no_cidb').value) {
                  var no_cidb = document.getElementById('no_cidb').value;
                  var iklanid = document.getElementById("id").value;
                  return new Promise(function (resolve) {
                  $.ajax({
                      url: '/checkmof',
                      type: 'get',
                      dataType: 'json',
                      data:{iklan_id:iklanid, mof:no_cidb},
                  })
                  // in case of successfully understood ajax response
                  .done(function (response) {
                    if(response == "true"){
                      Swal.hideLoading()
                      Swal.showValidationMessage(
                      'Sistem mendapati Nombor CIDB Syarikat telah berdaftar dengan perolehan ini.'
                      )
                    } else {
                      document.getElementById("no_syarikat").value = no_cidb;
                      Swal.close();
                    }
                  })
                  })
              } else {
                  Swal.showValidationMessage('Isi nombor lawatan')
              }
          },
          })
        }
    } else { // TIDAK_WAJIB
      if (today < tarikhMula) {
        Swal.fire({
            text: 'Pengisian Borang Belum Bermula.',
            icon: 'error',
            showConfirmButton: false,
            allowOutsideClick: false,
            allowEscapeKey: false
          });
      } else if (today >= tarikhTutup) {
        Swal.fire({
          text: 'Pengisian Borang Telah Ditutup.',
          icon: 'error',
          showConfirmButton: false,
          allowOutsideClick: false,
          allowEscapeKey: false
        });
      } else {
        Swal.fire({
          title: 'Borang Pendaftaran Kontraktor',
          html: "<br><label class='form-label'>Nombor CIDB Syarikat :</label><br><input type='text' id='no_cidb' onkeyup='this.value = this.value.toUpperCase();' class='form-control'><br>",
          confirmButtonText: 'Semak',
          showLoaderOnConfirm: true,
          allowOutsideClick: false,
          preConfirm: function (login) {
              if (document.getElementById('no_cidb').value) {
                  var no_cidb = document.getElementById('no_cidb').value;
                  var iklanid = document.getElementById("id").value;
                  return new Promise(function (resolve) {
                  $.ajax({
                      url: '/checkmof',
                      type: 'get',
                      dataType: 'json',
                      data:{iklan_id:iklanid, mof:no_cidb},
                  })
                  // in case of successfully understood ajax response
                  .done(function (response) {
                    if(response == "true"){
                      Swal.hideLoading()
                      Swal.showValidationMessage(
                      'Sistem mendapati Nombor CIDB Syarikat telah berdaftar dengan perolehan ini.'
                      )
                    } else {
                      document.getElementById("no_syarikat").value = no_cidb;
                      Swal.close();
                    }
                  })
                  })
              } else {
                  Swal.showValidationMessage('Isi nombor lawatan')
              }
            },
            })
          }
    }
  });
success
  function success() {
    var namasyarikat = document.getElementById("name_syarikat").value;
    var notel = document.getElementById("notel").value;
    var nofax = document.getElementById("nofax").value;
    var namapegawai = document.getElementById("nama_pegawai_ditauliah").value;
    var jawatan = document.getElementById("jawatan").value;
    var emel = document.getElementById("emel").value;
    var alamat = document.getElementById("alamat").value;
    var alamat2 = document.getElementById("alamat2").value;
    var poskod = document.getElementById("poskod").value;
    var negeri = document.getElementById("negeri").value;
    var bandar = document.getElementById("bandar").value;
    var checkbox = document.getElementById("checkbox").value;

    if(namasyarikat && notel && nofax && namapegawai && jawatan && emel && alamat && alamat2 && bandar && poskod && negeri && checkbox) {
      document.getElementById('hantar').disabled = false;

    } else {
      document.getElementById('hantar').disabled = true;
    }
  }

  $( "form" ).submit(function( event ) {
    $("#wait").css("display", "block");
    $("div.spanner").addClass("show");
  });

  
</script>

<style>
  .div1{
    padding: 0px 40px;
    text-align: justify;
  }

  .saringanwajib-text{
    text-align: justify;
  }

  .form-label{
      font-weight:bold;
  }

  .grecaptcha-badge {
      /* right: 0 !important; */
      bottom: 200 !important;
      type: hidden;
  }

  @media only screen and (max-width: 600px) {
    #logo{
        width:25% !important;
    }

    #text-logo{
        font-size: 20px !important;
    }

    #hantar{
        width: 100% !important;
    }
  }

  @media only screen and (max-width: 900px) {

    #hantar{
        width: 100% !important;
    }
  }
<style>

</html>