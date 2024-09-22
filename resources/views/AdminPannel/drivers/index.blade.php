@extends('AdminPannel.app')

@section('title', 'Admin Pannel - Driver List')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title d-flex justify-content-between align-items-center">
                            <span>Driver List</span>
                            <a href="{{ route('createdriver') }}" class="badge bg-danger">Create Driver</a>
                        </h5>
                        <div class="table-responsive">
                            <table class="table text-nowrap align-middle mb-0">
                                <thead>
                                    <tr class="border-2 border-bottom border-primary border-0">
                                        <th scope="col">ID</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">License No</th>
                                        <th scope="col">Address</th>
                                        <th scope="col">Phone</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Ambulance Status</th>
                                        <th scope="col" class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="table-group-divider">
                                    @foreach ($drivers as $driver)
                                        <tr>
                                            <td class="fw-medium">{{ $driver->id }}</td>
                                            <td class="fw-medium">{{ $driver->name }}</td>
                                            <td class="fw-medium">{{ $driver->driver_license_no }}</td>
                                            <td class="fw-medium">{{ $driver->driver_address }}</td>
                                            <td class="fw-medium">{{ $driver->driver_phone }}</td>
                                            <td class="fw-medium">{{ $driver->email }}</td>
                                            <td class="fw-medium text-center">
                                                @if(!Empty($driver->ambulance_id))
                                                    <iconify-icon icon="twemoji:ambulance" class="fs-10"></iconify-icon>
                                                @else
                                                    No Ambulance
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                <a href="{{ route('chatdriver', $driver->id) }}"
                                                    class="badge bg-success"><iconify-icon icon="line-md:chat-round-dots-twotone"></iconify-icon></a>
                                                <a href="{{ route('editdriver', $driver) }}"
                                                    class="badge bg-primary">Edit</a>
                                                <a href="#" class="badge bg-danger ms-2"
                                                    onclick="event.preventDefault();
                                            Swal.fire({
                                                title: 'Are you sure?',
                                                text: 'You will not be able to recover this driver!',
                                                icon: 'warning',
                                                showCancelButton: true,
                                                confirmButtonColor: '#3085d6',
                                                cancelButtonColor: '#d33',
                                                confirmButtonText: 'Yes, delete it!'
                                            }).then((result) => {
                                                if (result.isConfirmed) {
                                                    document.getElementById('delete-form-{{ $driver->id }}').submit();
                                                }
                                            });">Delete</a>
                                                <form id="delete-form-{{ $driver->id }}"
                                                    action="{{ route('deletedriver', $driver) }}" method="POST"
                                                    style="display: none;">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            </td> 
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        @if ($drivers->isEmpty())
                            <div class="alert alert-warning mt-3">No drivers found.</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
@endsection
