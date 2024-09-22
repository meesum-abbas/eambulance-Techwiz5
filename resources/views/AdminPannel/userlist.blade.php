@extends('AdminPannel.app')

@section('title', 'Rapid Rescue - Users List Page')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"><i class="fa-solid fa-user"></i> User List</h5>
                    <div class="table-responsive">
                        <table class="table text-nowrap align-middle mb-0">
                            <thead>
                                <tr class="border-2 border-bottom border-primary border-0">
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col" class="text-center">Phone</th>
                                    <th scope="col" class="text-center">Date of Birth</th>
                                    <th scope="col" class="text-center">User Image</th>
                                    <th scope="col" class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="table-group-divider">
                                @foreach($userslist as $user)
                                <tr>
                                    <td class="ps-0 fw-medium">
                                        <span class="table-link1 text-truncate d-block">{{ $user->name ?? 'N/A' }}</span>
                                    </td>
                                    <td>
                                        <a href="mailto:{{ $user->email ?? '#' }}" class="link-primary text-dark fw-medium d-block">{{ $user->email ?? 'N/A' }}</a>
                                    </td>
                                    <td class="text-center fw-medium">{{ $user->phone ?? 'N/A' }}</td>
                                    <td class="text-center fw-medium">
                                        {{ $user->date_of_birth ? $user->date_of_birth->format('Y-m-d') : 'N/A' }}
                                    </td>
                                    <td class="text-center fw-medium">
                                        @if($user->image)
                                            <img src="{{ asset($user->image) }}" alt="User Image" style="width: 50px; height: 50px; border-radius: 50%;">
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <a href="" class="badge bg-primary">Edit</a>
                                        <a href="" class="badge bg-danger">Delete</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
