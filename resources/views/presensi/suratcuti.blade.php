<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat Cuti</title>
</head>
<body>
    <div>
        <p>Bandar Lampung, {{ $date }}</p>
    </div>
    <div>
        <p>Perihal : 
        @if ($pengajuanizin->status === 'i')
            Izin
        @elseif ($pengajuanizin->status === 's')
            Sakit
        @else
            {{ $pengajuanizin->status }}
        @endif
        </p>
    </div>
    <br>
    <div>
        <p>Nama : {{ $nama }}</p>
    </div>
    <div>
        <p>NIK : {{ $nik }}</p>
    </div>
    <div>
        <p>Jabatan : {{ $jabatan }}</p>
    </div>
</body>
</html>