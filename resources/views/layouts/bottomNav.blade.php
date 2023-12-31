<!-- App Bottom Menu -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
<div class="appBottomMenu" >
    <div class="container-fluid bottom-bar bg-white d-flex justify-content-evenly align-items-center">
        <a href="/dashboard" class="d-flex flex-column justify-content-center align-items-center menu {{ request()->is('dashboard') ? 'selected' : '' }}">
          <img width="25" height="25" src="../../assets/img/home.png" alt="" />
          <div class="menu-text">Home</div>
        </a>
        <a href="/presensi/create" class="d-flex flex-column justify-content-center align-items-center menu {{ request()->is('presensi/create') ? 'selected' : '' }}">
          <img width="25" height="25" src="../../assets/img/presensi.png" alt="" />
          <div class="menu-text">Presensi</div>
        </a>
        <a href="/presensi/izin" class="d-flex flex-column justify-content-center align-items-center menu {{ request()->is('presensi/izin') || request()->is('presensi/buatizin') ? 'selected' : '' }}">
        <img width="25" height="25" src="../../assets/img/cuti.png" alt="" />
          <div class="menu-text">Cuti</div>
        </a>
        <a href="/history" class="d-flex flex-column justify-content-center align-items-center menu {{ request()->is('history') ? 'selected' : '' }}">
          <img width="25" height="25" src="../../assets/img/history.png" alt="" />
          <div class="menu-text">History</div>
        </a>
    </div>
</div>