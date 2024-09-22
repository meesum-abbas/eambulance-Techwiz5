@extends('AdminPannel.app')

@section('title', 'Admin Pannel - Driver Monitoring')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 mt-4">
                <h5>Drivers' Locations</h5>
                <div id="map" style="height: 500px;"></div>
            </div>
        </div>
    </div>

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const map = L.map('map').setView([51.505, -0.09], 2);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
            }).addTo(map);

            @foreach ($drivers as $driver)
                @if ($driver->latitude && $driver->longitude)
                    L.marker([{{ $driver->latitude }}, {{ $driver->longitude }}])
                        .addTo(map)
                        .bindPopup(`
                        <div style="text-align: center;">
                                <img src="{{ asset($driver->image) }}" alt="Driver Image" style="width: 100px; height: auto; border-radius: 50%;">
                                <br><b>{{ $driver->name }}</b><br>{{ $driver->driver_address }}<br>
                            </div>
                        `);
                @endif
            @endforeach
        });
    </script>
@endsection

@endsection
