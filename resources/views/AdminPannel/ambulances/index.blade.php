@extends('AdminPannel.app')

@section('title', 'Rapid Rescue - Ambulance Index Page')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title d-flex justify-content-between align-items-center">
                        <span>
                            <iconify-icon icon="twemoji:ambulance" class="fs-6"></iconify-icon> Ambulance List
                        </span>
                        <a href="{{ route('createambulance') }}" class="badge bg-danger"> Create Ambulance</a>
                    </h5>
                    <div class="table-responsive">
                        <table class="table text-nowrap align-middle mb-0">
                            <thead>
                                <tr class="border-2 border-bottom border-primary border-0">
                                    <th scope="col">ID</th>
                                    <th scope="col">Type</th>
                                    <th scope="col">Equipment</th>
                                    <th scope="col">Cost</th>
                                    <th scope="col">Size</th>
                                    <th scope="col">Ambulance Image</th>
                                    <th scope="col" class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="table-group-divider">
                                @foreach($ambulances as $ambulance)
                                <tr>
                                    <td class="fw-medium">{{ $ambulance->id }}</td>
                                    <td class="fw-medium">{{ $ambulance->type }}</td>
                                    <td class="fw-medium">
                                        @php
                                            $colors = ['bg-primary', 'bg-success', 'bg-danger', 'bg-warning', 'bg-info'];
                                        @endphp
                                        @foreach(explode(',', $ambulance->equipment) as $index => $item)
                                            <span class="badge {{ $colors[$index % count($colors)] }} me-1">{{ trim($item) }}</span>
                                        @endforeach
                                    </td>
                                    <td class="fw-medium">${{ number_format($ambulance->cost, 2) }}</td>
                                    <td class="fw-medium">{{ $ambulance->size }}</td>
                                    <td class="fw-medium">
                                        <img src="{{ asset($ambulance->image) }}" alt="{{ $ambulance->type }} Image" style="width: 100px; height: auto;">
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('editambulance', $ambulance) }}" class="badge bg-primary">Edit</a>
                                        <a href="#" class="badge bg-danger ms-2" onclick="event.preventDefault();
                                            Swal.fire({
                                                title: 'Are you sure?',
                                                text: 'You will not be able to recover this ambulance!',
                                                icon: 'warning',
                                                showCancelButton: true,
                                                confirmButtonColor: '#3085d6',
                                                cancelButtonColor: '#d33',
                                                confirmButtonText: 'Yes, delete it!'
                                            }).then((result) => {
                                                if (result.isConfirmed) {
                                                    document.getElementById('delete-form-{{ $ambulance->id }}').submit();
                                                }
                                            });">Delete</a>
                                        <form id="delete-form-{{ $ambulance->id }}" action="{{ route('deleteambulance', $ambulance) }}" method="POST" style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    @if($ambulances->isEmpty())
                        <div class="alert alert-warning mt-3">No ambulances found.</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
