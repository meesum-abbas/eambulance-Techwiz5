@extends('UserPannel.app')

@section('title', 'Rapid Rescue - User Profile Page')

@section('content')

<style>
    /* Add box styling for the vertical navbar container */
.nav-container {
    border: 1px solid #ddd; /* Light gray border around the box */
    border-radius: 8px;     /* Rounded corners */
    padding: 15px;          /* Padding inside the box */
    background-color: #f9f9f9; /* Light background color */
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); /* Subtle box shadow */
}

/* Styling for individual nav links */
.nav-link {
    margin-bottom: 10px;    /* Spacing between each link */
    border-radius: 4px;     /* Rounded corners for the links */
    padding: 10px 15px;     /* Padding inside the links */
    text-align: left;       /* Align text to the left */
    color: #333;            /* Dark text color */
}

/* Add hover effect for nav links */
.nav-link:hover {
    background-color: #e9ecef; /* Change background on hover */
    color: #0056b3;            /* Change text color on hover */
}

/* Active link styling */
.nav-link.active {
    background-color: #007bff; /* Primary color background for active link */
    color: #fff;               /* White text for active link */
    border: none;              /* Remove border for active link */
}

</style>

<!-- Header Start -->
<div class="container-fluid bg-breadcrumb">
    <div class="container text-center py-5" style="max-width: 900px;">
        <h4 id="breadcrumbTitle" class="text-white display-4 mb-4 wow fadeInDown" data-wow-delay="0.1s">Profile</h4>
        <ol class="breadcrumb d-flex justify-content-center mb-0 wow fadeInDown" data-wow-delay="0.3s">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li id="breadcrumbText" class="breadcrumb-item active text-primary">Profile</li>
        </ol>
    </div>
</div>
<!-- Header End -->

<div class="container-fluid" style="padding: 70px 90px; background: var(--bs-light);">
    <div class="main-body">
        <div class="row justify-content-around">
            <div class="col-md-4">
                <!-- Add a container for styling -->
                <div class="nav-container">
                    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                        <a class="nav-link active" id="v-pills-profile-tab" data-bs-toggle="pill" href="#v-pills-profile"
                            role="tab" aria-controls="v-pills-profile" aria-selected="true">Profile</a>
                        <a class="nav-link" id="v-pills-messages-tab" data-bs-toggle="pill" href="#v-pills-medprofile"
                            role="tab" aria-controls="v-pills-medprofile" aria-selected="false">Medical Profile</a>
                        <a class="nav-link" id="v-pills-settings-tab" data-bs-toggle="pill" href="#v-pills-instructions"
                            role="tab" aria-controls="v-pills-instructions" aria-selected="false">First-Aid Instructions</a>
                        <a class="nav-link" href="/logout">Logout</a>
                    </div>
                </div>
            </div>


            <div class="col-md-7 tab-content" id="v-pills-tabContent">
                <!-- Profile Tab -->
                <div class="tab-pane fade show active" id="v-pills-profile" role="tabpanel"
                    aria-labelledby="v-pills-profile-tab">
                    <div class="card mb-3" style="box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;">
                        <div class="card-body" style="padding:50px 34px;">
                            <div class="d-flex flex-column align-items-center text-center mb-5">
                                <img src="{{ asset(Auth::user()->image) }}" alt="Admin" class="rounded-circle"
                                    width="150">
                                <div class="mt-3">
                                    <h4>{{ Auth::user()->name }}</h4>
                                    <p class="text-secondary mb-1">{{ Auth::user()->bio }}</p>
                                </div>
                            </div>
                            <!-- Profile details -->
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Email</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    {{ Auth::user()->email }}
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Phone</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    {{ Auth::user()->phone }}
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Date Of Birth</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    {{ Auth::user()->date_of_birth ? \Carbon\Carbon::parse(Auth::user()->date_of_birth)->format('Y-m-d') : 'Not set' }}
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Password</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    ********
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Address</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    {{ Auth::user()->driver_address }}
                                </div>
                            </div>
                            <div class="d-flex flex-column align-items-center text-center mt-3">
                                <button class="btn btn-outline-primary" data-bs-toggle="modal"
                                    data-bs-target="#editModal">Edit</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Medical Profile Tab -->
                <div class="tab-pane fade" id="v-pills-medprofile" role="tabpanel"
                    aria-labelledby="v-pills-messages-tab">
                    <div class="card mb-3" style="box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;">
                        <div class="medical_card card-body" style="padding:20px 34px;">

                            <style>
                                .form-group label {
                                    color: black;
                                    font-weight: bold;
                                }

                                .form-group input {
                                    border: none;
                                }

                                input:disabled {
                                    color: black;
                                    background-color: transparent !important;
                                }
                            </style>

                            <h1 style="color: #ea001e;"><b>Medical Card</b></h1>
                            <hr>

                            @if ($medicalCard)
                                <div class="form-group">
                                    <label for="inputField">Medical History:</label>
                                    <input disabled value="{{ $medicalCard->medical_history }}">
                                </div>

                                <hr>
                                <div class="form-group">
                                    <label for="inputField">Allergies:</label>
                                    <input disabled value="{{ $medicalCard->allergies ?? 'N/A' }}">
                                </div>

                                <hr>
                                <div class="form-group">
                                    <label for="inputField">Emergency Contact:</label>
                                    <div class="card mt-3" style="box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;">
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label for="inputField">Name:</label>
                                                <input disabled value="{{ $medicalCard->name ?? 'N/A' }}">
                                            </div>

                                            <hr>
                                            <div class="form-group">
                                                <label for="inputField">Relation:</label>
                                                <input disabled value="{{ $medicalCard->relation ?? 'N/A' }}">
                                            </div>

                                            <hr>
                                            <div class="form-group">
                                                <label for="inputField">Contact Number:</label>
                                                <input disabled
                                                    value="{{ $medicalCard->contact_no ?? 'N/A' }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <p>No medical card found.</p>
                                <div class="d-flex flex-column align-items-center text-center mt-3">
                                    <button class="btn btn-outline-primary" data-bs-toggle="modal"
                                        data-bs-target="#addModal">Add</button>
                                </div>
                            @endif


                        </div>
                    </div>
                </div>


                <!-- First Aid Instructions Tab -->
                <div class="tab-pane fade" id="v-pills-instructions" role="tabpanel"
                    aria-labelledby="v-pills-settings-tab">
                    <div class="card mb-3" style="box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;">
                        <div class="card-body" style="padding:20px 34px;">

                            <h1 style="color: #ea001e;"><b>First-Aid Instructions</b></h1>
                            <hr>

                            <div class="form-group">
                                <label for="inputField">1. </label>
                                <input disabled style="width: 95%; font-size: 14px;"
                                    value="Stay calm and ensure the safety of the injured person.">
                            </div>

                            <hr>
                            <div class="form-group">
                                <label for="inputField">2:</label>
                                <input disabled style="width: 95%; font-size: 14px;"
                                    value="Call emergency services immediately.">
                            </div>

                            <hr>
                            <div class="form-group">
                                <label for="inputField">3:</label>
                                <input disabled style="width: 95%; font-size: 14px;"
                                    value="Provide first aid as necessary and you are trained to do so.">
                            </div>

                            <hr>
                            <div class="form-group">
                                <label for="inputField">4:</label>
                                <input disabled style="width: 95%; font-size: 14px;"
                                    value="Keep the person warm and comfortable until help arrives.">
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Add Medical Modal -->
<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addModalLabel">Add Medical Card</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addMedicalForm">
                    <div class="mb-3">
                        <label for="medical_histroy" class="form-label">Medical History</label>
                        <input type="text" class="form-control" id="medical_histroy" name="medical_histroy" required placeholder="Medical History">
                    </div>
                    <div class="mb-3">
                        <label for="allergies" class="form-label">Allergies</label>
                        <input type="text" class="form-control" id="allergies" name="allergies" required placeholder="Allergies">
                    </div>
                    <div class="mb-3">
                        <small class="text-warning">Please Provide Emergency Contact No.</small><br>
                        <label for="contact_name" class="form-label">Contact Name</label>
                        <input type="text" class="form-control" id="contact_name" name="contact_name" required placeholder="Contact Name">
                    </div>
                    <div class="mb-3">
                        <label for="relation" class="form-label">Relation</label>
                        <input type="text" class="form-control" id="relation" name="relation" required placeholder="Relation">
                    </div>
                    <div class="mb-3">
                        <label for="contact_number" class="form-label">Contact Number</label>
                        <input type="text" class="form-control" id="contact_number" name="contact_number" pattern="\d{0,11}" maxlength="11" oninput="this.value = this.value.replace(/[^0-9]/g, '');" required placeholder="Contact Number">
                        <small class="form-text text-muted">Please enter a valid contact number (up to 11 digits).</small>
                    </div> 
                    <button type="submit" class="btn btn-primary">Save Medical Card</button>
                </form>
            </div>
            
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Profile</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editProfileForm" enctype="multipart/form-data">
                    <div class="row mb-3"> 
                        <div class="col-md-12">
                            <label for="name" class="form-label">Full Name</label>
                            <input type="text" placeholder="Full Name" required class="form-control" id="name" name="name" value="{{ Auth::user()->name }}">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" placeholder="Email" id="email" name="email" value="{{ Auth::user()->email }}" disabled required>
                            <small>Email cannot be changed</small>
                        </div>
    
                        <div class="col-md-6">
                            <label for="phone" class="form-label">Phone</label>
                            <input type="text" class="form-control" id="phone" name="phone" value="{{ Auth::user()->phone }}" pattern="\d{0,11}" maxlength="11" oninput="this.value = this.value.replace(/[^0-9]/g, '');" required>
                            <small>Please enter a valid contact number (up to 11 digits).</small>
                        </div>
                        
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="date_of_birth" class="form-label">Date Of Birth</label>
                            <input type="date" class="form-control" id="date_of_birth" placeholder="Date Of Birth" name="date_of_birth" required value="{{ Auth::user()->date_of_birth ? \Carbon\Carbon::parse(Auth::user()->date_of_birth)->format('Y-m-d') : '' }}">
                        </div>
    
                        <div class="col-md-6">
                            <label for="address" class="form-label">Address</label>
                            <input type="text" class="form-control" id="address" name="driver_address" placeholder="Address" required value="{{ Auth::user()->driver_address }}">
                        </div>
                    </div>

                    <div class="row mb-3">

                        <div class="col-md-6">
                            <label for="bio" class="form-label">Bio</label>
                            <input type="text" class="form-control" id="bio" name="bio" value="{{ Auth::user()->bio }}" placeholder="Bio" required>
                        </div>
    
                        <div class="col-md-6">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                            <small>Leave blank if you don't want to change the image.</small>
                        </div>
                    </div>
                    
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" form="editProfileForm">Save changes</button>
            </div>
        </div>
    </div>
</div>



@section('scripts')
<script>

    document.addEventListener('DOMContentLoaded', function () {
        const tabs = document.querySelectorAll('.nav-link');
        const breadcrumbTitle = document.getElementById('breadcrumbTitle');
        const breadcrumbText = document.getElementById('breadcrumbText');

        tabs.forEach(tab => {
            tab.addEventListener('click', function () {
                let selectedText = this.innerText;
                breadcrumbTitle.innerText = selectedText;
                breadcrumbText.innerText = selectedText;
            });
        });
    });

    document.addEventListener('DOMContentLoaded', function () {
        const form = document.getElementById('editProfileForm');

        if (form) {
            form.onsubmit = function (event) {
                event.preventDefault(); // Prevent default form submission

                const formData = new FormData(form);

                fetch('{{ route('updateprofile') }}', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert(data.success);
                            // location.reload?();
                        } else {
                            console.error(data.errors);
                        }
                    })
                    .catch(error => {
                        alert('Error: ' + error.message);
                    });
            };
        }
    });
    document.getElementById('addMedicalForm').addEventListener('submit', function (e) {
        e.preventDefault();
        
        var formData = new FormData(this);

        // Send the form data via AJAX
        fetch('{{ route("medical-cards.store") }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            },
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert(data.message); // Display success message
                window.location.reload(); // Optional: Refresh the page
            } else {
                alert('An error occurred: ' + JSON.stringify(data.errors));
            }
        })
        .catch(error => console.error('Error:', error));
    });

</script>

@endsection

@endsection