<!doctype html>
<html lang="en">

<head>
    @yield('head')
</head>

<style>
    .bg-image{
        background-color: #f0f4f9;
        background-size: cover;
        background-repeat: no-repeat;
        background-position: top center;
        background-position: center top;
    }
    
    @media (max-width: 767px) {
        body {
            height: 300px; /* Set the height you want to crop the image to */
            overflow: hidden;
        }
    }
</style>

<body class="bg-image" style="overflow-x: hidden">
    <!-- loader -->
    <div id="loader">
        <div class="spinner-border text-primary" role="status"></div>
    </div>
    <!-- * loader -->

    @yield('header')

    <!-- App Capsule -->
    <div id="appCapsule">
        @yield('content')
    </div>
    <!-- * App Capsule -->

    @include('layouts.bottomNav')

    @include('layouts.script')

</body>

</html>