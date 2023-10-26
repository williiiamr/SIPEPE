<!doctype html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login Karyawan</title>
  <link rel="icon" href="logo.png" type="image/x-icon" />
  <link rel="stylesheet" href= {{ asset("assets/css/login_history.css") }} />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src = "./assets/js/sweetalert.js" defer></script>
</head>

<body class="bg-image-login" style="background-image: url('{{ asset('assets/img/bg-login.png')}}');">
  <div class="position-logo" id="bg">
    <img src={{ asset("assets/img/logo.png") }} alt="Sikap!" width="125" />
  </div>
  <div class="radius">
    <div class="container-judul mb-5">
      <div class="judul-sikap">Sistem Informasi Kepegawaian</div>
      <div class="judul-deskripsi mt-3">Presensi dan Cuti dalam Satu Genggaman</div>
    </div>
    <div class="wrap-login100">
      <form action='/proseslogin' method="POST" class='login100-form validate-form'>
        @csrf
        <div class="mb-3">
          <input type="text" class="form-control" id="nik" name='nik' aria-describedby="emailHelp" placeholder="NIK" />
        </div>
        <div class="mb-3">
          <input type="password" class="form-control" id="password" name="password" placeholder="Password" />
        </div>
        <div class="text-center"><button type="submit" class="btn btn-primary px-5 mb-5 w-100">LOGIN</button></div>
      </form>
    </div>
  </div>
</body>
</html>
