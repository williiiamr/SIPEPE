@extends('layouts/presensi')
@section('head')
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Formulir Cuti Karyawan</title>
    <link rel="icon" href="logo.png" type="image/x-icon" />
    <link rel="stylesheet" href= {{ asset("assets/css/login_history.css") }} />
    <link rel="stylesheet" href= {{ asset("assets/css/form-cuti.css") }} />
    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <!-- Include Bootstrap Datepicker CSS and JS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/css/materialize.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
     <!-- Include Moment.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment-with-locales.min.js"></script>
@endsection
@section('header')
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
        <header class="app-header">
            <a href='/presensi/izin' class='headerButton goBack'>
                <svg height="32px" id="Layer_1" style="enable-background:new 0 0 32 32" version="1.1" viewBox="0 0 32 32" width="32px" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                    <path
                        d="M28,14H8.8l4.62-4.62C13.814,8.986,14,8.516,14,8c0-0.984-0.813-2-2-2c-0.531,0-0.994,0.193-1.38,0.58l-7.958,7.958  C2.334,14.866,2,15.271,2,16s0.279,1.08,0.646,1.447l7.974,7.973C11.006,25.807,11.469,26,12,26c1.188,0,2-1.016,2-2  c0-0.516-0.186-0.986-0.58-1.38L8.8,18H28c1.104,0,2-0.896,2-2S29.104,14,28,14z"
                        fill="#ffffff"/>
                </svg>
            </a>
            <?xml version="1.0" ?><!DOCTYPE svg PUBLIC '-//W3C//DTD SVG 1.1//EN' 'http://www.w3.org/Graphics/SVG/1.1/DTD/svg11.dtd'>
          <h1 class="header-title">Formulir Cuti</h1>
        </header>
@endsection
@section('content')
<div class="form-cont bg-white rounded-2 shadow p-4 overflow-hidden">
      <p class="fw-bold sub-form">Form Pengajuan Cuti</p>
      <form method="POST" action="/presensi/storeizin" id="frmIzin">
        @csrf
        <div class="row g-3">
          <div class="col-md-3 col-5 position-relative">
            <label for="tgl_izin" class="form-label">Tanggal</label>
            <input type="text" id="tgl_izin" name="tgl_izin" class="form-control form-control-sm datepicker" placeholder="Tanggal">
            <!-- <input type="date" id="tgl_izin" name="tgl_izin" class="form-control form-control-sm" /> -->
          </div>
          <div class="col-md-3 col-5 ms-2">
            <div class="form-group">
              <label for="status" class="form-label ms-1">Keterangan</label>
              <select name="status" id="status" class="form-select form-select-sm select-style">
                <option value="">Izin / Sakit</option>
                <option value="i">Izin</option>
                <option value="s">Sakit</option>
              </select>
            </div>
          </div>
        </div>
        <div class="row mt-3">
          <div class="col">
            <label for="keterangan">Alasan</label>
            <textarea name="keterangan" id="keterangan" class="form-control" placeholder="Alasan..."></textarea>
          </div>
        </div>
        <div class="d-flex justify-content-end mt-5">
          <button class="rounded-2" type="submit">Simpan</button>
        </div>
      </form>
    </div>
@endsection
@push('myscript')
<script>
    var currYear = (new Date()).getFullYear();

    $(document).ready(function() {
      $(".datepicker").datepicker({
        format: "yyyy-mm-dd"    
      });

      $("#tgl_izin").change(function(e){
        var tgl_izin = $(this).val();
        $.ajax({
            type: 'POST'
            , url: '/presensi/cekpengajuanizin'
            , data: {
                _token: "{{ csrf_token() }}"
                , tgl_izin: tgl_izin
            }
            , cache: false
            , success: function(respond){
                if(respond == 1){
                    alert('Anda sudah melakukan input pengajuan izin pada tanggal tersebut !');
                    $("#tgl_izin").val("");
                }
            }
        });
      });

      $("#frmIzin").submit(function() {
        var tgl_izin = $("#tgl_izin").val();
        var status = $("#status").val();
        var keterangan = $("#keterangan").val();
        if (tgl_izin == "") {
            alert('Tanggal harus diisi');
            return false;
        } else if (status == "") {
            alert('Status harus diisi');
            return false;
        } else if (keterangan == "") {
            alert('Keterangan harus diisi');
            return false;
        }
      });
    });
</script>
@endpush