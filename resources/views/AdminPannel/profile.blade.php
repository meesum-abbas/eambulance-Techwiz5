    @extends('AdminPannel.app')

    @section('title', 'Rapid Rescue - Admin Profile Page')

    @section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title d-flex align-items-center gap-2 mb-4">
                            Edit Profile
                            <span>
                                <iconify-icon icon="solar:question-circle-bold" class="fs-7 d-flex text-muted"
                                    data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="tooltip-success"
                                    data-bs-title="Traffic Overview"></iconify-icon>
                            </span>
                        </h5>
                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        <form action="{{ url('admin/profile/update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    value="{{ old('name', $user->name) }}" required>
                                @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    value="{{ old('email', $user->email) }}" disabled>
                                    <span class="badge bg-success">This Email Field Is Disabled</span>
                                @error('email')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="phone" class="form-label">Phone Number</label>
                                <input type="text" class="form-control" id="phone" name="phone"
                                    value="{{ old('phone', $user->phone) }}">
                                @error('phone')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="date_of_birth" class="form-label">Date of Birth</label>
                                <input type="date" class="form-control" id="date_of_birth" name="date_of_birth"
                                    value="{{ old('date_of_birth', $user->date_of_birth) }}">
                                @error('date_of_birth')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="bio" class="form-label">Bio</label>
                                <textarea class="form-control" id="bio" name="bio">{{ old('bio', $user->bio) }}</textarea>
                                @error('bio')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="about_me" class="form-label">About Me</label>
                                <textarea class="form-control" id="about_me" name="about_me">{{ old('about_me', $user->about_me) }}</textarea>
                                @error('about_me')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="image" class="form-label">Profile Image</label>
                                <input type="file" class="form-control" id="image" name="image" accept="image/*">
                                <small>Leave blank if you don't want to change the image.</small>

                                    <div class="mt-2">
                                        <strong>Current Image:</strong><br>
                                        <img src="{{ asset($user->image) }}" alt="Current Profile Image"
                                            style="width: 150px; height: auto;">
                                    </div>
                                @error('image')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-danger">Update Profile</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
