@extends('backend.layouts.app')

@section('title', __('Kod Bidang'))

@section('content')
    <x-backend.card>
        <x-slot name="header">
            <span style="font-weight: bold;"> @lang('Senarai Kod Bidang') </span>
        </x-slot>

        @if ($logged_in_user->hasAllAccess())
            <x-slot name="headerActions">
                <x-utils.link
                    icon="c-icon cil-plus"
                    class="card-header-action"
                    :href="route('admin.auth.bidang.create')"
                    :text="__('Tambah Kod Bidang')"
                />
            </x-slot>
        @endif

        <x-slot name="body">
            <livewire:backend.bidang-table />
        </x-slot>
    </x-backend.card>

    <script>
        function padam(id,subBidang) {
            subBid = "<div style='text-align: left;'>";
            subBidang = JSON.parse(subBidang);
            for (var i = 0; i < subBidang.length; i++) {
                if (i == 0)
                {
                    subBid = subBid + '<span id="dots"></span><span id="more" style="display: none;"><table>';
                }
                subBid = subBid + '<tr><td style="vertical-align:top">' + (i + 1) + '.</td><td style="padding-left: 5px;">' + subBidang[i]['sub_bidang'] + '</td></tr>';
                if (i == (subBidang.length - 1))
                {
                    subBid = subBid + '</table></span>';
                }
            }
            subBid = subBid + '<br><a onclick="myFunction()" id="myBtn" style="color: blue; cursor: pointer;">Lihat Sub Bidang</a>';
            subBid = subBid + "</div>"
            Swal.fire({
                title: 'Adakah anda pasti untuk padam Kod Bidang ini bersama Sub Bidang?',
                showCancelButton: true,
                confirmButtonText: 'Ya',
                cancelButtonText: 'Tidak',
                reverseButtons: true,
                html: subBid,
                icon: 'warning'
            }).then((result) => {
                if (result.value) {
                    window.location.href="/admin/auth/bidang/delete/" + id;
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
