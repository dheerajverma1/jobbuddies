

<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-light" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <!-- Sidebar - Brand -->
                <a class="sidebar-brand d-none d-lg-block align-items-center justify-content-center"
                    href="#">
                    <img src="{{ asset('assets/frontend/images/logo.png') }}" class="img-fluid" alt="logo">
                </a>

                <a class="{{ request()->is('admin/dashboard') ? 'nav-link active' : 'nav-link' }}"
                    href="{{ route('candiate.index') }}">
                    <div class="sb-nav-link-icon">
                        <!-- <img src="imgs/dash.png" alt="bar-icon"> -->
                        <!-- <img src="imgs/menu-icon/dashboard.svg" alt="image"> -->
                        <svg height="24" viewBox="0 96 720 720" width="24" version="1.1" id="svg4"
                            sodipodi:docname="2550e332124d7d8482cbdf6ebee23de4.svg"
                            xmlns:inkscape="http://www.inkscape.org/namespaces/inkscape"
                            xmlns:sodipodi="http://sodipodi.sourceforge.net/DTD/sodipodi-0.dtd"
                            xmlns="http://www.w3.org/2000/svg" xmlns:svg="http://www.w3.org/2000/svg">
                            <defs id="defs8" />
                            <sodipodi:namedview id="namedview6" pagecolor="#ffffff" bordercolor="#666666"
                                borderopacity="1.0" inkscape:pageshadow="2" inkscape:pageopacity="0.0"
                                inkscape:pagecheckerboard="0" />
                            <path
                                d="M 390,366 V 96 H 720 V 366 Z M 0,486 V 96 H 330 V 486 Z M 390,816 V 426 H 720 V 816 Z M 0,816 V 546 H 330 V 816 Z M 60,426 H 270 V 156 H 60 Z M 450,756 H 660 V 486 H 450 Z m 0,-450 H 660 V 156 H 450 Z M 60,756 H 270 V 606 H 60 Z M 270,426 Z M 450,306 Z m 0,180 z M 270,606 Z"
                                id="path2" />
                        </svg>
                    </div>
                    <span class="menu-text">Dashboard</span>
                </a>
            </div>
        </div>
    </nav>
</div>