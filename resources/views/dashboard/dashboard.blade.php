@extends('layouts.presensi')
@section('head')
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <link rel="stylesheet" href= {{ asset("assets/css/style-dashboard.css") }} />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
@endsection

@section('content')
<div class="background rounded-bottom-5 position-absolute shadow"></div>
<div class="container-xl position-relative gx-0">
  <div class="header d-flex justify-content-between py-2">
    <img width="100" height="100" class="img-fluid" src="{{ asset("assets/img/logo.png") }}" alt="" />
    <div class="d-flex align-items-center mx-3">
      <img class="mx-2 img-fluid" width="40" height="40" src="{{ asset("assets/img/profil.png") }}" alt="" /> 
      <div class="dropdown">
        <button onclick="myFunction()" class="dropbtn">{{ Auth::guard('karyawan')->user()->nama }} <i class="fa fa-caret-down"></i></button>
        <div id="myDropdown" class="dropdown-content">
          <a href="/proseslogout" onclick="showSuccess()">Log Out</a>
        </div>
      </div>
    </div>
  </div>
  <div class="appeal bg-white rounded-5 shadow">
    <div class="text-center fw-bolder h-25 pt-3 appeal-title">PASTIKAN</div>
    <div class="w-100 d-flex justify-content-center align-items-center h-75">
      <div class="text-center mx-3 d-flex flex-column justify-content-center align-items-center reminder">
        <img width="35" height="35" src="{{ asset("assets/img/solar_gps-bold.png") }}" alt="" />
        <div class="fw-medium">GPS Menyala dan berfungsi dengan baik</div>
      </div>
      <div class="text-center mx-3 d-flex flex-column justify-content-center align-items-center reminder">
        <img width="35" height="35" src="{{ asset("assets/img/ion_glasses.png") }}" alt="" />
        <div class="fw-medium">Lepas topi, kacamata hitam, ataupun masker</div>
      </div>
      <div class="text-center mx-3 d-flex flex-column justify-content-center align-items-center reminder">
        <img width="35" height="35" src="{{ asset("assets/img/solar_gps-bold-2.png") }}" alt="" />
        <div class="fw-medium">Gunakan lokasi kerja sebagai latar belakang</div>
      </div>
    </div>
  </div>
  <div class="mt-4 w-100 status-container d-flex justify-content-between gx-0">
    <div class="status bg-danger rounded-4 d-flex flex-column justify-content-center shadow">
      <div class="small-font fw-bolder ms-3 text-white">Absen Masuk</div>
      <div class="medium-font fw-bolder ms-3 text-white"><span>{{ $presensihariini != null ? $presensihariini->jam_in : 'Anda Belum Absen' }}</span></div>
    </div>
    <div class="status bg-danger rounded-4 d-flex flex-column justify-content-center shadow">
      <div class="small-font fw-bolder ms-3 text-white">Absen Pulang</div>
      <div class="medium-font fw-bolder ms-3 text-white">{{ $presensihariini != null ? $presensihariini->jam_out : 'Anda Belum Absen' }}</div>
    </div>
  </div>
  <div class="small-font fw-bolder my-4">
    <p class="subtitle">Absensi Bulan <span class="purple">Maret</span></p>
  </div>
  <div class="row gx-0 info-row mb-5">
    <div class="col-6 col-md-3 info-container">
      <div class="h-100 bg-white information rounded-4 shadow px-md-4 px-3 d-flex justify-content-start align-items-center">
        <img width="30" height="30" src="{{ asset("assets/img/mingcute_exit-door-line.png") }}" alt="" />
        <div class="ms-2 d-flex flex-column justify-content-center align-items-start">
          <div class="fs-6 fw-bold">Hadir</div>
          <div class="test fw-bold days">{{ $rekap->jmlhadir }} Hari</div>
        </div>
      </div>
    </div>
    <div class="col-6 col-md-3 info-container d-flex justify-content-end justify-content-md-start">
      <div class="h-100 bg-white information rounded-4 shadow px-md-4 px-3 d-flex justify-content-start align-items-center">
        <img width="30" height="30" src="{{ asset("assets/img/iconamoon_profile-fill.png") }}" alt="" />
        <div class="ms-2 d-flex flex-column justify-content-center align-items-start">
          <div class="fs-6 fw-bold">Izin</div>
          <div class="test fw-bold days">0 Hari</div>
        </div>
      </div>
    </div>
    <div class="col-6 col-md-3 info-container mt-md-0 mt-3 d-flex justify-content-md-end justify-content-start">
      <div class="h-100 bg-white information rounded-4 shadow px-md-4 px-3 d-flex justify-content-start align-items-center">
        <img width="30" height="30" src="{{ asset("assets/img/clarity_sad-face-solid.png") }}" alt="" />
        <div class="ms-2 d-flex flex-column justify-content-center align-items-start">
          <div class="fs-6 fw-bold">Sakit</div>
          <div class="test fw-bold days">0 Hari</div>
        </div>
      </div>
    </div>
    <div class="col-6 col-md-3 info-container mt-md-0 mt-3 d-flex justify-content-end">
      <div class="h-100 bg-white information rounded-4 shadow px-md-4 px-3 d-flex justify-content-start align-items-center">
        <img width="30" height="30" src="{{ asset("assets/img/mdi_clock-outline.png") }}" alt="" />
        <div class="ms-2 d-flex flex-column justify-content-center align-items-start">
          <div class="fs-6 fw-bold">Terlambat</div>
          <div class="test fw-bold days">{{ $rekap->jmlterlambat }} Hari</div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@push('myscript')
<script>
  function myFunction() {
    document.getElementById("myDropdown").classList.toggle("show");
  }

  window.onclick = function (event) {
    if (!event.target.matches(".dropbtn")) {
      var dropdowns = document.getElementsByClassName("dropdown-content");
      var i;
      for (i = 0; i < dropdowns.length; i++) {
        var openDropdown = dropdowns[i];
        if (openDropdown.classList.contains("show")) {
          openDropdown.classList.remove("show");
        }
      }
    }
  };
</script>
@endpush