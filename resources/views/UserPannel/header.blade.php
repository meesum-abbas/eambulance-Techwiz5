<!-- spinner Start -->
<div id="spinner"
    class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
    <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
        <spazn class="sr-only">Loading...</spazn>
    </div>
</div>
<!-- spinner End -->

<!-- Topbar Start -->
<div class="container-fluid topbar bg-secondary d-none d-xl-block w-100">
    <div class="container">
        <div class="row gx-0 align-items-center" style="height: 45px;">
            <div class="col-lg-6 text-center text-lg-start mb-lg-0">
                <div class="d-flex flex-wrap">
                    <a class="text-muted me-4"><i class="fas fa-map-marker-alt text-primary me-2"></i>Find an
                        Ambulance</a>
                    <a href="tel:+01234567890" class="text-muted me-4"><i
                            class="fas fa-phone-alt text-primary me-2"></i>+92 0317 2959985</a>
                    <a href="mailto:example@gmail.com" class="text-muted me-0"><i
                            class="fas fa-envelope text-primary me-2"></i>info@example.com</a>
                </div>
            </div>
            <div class="col-lg-6 text-center text-lg-end">
                <div class="d-flex align-items-center justify-content-end">
                    <a class="btn btn-light btn-sm-square rounded-circle me-3"><i class="fab fa-facebook-f"></i></a>
                    <a class="btn btn-light btn-sm-square rounded-circle me-3"><i class="fab fa-twitter"></i></a>
                    <a class="btn btn-light btn-sm-square rounded-circle me-3"><i class="fab fa-instagram"></i></a>
                    <a class="btn btn-light btn-sm-square rounded-circle me-0"><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Topbar End -->

<!-- Navbar & Hero Start -->
<div class="container-fluid nav-bar sticky-top px-0 px-lg-4 py-2 py-lg-0">
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light">
            <a href="/" class="navbar-brand p-0">
                <img src="{{asset('userpannel/logo.png')}}" alt="" class="img-fluid">
                <!-- <h1 class="display-6 text-primary" style="color: #8a8082 !important;">
                    <i style="color: #ea001e !important;" class="fas fa-stethoscope me-3"></i>Rapid Rescue
                </h1> -->
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="fa fa-bars"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbar~Collapse">
                <div class="navbar-nav mx-auto py-0">
                    <a href="/" class="nav-item nav-link" id="homeLink">Home</a>
                    <a href="#features" class="nav-item nav-link" id="featuresLink">Features</a>
                    <a href="#ambulances" class="nav-item nav-link" id="ambulancesLink">Ambulances</a>
                    <a href="#services" class="nav-item nav-link" id="servicesLink">Services</a>
                    <a href="#about-us" class="nav-item nav-link" id="aboutLink">About</a>
                    <a href="#feedback-form" class="nav-item nav-link" id="">FeedBack</a>
                    <a href="#Contact-form" class="nav-item nav-link" id="contactLink">Contact</a>
                </div>

                @guest
                    <a href="/login" class="btn btn-primary rounded-pill py-2 px-4">Login/Register</a>
                @endguest

                @auth
                    <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">

                        <li class="nav-item dropdown">
                            <a class="nav-link nav-icon-hover" id="drop2" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="{{ asset(Auth::user()->image) }}" alt="User Image" width="35" height="35"
                                    class="rounded-circle"><span class="ms-2">{{ Auth::user()->name }}</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                                <div class="message-body">
                                    <a href="{{ route('profile') }}" class="d-flex align-items-center gap-2 dropdown-item">
                                        <i class="fas fa-user" style="font-size: 16px !important;"></i>
                                        <p class="mb-0 fs-3" style="font-size: 16px !important;">Profile</p>
                                    </a>
                                    <a class="d-flex align-items-center gap-2 dropdown-item">
                                        <i class="fas fa-stethoscope" style="font-size: 16px !important;"></i>

                                        <p class="mb-0 fs-3" style="font-size: 16px !important;">Medical Profile</p>
                                    </a>
                                    <a class="d-flex align-items-center gap-2 dropdown-item">
                                        <!-- <i class="fas fa-stethoscope" style="font-size: 16px !important;"></i> -->
                                        <i class="fa fa-kit-medical" style="font-size: 16px !important;"></i>
                                        <p class="mb-0 fs-3" style="font-size: 16px !important;">First-Aid Instructions</p>
                                    </a>
                                    <a href="/logout" class="btn btn-outline-primary mx-3 mt-2 d-block">Logout</a>
                                </div>
                            </div>
                        </li>
                    </ul>
                @endauth
            </div>
        </nav>
    </div>
</div>

<!-- Navbar & Hero End -->


<script>
    document.addEventListener('DOMContentLoaded', function () {
        const sections = document.querySelectorAll('section'); // Assuming each section is wrapped in <section>
        const navLinks = document.querySelectorAll('.navbar-nav .nav-link');

        function setActiveLink() {
            let scrollPos = window.scrollY + 200; // Adjust this offset as necessary
            sections.forEach(section => {
                if (scrollPos >= section.offsetTop && scrollPos < section.offsetTop + section.offsetHeight) {
                    const id = section.getAttribute('id');
                    navLinks.forEach(link => {
                        link.classList.remove('active');
                        if (link.getAttribute('href') === `#${id}`) {
                            link.classList.add('active');
                        }
                    });
                }
            });
        }

        window.addEventListener('scroll', setActiveLink);
        setActiveLink(); // Call once to set initial active link
    });

</script>