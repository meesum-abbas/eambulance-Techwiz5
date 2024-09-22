@extends('AdminPannel.app')

@section('title', 'Admin Pannel - Edit Driver')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Edit Driver</h5>

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

                    <form action="{{ route('updatedriver', $driver->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('POST')

                        <div class="mb-3">
                            <label for="driver_name" class="form-label">Driver Name</label>
                            <input type="text" class="form-control" id="driver_name" name="driver_name" value="{{ old('driver_name', $driver->name) }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="driver_license_no" class="form-label">Driver License No</label>
                            <input type="text" class="form-control" id="driver_license_no" name="driver_license_no" value="{{ old('driver_license_no', $driver->driver_license_no) }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="driver_address" class="form-label">Driver Address</label>
                            <input type="text" class="form-control" id="driver_address" name="driver_address" value="{{ old('driver_address', $driver->driver_address) }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="driver_phone" class="form-label">Driver Phone</label>
                            <input type="text" class="form-control" id="driver_phone" name="driver_phone" value="{{ old('driver_phone', $driver->driver_phone) }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" name="username" value="{{ old('username', $driver->username) }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $driver->email) }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password (Leave blank to keep current)</label>
                            <input type="password" class="form-control" id="password" name="password">
                        </div>
                        <div class="mb-3">
                            <label for="driver_image" class="form-label">Driver Image</label>
                            <input type="file" class="form-control" id="driver_image" name="driver_image" accept="image/*">
                        </div>
                        <div class="mb-3">
                            <label for="ambulance_id" class="form-label">Select Ambulance</label>
                            <select class="form-select" id="ambulance_id" name="ambulance_id" required>
                                <option value="">Select an ambulance</option>
                                @foreach ($ambulances as $ambulance)
                                    <option value="{{ $ambulance->id }}" selected>{{ $ambulance->type }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="map" class="form-label">Driver Current Location</label>
                            <div id="map" style="height: 300px;"></div>
                            <input type="hidden" id="latitude" name="latitude" value="{{ old('latitude', $driver->latitude) }}">
                            <input type="hidden" id="longitude" name="longitude" value="{{ old('longitude', $driver->longitude) }}">
                        </div>

                        <button type="submit" class="btn btn-danger">Update Driver</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@section('scripts')
<script>
    const map = L.map('map').setView([{{ $driver->latitude ?? 0 }}, {{ $driver->longitude ?? 0 }}], 15);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
    }).addTo(map);

    let marker = L.marker([{{ $driver->latitude ?? 0 }}, {{ $driver->longitude ?? 0 }}]).addTo(map);
    marker.bindPopup('Current Location').openPopup();

    function onMapClick(e) {
        marker.setLatLng(e.latlng);
        document.getElementById('latitude').value = e.latlng.lat;
        document.getElementById('longitude').value = e.latlng.lng;
    }

    map.on('click', onMapClick);
</script>
@endsection

@endsection
