<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Rapid Rescue - Login Here</title>
    <link rel="shortcut icon" type="image/png" href="{{ asset('adminpannel/images/logos/seodashlogo.png') }}" />
    <link rel="stylesheet" href="{{ asset('adminpannel/css/styles.min.css') }}" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        .bg-new{
            background: linear-gradient(to bottom right, rgba(255, 0, 0, 0.8), rgba(255, 102, 102, 0.8));
        }
    </style>
</head>

<body>
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        <div class="position-relative overflow-hidden bg-new min-vh-100 d-flex align-items-center justify-content-center">
            <div class="d-flex align-items-center justify-content-center w-100">
                <div class="row justify-content-center w-100">
                    <div class="col-md-8 col-lg-6 col-xxl-6">
                        <div class="card mb-0">
                            <div class="card-body">
                                <a href="/" class="text-nowrap logo-img text-center d-block py-3 w-100">
                                    <img src="{{asset('userpannel/logo.png')}}" alt="" class="img-fluid w-50">
                                </a>
                                <p class="text-center">RAPID Ambulance Service is a 24/7 Ambulance Unit working 365 days a year! We can be deployed any time. All our units are composed of well trained personnel.</p>
                                <form action="{{ route('login') }}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Username</label>
                                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ old('email') }}">
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-4">
                                        <label for="exampleInputPassword1" class="form-label">Password</label>
                                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="exampleInputPassword1">
                                        @error('password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between mb-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked>
                                            <label class="form-check-label text-dark" for="flexCheckChecked">
                                                Remember this Device
                                            </label>
                                        </div>
                                        <a class="text-danger fw-bold" href="./index.html">Forgot Password?</a>
                                    </div>
                                    <input type="submit" class="btn btn-outline-danger w-100 py-2 fs-5 mb-4" value="Sign In">
                                    <div class="d-flex align-items-center justify-content-center">
                                        <p class="fs-5 mb-0 fw-bold">New to Rapid Rescue</p>
                                        <a class="text-danger fw-bold ms-2" href="/register">Create an account</a>
                                    </div>
                                </form>

                                @if(Session::has('error'))
                                    <div class="alert alert-danger mt-3" role="alert">{{ Session::get('error') }}</div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('adminpannel/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('adminpannel/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js"></script>
</body>

</html>
