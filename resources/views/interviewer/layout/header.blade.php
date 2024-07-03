<!-- header.blade.php -->
<div id="layoutSidenav_content">
    <div id="sidebar-overlay"></div>
    <nav class="sb-topnav navbar navbar-expand navbar-white">
        <a class="navbar-brand ml-3 d-lg-none d-block align-items-center justify-content-center" href="{{ route('superadmin.dashboard') }}">
            <img src="{{ asset('assets/frontend/images/logo.png') }}" class="img-fluid" alt="logo">
        </a>
        <button class="btn btn-link btn-sm order-1 order-xl-0 me-0 me-xl-4 ms-0 ms-xl-3" id="sidebarToggle" href="#!">
            <i class="fa fa-bars fa-2x text-danger"></i>
            <i class="fas fa-times fa-2x text-danger d-none"></i>
        </button>
        <div class="page-title d-none d-xl-inline-block">
            <h4 class="mb-0 fw-semi">{{ $pageTitle }}</h4>
        </div>
        <ul class="navbar-nav profile-dropdown ml-auto mr-0 mr-md-3 my-2 my-md-0">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    @php
                        if (Auth::user()->image && file_exists(public_path('storage/images/' . Auth::user()->image))) {
                            $profileImage = asset('storage/images/' . Auth::user()->image);
                        } else {
                            $profileImage = asset('assets/imgs/login-profile.png');
                        }
                    @endphp
                    <img class="img-profile rounded-circle" alt="" src="{{ $profileImage }}">
                </a>
                <ul class="dropdown-menu dropdown-menu-right shadow-sm border-0" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="{{ route('superadmin.logout') }}">Logout</a></li>
                </ul>
            </li>
        </ul>
    </nav>
</div>