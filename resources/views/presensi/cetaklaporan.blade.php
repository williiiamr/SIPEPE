<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>A4</title>

  <!-- Normalize or reset CSS with your favorite library -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/7.0.0/normalize.min.css">

  <!-- Load paper.css for happy printing -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paper-css/0.4.1/paper.css">

  <!-- Set page size here: A5, A4 or A3 -->
  <!-- Set also "landscape" if you need -->
  <style>
    @page { 
      size: A4 
    }
    #judul {
      font-family: Helvetica, sans-serif;
      font-weight: bold;
      font-size: 20px;
    }
    .tablepresensi{
      width: 100%;
      margin-top: 20px;
      border-collapse: collapse;
    }

    .tablepresensi tr th {
      border: 1px solid black;
      background-color: lightgrey; 
    }

    .tablepresensi tr td {
      border: 1px solid black;
      font-size: 10px;
      padding: 5px;
    }
  </style>
</head>

<!-- Set "A5", "A4" or "A3" for class name -->
<!-- Set also "landscape" if you need -->
<body class="A3 landscape">

  <!-- Each sheet element should have the class "sheet" -->
  <!-- "padding-**mm" is optional: you can set 10, 15, 20 or 25 -->
  <section class="sheet padding-10mm">

    <table style="width: 100%;" >
      <tr>
        <td style="width: 30px; height: 30px;">
          <img src="{{ asset('assets/img/logodfi.png') }}" width="120">
        </td>
        <td> 
          <span id='judul'>
            PT. Digital Forte Indonesia<br>
            Laporan Presensi Karyawan Bulan {{ $namabulan[$bulan] }} {{ $tahun }}
          </span><br>
          <span style="line-height: 5px;">Jl. Kamboja 1, Mekar Jaya, Kec. Sukmajaya, Kota Depok, Jawa Barat 16411</span>
        </td>
      </tr>
    </table>
    <table class="tablepresensi">
      <thead>
        <tr>
          <th>Nik</th>
          <th>Nama Karyawan</th>
          @for ($day = 1; $day <= 31; $day++)
            <th>{{ $day }}</th>
          @endfor
        </tr>
      </thead>
      <tbody>
        @foreach ($presensi as $data)
        <tr>
          <td>{{ $data->nik }}</td>
          <td>{{ $data->nama }}</td>
          <!-- Add day data here -->
          @for ($day = 1; $day <= 31; $day++)
              <td>
                @if ($data->attendedOnDay($tahun, $bulan, $day, $data->nik))
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-check" width="12" height="12" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M5 12l5 5l10 -10"></path>
                  </svg>
                        
                @elseif ($izin->permittedOnDay($tahun, $bulan, $day, $data->nik))
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-check" width="12" height="12" viewBox="0 0 24 24" stroke-width="2" stroke="red" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M5 12l5 5l10 -10"></path>
                  </svg>

                @else
                    <!-- Empty box symbol -->
                @endif
              </td>
          @endfor
        </tr>
        @endforeach
      </tbody>
    </table>

  </section>

</body>

</html>