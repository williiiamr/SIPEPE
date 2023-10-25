<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>History</title>
    <link rel="stylesheet" type="text/css" href={{ asset("assets/css/editprofile.css") }}>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src = "./assets/js/sweetalert.js" defer></script>
</head>
<body>
    <div class='appHeader text-light' style="background-color: #203585;">
        <div class='left'>
            <a href='/dashboard' class='headerButton goBack'>
                <ion-icon name="chevron-back-outline"></ion-icon>
            </a>
        </div>
        <div class='pageTitle'>Edit Profile</div>
        <div class='right'></div>
    </div>
    <div class="container">
        @php
            $messagesuccess = Session::get('success');
            $messageerror = Session::get('error');
        @endphp

        @if (Session::has('success'))
            <script>
                // SweetAlert for success message
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: '{{ $messagesuccess }}',
                });
            </script>
        @endif

        @if (Session::has('error'))
            <script>
                // SweetAlert for error message
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: '{{ $messageerror }}',
                });
            </script>
        @endif
    </div>
    <div class="main-content">
        <div
          class="header pb-8 pt-5 pt-lg-8 d-flex align-items-center"
          style="min-height: 600px; background-image: url('assets/img/sample/photo/tokyos.jpg'); background-size: cover; background-position: center top"
        >
          <!-- Mask -->
          <span class="mask bg-gradient-default opacity-8"></span>
          <!-- Header container -->
          <div class="container-fluid d-flex align-items-center">
            <div class="row">
              <div class="col-lg-7 col-md-10">
                <h1 class="display-2 text-white">Hello, {{ Auth::guard('karyawan')->user()->nama }}</h1>
                <p class="text-white mt-0 mb-5" style="font-size: 14px">This is ysour sprossfssile page. You can see the progress you've made with your work and manage your projects or assigned tasks</p>
              </div>
            </div>
          </div>
        </div>
        <!-- Page content -->
        <div class="container-fluid mt--7">
          <div class="row">
            <div class="col-xl-4 order-xl-2 mb-5 mb-xl-0">
              <div class="card card-profile shadow" style="margin-top: -240px; margin-bottom: 100px;">
                <div class="row justify-content-center">
                  <div class="col-lg-3 order-lg-2">
                    <div class="card-profile-image">
                      <a href="#">
                        @if(!empty(Auth::guard('karyawan')->user()->foto))
                          @php
                          $path = Storage::url('public/uploads/karyawan/'.Auth::guard('karyawan')->user()->foto);
                          @endphp
                              <img style="border-radius:100px;" src="{{ url($path) }}" alt="avatar" class="imaged w64 rounded">
                        @else
                            <img src="assets/img/sample/avatar/avatar1.jpg" alt="avatar" class="imaged w64 rounded">
                        @endif
                      </a>
                    </div>
                  </div>
                </div>
                <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
                  <div class="d-flex justify-content-between">
                  </div>
                </div>
                <div class="card-body pt-0 pt-md-4">
                  <br>
                  <br>
                  <br>
                  <div class="text-center">
                    <h3>{{ Auth::guard('karyawan')->user()->nama }}</h3>
                    <div class="h5 mt-4"><i class="ni business_briefcase-24 mr-2"></i>{{ Auth::guard('karyawan')->user()->jabatan }}</div>
                    <div><i class="ni education_hat mr-2"></i>PT Digital Forte Indonesia</div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-8 order-xl-1">
              <div class="card bg-secondary shadow" style="margin-top: -240px;">
                <div class="card-header bg-white border-0">
                  <div class="row align-items-center">
                    <div class="col-8">
                      <h3 class="mb-0">Edit your profile</h3>
                    </div>
                  </div>
                </div>
                <div class="card-body">
                  <form action="/presensi/{{ $datauser->nik }}/updateprofile" method="POST" enctype="multipart/form-data">
                  @csrf
                    <h6 class="heading-small text-muted mb-4">User information</h6>
                    <div class="pl-lg-4">
                      <div class="row">
                        <div class="col-lg-6">
                          <div class="form-group focused">
                            <label class="form-control-label" for="input-username">Nama Lengkap</label>
                            <input type="text" id="input-username" class="form-control form-control-alternative" value="{{ $datauser->nama }}" placeholder="Nama Lengkap" name="nama_lengkap"/>
                          </div>
                        </div>
                        <div class="col-lg-6">
                          <div class="form-group focused">
                            <label class="form-control-label" for="input-nik">NIK</label>
                            <input type="text" id="input-nik" class="form-control form-control-alternative" value="{{ $datauser->no_hp }}" placeholder="No. HP" name="no_hp" />
                          </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                              <label class="form-control-label" for="input-email">Password</label>
                              <input type="password" id="input-password" class="form-control form-control-alternative" placeholder="Password" />
                            </div>
                            <div class="form-group">
                              <label class="form-control-label">Photo Profiles</label>
                            </div>
                            <div class="custom-file-upload" id="fileUpload1">
                            <input type="file" name="foto" id="fileuploadInput" accept=".png, .jpg, .jpeg" />
                            <label for="fileuploadInput">
                              <span>
                                <strong>
                                  <ion-icon name="cloud-upload-outline" role="img" class="md hydrated" aria-label="cloud upload outline"></ion-icon>
                                  <i>Tap to Upload</i>
                                </strong>
                              </span>
                            </label>
                          </div>

                        </div>
                        
                      </div>
                      <button class="btn btn-info">Save Changes</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="alert alert-primary" role="alert">
</div>
</body>
</html>