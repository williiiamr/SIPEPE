@extends('dashboard.tabler')
@section('content')
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <h2 class="page-title">
                Laporan Presensi
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
                        <form action="/presensi/cetak" target='_blank' method="POST">
                            @csrf
                            <div class="row mt-2">
                                <div class="col-12">
                                    <div class="form-group">
                                        <select name='bulan' id='bulan' class='form-select'>
                                                @for ($i=1; $i<=12; $i++)
                                                    <option value="{{ $i }}" {{ date('m')==$i ? 'selected' : '' }}>{{ $namabulan[$i] }}</option>
                                                @endfor
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-12">
                                    <div class="form-group">
                                        <select name='tahun' id='tahun' class='form-select'>
                                            @for ($tahun = 2022; $tahun<=date('Y'); $tahun++)
                                                <option value='{{ $tahun }}' {{ date('Y')==$tahun ? 'selected' : '' }}>{{ $tahun }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-12">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary" name="cetak">Cetak</button>
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