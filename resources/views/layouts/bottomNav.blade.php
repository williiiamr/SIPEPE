<!-- App Bottom Menu -->
<div class="appBottomMenu">
    <a href="/dashboard" class="item {{ request()->is('dashboard') ? 'active' : '' }}">
        <div class="col4">
        <img src="../../assets/img/sample/photo/home-2.png" alt="images" class="icon-size2">
            <h5>Home</h5>
        </div>
    </a>

    <a href="/presensi/create" class="item">
        <div class="col">
            <div class="action-button large mb-5">
            <img src="../../assets/img/sample/photo/camera-bold.png" alt="images" class="icon-size2">
             </div>
        </div>
    </a>

    <a href="/history" class="item {{ request()->is('history') ? 'active' : '' }}">
        <div class="col4">
        <img src="../../assets/img/sample/photo/octicon.png" alt="imasges" class="icon-size2" style="margin-top: -2px;">
            <h5>History</h5>
        </div>
    </a>
</div>
<!-- * App Bottom Menu -->