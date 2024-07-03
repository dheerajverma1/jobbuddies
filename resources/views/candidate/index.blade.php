@extends('candidate.layout.master')

@section('main-content-section')
    @php
    $interviewer = Auth::user()->role == \App\Models\User::INTERVIEWER 
    @endphp
    @include('candidate.models.model')
    <div id="layoutSidenav_content" style="min-height:unset">
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
    <div class="container-fluid px-lg-4 mt-4 mt-xl-5">
        <h2 class="main-title d-xl-none d-block">{{ $pageTitle }}</h2>
        <div id="calendar"></div>
    </div>
@endsection
@push('script')
    <script>
  $(document).ready(function() {
            $('#calendar').fullCalendar({
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay'
                },
                editable: true,
                events: '/candiate/get-meeting',
                dayRender: function(date, cell) {
                    if (date.isBefore(moment(), 'day')) {
                        $(cell).addClass('fc-past');
                    }
                },
                selectable: true,
                selectAllow: function(selectInfo) {
                    return moment().diff(selectInfo.start, 'days') <= 0;
                },
                dayClick: function(date, jsEvent, view) {
                    if (date.isSameOrAfter(moment(), 'day')) {
                        $('#addMeetingsModal').modal('show');
                        $('#start_time').val(date.format('YYYY-MM-DDTHH:mm'));
                    }
                }
            });

            // Submit form via AJAX
            $('#addMeetingsForm').on('submit', function(e) {
                e.preventDefault();
                $.ajax({
                    url: '{{ route('candiate.store') }}',
                    type: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        $('#calendar').fullCalendar('refetchEvents');
                        $('#addMeetingsModal').modal('hide');
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                        // Handle error here
                    }
                });
            });
        });
    </script>
@endpush
