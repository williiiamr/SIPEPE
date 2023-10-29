<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <link rel="stylesheet" href={{ asset("assets/css/login_history.css") }}  />
    <title>Document</title>
  </head>
  <body>
    <ul class="ul-history mt-3" style="border-radius: 20px; box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 2px 6px 2px;">
      @foreach ($history as $d)
      <li>
        <div class="text-date" style="margin-left: 30px;">
          {{ date('Y-m-d', strtotime($d->tgl_presensi)) }}
          <span class="badge badge-red gradasigreen">{{ $d->jam_in }}</span>
          <span class="badge badge-danger">{{ $d->jam_out }}</span>
        </div>
      </li>
      @endforeach
    </ul>
  </body>
</html>