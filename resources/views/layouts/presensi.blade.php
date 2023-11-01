<!doctype html>
<html lang="en">
<head>
    <title>SIKAP!</title>
    <link rel="icon" href="{{ asset("assets/img/logo.png") }}"/>
    @yield('head')
</head>

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