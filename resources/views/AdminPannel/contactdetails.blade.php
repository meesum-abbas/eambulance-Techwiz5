@extends('AdminPannel.app')

@section('title', 'Rapid Rescue - Contacts List')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title d-flex justify-content-between align-items-center">
                        <span>
                            <iconify-icon icon="twemoji:telephone" class="fs-6"></iconify-icon> Contacts List
                        </span>
                    </h5>
                    <div class="table-responsive">
                        <table class="table text-nowrap align-middle mb-0">
                            <thead>
                                <tr class="border-2 border-bottom border-primary border-0">
                                    <th scope="col">ID</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Phone</th>
                                    <th scope="col">Subject</th>
                                    <th scope="col">Message</th>
                                </tr>
                            </thead>
                            <tbody class="table-group-divider">
                                @foreach($contacts as $contact)
                                <tr>
                                    <td class="fw-medium">{{ $contact->id }}</td>
                                    <td class="fw-medium">{{ $contact->name }}</td>
                                    <td class="fw-medium">{{ $contact->email }}</td>
                                    <td class="fw-medium">{{ $contact->phone }}</td>
                                    <td class="fw-medium">{{ $contact->subject }}</td>
                                    <td class="fw-medium">{{ $contact->message }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    @if($contacts->isEmpty())
                        <div class="alert alert-warning mt-3">No contacts found.</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
