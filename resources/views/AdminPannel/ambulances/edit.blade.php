@extends('AdminPannel.app')

@section('title', 'Rapid Rescue - Edit Ambulance')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title d-flex align-items-center gap-2 mb-4">
                        Edit Ambulance
                        <span>
                            <iconify-icon icon="twemoji:ambulance" class="fs-6"></iconify-icon>
                        </span>
                    </h5>

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

                    <form action="{{ route('updateambulance', $ambulance->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('POST')

                        <div class="mb-3">
                            <label for="type" class="form-label">Ambulance Type</label>
                            <input type="text" class="form-control" id="type" name="type" value="{{ old('type', $ambulance->type) }}" required>
                            @error('type')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="equipment" class="form-label">Equipment</label>
                            <textarea class="form-control" id="equipment" name="equipment" required>{{ old('equipment', $ambulance->equipment) }}</textarea>
                            @error('equipment')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="cost" class="form-label">Cost</label>
                            <input type="number" class="form-control" id="cost" name="cost" step="0.01" value="{{ old('cost', $ambulance->cost) }}" required>
                            @error('cost')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="size" class="form-label">Size</label>
                            <input type="text" class="form-control" id="size" name="size" value="{{ old('size', $ambulance->size) }}" required>
                            @error('size')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="image" class="form-label">Profile Image</label>
                            <input type="file" class="form-control" id="image" name="image" accept="image/*">
                            <small>Leave blank if you don't want to change the image.</small>

                            <div class="mt-2">
                                <strong>Current Image:</strong><br>
                                <img src="{{ asset($ambulance->image) }}" alt="Current Ambulance Image" style="width: 150px; height: auto;">
                            </div>

                            @error('image')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-danger">Update Ambulance</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
