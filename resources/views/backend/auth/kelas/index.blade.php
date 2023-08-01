@extends('backend.layouts.app')

@section('title', __('Senarai Kategori'))

@section('content')
    <x-backend.card>
        <x-slot name="header">
            <span style="font-weight: bold;"> @lang('Senarai Kategori') </span>
        </x-slot>

        @if ($logged_in_user->hasAllAccess())
            <x-slot name="headerActions">
                <x-utils.link
                    icon="c-icon cil-plus"
                    class="card-header-action"
                    :href="route('admin.auth.kelas.create')"
                    :text="__('Tambah Kategori')"
                />
            </x-slot>
        @endif

        <x-slot name="body">
            <livewire:backend.kelas-table />
        </x-slot>
    </x-backend.card>

    <script>
        function padam(id, pengkhususan) {
            pengkhus = "<div style='text-align: left;'>";
            pengkhusus = JSON.parse(pengkhususan);
            for (var i = 0; i < pengkhusus.length; i++) {
                if (i == 0)
                {
                    pengkhus = pengkhus + '<span id="dots"></span><span id="more" style="display: none;"><table>';
                }
                pengkhus = pengkhus + '<tr><td style="padding-right: 5px; vertical-align:top;">' + (i + 1) + '.</td><td>' + pengkhusus[i]['pengkhususan'] + '</td></tr>';
                if (i == (pengkhusus.length - 1))
                {
                    pengkhus = pengkhus + '</table></span>';
                }
            }
            pengkhus = pengkhus + '<br><a onclick="myFunction()" id="myBtn" style="color: blue; cursor: pointer;">Lihat Pengkhususan</a>';
            pengkhus = pengkhus + "</div>"
            Swal.fire({
                title: 'Adakah anda pasti untuk padam Kategori ini bersama Pengkhususan?',
                showCancelButton: true,
                confirmButtonText: 'Ya',
                cancelButtonText: 'Tidak',
                reverseButtons: true,
                html: pengkhus,
                icon: 'warning'
            }).then((result) => {
                if (result.value) {
                    window.location.href="/admin/auth/kelas/delete/" + id;
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
            btnText.innerHTML = "Lihat Pengkhususan";
            moreText.style.display = "none";
          } else {
            dots.style.display = "none";
            btnText.innerHTML = "Tutup Pengkhususan";
            moreText.style.display = "inline";
          }
        }
    </script>
@endsection
