@extends('layouts.presensi')
@section('content')

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@500&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,600;1,400&display=swap" rel="stylesheet">
<script src = "./assets/js/main.js" defer></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src = "./assets/js/sweetalert.js" defer></script>

<!-- Image and text -->
<nav class="navbar navbar-light" style="background-color: white;">
    <a class="navbar-brand" href="#">
        <img src="assets/img/sample/photo/digitalforte.png" width="auto" height="40px" alt="">
    </a>
    <a>
        <div class="avatar1">
            <div class="nama">
                @if(!empty(Auth::guard('karyawan')->user()->foto))
                @php
                $path = Storage::url('public/uploads/karyawan/'.Auth::guard('karyawan')->user()->foto);
                @endphp
                    <img src="{{ url($path) }}" alt="avatar" class="imaged w32 rounded">
                @else
                    <img src="assets/img/sample/avatar/avatar1.jpg" alt="avatar" class="imaged w32 rounded">
                @endif
                <div class="dropdown">
                    <button>
                        {{ Auth::guard('karyawan')->user()->nama }}
                    </button>
                    <div class="arrow-down">
                    </div>
                    <div class="dropdown-content">
                        <a href="/editprofile">Edit Profile</a>  
                        <a href="/proseslogout" onclick="showSuccess()">Log out</a>
                    </div>
                </div>
            </div>
        </div>
    </a>
    
</nav>

<div class="center-element mt-5">
    <div class="header-ucapan">
        Hello, {{ Auth::guard('karyawan')->user()->nama }} !
    </div>
    <div class="header-deskripsi">
        Temukan Semangat
    </div>
    <div class="header-deskripsi1">
        Dalam Setiap Langkahs Karirmu!
    </div>


</div>

<div class="datetime">
    <div class="time"></div>
    <div class="date"></div>
</div>



<div class="rectangle-dashboard">
    <div class="center-element">
    <div class="card-rectangle1 mt-5 bg-success">
        <div class="teks-presensi">
                Masuk :
            <div class="info-presensi">
             <span>{{ $presensihariini != null ? $presensihariini->jam_in : 'Anda Belum Absen' }}</span>
            </div>
        </div>
    </div>
    <div class="card-rectangle2 mt-5 bg-danger">
        <div class="teks-presensi">
                Keluar :
            <div class="info-presensi">
             <span>{{ $presensihariini != null ? $presensihariini->jam_out : 'Anda Belum Absen' }}</span>
            </div>
        </div>
    </div>
    
    </div>
    <div class="center-element">
    <div class="rectangle-guide">
        <div class="isi-guide">
            Pastikan:
        </div>
        <div class="container text-center">
        <div class="row flex-wrap">
    <div class="col mt-2">
        <img src="assets/img/sample/photo/gps-bold.png" alt="image-gps" class="img-fluid">
        <div class="deskripsi-guide">
            GPS Menyala dan berfungsi dengan basik
        </div>
    </div>
    <div class="col mt-2">
        <img src="assets/img/sample/photo/ion_glasses.png" alt="image-gps" class="img-fluid">
        <div class="deskripsi-guide">
            Lepas topi, kacamata hitam, ataupun masker
        </div>
    </div>
    <div class="col mt-2">
        <img src="assets/img/sample/photo/solar-gps.png" alt="image-gps" class="img-fluid">
        <div class="deskripsi-guide">
            Gunakan lokasi kerja sebagai latar belakang
        </div>
    </div>
</div>

</div>
    </div>
    </div>
    <br>
    <div class="center-element">
        <div class="card-grid">
            <div class="card" style="border-radius: 20px;">
                <h2 class="card-title">Hadir</h2>
                <div class="gambar-presensi">
                <img src="assets/img/sample/photo/uil_entry.png" width="65px">
                </div>
                <p class="card-description">{{ $rekap->jmlhadir }} Hari</p>
            </div>
            <div class="card" style="border-radius: 20px;">
                <h2 class="card-title">Telat</h2>
                <div class="gambar-presensi">
                <img src="assets/img/sample/photo/bell-ringing.png" width="65px">
                </div>
                <p class="card-description">{{ $rekap->jmlterlambat }} Hari</p>
            </div>
        </div>
    </div>
</div>



@endsection('content')