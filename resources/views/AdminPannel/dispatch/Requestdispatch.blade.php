@extends('AdminPannel.app')
@section('title', 'Rapid Rescue - Emergency Requests')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title d-flex justify-content-between align-items-center">
                        <span>
                            <iconify-icon icon="twemoji:ambulance" class="fs-6"></iconify-icon> Emergency Requests
                        </span>
                    </h5>

                    <div id="map" style="height: 400px;"></div> <!-- The map container -->

                    <div class="table-responsive mt-4">
                        <table class="table table-striped text-nowrap align-middle mb-0">
                            <thead>
                                <tr class="border-bottom border-primary">
                                    <th scope="col">ID</th>
                                    <th scope="col">Hospital Name</th>
                                    <th scope="col">Mobile No</th>
                                    <th scope="col">Address</th>
                                    <th scope="col">Type</th>
                                    <th scope="col">Driver</th>
                                    <th scope="col">Status</th>
                                </tr>
                            </thead>
                            <tbody class="table-group-divider">
                                @foreach($emergencyRequests as $request)
                                <tr>
                                    <td class="fw-medium">{{ $request->id }}</td>
                                    <td class="fw-medium">{{ $request->hospital_name }}</td>
                                    <td class="fw-medium">{{ $request->mobile_no }}</td>
                                    <td class="fw-medium">{{ $request->address }}</td>
                                    <td class="fw-medium">{{ ucfirst($request->type) }}</td>
                            
                                    <td class="text-center">
                                        @if($request->status === 'dispatched')
                                            @if($request->driver)
                                                <span class="badge bg-danger">{{ $request->driver->name }}</span>
                                            @else
                                                <span class="badge bg-warning">No Driver Assigned</span>
                                            @endif
                                        @elseif($request->status === 'completed')
                                            @if($request->driver)
                                                <span class="badge bg-success">{{ $request->driver->name }}</span>
                                            @else
                                                <span class="badge bg-success">Ride Completed (No Driver Assigned)</span>
                                            @endif
                                        @else
                                            <form action="{{ route('assign.driver', $request->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <select name="driver_id" class="form-control">
                                                    <option value="">Select Driver</option>
                                                    @foreach($drivers as $driver)
                                                        <option value="{{ $driver->id }}" {{ $request->driver_id == $driver->id ? 'selected' : '' }}>
                                                            {{ $driver->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <button type="submit" class="badge bg-warning mt-2">Assign Driver</button>
                                            </form>
                                        @endif
                                    </td>
                                    
                                    <td class="fw-medium">{{ ucfirst($request->status) }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                            
                        </table>
                    </div>

                    @if($emergencyRequests->isEmpty())
                        <div class="alert alert-warning mt-3">No emergency requests found.</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div> 
@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const map = L.map('map').setView([31.5204, 74.3587], 12);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 18,
        attribution: '© OpenStreetMap'
    }).addTo(map);

    var emergencyRequests = @json($emergencyRequests);

    emergencyRequests.data.forEach(function (request) {
        if (request.latitude && request.longitude) {
            var hospitalCoords = [request.latitude, request.longitude];

            // Create hospital marker
            var hospitalMarker = L.marker(hospitalCoords)
                .addTo(map)
                .bindPopup(` 
                    <div style="text-align: center;">
                        <h3>Patient Details</h3>
                        <b>Patient Pick Up Point:</b> ${request.pickup_address}<br>
                        <b>Patient Mobile No:</b> ${request.mobile_no}<br>
                    </div>`);

            // Check if the request status is completed
            if (request.status === 'completed') {
                // Remove the hospital marker
                hospitalMarker.remove();
                return; // Skip further processing for this request
            }

            // Check if there's an assigned driver
            if (request.driver) {
                var driverCoords = [request.driver.latitude, request.driver.longitude];
                var driverMarker = L.marker(driverCoords)
                    .addTo(map)
                    .bindPopup(` 
                        <div style="text-align: center;">
                            <h3>Ambulance Driver</h3>
                            <b>Driver Name:</b> ${request.driver.name}<br>
                            <b>Driver Mobile No:</b> ${request.driver.driver_phone}<br>
                        </div>
                    `);

                // Add routing control if a driver is present
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
</script>
@endsection



@endsection
