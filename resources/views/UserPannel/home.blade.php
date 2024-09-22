@extends('UserPannel.app')

@section('title', 'Rapid Rescue - Home Page')

@section('content')


    <!-- Carousel Start -->
    <div class="header-carousel">
        <div id="carouselId" class="carousel slide" data-bs-ride="carousel" data-bs-interval="false">
            <div class="carousel-inner" role="listbox">
                <div class="carousel-item active">
                    <img src="{{ asset('userpannel/img/ambulance-bg.jpg') }}" class="img-fluid w-100" alt="First slide" />
                    <div class="carousel-caption">
                        <div class="container py-4">
                            <div class="row g-5">
                                <div class="col-lg-6 fadeInLeft animated" data-animation="fadeInLeft" data-delay="1s"
                                    style="animation-delay: 1s;">
                                    <div class="bg-secondary rounded p-5">
                                        <h4 class="text-white mb-4">EMERGENCY REQUEST</h4>
                                        {{-- Success Message --}}
                                        @if (session('success'))
                                            <script>
                                                Swal.fire({
                                                    icon: 'success',
                                                    title: 'Success!',
                                                    text: '{{ session('success') }}',
                                                    confirmButtonColor: '#3085d6',
                                                    confirmButtonText: 'OK'
                                                });
                                            </script>
                                        @endif

                                        {{-- Error Messages --}}
                                        @if ($errors->any())
                                            <script>
                                                Swal.fire({
                                                    icon: 'error',
                                                    title: 'Oops...',
                                                    html: `
                                                        <ul>
                                                            @foreach ($errors->all() as $error)
                                                                <li>{{ $error }}</li>
                                                            @endforeach
                                                        </ul>
                                                    `,
                                                    confirmButtonColor: '#d33',
                                                    confirmButtonText: 'OK'
                                                });
                                            </script>
                                        @endif
                                        <form method="POST" action="{{ route('emergency-requests') }}">
                                            @csrf
                                            <div class="row g-3">
                                                <div class="col-12">
                                                    <input class="form-control" type="text" placeholder="Hospital Name"
                                                        name="hospital_name" aria-label="Hospital Name">
                                                </div>
                                                <div class="col-12">
                                                    <div class="input-group">
                                                        <div
                                                            class="d-flex align-items-center bg-light text-body rounded-start p-2">
                                                            <span class="fas fa-mobile"></span><span class="ms-1">Mobile
                                                                No</span>
                                                        </div>
                                                        <input class="form-control" type="tel" placeholder="Mobile No"
                                                            name="mobile_no" aria-label="Mobile No">
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="input-group">
                                                        <div
                                                            class="d-flex align-items-center bg-light text-body rounded-start p-2">
                                                            <span class="fas fa-map-marker-alt"></span><span
                                                                class="ms-1">Address</span>
                                                        </div>
                                                        <input class="form-control" type="text" placeholder="Address"
                                                            name="address" aria-label="Address">
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="input-group">
                                                        <div
                                                            class="d-flex align-items-center bg-light text-body rounded-start p-2">
                                                            <span class="fas fa-map-marker-alt"></span><span
                                                                class="ms-1">Pickup Address</span>
                                                        </div>
                                                        <input class="form-control" type="text" name="pickup_address"
                                                            placeholder="Current Location" aria-label="Pickup Address"
                                                            id="pickupAddress">
                                                    </div>
                                                    <button type="button" class="btn btn-light mt-2" id="getLocation">Get
                                                        Location</button>

                                                </div>
                                                <div class="col-12">
                                                    <input type="hidden" id="latitude" name="latitude"
                                                        class="form-control mt-2" placeholder="Latitude" readonly>
                                                </div>
                                                <div class="col-12">
                                                    <input type="hidden" id="longitude" name="longitude"
                                                        class="form-control mt-2" placeholder="Longitude" readonly>
                                                </div>
                                                <div class="col-12">
                                                    <select id="typeSelect" name="type" class="form-select"
                                                        aria-label="Select type">
                                                        <option selected disabled>Select Type</option>
                                                        <option value="emergency">Emergency</option>
                                                        <option value="non-emergency">Non-Emergency</option>
                                                    </select>
                                                </div>
                                                <div class="col-12">
                                                    <button class="btn btn-light w-100 py-2">Hit This Button</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>

                                </div>

                                <div class="col-lg-6 d-none d-lg-flex justify-content-center align-items-center fadeInRight animated"
                                    data-animation="fadeInRight" data-delay="1s" style="animation-delay: 1s;">
                                    <div class="text-start">
                                        <h1 class="display-5 text-white">Emergency Services Available 24/7</h1>
                                        <p>Your safety is our priority. Contact us for immediate assistance.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Carousel End -->

    <!-- Features Start -->
    <section class="container-fluid feature py-5" id="features">

        <div class="container py-5">
            <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 800px;">
                <h1 class="display-5 text-capitalize mb-3">Rapid Resuce <span class="text-primary">Features</span></h1>
                <p class="mb-0">Our Rapid Rescue System provides exceptional emergency response services. We ensure timely
                    and efficient assistance during critical situations, leveraging advanced technology and a dedicated team
                    to provide top-notch care.</p>
            </div>
            <div class="row g-4 align-items-center">
                <div class="col-xl-4">
                    <div class="row gy-4 gx-0">
                        <div class="col-12 wow fadeInUp" data-wow-delay="0.1s">
                            <div class="feature-item">
                                <div class="feature-icon">
                                    <span class="fa fa-ambulance fa-2x"></span>
                                </div>
                                <div class="ms-4">
                                    <h5 class="mb-3">Rapid Response</h5>
                                    <p class="mb-0">Our ambulances are equipped to reach the scene quickly and provide
                                        immediate medical attention, ensuring every second counts.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 wow fadeInUp" data-wow-delay="0.3s">
                            <div class="feature-item">
                                <div class="feature-icon">
                                    <span class="fa fa-clock fa-2x"></span>
                                </div>
                                <div class="ms-4">
                                    <h5 class="mb-3">24/7 Availability</h5>
                                    <p class="mb-0">Our service operates around the clock to be there for you whenever an
                                        emergency strikes, providing peace of mind at all hours.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 col-xl-4 wow fadeInUp" data-wow-delay="0.2s">
                    <img src="{{ asset('userpannel/img/home/ambulance.png') }}" class="img-fluid w-100"
                        style="object-fit: cover;" alt="Emergency Response">
                </div>
                <div class="col-xl-4">
                    <div class="row gy-4 gx-0">
                        <div class="col-12 wow fadeInUp" data-wow-delay="0.1s">
                            <div class="feature-item justify-content-end">
                                <div class="text-end me-4">
                                    <h5 class="mb-3">State-of-the-Art Equipment</h5>
                                    <p class="mb-0">We utilize the latest technology and medical equipment to ensure the
                                        highest level of care during emergencies.</p>
                                </div>
                                <div class="feature-icon">
                                    <span class="fa fa-cogs fa-2x"></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 wow fadeInUp" data-wow-delay="0.3s">
                            <div class="feature-item justify-content-end">
                                <div class="text-end me-4">
                                    <h5 class="mb-3">Expert Medical Team</h5>
                                    <p class="mb-0">Our team consists of highly trained paramedics and emergency medical
                                        technicians who are ready to provide top-quality care in any situation.</p>
                                </div>
                                <div class="feature-icon">
                                    <span class="fa fa-user-md fa-2x"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Features End -->

    <!-- Car categories Start -->
    <section class="container-fluid categories py-5" id="ambulances">
        <div class="container pb-5">
            <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 800px;">
                <h1 class="display-5 text-capitalize mb-3">Ambulances <span class="text-primary">Showcase</span></h1>
                <p class="mb-0"> Explore our diverse fleet of ambulances, equipped with the latest medical technology to provide urgent care and emergency services. Each ambulance is carefully maintained to ensure the highest standards of safety and efficiency, ready to respond to any medical situation.</p> 
            </div>
            <div class="categories-carousel owl-carousel wow fadeInUp" data-wow-delay="0.1s"> 
                @foreach ($ambulancelist as $ambulance)
                    <div class="categories-item p-4">
                        <div class="categories-item-inner">
                            <div class="categories-img rounded-top">
                                <img src="{{ asset($ambulance->image) }}" class="img-fluid w-100  rounded-top"
                                    alt="" style="height: 200px">
                            </div>
                            <div class="categories-content rounded-bottom p-4">
                                <h4>{{ $ambulance->type }}</h4>
                                <div class="categories-review mb-4">
                                    <div class="me-3">4.5 Review</div>
                                    <div class="d-flex justify-content-center text-secondary">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star text-body"></i>
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <h4 class="bg-white text-primary rounded-pill py-2 px-4 mb-0">
                                        ${{ $ambulance->cost }}/Day</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach 
            </div>
        </div>
    </section>
    <!-- Car categories End -->

    <!-- Fact Counter -->
    <div class="container-fluid counter bg-secondary py-5">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-md-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="counter-item text-center">
                        <div class="counter-item-icon mx-auto">
                            <i class="fas fa-heartbeat fa-2x"></i>
                        </div>
                        <div class="counter-counting my-3">
                            <span class="text-white fs-2 fw-bold" data-toggle="counter-up">1,245</span>
                            <span class="h1 fw-bold text-white">+</span>
                        </div>
                        <h4 class="text-white mb-0">Lives Saved</h4>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="counter-item text-center">
                        <div class="counter-item-icon mx-auto">
                            <i class="fas fa-ambulance fa-2x"></i>
                        </div>
                        <div class="counter-counting my-3">
                            <span class="text-white fs-2 fw-bold" data-toggle="counter-up">78</span>
                            <span class="h1 fw-bold text-white">+</span>
                        </div>
                        <h4 class="text-white mb-0">Ambulances Deployed</h4>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="counter-item text-center">
                        <div class="counter-item-icon mx-auto">
                            <i class="fas fa-users fa-2x"></i>
                        </div>
                        <div class="counter-counting my-3">
                            <span class="text-white fs-2 fw-bold" data-toggle="counter-up">35</span>
                            <span class="h1 fw-bold text-white">+</span>
                        </div>
                        <h4 class="text-white mb-0">Dedicated Team Members</h4>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="0.7s">
                    <div class="counter-item text-center">
                        <div class="counter-item-icon mx-auto">
                            <i class="fas fa-road fa-2x"></i>
                        </div>
                        <div class="counter-counting my-3">
                            <span class="text-white fs-2 fw-bold" data-toggle="counter-up">15,300</span>
                            <span class="h1 fw-bold text-white">+</span>
                        </div>
                        <h4 class="text-white mb-0">Total Kilometers Traveled</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Fact Counter -->

    <!-- Services Start -->
    <section class="container-fluid service py-5" id="services">
        <div class="container py-5">
            <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 800px;">
                <h1 class="display-5 text-capitalize mb-3">Rapid <span class="text-primary">Rescue Services</span></h1>
                <p class="mb-0">Our emergency response services are designed to provide quick and efficient assistance in
                    critical situations. From rapid ambulance dispatch to expert medical support, we are committed to saving
                    lives and delivering exceptional care.</p>
            </div>
            <div class="row g-4">
                <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="service-item p-4">
                        <div class="service-icon mb-4">
                            <i class="fa fa-phone-alt fa-2x"></i>
                        </div>
                        <h5 class="mb-3">Emergency Hotline</h5>
                        <p class="mb-0">24/7 emergency hotline for immediate assistance. Reach out to us anytime for
                            urgent
                            medical help.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="service-item p-4">
                        <div class="service-icon mb-4">
                            <i class="fa fa-heartbeat fa-2x"></i>
                        </div>
                        <h5 class="mb-3">Medical Support</h5>
                        <p class="mb-0">Professional medical support provided by experienced paramedics during
                            emergencies.
                            Your health and safety are our top priorities.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="service-item p-4">
                        <div class="service-icon mb-4">
                            <i class="fa fa-ambulance fa-2x"></i>
                        </div>
                        <h5 class="mb-3">Rapid Ambulance Dispatch</h5>
                        <p class="mb-0">Quick deployment of fully equipped ambulances to your location, ensuring timely
                            transportation to medical facilities.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="service-item p-4">
                        <div class="service-icon mb-4">
                            <i class="fa fa-shield-alt fa-2x"></i>
                        </div>
                        <h5 class="mb-3">Emergency Preparedness</h5>
                        <p class="mb-0">Comprehensive emergency preparedness plans and drills to ensure readiness and
                            effective response during crises.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="service-item p-4">
                        <div class="service-icon mb-4">
                            <i class="fa fa-hospital fa-2x"></i>
                        </div>
                        <h5 class="mb-3">Hospital Coordination</h5>
                        <p class="mb-0">Efficient coordination with hospitals to ensure seamless transition from
                            emergency
                            response to in-hospital care.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="service-item p-4">
                        <div class="service-icon mb-4">
                            <i class="fa fa-medkit fa-2x"></i>
                        </div>
                        <h5 class="mb-3">First Aid Training</h5>
                        <p class="mb-0">Offering first aid training programs to equip individuals with essential skills
                            to
                            handle emergencies effectively.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Services End -->

    <!-- About Start -->
    <section class="container-fluid overflow-hidden about py-5" id="about-us">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-xl-6 wow fadeInLeft" data-wow-delay="0.2s">
                    <div class="about-item">
                        <div class="pb-5">
                            <h1 class="display-5 text-capitalize">About <span class="text-primary">Our Rapid Rescue
                                    System</span></h1>
                            <p class="mb-0">At Rapid Rescue, we are dedicated to providing prompt and efficient emergency
                                response services. Our mission is to ensure that help is available when it's needed the
                                most, with a focus on quick response times and high-quality care.</p>
                        </div>
                        <div class="row g-4">
                            <div class="col-lg-6">
                                <div class="about-item-inner border p-4">
                                    <div class="about-icon mb-4">
                                        <img src="{{ asset('userpannel/img/about-icon-1.png') }}"
                                            class="img-fluid w-50 h-50" alt="Vision Icon">
                                    </div>
                                    <h5 class="mb-3">Our Vision</h5>
                                    <p class="mb-0">To be the leading provider of emergency response services, setting
                                        the
                                        standard for rapid and effective medical care during crises.</p>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="about-item-inner border p-4">
                                    <div class="about-icon mb-4">
                                        <img src="{{ asset('userpannel/img/about-icon-2.png') }}"
                                            class="img-fluid h-50 w-50" alt="Mission Icon">
                                    </div>
                                    <h5 class="mb-3">Our Mission</h5>
                                    <p class="mb-0">To deliver exceptional emergency medical services through a
                                        commitment
                                        to rapid response, advanced technology, and a skilled team.</p>
                                </div>
                            </div>
                        </div>
                        <p class="text-item my-4">Our Rapid Rescue System is designed to address emergencies swiftly and
                            efficiently. We pride ourselves on our ability to adapt to various situations and provide the
                            best possible care in critical moments.</p>
                        <div class="row g-4">
                            <div class="col-lg-6">
                                <div class="text-center rounded bg-secondary p-4">
                                    <h1 class="display-6 text-white">20</h1>
                                    <h5 class="text-light mb-0">Years Of Experience</h5>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="rounded">
                                    <p class="mb-2"><i class="fa fa-check-circle text-primary me-1"></i> Experienced
                                        Paramedic Team</p>
                                    <p class="mb-2"><i class="fa fa-check-circle text-primary me-1"></i>
                                        State-of-the-Art
                                        Equipment</p>
                                    <p class="mb-2"><i class="fa fa-check-circle text-primary me-1"></i> Rapid Response
                                        Times</p>
                                    <p class="mb-0"><i class="fa fa-check-circle text-primary me-1"></i> 24/7
                                        Availability
                                    </p>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-xl-6 wow fadeInRight" data-wow-delay="0.2s">
                    <div class="about-img">
                        <div class="img-1">
                            <img src="{{ asset('userpannel/img/home/ambulance5.png') }}"
                                class="img-fluid rounded h-100 w-100" alt="Emergency Response">
                        </div>
                        <div class="img-2">
                            <img src="{{ asset('userpannel/img/home/ambulance4.png') }}" class="img-fluid rounded w-100"
                                alt="Ambulance Service">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- About End -->
<!-- Feedback Start -->
<section class="container-fluid contact py-5" id="feedback-form">
    <div class="container py-5">
        <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 800px;">
            <h1 class="display-5 text-capitalize text-primary mb-3">Feed Back</h1>
            <p class="mb-0">For urgent assistance, please fill out the contact form below. Our team is ready to respond
                quickly to your emergency needs. If you require immediate help, call our emergency hotline at
                <strong>123-456-7890</strong>. We appreciate your trust in Rapid Rescue.
            </p>
        </div>

        <div class="row g-5">

            <div class="col-xl-12 wow fadeInUp" data-wow-delay="0.1s">
                <div class="bg-secondary p-5 rounded">
                    <h4 class="text-primary mb-4">Send Your Message</h4>
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('feedback.store') }}" method="POST">
                        @csrf
                        <div class="row g-4">
                            <div class="col-lg-12 col-xl-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="name" name="name"
                                        placeholder="Your Name" required>
                                    <label for="name">Your Name</label>
                                </div>
                            </div>
                            <div class="col-lg-12 col-xl-6">
                                <div class="form-floating">
                                    <input type="email" class="form-control" id="email" name="email"
                                        placeholder="Your Email" required>
                                    <label for="email">Your Email</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <textarea class="form-control" name="message" placeholder="Leave a message here"
                                        id="message" style="height: 160px" required></textarea>
                                    <label for="message">Message</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <button class="btn btn-light w-100 py-3" type="submit">Send Message</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>

        </div>

    </div>
</section>
<!-- Feedback End -->
    
    <!-- Car Steps Start -->
    <div class="container-fluid steps py-5">
        <div class="container py-5">
            <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 800px;">
                <h1 class="display-5 text-capitalize text-white mb-3">Rapid<span class="text-primary"> Rescue
                        Process</span>
                </h1>
                <p class="mb-0 text-white">Our streamlined process ensures swift and effective response during emergencies.
                    Follow these steps to access our services and receive the assistance you need quickly and efficiently.
                </p>
            </div>
            <div class="row g-4">
                <div class="col-lg-3 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="steps-item p-4 mb-4">
                        <h4> Book in Just 2 tabs </h4>
                        <p class="mb-0">Fill the above form in banner with correct information and select rathers its
                            urgent or not.</p>
                        <div class="setps-number">01.</div>
                    </div>
                </div>
                <div class="col-lg-3 wow fadeInUp" data-wow-delay="0.3s">

                    <div class="steps-item p-4 mb-4">
                        <h4>Near by Drivers</h4>
                        <p class="mb-0">In some time the required equipments and near by driver will dispatch for you.
                        </p>
                        <div class="setps-number">02.</div>
                    </div>
                </div>

                <div class="col-lg-3 wow fadeInUp" data-wow-delay="0.3s">

                    <div class="steps-item p-4 mb-4">
                        <h4 class="fs-5">Dispatch & Coordination</h4>
                        <p class="mb-0">Our team will quickly dispatch the necessary resources and coordinate.</p>
                        <div class="setps-number">03.</div>
                    </div>
                </div>

                <div class="col-lg-3 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="steps-item p-4 mb-4">
                        <h4>Receive Assistance</h4>
                        <p class="mb-0">Experience timely and professional experts handle the situation and
                            provide the necessary support.</p>
                        <div class="setps-number">04.</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Car Steps End -->

    <!-- Contact Start -->
    <section class="container-fluid contact py-5" id="Contact-form">
        <div class="container py-5">
            <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 800px;">
                <h1 class="display-5 text-capitalize text-primary mb-3">Contact Us</h1>
                <p class="mb-0">For urgent assistance, please fill out the contact form below. Our team is ready to
                    respond
                    quickly to your emergency needs. If you require immediate help, call our emergency hotline at
                    <strong>123-456-7890</strong>. We appreciate your trust in Rapid Rescue.
                </p>
            </div>

            <div class="row g-5">
                <div class="col-12 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="row g-5">
                        <div class="col-md-6 col-lg-6 col-xl-3">
                            <div class="contact-add-item p-4">
                                <div class="contact-icon mb-4">
                                    <i class="fas fa-map-marker-alt fa-2x"></i>
                                </div>
                                <div>
                                    <h4>Address</h4>
                                    <p class="mb-0">456 Health St, Karachi, Pakistan</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="0.3s">
                            <div class="contact-add-item p-4">
                                <div class="contact-icon mb-4">
                                    <i class="fas fa-envelope fa-2x"></i>
                                </div>
                                <div>
                                    <h4>Mail Us</h4>
                                    <p class="mb-0">info@rapidrescue.com</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="0.5s">
                            <div class="contact-add-item p-4">
                                <div class="contact-icon mb-4">
                                    <i class="fa fa-phone-alt fa-2x"></i>
                                </div>
                                <div>
                                    <h4>Telephone</h4>
                                    <p class="mb-0">(+92) 300 123 4567</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="0.7s">
                            <div class="contact-add-item p-4">
                                <div class="contact-icon mb-4">
                                    <i class="fab fa-firefox-browser fa-2x"></i>
                                </div>
                                <div>
                                    <h4>Website</h4>
                                    <p class="mb-0">www.rapidrescue.com</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="bg-secondary p-5 rounded">
                        <h4 class="text-primary mb-4">Send Your Message</h4>
                        <form action="{{ route('contact.store') }}" method="POST">
                            @csrf
                            <div class="row g-4">
                                <div class="col-lg-12 col-xl-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="name" name="name"
                                            placeholder="Your Name" required>
                                        <label for="name">Your Name</label>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-xl-6">
                                    <div class="form-floating">
                                        <input type="email" class="form-control" id="email" name="email"
                                            placeholder="Your Email" required>
                                        <label for="email">Your Email</label>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-xl-6">
                                    <div class="form-floating">
                                        <input type="tel" class="form-control" id="phone" name="phone" placeholder="Phone"
                                            required>
                                        <label for="phone">Your Phone</label>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-xl-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="subject" name="subject"
                                            placeholder="Subject" required>
                                        <label for="subject">Subject</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating">
                                        <textarea class="form-control" placeholder="Leave a message here" id="message"
                                            name="message" style="height: 160px" required></textarea>
                                        <label for="message">Message</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-light w-100 py-3">Send Message</button>
                                </div>
                            </div>
                        </form>
                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                    </div>
                </div>
                <div class="col-12 col-xl-1 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="d-flex flex-xl-column align-items-center justify-content-center">
                        <a class="btn btn-xl-square btn-light rounded-circle mb-0 mb-xl-4 me-4 me-xl-0" href=""><i
                                class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-xl-square btn-light rounded-circle mb-0 mb-xl-4 me-4 me-xl-0" href=""><i
                                class="fab fa-twitter"></i></a>
                        <a class="btn btn-xl-square btn-light rounded-circle mb-0 mb-xl-4 me-4 me-xl-0" href=""><i
                                class="fab fa-instagram"></i></a>
                        <a class="btn btn-xl-square btn-light rounded-circle mb-0 mb-xl-0 me-0 me-xl-0" href=""><i
                                class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
                <div class="col-12 col-xl-5 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="p-5 bg-light rounded">
                        <div class="bg-white rounded p-4 mb-4">
                            <h4 class="mb-3">Main Branch</h4>
                            <div class="d-flex align-items-center flex-shrink-0 mb-3">
                                <p class="mb-0 text-dark me-2">Address:</p><i
                                    class="fas fa-map-marker-alt text-primary me-2"></i>
                                <p class="mb-0">101 Rescue Rd, Karachi, Pakistan</p>

                            </div>
                            <div class="d-flex align-items-center">
                                <p class="mb-0 text-dark me-2">Telephone:</p><i
                                    class="fa fa-phone-alt text-primary me-2"></i>
                                <p class="mb-0">(+92) 300 123 4567</p>
                            </div>
                        </div>
                        <div class="bg-white rounded p-4 mb-4">
                            <h4 class="mb-3">Branch 02</h4>
                            <div class="d-flex align-items-center mb-3">
                                <p class="mb-0 text-dark me-2">Address:</p><i
                                    class="fas fa-map-marker-alt text-primary me-2"></i>
                                <p class="mb-0">789 Care Ave, Lahore, Pakistan</p>
                            </div>
                            <div class="d-flex align-items-center">
                                <p class="mb-0 text-dark me-2">Telephone:</p><i
                                    class="fa fa-phone-alt text-primary me-2"></i>
                                <p class="mb-0">(+92) 301 234 5678</p>
                            </div>
                        </div>
                        <div class="bg-white rounded p-4 mb-0">
                            <h4 class="mb-3">Branch 03</h4>
                            <div class="d-flex align-items-center mb-3">
                                <p class="mb-0 text-dark me-2">Address:</p><i
                                    class="fas fa-map-marker-alt text-primary me-2"></i>
                                <p class="mb-0">456 Health St, Islamabad, Pakistan</p>
                            </div>
                            <div class="d-flex align-items-center">
                                <p class="mb-0 text-dark me-2">Telephone:</p><i
                                    class="fa fa-phone-alt text-primary me-2"></i>
                                <p class="mb-0">(+92) 302 345 6789</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="rounded">
                        <h5>Track Drivers' Locations</h5>
                        <div id="usermap" class="w-100" style="height: 400px;"></div>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <!-- Contact End -->

@section('scripts')
    <script>
        $(document).ready(function() {
            $('#getLocation').on('click', function() {
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(function(position) {
                        const lat = position.coords.latitude;
                        const lng = position.coords.longitude;
                        $('#latitude').val(lat);
                        $('#longitude').val(lng);

                        const url =
                            `https://nominatim.openstreetmap.org/reverse?lat=${lat}&lon=${lng}&format=json`;

                        $.get(url, function(data) {
                            if (data && data.display_name) {
                                $('#pickupAddress').val(data.display_name);
                            } else {
                                alert("Unable to retrieve address.");
                            }
                        }).fail(function() {
                            alert("Error retrieving address.");
                        });

                    }, function() {
                        alert("Unable to retrieve your location.");
                    });
                } else {
                    alert("Geolocation is not supported by this browser.");
                }
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            const map = L.map('usermap').setView([51.505, -0.09], 2);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
            }).addTo(map);

            @foreach ($drivers as $driver)
                @if ($driver->latitude && $driver->longitude)
                    L.marker([{{ $driver->latitude }}, {{ $driver->longitude }}])
                        .addTo(map)
                        .bindPopup(`
                        <div style="text-align: center;">
                                <img src="{{ asset($driver->image) }}" alt="Driver Image" style="width: 100px; height: auto; border-radius: 50%;">
                                <br><b>{{ $driver->name }}</b><br>{{ $driver->driver_address }}<br>
                            </div>
                        `)
                        .on('click', function() {
                        map.setView([{{ $driver->latitude }}, {{ $driver->longitude }}], 14); // Zoom in on marker
                    });
                @endif
            @endforeach
        });
    </script>
@endsection
@endsection
