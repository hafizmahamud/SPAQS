<!DOCTYPE HTML>
@extends('tunas::layouts.masterIklan')

<div style="background-color:white; padding:5px;">
    <img id="logo" src="/img/Logo_JPS.png" alt="" style="display:block; margin-left:auto; margin-right:auto; width:10%;"><br>
    <p id="text-logo" style=" text-align:center; font-size:30px; ">JABATAN PENGAIRAN DAN SALIRAN MALAYSIA
    </p>
</div>
<body>
    <main id="main-template" class="main-template" >
        <section class="section">
            <div style="display: flex;">
                <h5 class="card-title">Senarai Iklan Dibuka</h5>
            </div>

            <div class="card">
                <div class="card-body">
                    <br>
                    <br>
                    <livewire:frontend.senarai-iklan-buka-table />
                    <br>
                    <br>
                </div>
            </div>
        </section>
    </main>
</body>

<script>
    function view(id) {
        window.location.href="/tunas/viewiklan-public/" + id;
    }
  </script>



