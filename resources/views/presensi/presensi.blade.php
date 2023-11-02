@extends('layouts.presensi')
@section('head')
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>History Karyawan</title>
    <link rel="icon" href="logo.png" type="image/x-icon" />
    <link rel="stylesheet" href= {{ asset("assets/css/login_history.css") }} />
    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- Include Bootstrap Datepicker CSS and JS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
     <!-- Include Moment.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment-with-locales.min.js"></script>
@endsection
@section('header')
 <!-- App Header -->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
        <header class="app-header">
            <a href='/dashboard' class='headerButton goBack'>
                <svg height="32px" id="Layer_1" style="enable-background:new 0 0 32 32" version="1.1" viewBox="0 0 32 32" width="32px" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                    <path
                        d="M28,14H8.8l4.62-4.62C13.814,8.986,14,8.516,14,8c0-0.984-0.813-2-2-2c-0.531,0-0.994,0.193-1.38,0.58l-7.958,7.958  C2.334,14.866,2,15.271,2,16s0.279,1.08,0.646,1.447l7.974,7.973C11.006,25.807,11.469,26,12,26c1.188,0,2-1.016,2-2  c0-0.516-0.186-0.986-0.58-1.38L8.8,18H28c1.104,0,2-0.896,2-2S29.104,14,28,14z"
                        fill="#ffffff"/>
                    </svg>
            </a>
            <h1 class="header-title">Presensi</h1>
        </header>
<!-- * App Header -->
<style>
.webcam-capture,
.webcam-capture video {
    width: 55% !important;
    height: auto !important;
    border-radius: 15px;
    margin-bottom: 15px;
}

/* Tambahkan kode berikut untuk menengahkan video */
.webcam-capture {
    display: flex;
    justify-content: center;
    align-items: center;
    max-width: 100%; /* Tambahkan lebar maksimum */
    margin: 0 auto; /* Tambahkan margin auto untuk mengatur elemen di tengah */
}



    #map { height: 290px; }
    @media (max-width: 767px) {
        .webcam-capture,
        .webcam-capture video {
            width: 100% !important; /* Ubah lebar video menjadi 100% pada layar kecil */
        }

        #map {
            height: 380px;
            border-radius: 15px; /* Sesuaikan tinggi peta untuk tampilan pada layar kecil */
        }
    }
</style>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
crossorigin=""/> 
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
     integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
     crossorigin=""></script>
@endsection
@section('content')
<div class='row' style='margin-top: 70px'>
    <div class="col">
        <input type='hide' id='lokasi' style="display: none;"> 
        <div class='webcam-capture'></div> 
    </div>
</div>
<div class='row'>
    <div class='col'> 
        @if ($data > 0)
            <button id='absen' class='btn btn-danger btn-block w-100'>Absen Pulang</button>
        @else
            <button id='absen' class='btn btn-primary btn-block w-100'>Absen Masuk</button>
        @endif
    </div>
</div>
<div class="row mt-2">
    <div class="col">
        <div id="map"></div>
    </div>
</div>
@endsection

@push('myscript')
<script>
    Webcam.set({
        height:480,
        width:640,
        image_format:'jpeg',
        jpeg_quality:80
    });

    Webcam.attach('.webcam-capture');

    var lokasi = document.getElementById('lokasi');
    if(navigator.geolocation){
        navigator.geolocation.getCurrentPosition(successCallback, errorCallback);
    }

    function successCallback(position){
        lokasi.value = position.coords.latitude + ',' + position.coords.longitude;  
        var map = L.map('map').setView([position.coords.latitude, position.coords.longitude], 13);
        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);

        var marker = L.marker([position.coords.latitude, position.coords.longitude]).addTo(map);

        var circle = L.circle([-5.396866794639903, 105.27792672028814], {
            color: 'red',
            fillColor: '#f03',
            fillOpacity: 0.5,
            radius: 20
        }).addTo(map);
    }

    function errorCallback(){

    }

    $('#absen').click(function(e) {
        Webcam.snap(function(uri){
            image = uri;
        });
        var lokasi = $('#lokasi').val();
        $.ajax({
            type:'POST',
            url:'/presensi/store',
            data:{
                _token:'{{ csrf_token() }}',
                image:image,
                lokasi:lokasi
            },
            cache:false,
            success:function(respond){
                var status = respond.split('|');
                if(status[0] == 'Success'){
                    alert(status[1]);
                    setTimeout("location.href='/dashboard'", 2000);
                } else if (status == 'Error'){
                    alert(status[1]);
                }else {
                    alert(status[1]);
                }
            }
        });
    });
</script>
@endpush
