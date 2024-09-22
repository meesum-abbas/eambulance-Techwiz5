<aside class="left-sidebar">
    <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
            <a class="text-nowrap logo-img">
                <img src="{{asset('userpannel/logo.png')}}" alt="" class="img-fluid"> 
            </a>
            <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                <i class="ti ti-x fs-8"></i>
            </div>
        </div>
        <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
            <ul id="sidebarnav">
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-6"></i>
                    <span class="hide-menu">Admin Dashboard</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('dashboard') }}" aria-expanded="false">
                        <span>
                            <iconify-icon icon="solar:home-smile-bold-duotone" class="fs-6"></iconify-icon>
                        </span>
                        <span class="hide-menu">Dashboard</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('showusers') }}" aria-expanded="false">
                        <span>
                            <iconify-icon icon="mdi:information" class="fs-6"></iconify-icon>
                        </span>
                        <span class="hide-menu">User Management</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('showambulance') }}" aria-expanded="false">
                        <span>
                            <iconify-icon icon="twemoji:ambulance" class="fs-6"></iconify-icon>
                        </span>
                        <span class="hide-menu">Ambulance Details</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('showdrivers') }}" aria-expanded="false">
                        <span>
                            <iconify-icon icon="mdi:car" class="fs-6"></iconify-icon>
                        </span>
                        <span class="hide-menu">Driver Management</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('monitoring') }}" aria-expanded="false">
                        <span>
                            <iconify-icon icon="mdi:monitor" class="fs-6"></iconify-icon>
                        </span>
                        <span class="hide-menu">Monitoring</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('dispatch') }}" aria-expanded="false">
                        <span>
                            <iconify-icon icon="mdi:truck" class="fs-6"></iconify-icon>
                        </span>
                        <span class="hide-menu">Dispatch Control</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('contacts') }}" aria-expanded="false">
                        <span>
                            <iconify-icon icon="twemoji:telephone" class="fs-6"></iconify-icon>
                        </span>
                        <span class="hide-menu">Contact Detials</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('feedback') }}" aria-expanded="false">
                        <span>
                            <iconify-icon icon="twemoji:telephone" class="fs-6"></iconify-icon>
                        </span>
                        <span class="hide-menu">Feedback Detials</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>

<div class="body-wrapper">
    <header class="app-header">
        <nav class="navbar navbar-expand-lg navbar-light">
            <ul class="navbar-nav">
                <li class="nav-item d-block d-xl-none">
                    <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse" href="javascript:void(0)">
                        <i class="ti ti-menu-2"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-icon-hover" href="javascript:void(0)">
                        <i class="ti ti-bell-ringing"></i>
                        <div class="notification bg-primary rounded-circle"></div>
                    </a>
                </li>
            </ul>
            <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
                <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">

                    <li class="nav-item dropdown">
                        <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="{{ asset(Auth::user()->image) }}" alt="User Image" width="35" height="35"
                                class="rounded-circle">
                        </a>
                        <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                            <div class="message-body">
                                <a href="{{ route('editprofile') }}"
                                    class="d-flex align-items-center gap-2 dropdown-item">
                                    <i class="ti ti-user fs-6"></i>
                                    <p class="mb-0 fs-3">My Profile</p>
                                </a> 
                                <a href="/logout" class="btn btn-outline-primary mx-3 mt-2 d-block">Logout</a>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
