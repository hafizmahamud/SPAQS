@extends('backend.layouts.app')

@section('title', __('UPKJ'))

@section('content')
    <x-backend.card>
        <x-slot name="header">
            <span style="font-weight: bold;"> @lang('Senarai Kelas UPKJ') </span>
        </x-slot>

        @if ($logged_in_user->hasAllAccess())
            <x-slot name="headerActions">
                <x-utils.link
                    icon="c-icon cil-plus"
                    class="card-header-action"
                    :href="route('admin.auth.upkj.create')"
                    :text="__('Tambah Kelas UPKJ')"
                />
            </x-slot>
        @endif

        <x-slot name="body">
            <livewire:backend.upkj-table />
        </x-slot>
    </x-backend.card>

    <script>
        function padam(id,subKelasUpkj) {
            subUp = "<div style='text-align: left;'>";
            subUpkj = JSON.parse(subKelasUpkj);
            for (var i = 0; i < subUpkj.length; i++) {
                if (i == 0)
                {
                    subUp = subUp + '<span id="dots"></span><span id="more" style="display: none;"><table>';
                }
                subUp = subUp + '<tr><td style="vertical-align:top">' + (i + 1) + '.</td><td style="padding-left: 5px;">' + subUpkj[i]['tajuk_kecil'] + ' - ' + subUpkj[i]['tajuk_kecil'] + '</td></tr>';
                if (i == (subUpkj.length - 1))
                {
                    subUp = subUp + '</table></span>';
                }
            }
            subUp = subUp + '<br><a onclick="myFunction()" id="myBtn" style="color: blue; cursor: pointer;">Lihat Sub Bidang</a>';
            subUp = subUp + "</div>"
            Swal.fire({
                title: 'Adakah anda pasti untuk padam Kelas Upkj ini bersama Sub Kelas Upkj?',
                showCancelButton: true,
                confirmButtonText: 'Ya',
                cancelButtonText: 'Tidak',
                reverseButtons: true,
                html: subUp,
                icon: 'warning'
            }).then((result) => {
                if (result.value) {
                    window.location.href="/admin/auth/upkj/delete/" + id;
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
            btnText.innerHTML = "Lihat Sub Kelas Upkj"; 
            moreText.style.display = "none";
          } else {
            dots.style.display = "none";
            btnText.innerHTML = "Tutup Sub Kelas Upkj"; 
            moreText.style.display = "inline";
          }
        }
    </script>
@endsection
