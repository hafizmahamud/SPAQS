@extends('backend.layouts.app')

@section('title', __('Senarai Pejabat JPS'))

@section('content')
    <x-backend.card>
        <x-slot name="header">
            <span style="font-weight: bold;"> @lang('Senarai Pejabat JPS') </span>
        </x-slot>

        @if ($logged_in_user->hasAllAccess())
            <x-slot name="headerActions">
                <x-utils.link
                    icon="c-icon cil-plus"
                    class="card-header-action"
                    :href="route('admin.auth.negeri.create')"
                    :text="__('Tambah Pejabat JPS')"
                />
            </x-slot>
        @endif

        <x-slot name="body">
            <livewire:backend.negeri-table />
        </x-slot>
    </x-backend.card>
    <script>
        function padam(id,bahagian) {
            bahagian2 = "<div style='text-align: left;'>";
            Bahagian2 = JSON.parse(bahagian);
            
            for (var i = 0; i < Bahagian2.length; i++) {
                //console.log(bahagian2[i]['bahagian']);
                if (i == 0)
                {
                    bahagian2 = bahagian2 + '<span id="dots"></span><span id="more" style="display: none;">';
                }
                bahagian2 = bahagian2 + '<br>' + (i + 1) + '. ' + Bahagian2[i]['bahagian'];
                    if (i == (Bahagian2.length - 1))
                    {
                        bahagian2 = bahagian2 + '</span>';
                    }
                }
                bahagian2 = bahagian2 + '<br><a onclick="myFunction()" id="myBtn" style="color: blue;cursor:pointer;align:center;">Lihat Bahagian</a>';
                bahagian2 = bahagian2 + "</div>"

            Swal.fire({
                title: 'Adakah anda pasti untuk padam Pejabat JPS ini berserta Bahagian ?',
                html: bahagian2,
                showCancelButton: true,
                confirmButtonText: 'Ya',
                cancelButtonText: 'Tidak',
                reverseButtons: true,
                icon: 'warning'
            }).then((result) => {
                if (result.value) {
                    window.location.href="/admin/auth/negeri/delete/" + id;
                }
            });
        }
    </script>
    <script>

function myFunction() {

  var dots = document.getElementById("dots");
  var moreText = document.getElementById("more");
  var btnText = document.getElementById("myBtn");

  if (dots.style.display === "none") {
    dots.style.display = "inline";
    btnText.innerHTML = "Lihat Bahagian";
    moreText.style.display = "none";
  } else {
    dots.style.display = "none";
    btnText.innerHTML = "Tutup Bahagian";
    moreText.style.display = "inline";
  }
}

</script>
@endsection
