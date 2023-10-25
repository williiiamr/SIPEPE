@extends('dashboard.tabler')
@section('content') 
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <h2 class="page-title">
                Setting Konfigurasi
                </h2>
            </div>
        </div>
    </div>
</div>
<div class="page-body">
    <div class="container-xl">
        <div class="row">
            <div class="col-6">
                <div class="card">
                    <div class="card-body">
                        <form action="/settings/update" method="POST">
                            @csrf
                            <h3 class="page-title mb-1">
                                Pilih Lokasi
                            </h3>
                            <div class="row mt-2">
                                <div class="col-12">
                                    <div class="form-group">
                                        <input type='text' class="form-control" id="latitude" name="latitude" autocomplete="off" placeholder="Masukan Latidude" value="{{ $datagps->latitude }}" >
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-12">
                                    <div class="form-group">
                                        <input type='text' class="form-control" id="longitude" name="longitude" autocomplete="off" placeholder="Masukan Longitude" value="{{ $datagps->longitude }}" >
                                    </div>
                                </div>
                            </div>
                            <h3 class="page-title mt-5 mb-1">
                                Pilih Jam
                            </h3>
                            <div class="row mt-2">
                                <div class="col-12">
                                    <div class="form-group">
                                        <input type='text' class="form-control" id="jam_masuk" name="jam_masuk" autocomplete="off" placeholder="Masukan Jam Masuk" value="{{ $datagps->jam_masuk }}" >
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-12">
                                    <div class="form-group">
                                        <input type='text' class="form-control" id="jam_keluar" name="jam_keluar" autocomplete="off" placeholder="Masukan Keluar" value="{{ $datagps->jam_keluar }}" >
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-12">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary" name="cetak">submit</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection