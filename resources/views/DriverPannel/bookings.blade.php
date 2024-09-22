@extends('DriverPannel.app')
@section('title', 'Driver Bookings')
<meta name="csrf-token" content="{{ csrf_token() }}"> 
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card text-center">
                <div class="card-body">
                    <h1>Welcome to the Driver Bookings!</h1>
                    <p>Your assigned emergency requests:</p>

                    <div id="map" style="height: 400px;"></div>

                    @if($emergencyRequests->isEmpty())
                        <div class="alert alert-warning">No emergency requests assigned.</div>
                    @else
                        <table class="table table-striped text-nowrap align-middle mb-0">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Hospital Name</th>
                                    <th>Mobile No</th>
                                    <th>Address</th>
                                    <th>Type</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($emergencyRequests as $request)
                                <tr>
                                    <td>{{ $request->id }}</td>
                                    <td>{{ $request->hospital_name }}</td>
                                    <td>{{ $request->mobile_no }}</td>
                                    <td>{{ $request->address }}</td>
                                    <td>{{ ucfirst($request->type) }}</td>
                                    <td class="badge bg-danger">{{ $request->status }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const map = L.map('map').setView([31.5204, 74.3587], 12);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 18,
            attribution: '© OpenStreetMap'
        }).addTo(map);

        var emergencyRequests = @json($emergencyRequests);

        emergencyRequests.forEach(function (request) {
            if (request.latitude && request.longitude) {
                var hospitalCoords = [request.latitude, request.longitude];

                var hospitalMarker = L.marker(hospitalCoords)
                    .addTo(map)
                    .bindPopup(` 
                        <div style="text-align: center;">
                            <h3>Patient Details</h3>
                            <b>Patient Pick Up Point:</b> ${request.pickup_address}<br>
                            <b>Patient Mobile No:</b> ${request.mobile_no}<br>
                        </div>`
                    );

                if (request.driver) {
                    var driverCoords = [request.driver.latitude, request.driver.longitude];

                    var driverMarker = L.marker(driverCoords)
                        .addTo(map)
                        .bindPopup(`
                            <div style="text-align: center;">
                                <h3>Ambulance Driver</h3>
                                <b>Driver Name:</b> ${request.driver.name}<br>
                                <b>Driver Mobile No:</b> ${request.driver.driver_phone}<br>
                                <button class="badge bg-success" onclick="completeRide(${request.id})">Complete Ride</button>
                            </div>
                        `);

                    L.Routing.control({
                        waypoints: [
                            L.latLng(hospitalCoords),
                            L.latLng(driverCoords)
                        ],
                        routeWhileDragging: true,
                        createMarker: function() { return null; }
                    }).addTo(map);
                }
            }
        });
    });

    function completeRide(requestId) {
    if (confirm('Are you sure you want to complete this ride?')) {
        fetch(`/driver/complete-ride/${requestId}`, { 
            method: 'put',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                alert('Ride completed successfully!');
                location.reload(); 
            } else {
                alert('Failed to complete the ride. Please try again.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('There was an error completing the ride.');
        });
    }
}

</script>
@endsection
