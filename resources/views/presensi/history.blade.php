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
            <?xml version="1.0" ?><!DOCTYPE svg PUBLIC '-//W3C//DTD SVG 1.1//EN' 'http://www.w3.org/Graphics/SVG/1.1/DTD/svg11.dtd'>
          <h1 class="header-title">History</h1>
        </header>
@endsection
@section('content')
    <div class='row' style='margin-top:70px'>
        <div class='col'>
            <div class='row'>
                <div class="col-12">
                    <div class='form-group caridata-history mb-2'>
                        <select name='bulan' id='bulan' class="form-control">
                            <option value=''>Bulan</option>
                            @for ($i=1; $i<=12; $i++)
                                <option value="{{ $i }}" {{ date('m')==$i ? 'selected' : '' }}>{{ $namabulan[$i] }}</option>
                            @endfor
                        </select>
                    </div>
                </div>
            </div>
            <div class='row'>
                <div class="col-12">
                    <div class='form-group caridata-history'>
                        <select name='tahun' id='tahun' class="form-control">
                            <option value=''>Tahun</option>
                            @for ($tahun = 2022; $tahun<=date('Y'); $tahun++)
                                <option value='{{ $tahun }}' {{ date('Y')==$tahun ? 'selected' : '' }}>{{ $tahun }}</option>
                            @endfor
                        </select>
                    </div>
                </div>
            </div>
            <br>
            <div class='row'>
                <div class="col-12">
                    <div class='form-group caridata-history' >
                        <button class='btn btn-block text-light w-100'  style="background-color: #5236FF;" id='getdata'>Cari Data</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col" id='showhistory'>
            
        </div>
    </div>
   
    @push('myscript')
        <script>
            $(function(){
                $('#getdata').click(function(e){
                    var bulan = $('#bulan').val();
                    var tahun = $('#tahun').val();
                    $.ajax({
                        type: 'POST',
                        url: '/gethistori',
                        data: {
                            _token: '{{ csrf_token() }}',
                            bulan: bulan,
                            tahun: tahun
                        },
                        cache: false,
                        success: function(respond){
                            $("#showhistory").html(respond);
                        }
                    });
                });
            });
        </script>
    @endpush
@endsection