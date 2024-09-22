@extends('AdminPannel.app')

@section('title', 'Admin Pannel - Create Driver')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Create Driver</h5>

                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('savedriver') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="driver_name" class="form-label">Driver Name</label>
                                <input type="text" class="form-control" id="driver_name" name="driver_name" required>
                            </div>
                            <div class="mb-3">
                                <label for="driver_license_no" class="form-label">Driver License No</label>
                                <input type="text" class="form-control" id="driver_license_no" name="driver_license_no"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label for="driver_address" class="form-label">Driver Address</label>
                                <input type="text" class="form-control" id="driver_address" name="driver_address"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label for="driver_phone" class="form-label">Driver Phone</label>
                                <input type="text" class="form-control" id="driver_phone" name="driver_phone" required>
                            </div>
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" id="username" name="username" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <div class="mb-3">
                                <label for="driver_image" class="form-label">Driver Image</label>
                                <input type="file" class="form-control" id="driver_image" name="driver_image"
                                    accept="image/*">
                            </div>
                            <div class="mb-3">
                                <label for="ambulance_id" class="form-label">Select Ambulance</label>
                                @if ($ambulances->isEmpty())
                                    <div class="alert alert-warning">No ambulance exists.</div>
                                @else
                                    <select class="form-select" id="ambulance_id" name="ambulance_id" required>
                                        <option value="">Select an ambulance</option>
                                        @foreach ($ambulances as $ambulance)
                                            <option value="{{ $ambulance->id }}">{{ $ambulance->type }}</option>
                                        @endforeach
                                    </select>
                                @endif
                            </div>

                            <div class="mb-3">
                                <label for="map" class="form-label">Driver Current Location</label>

                                <div class="mb-3">
                                    <label for="manual_latitude" class="form-label">Manual Latitude</label>
                                    <input type="text" class="form-control" id="manual_latitude" name="manual_latitude"
                                        placeholder="Optional">
                                </div>
                                <div class="mb-3">
                                    <label for="manual_longitude" class="form-label">Manual Longitude</label>
                                    <input type="text" class="form-control" id="manual_longitude" name="manual_longitude"
                                        placeholder="Optional">
                                </div>
                                <div id="map" style="height: 300px; margin-top: 10px;"></div>
                                <input type="hidden" id="latitude" name="latitude">
                                <input type="hidden" id="longitude" name="longitude">
                                <small class="text-muted">Please allow location access to automatically fetch your current
                                    location.</small>
                            </div>
                            <button type="submit" class="btn btn-danger">Create Driver</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@section('scripts')
    <script>
        let map;
        let marker;

        function initMap() {
            const initialLocation = [51.505, -0.09];
            map = L.map('map').setView(initialLocation, 15);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
            }).addTo(map);

            marker = L.marker(initialLocation).addTo(map);

            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition((position) => {
                    const pos = [position.coords.latitude, position.coords.longitude];
                    map.setView(pos, 13);
                    placeMarker(pos);
                }, (error) => {
                    alert("Unable to retrieve your location. Please check your permissions.");
                });
            } else {
                alert("Geolocation is not supported by this browser.");
            }
        }

        function placeMarker(location) {
            marker.setLatLng(location);
            document.getElementById("latitude").value = location[0];
            document.getElementById("longitude").value = location[1];

            const driverName = document.getElementById('driver_name').value || "Driver Location";
            marker.bindTooltip(driverName).openTooltip();
        }

        document.getElementById('manual_latitude').addEventListener('change', updateMap);
        document.getElementById('manual_longitude').addEventListener('change', updateMap);

        function updateMap() {
            const manualLat = parseFloat(document.getElementById('manual_latitude').value);
            const manualLng = parseFloat(document.getElementById('manual_longitude').value);

            if (!isNaN(manualLat) && !isNaN(manualLng)) {
                const manualPos = [manualLat, manualLng];
                map.setView(manualPos, 13);
                placeMarker(manualPos);
            }
        }

        document.addEventListener('DOMContentLoaded', initMap);
    </script>
@endsection

@endsection
