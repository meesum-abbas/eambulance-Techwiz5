<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <link rel="shortcut icon" type="image/png" href="{{ asset('adminpannel/images/logos/seodashlogo.png') }}" />
    <link rel="stylesheet" href="{{ asset('adminpannel/css/styles.min.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine/dist/leaflet-routing-machine.css" /> 
</head>

<body>

    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        @include('DriverPannel.header')
        @yield('content')
    </div>

    <script src="{{ asset('adminpannel/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('adminpannel/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('adminpannel/libs/apexcharts/dist/apexcharts.min.js') }}"></script>
    <script src="{{ asset('adminpannel/libs/simplebar/dist/simplebar.js') }}"></script>
    <script src="{{ asset('adminpannel/js/sidebarmenu.js') }}"></script>
    <script src="{{ asset('adminpannel/js/app.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet-routing-machine/dist/leaflet-routing-machine.js"></script>
    @yield('scripts')
</body>

</html>
