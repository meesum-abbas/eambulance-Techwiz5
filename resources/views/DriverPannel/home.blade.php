@extends('DriverPannel.app')

@section('title', 'Rapid Rescue - Driver Home Page')

@section('content')

      <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title d-flex align-items-center gap-2 mb-4">
                            Welcome To E-Ambulance <span class="badge bg-success">{{ Auth::user()->name }}</span> </h5> 
                            <p>Your role is crucial in ensuring timely assistance during emergencies.</p>
                            <p>Stay updated with your assigned requests and navigate efficiently to your destinations.</p>    
                    </div>
                </div>
            </div>
        </div>

        <div class="py-6 px-6 text-center">
          <p class="mb-0 fs-4">Design and Developed by <a href="/" target="_blank"
              class="pe-1 text-primary text-decoration-underline">E- Ambulance</a></p>
        </div>
      </div>
    </div> 
@endsection
