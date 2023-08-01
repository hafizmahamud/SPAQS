@extends('backend.layouts.app')

@section('title', __('Kelas Pukonsa'))

@section('content')
    <x-backend.card>
        <x-slot name="header">
            <span style="font-weight: bold;"> @lang('Senarai Kelas Pukonsa') </span>
        </x-slot>

        @if ($logged_in_user->hasAllAccess())
            <x-slot name="headerActions">
                <x-utils.link
                    icon="c-icon cil-plus"
                    class="card-header-action"
                    :href="route('admin.auth.pukonsa.create')"
                    :text="__('Tambah Kelas Pukonsa')"
                />
            </x-slot>
        @endif

        <x-slot name="body">
            <livewire:backend.pukonsa-table />
        </x-slot>
    </x-backend.card>

    <script>
        function padam(id,subPukonsa) {
            subPukon = "<div style='text-align: left;'>";
            subPukonsa = JSON.parse(subPukonsa);
            for (var i = 0; i < subPukonsa.length; i++) {
                if (i == 0)
                {
                    subPukon = subPukon + '<span id="dots"></span><span id="more" style="display: none;"><table>';
                }
                subPukon = subPukon + '<tr><td style="vertical-align:top">' + (i + 1) + '.</td><td style="padding-left: 5px;">' + subPukonsa[i]['keterangan'] + '</td></tr>';
                if (i == (subPukonsa.length - 1))
                {
                    subPukon = subPukon + '</table></span>';
                }
            }
            subPukon = subPukon + '<br><a onclick="myFunction()" id="myBtn" style="color: blue; cursor: pointer;">Lihat Sub Kelas Pukonsa</a>';
            subPukon = subPukon + "</div>"
            Swal.fire({
                title: 'Adakah anda pasti untuk padam Kelas Pukonsa ini bersama Sub Kelas Pukonsa?',
                showCancelButton: true,
                confirmButtonText: 'Ya',
                cancelButtonText: 'Tidak',
                reverseButtons: true,
                html: subPukon,
                icon: 'warning'
            }).then((result) => {
                if (result.value) {
                    window.location.href="/admin/auth/pukonsa/delete/" + id;
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
            btnText.innerHTML = "Lihat Sub Bidang"; 
            moreText.style.display = "none";
          } else {
            dots.style.display = "none";
            btnText.innerHTML = "Tutup Sub Bidang"; 
            moreText.style.display = "inline";
          }
        }
    </script>
@endsection
