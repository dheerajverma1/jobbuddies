

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
                @if (Auth::user()->role == \App\Models\User::SUPER_ADMIN)
                    <a class="{{ request()->is('admin/teachers') ? 'nav-link active' : 'nav-link' }}"
                        href="{{ route('superadmin.interviewers.index') }}">
                        <div class="sb-nav-link-icon">
                            <!-- <img src="imgs/candidates.png" alt="bar-icon"> -->
                            <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960"
                                width="24">
                                <path
                                    d="M479.736-220Q622-220 721-319.344T820-560q0-39.102-8.5-75.051Q803-671 788-704q-28 21-60.609 32.5Q694.783-660 660-660q-55 0-101.5-28T480-761q-32 45-78.5 73T300-660q-34.783 0-67.391-11.5Q200-683 172-704q-15 33-23.5 69.5T140-560q0 141.312 99.267 240.656Q338.533-220 479.736-220ZM354.225-463Q377-463 392.5-478.725q15.5-15.726 15.5-38.5Q408-540 392.275-555.5q-15.726-15.5-38.5-15.5Q331-571 315.5-555.275q-15.5 15.726-15.5 38.5Q300-494 315.725-478.5q15.726 15.5 38.5 15.5Zm253 0Q630-463 645.5-478.725q15.5-15.726 15.5-38.5Q661-540 645.275-555.5q-15.726-15.5-38.5-15.5Q584-571 568.5-555.275q-15.5 15.726-15.5 38.5Q553-494 568.725-478.5q15.726 15.5 38.5 15.5ZM300-720q63 0 106.5-43.5T450-870v-29q-77 7-141 44.5T203-757q20 17 44.839 27 24.838 10 52.161 10Zm360 0q27.323 0 52.161-10Q737-740 757-757q-42-60-106-97.5T510-899v29q0 63 43.5 106.5T660-720ZM66-80q-26.145 0-44.072-19.5Q4-119 6-145l38-417q8-84 45.5-157t96-126.5q58.5-53.5 134-84T480-960q85 0 160.5 30.5t134 84Q833-792 870.5-719T916-562l38 417q2 26-15.928 45.5Q920.145-80 894-80H66Zm413.948-80Q342-160 235.5-243T94-454L66-140h828l-28-314q-35 128-141 211t-245.052 83ZM510-899Zm-60 0Zm29.948 759H894 66h413.948Z" />
                            </svg>
                        </div>
                        <span class="menu-text">Interviewers</span>
                    </a>
                @endif
                @if (Auth::user()->role == \App\Models\User::SUPER_ADMIN)
                    <div class="has_dropdown">
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                            data-bs-target="#collapseLayouts2" aria-expanded="false"
                            aria-controls="collapseLayouts">
                            <div class="sb-nav-link-icon">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M6 5V4C6 2.34315 7.34315 1 9 1H15C16.6569 1 18 2.34315 18 4V5H20C21.6569 5 23 6.34315 23 8V20C23 21.6569 21.6569 23 20 23H4C2.34315 23 1 21.6569 1 20V8C1 6.34315 2.34315 5 4 5H6ZM8 4C8 3.44772 8.44772 3 9 3H15C15.5523 3 16 3.44772 16 4V5H8V4ZM19.882 7H4.11803L6.34164 11.4472C6.51103 11.786 6.8573 12 7.23607 12H11C11 11.4477 11.4477 11 12 11C12.5523 11 13 11.4477 13 12H16.7639C17.1427 12 17.489 11.786 17.6584 11.4472L19.882 7ZM11 14H7.23607C6.09975 14 5.06096 13.358 4.55279 12.3416L3 9.23607V20C3 20.5523 3.44772 21 4 21H20C20.5523 21 21 20.5523 21 20V9.23607L19.4472 12.3416C18.939 13.358 17.9002 14 16.7639 14H13C13 14.5523 12.5523 15 12 15C11.4477 15 11 14.5523 11 14Z"
                                        fill="#0F0F0F" />
                                </svg>
                            </div>
                            Jobs
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseLayouts2" aria-labelledby="headingTwo"
                            data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="{{ request()->is('school-management/jobs') ? 'nav-link active' : 'nav-link' }}"
                                    href="{{ route('superadmin.jobs.index') }}">Job List</a>
                                <a class="{{ request()->is('school-management/candidates') ? 'nav-link active' : 'nav-link' }}"
                                    href="{{ route('superadmin.candidates.index') }}">Candidate List</a>
                            </nav>
                        </div>
                    </div>
                @endif
                <a class="{{ request()->is('admin/zoom-call') ? 'nav-link active' : 'nav-link' }}"
                    href="{{ route('superadmin.meetings.index') }}">
                    <div class="sb-nav-link-icon">
                        <svg height="24" viewBox="0 96 400 800" width="24" version="1.1"
                            id="svg4" sodipodi:docname="5dedfc07a36042049981de6629d68d42.svg"
                            xmlns:inkscape="http://www.inkscape.org/namespaces/inkscape"
                            xmlns:sodipodi="http://sodipodi.sourceforge.net/DTD/sodipodi-0.dtd"
                            xmlns="http://www.w3.org/2000/svg" xmlns:svg="http://www.w3.org/2000/svg">
                            <defs id="defs8" />
                            <sodipodi:namedview id="namedview6" pagecolor="#ffffff" bordercolor="#666666"
                                borderopacity="1.0" inkscape:pageshadow="2" inkscape:pageopacity="0.0"
                                inkscape:pagecheckerboard="0" />
                            <path
                                d="m 0,96 h 400 v 333 q 0,23 -11.316,42.149 Q 377.368,490.298 357,502 l -141,82 26,97 H 376 L 267,762 309,896 200,815 90,896 132,762 23,681 H 158.111 L 183,584 43,502 Q 22.632,490.298 11.316,471.149 0,452 0,429 Z m 60,60 v 273 q 0,7 4.5,13 4.5,6 13.5,11 l 96,53 V 156 Z m 280,0 H 234 v 350 l 88,-53 q 9,-5 13.5,-11 4.5,-6 4.5,-13 z M 204,339 Z m -30,-8 z m 60,0 z"
                                id="path2" />
                        </svg>
                    </div>
                    <span class="menu-text">Zoom Call</span>
                </a>
            </div>
        </div>
    </nav>
</div>