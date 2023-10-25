@extends('dashboard.tabler')
@section('content')
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <!-- Page pre-title -->
                <div class="page-pretitle">
                Karyawan
                </div>
                <h2 class="page-title">
                Data Karyawan
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
                                <a href='#' class='btn btn-primary' id='btntambah'>Tambah Data</a>
                            </div>
                        </div>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nik</th>
                                    <th>Nama</th>
                                    <th>Jabatan</th>
                                    <th>No Hp</th>
                                    <th>Foto</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($karyawan as $d )
                                @php
                                    $path = Storage::url('uploads/karyawan/' . $d->foto);
                                @endphp
                                    <tr>
                                        <td>{{ $loop->iteration + $karyawan->firstItem() - 1 }}</td>
                                        <td>{{ $d->nik }}</td>
                                        <td>{{ $d->nama }}</td>
                                        <td>{{ $d->jabatan }}</td>
                                        <td>{{ $d->no_hp }}</td>
                                        @if (empty($d->foto))
                                            <td><img src="{{ asset('assets/img/sample/avatar/avatar1.jpg') }}" class='avatar' alt='none'></td>
                                        @else
                                            <td><img src="{{ url($path) }}" class='avatar' alt='none'></td>
                                        @endif
                                        <td>
                                             <div class="btn-group">
                                                <a href='#' class="edit" nik="{{ $d->nik }}"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-edit-circle" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                    <path d="M12 15l8.385 -8.415a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3z"></path>
                                                    <path d="M16 5l3 3"></path>
                                                    <path d="M9 7.07a7 7 0 0 0 1 13.93a7 7 0 0 0 6.929 -6"></path>
                                                 </svg></a>

                                                 <form action="/karyawan/{{ $d->nik }}/delete" method="POST" style="margin-left:5px">
                                                    @csrf
                                                   

                                                    <a href="#" class="delete-confirm">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-forbid" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                            <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0"></path>
                                                            <path d="M9 9l6 6"></path>
                                                         </svg>
                                                    </a>
                                                 </form>
                                             </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $karyawan->links('vendor\pagination\bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- Modal Add --}}
<div class="modal" id="input-karyawan" tabindex="-1">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Data Karyawan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/karyawan/store" method='POST' id='formkaryawan'>
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <div class="input-icon mb-3">
                                <span class="input-icon-addon">
                                  <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                                  <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><circle cx="12" cy="7" r="4"></circle><path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path></svg>
                                </span>
                                <input type="text" class="form-control" placeholder="NIK" name='nik' id='nik'>
                            </div>
                            <div class="input-icon mb-3">
                                <span class="input-icon-addon">
                                  <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                                  <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><circle cx="12" cy="7" r="4"></circle><path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path></svg>
                                </span>
                                <input type="text" class="form-control" placeholder="Nama" name='nama' id='nama'>
                            </div>
                            <div class="input-icon mb-3">
                                <span class="input-icon-addon">
                                  <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                                  <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><circle cx="12" cy="7" r="4"></circle><path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path></svg>
                                </span>
                                <input type="text" class="form-control" placeholder="No_telepon" name='no_telp' id='no_telp'>
                            </div>
                            <div class="input-icon mb-3">
                                <span class="input-icon-addon">
                                  <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                                  <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><circle cx="12" cy="7" r="4"></circle><path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path></svg>
                                </span>
                                <input type="text" class="form-control" placeholder="Jabatan" name='jabatan' id='jabatan'>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <button class='btn btn-primary w-100'>Simpan</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
{{-- Modal Edit --}}
<div class="modal" id="edit-karyawan" tabindex="-1">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Karyawan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="loadedit">

            </div>
        </div>
    </div>
</div>
@endsection
@push('myscript')
    <script>
        $(function(){
            $('#btntambah').click(function(){
                $('#input-karyawan').modal('show');
            });

            $('#formkaryawan').submit(function(){
                var nik = $('#nik').val();
                var nama = $('#nama').val();
                var no_telp = $('#no_telp').val();
                var jabatan = $('#jabatan').val();
                if(nik==''){
                    alert('nik harus diisi');
                    $('#nik').focus();
                }

            });

            $(".delete-confirm").click(function(){
                var form = $(this).closest('form');
                form.submit();
            });

            $('.edit').click(function(){
                var nik = $(this).attr('nik');
                $.ajax({
                    type: 'POST',
                    url: '/karyawan/edit',
                    cache: false,
                    data: {
                        _token: "{{ csrf_token(); }}",
                        nik: nik
                    },
                    success: function(respond){
                        $("#loadedit").html(respond);
                    }
                });
                $('#edit-karyawan').modal('show');
            });
        });
    </script>
@endpush