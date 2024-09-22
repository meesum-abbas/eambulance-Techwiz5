@extends('AdminPannel.app')

@section('title', 'Rapid Rescue - Feedback List')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title d-flex justify-content-between align-items-center">
                        <span>
                            <iconify-icon icon="twemoji:mailbox" class="fs-6"></iconify-icon> Feedback List
                        </span>
                    </h5>
                    <div class="table-responsive">
                        <table class="table text-nowrap align-middle mb-0">
                            <thead>
                                <tr class="border-2 border-bottom border-primary border-0">
                                    <th scope="col">ID</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Message</th>
                                    <th scope="col">Submitted At</th>
                                </tr>
                            </thead>
                            <tbody class="table-group-divider">
                                @foreach($feedbacks as $feedback)
                                <tr>
                                    <td class="fw-medium">{{ $feedback->id }}</td>
                                    <td class="fw-medium">{{ $feedback->name }}</td>
                                    <td class="fw-medium">{{ $feedback->email }}</td>
                                    <td class="fw-medium">{{ $feedback->message }}</td>
                                    <td class="fw-medium">{{ $feedback->created_at->format('Y-m-d H:i:s') }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    @if($feedbacks->isEmpty())
                        <div class="alert alert-warning mt-3">No feedback found.</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
