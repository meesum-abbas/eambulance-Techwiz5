<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>@yield('title')</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,400;0,700;0,900;1,400;1,700;1,900&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="{{ asset('userpannel/lib/animate/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('userpannel/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('userpannel/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('userpannel/css/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
</head>

<body>
    @include('UserPannel.header')
    @yield('content')
    @include('UserPannel.footer')

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('userpannel/lib/wow/wow.min.js') }}"></script>
    <script src="{{ asset('userpannel/lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('userpannel/lib/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ asset('userpannel/lib/counterup/counterup.min.js') }}"></script>
    <script src="{{ asset('userpannel/lib/owlcarousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('userpannel/js/main.js') }}"></script>
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> 
    @yield('scripts')

</body>

</html>
