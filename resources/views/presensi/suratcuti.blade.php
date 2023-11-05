<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat Cuti</title>
    <style>
        body {
            margin-top: 30px;
            margin-bottom: 30px;
            margin-left: 30px;
            margin-right: 30px;
        }

        .content {
            margin-top: 10px;
            margin-bottom: 10px;
            margin-left: 10px;
            margin-right: 10px;
        }
    </style>
</head>
<body>
    <div class="content" style="text-align: right;">
        <span>Bandar Lampung, {{ $date }}</span>
    </div>
    <div class="content">
        <span style="line-height: 1.5 ;">Kepada Yth.</span>
    </div>
    <div class="content">
        <span style="line-height: 1.5 ;">Bpk/Ibu Pimpinan PT. Ressa Abadi</span>
    </div>
    <div class="content">
        <span style="line-height: 1.5 ;">Di tempat.</span>
    </div>
    <br>
    <div class="content">
        <span style="line-height: 1.5 ;">Dengan hormat,</span>
    </div>
    <div class="content">
        <span style="line-height: 1.5 ;">Saya yang bertanda tangan di bawah ini :</span>
    </div>
    <div class="content">
        <span style="line-height: 0.8 ;">Nama</span>
        <span style="line-height: 0.8 ; text-indent: 20px; display: inline-block;">:</span>
        <span style="line-height: 0.8 ;">{{ $nama }}</span>
    </div>
    <div class="content">
        <span style="line-height: 1.5 ;">NIK</span>
        <span style="line-height: 1.5 ;text-indent: 20px;">:</span>
        <span style="line-height: 1.5 ;">{{ $nik }}</span>
    </div>
    <div class="content">
        <span style="line-height: 1.5 ;">Jabatan</span>
        <span style="line-height: 1.5 ;text-indent: 20px;">:</span>
        <span style="line-height: 1.5 ;">{{ $jabatan }}</span>
    </div>
    <div class="content">
        <span style="line-height: 2 ;">Dengan surat ini saya bermaksud untuk meminta cuti untuk tidak masuk kerja pada hari {{ $tgl_izin }} dikarenakan 
            @if ($pengajuanizin->status === 'i')
                izin.
            @elseif ($pengajuanizin->status === 's')
                sakit.
            @else
                {{ $pengajuanizin->status }}
            @endif
        </span>
    </div>
    <div class="content">
        <span style="line-height: 2 ;">Demikian surat 
            @if ($pengajuanizin->status === 'i')
                izin
            @elseif ($pengajuanizin->status === 's')
                sakit
            @else
                {{ $pengajuanizin->status }}
            @endif
            ini, mohon kiranya untuk dapat dimaklumi. Atas perhatian serta
            @if ($pengajuanizin->status === 'i')
                izin
            @elseif ($pengajuanizin->status === 's')
                sakit
            @else
                {{ $pengajuanizin->status }}
            @endif
            yang diberikan, saya mengucapkan terima kasih.
        </span>
    </div>
    <br>
    <br>
    <br>
    <div class="content">
        <p style="line-height: 0.1 ; text-indent: 20px;">Direktur</p>
    </div>
    <img src="assets/img/TTD PT Ressa Abadi.png" alt="img" width="100px" class="content">
    <div class="content">
        <p style="line-height: 0.1 ;">Stefan Yesaya</p>
    </div>
</body>
</html>