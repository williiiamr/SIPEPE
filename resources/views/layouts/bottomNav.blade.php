<!-- App Bottom Menu -->
<div class="appBottomMenu" >
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <div class="container-fluid bottom-bar bg-white d-flex justify-content-evenly align-items-center">
        <a href="/dashboard" class="d-flex flex-column justify-content-center align-items-center menu">
          <img width="25" height="25" src="../../assets/img/home.png" alt="" />
          <div class="menu-text selected">Home</div>
        </a>
        <a href="/presensi/create" class="d-flex flex-column justify-content-center align-items-center menu">
          <img width="25" height="25" src="../../assets/img/presensi.png" alt="" />
          <div class="menu-text">Presensi</div>
        </a>
        <a href="#" class="d-flex flex-column justify-content-center align-items-center menu">
          <img width="25" height="25" src="../../assets/img/cuti.png" alt="" />
          <div class="menu-text">Cuti</div>
        </a>
        <a href="/history" class="d-flex flex-column justify-content-center align-items-center menu">
          <img width="25" height="25" src="../../assets/img/history.png" alt="" />
          <div class="menu-text">History</div>
        </a>
    </div>
</div>
<!-- * App Bottom Menu -->



{{-- 
<a href="/dashboard" class="item {{ request()->is('dashboard') ? 'active' : '' }}">
    <div class="col4">
    <img src="../../assets/image/home.png" alt="images" class="icon-size2">
        <h5>Home</h5>
    </div>
</a>

<a href="/presensi/create" class="item">
    <div class="col">
        <div class="action-button large mb-5">
        <img src="../../assets/image/presensi.png" alt="images" class="icon-size2">
         </div>
    </div>
</a>

<a href="/history" class="item {{ request()->is('history') ? 'active' : '' }}">
    <div class="col4">
    <img src="../../assets/image/history.png" alt="imasges" class="icon-size2" style="margin-top: -2px;">
        <h5>History</h5>
    </div>
</a> --}}