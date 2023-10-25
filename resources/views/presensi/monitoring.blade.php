@extends('dashboard.tabler')
@section('content')
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <h2 class="page-title">
                Monitoring Presensi
                </h2>
            </div>
        </div>
    </div>
</div>
<div class="page-body">
    <div class="container-xl">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <input type='text' class="form-control" id="tanggal" name="tanggal" autocomplete="off" placeholder="Select Tanggal" value="{{ date("Y-m-d") }}" >
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <table class="table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nik</th>
                                            <th>Nama</th>
                                            <th>Jabatan</th>
                                            <th>No Hp</th>
                                            <th>Jam Masuk</th>
                                            <th>Jam Keluar</th>
                                            <th>Foto In</th>
                                            <th>Foto Keluar</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody id='loadpresensi'>
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>         
</div>
@endsection
@push('myscript')
<script>
    $(function () {
        $("#tanggal").datepicker({ 
            autoclose: true, 
            todayHighlight: true,
            format: 'yyyy-mm-dd'
        });

        function loadpresensi(){
            var tanggal = $('#tanggal').val();
            $.ajax({
                type:'POST',
                url:'/getpresensi',
                data:{
                    _token:'{{ csrf_token() }}',
                    tanggal:tanggal
                },
                cache:false,
                success:function(respond){
                    $('#loadpresensi').html(respond);
                }
            });
        }
        $("#tanggal").change(function(e){
            loadpresensi();
        });

        loadpresensi();
    });
</script>    
@endpush