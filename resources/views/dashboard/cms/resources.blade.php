@extends('dashboard.layouts.master')
@push('page_css')
    <style>
        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
            z-index: 1;
        }

        .dropdown-content input {
            margin: 5px;
        }

        /* .dropdown-content button {
                                                       display: block;
                                                       background-color: #212529;
                                                       color: white;
                                                       padding: 10px;
                                                       text-align: center;
                                                       border: none;
                                                       cursor: pointer;
                                                       } */
        /* .dropdown-content button:hover {
                                                       background-color: #3e8e41;
                                                       } */
        .dropdown:hover .dropdown-content {
            display: block;
        }

        /* Container for the dropdown */
        .dropdown {
            position: relative;
            display: inline-block;
        }

        /* Dropdown content (hidden by default) */
        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
            z-index: 1;
            right: 0;
            /* Aligns dropdown content to the right side of the button */
        }

        /* Links inside the dropdown */
        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        /* Show the dropdown menu on hover */
        .dropdown:hover .dropdown-content {
            display: block;
        }

        /* Change color of dropdown links on hover */
        .dropdown-content a:hover {
            background-color: #f1f1f1;

        }

        input[type=number]::-webkit-outer-spin-button,
        input[type=number]::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        input[type=number] {
            -moz-appearance: textfield;
        }
    </style>
@endpush
@section('main-content-section')
    <main id="homepage">
        <section class="interviews-section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-md-8 col-sm-12 offset-lg-2 offset-md-2 offset-sm-0 my-auto">
                        <div class="interviews-wrap text-center">
                            <div class="heading-wrap mb-5">
                                <h2 class="heading">Practice 1:1 interviews with top tech experts</h2>
                                <p class="sub-heading">Crack your next tech-interview with us</p>
                            </div>
                            <form class="search_profile">
                                <div class="search-box search_pop">
                                    <div class="seach_box_warp">
                                        <div class="input-form-search">
                                            <input type="text" class="form-control" name=""
                                                placeholder="Search Profile">
                                            <div class="button-search"><i class="bi bi-search"></i></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="feateure_items mt-4 mb-5">
                                    <div class="feature_items_home" id="job_list">
                                        @foreach ($jobs as $job)
                                            <div class="feature_wrap job_list" onclick="getJobSkill({{ $job->id }})">
                                                @if ($job->job_icon)
                                                    <img class="job_image"
                                                        src="{{ asset('storage/images/' . $job->job_icon) }}">
                                                @endif
                                                <p>{{ $job->title }}</p>
                                            </div>
                                        @endforeach
                                        @if ($jobCount > 4)
                                            <div class="feature_wrap view_all" id="viewAllJob">
                                                <i class="bi bi-plus-circle-fill"></i>
                                                <p>View All</p>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="button-wrap">
                                    <button type="button" class="btn btn-dark rounded-pill request_now"
                                        id="jobSkillRequestBtn" disabled>Request now <i
                                            class="bi bi-arrow-right-short"></i></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="expert-section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="interviews-wrap text-center">
                            <div class="heading-wrap mb-5">
                                <h2 class="heading">Our elite expert panel</h2>
                                <p class="sub-heading">1000+ qualified interviewers available round the clock</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <a href="#" class="expert-wrap">
                            <div class="expert_image">
                                <img src="{{ asset('assets/frontend/images/avtar-1.jpg') }}" class="img-fluid w-100">
                                <p class="rating-text">4.70 <i class="bi bi-star-fill"></i></p>
                            </div>
                            <div class="expert_name">
                                <h4 class="Name">Name</h4>
                                <p class="sub-heading">Engineer</p>
                            </div>
                        </a>
                    </div>
                    <div class="col-sm-3">
                        <a href="#" class="expert-wrap">
                            <div class="expert_image">
                                <img src="{{ asset('assets/frontend/images/avtar-1.jpg') }}" class="img-fluid w-100">
                                <p class="rating-text">4.70 <i class="bi bi-star-fill"></i></p>
                            </div>
                            <div class="expert_name">
                                <h4 class="Name">Name</h4>
                                <p class="sub-heading">Engineer</p>
                            </div>
                        </a>
                    </div>
                    <div class="col-sm-3">
                        <a href="#" class="expert-wrap">
                            <div class="expert_image">
                                <img src="{{ asset('assets/frontend/images/avtar-1.jpg') }}" class="img-fluid w-100">
                                <p class="rating-text">4.70 <i class="bi bi-star-fill"></i></p>
                            </div>
                            <div class="expert_name">
                                <h4 class="Name">Name</h4>
                                <p class="sub-heading">Engineer</p>
                            </div>
                        </a>
                    </div>
                    <div class="col-sm-3">
                        <a href="#" class="expert-wrap">
                            <div class="expert_image">
                                <img src="{{ asset('assets/frontend/images/avtar-1.jpg') }}" class="img-fluid w-100">
                                <p class="rating-text">4.70 <i class="bi bi-star-fill"></i></p>
                            </div>
                            <div class="expert_name">
                                <h4 class="Name">Name</h4>
                                <p class="sub-heading">Engineer</p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <div class="sarch_practice_model" style="display: none">
        <div class="model_practice_wrap">
            <div class="close_btn">
                <i class="bi bi-x-circle-fill"></i>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-md-8 col-sm-12 offset-lg-2 offset-md-2 offset-sm-0 my-auto">
                        <div class="interviews-wrap text-center">
                            <div class="heading-wrap mb-5">
                                <h2 class="heading">Practice 1:1 interviews with top tech experts</h2>
                                <p class="sub-heading">Crack your next tech-interview with us</p>
                            </div>
                            <form class="search_profile">
                                <div class="search-box">
                                    <div class="seach_box_warp">
                                        <div class="input-form-search">
                                            <input type="text" class="form-control" name=""
                                                placeholder="Search Profile">
                                            <div class="button-search"><i class="bi bi-search"></i></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="feateure_items mt-4 mb-5">
                                    <div class="feature_items_home" id="all_job_list">
                                    </div>
                                </div>
                                <div class="button-wrap btn-blur py-3">
                                    <button type="button" class="btn btn-dark rounded-pill request_now">Request now <i
                                            class="bi bi-arrow-right-short"></i></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="sidebar_model" style="display: none">
        <div class="feature_content_pop">
            <div class="feature_wrap-skills">
                <form method="POST" action="{{ route('user.createUser') }}" id="msform">
                    @csrf
                    <!-- fieldsets -->
                    <fieldset>
                        <div class="heading-model">
                            <h2><span class="close_model"><i class="bi bi-arrow-left"></i></span> <span
                                    id="job_title"></span></h2>
                        </div>
                        <div class="skil_wrap_pop">
                            <div class="skil-bansed" id="jobSkillList">
                            </div>
                            <div class="skil-bansed">
                                <div class="heading_skil">
                                    <h3>Round based</h3>
                                </div>
                                <div class="feature_items_home">
                                    <div class="radio_check">
                                        <input class="form-check-input" type="radio" name="round_type" id="Structure">
                                        <label class="form-check-label" for="Structure">
                                            <div class="skil_wrap">
                                                <div class="skil_icon">
                                                    <img src="{{ asset('assets/frontend/images/skill-icon/dsa.svg') }}">
                                                </div>
                                                <p>Data Structure & Algorithms</p>
                                            </div>
                                        </label>
                                    </div>
                                    <div class="radio_check">
                                        <input class="form-check-input" type="radio" name="round_type" id="Machine">
                                        <label class="form-check-label" for="Machine">
                                            <div class="skil_wrap">
                                                <div class="skil_icon">
                                                    <img
                                                        src="{{ asset('assets/frontend/images/skill-icon/machine-coding.svg') }}">
                                                </div>
                                                <p>Machine Coding</p>
                                            </div>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input type="button" name="next" id="skilledbtn"
                            class="next btn btn-dark d-block w-100 action-button" value="Confirm Details" disabled />
                    </fieldset>
                    <fieldset>
                        <button type="button" name="previous" class="previous action-button-previous"><i
                                class="bi bi-arrow-left"></i></button>
                        <div class="heading-model">
                            <h2><span>Select Seniority</span></h2>
                        </div>
                        <div class="check-seniority">
                            <div class="seniority_check">
                                <input class="form-check-input" type="radio" name="experience_level" id="Internship">
                                <label class="form-check-label" for="Internship">
                                    <div class="skil_wrap_seniority">
                                        <p>Internship</p>
                                        <p>0 Year of Experience</p>
                                    </div>
                                </label>
                            </div>
                            <div class="seniority_check">
                                <input class="form-check-input" type="radio" name="experience_level" id="Entry">
                                <label class="form-check-label" for="Entry">
                                    <div class="skil_wrap_seniority">
                                        <p>Entry Level</p>
                                        <p>0-1 Year of Experience</p>
                                    </div>
                                </label>
                            </div>
                            <div class="seniority_check">
                                <input class="form-check-input" type="radio" name="experience_level"
                                    id="Intermediate">
                                <label class="form-check-label" for="Intermediate">
                                    <div class="skil_wrap_seniority">
                                        <p>Intermediate</p>
                                        <p>1-3 Year of Experience</p>
                                    </div>
                                </label>
                            </div>
                            <div class="seniority_check">
                                <input class="form-check-input" type="radio" name="experience_level" id="Mid-Senior">
                                <label class="form-check-label" for="Mid-Senior">
                                    <div class="skil_wrap_seniority">
                                        <p>Mid-Senior</p>
                                        <p>3-5 Year of Experience</p>
                                    </div>
                                </label>
                            </div>
                            <div class="seniority_check">
                                <input class="form-check-input" type="radio" name="experience_level" id="Mid-Senior">
                                <label class="form-check-label" for="team-lead">
                                    <div class="skil_wrap_seniority">
                                        <p>Team Lead</p>
                                        <p>7+ Year of Experience</p>
                                    </div>
                                </label>
                            </div>
                            <div class="seniority_check">
                                <input class="form-check-input" type="radio" name="experience_level" id="Mid-Senior">
                                <label class="form-check-label" for="manager">
                                    <div class="skil_wrap_seniority">
                                        <p>Manager</p>
                                        <p>9+ Year of Experience</p>
                                    </div>
                                </label>
                            </div>
                        </div>
                        <input type="button" name="next" class="next btn btn-dark d-block w-100 action-button"
                            value="Continue" />
                    </fieldset>
                    <fieldset>
                        <button type="button" name="previous" class="previous action-button-previous"><i
                                class="bi bi-arrow-left"></i></button>
                        <div class="heading-model">
                            <h2><span>Schedule your mock interview</span></h2>
                        </div>
                        <h3 class="fs-subtitle">Fill out your details</h3>
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" name="name" id="name"
                                value="{{ Auth::check() ? Auth::user()->name : '' }}" placeholder="Enter full name"
                                {{ Auth::check() ? 'readonly' : '' }} required>
                            <div class="invalid-feedback" id="nameError"></div>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email address</label>
                            <input type="email" class="form-control" name="email" id="email"
                                placeholder="Enter email" value="{{ Auth::check() ? Auth::user()->email : '' }}"
                                {{ Auth::check() ? 'readonly' : '' }} required>
                            <div class="invalid-feedback" id="emailError"></div>
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Enter your phone number</label>
                            <input type="text" name="phone" minlength="14" maxlength="14" class="form-control"
                                id="phone" value="{{ Auth::check() ? Auth::user()->phone : '' }}"
                                oninput="this.value = this.value.replace(/[^0-9.]/g, '')" placeholder="" required
                                {{ Auth::check() ? 'readonly' : '' }}>
                            <div class="invalid-feedback" id="phoneError"></div>
                        </div>
                        @if (!Auth::check())
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="Password" name="password" class="form-control" id="password"
                                    placeholder="Create password" required>
                                <div class="invalid-feedback" id="passwordError"></div>
                            </div>
                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label">Confirm Password</label>
                                <input type="Password" name="password_confirmation" class="form-control"
                                    id="password_confirmation" placeholder="Re-enter your Password" required>
                                <div class="invalid-feedback" id="passwordConfirmationError"></div>
                            </div>
                            <button type="button" class="submit btn btn-dark d-block w-100 action-button"
                                data-bs-toggle="modal" id="continue-details">Continue</button>
                            <button type="button" id="hidden-button" class="next" style="display: none;"></button>
                        @else
                            <button type="button" class="submit next btn btn-dark d-block w-100 action-button">
                                Confirm Detail
                            </button>
                        @endif
                    </fieldset>
                    <fieldset>
                        <button type="button" name="previous" class="previous action-button-previous"><i
                                class="bi bi-arrow-left"></i></button>
                        <div class="heading-model">
                            <h2><span>Choose availability</span></h2>
                        </div>
                        <div class="choose_availability-wrap">
                            @php
                                use Carbon\Carbon;
                                // Calculate the current date
                                $currentDate = Carbon::now()->format('j M');
                                $todayDate = Carbon::now();
                                $daysToAdd = 7 - $todayDate->dayOfWeek;
                                $newDate = $todayDate->copy()->addDays($daysToAdd);
                                $formattedDate = $newDate->format('j M');
                                $weekDates = [];
                                for ($i = 0; $i <= $daysToAdd; $i++) {
                                    $date = $todayDate->copy()->addDays($i);
                                    $weekDates[] = [
                                        'day' => $date->format('D'),
                                        'date' => $date->format('j M'),
                                    ];
                                }
                            @endphp
                        </div>
                        <div class="choose_availability-pagination">
                            <a href="javascript:void(0)" class="prev" id="prevBtn" style="display:none">
                                <i class="bi bi-chevron-left"></i> Prev
                            </a>
                            <div class="date_pagi">
                                <a href="javascript:void(0)" class="start-date">{{ $currentDate }}</a>
                                <span>-</span>
                                <a href="javascript:void(0)" class="end-date">{{ $formattedDate }}</a>
                            </div>
                            <a href="javascript:void(0)" class="nextbtn">
                                Next <i class="bi bi-chevron-right"></i>
                            </a>
                        </div>
                        <input type="submit" name="submit" class="submit next btn btn-dark d-block w-100 action-button"
                            value="Schedule" />
                        <div class="choose_availability-time">
                            @foreach ($weekDates as $weekDate)
                                <div class="table_tr">
                                    <div class="table_date">
                                        <strong>{{ $weekDate['day'] }}</strong>{{ $weekDate['date'] }}
                                    </div>
                                    <div class="table_time">
                                        <input type="time" class="starttime" name="starttime" value="Select">
                                        <span>-</span>
                                        <input type="time" class="endtime" name="endtime" value="Select">
                                    </div>
                                    <div class="table_add_more"
                                        onclick="addAvailability('{{ $weekDate['day'] . $weekDate['date'] }}')">
                                        <div class="plus_items-table"><i class="bi bi-plus-circle-fill"></i></div>
                                    </div>
                                    <div class="table_add_more">
                                        <!-- <div class="copy_items-table"><i class="bi bi-copy"></i></div> -->
                                        <div class="dropdown">
                                            <button type="button" class="copy_items-table dropbtn"><i
                                                    class="bi bi-copy"></i></button>
                                            <div class="dropdown-content">
                                                <input type="checkbox" id="saturday" name="day" value="Saturday">
                                                <label for="saturday">Saturday</label><br>
                                                <input type="checkbox" id="sunday" name="day" value="Sunday">
                                                <label for="sunday">Sunday</label><br>
                                                <input type="checkbox" id="monday" name="day" value="Monday">
                                                <label for="monday">Monday</label><br>
                                                <button type="button" class="btn btn-dark rounded-pill request_now"
                                                    onclick="applyTimes()">Apply</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="table_time" id="{{ $weekDate['day'] . $weekDate['date'] }}">
                                    </div>
                            @endforeach

                            <div class="mb-3">
                                <label for="timezone" class="form-label">Timezone</label>
                                <select class="form-control" id="timezone">
                                    <option>(UTC-08:00) Pacific Time (US & Canada)</option>
                                    <option>(UTC-08:00) Pacific Time (US & Canada)</option>
                                    <option>(UTC-08:00) Pacific Time (US & Canada)</option>
                                    <option>(UTC-08:00) Pacific Time (US & Canada)</option>
                                    <option>(UTC-08:00) Pacific Time (US & Canada)</option>
                                    <option>(UTC-08:00) Pacific Time (US & Canada)</option>
                                </select>
                            </div>

                        </div>
                        {{-- <input type="submit" name="submit" class="submit next btn btn-dark d-block w-100 action-button"
                  value="Schedule" /> --}}
                    </fieldset>
                    <fieldset>
                        <button type="button" name="previous" class="previous action-button-previous"><i
                                class="bi bi-arrow-left"></i></button>
                        <div class="heading-model">
                            <h2><span>Choose Company Type</span></h2>
                        </div>
                        @php
                            $company_types_price = config('constants.company_types_price');
                            $company_types = config('constants.company_types');
                        @endphp
                        <div class="check-company">
                            @foreach ($groupedCompanies as $companyType => $companies)
                                <div class="company_check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault"
                                        id="{{ $companyType }}">
                                    <label class="form-check-label" for="{{ $companyType }}">
                                        <div class="skil_wrap_{{ $companyType }}">
                                            <p class="company-names">{{ $company_types[$companyType] }}</p>
                                            <p class="company-info">
                                                @if ($companyType == 'faang')
                                                    Companies that build the best tech products in the world
                                                @elseif($companyType == 'product_companies')
                                                    Companies that build some of the most used tech products in the world
                                                @elseif($companyType == 'startup')
                                                    Recently established companies that are hustling to grow fast
                                                @elseif($companyType == 'hypergrowth')
                                                    Startups that are growing at a rapid pace and on the journey to becoming
                                                    enterprises
                                                @elseif($companyType == 'it_services')
                                                    Companies that build systems to help other companies grow fast
                                                @endif
                                            </p>
                                            <div class="logo-svg-company">
                                                @foreach ($companies as $company)
                                                    <img src="{{ asset('storage/images/' . $company->company_logo) }}">
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="price">
                                            <p>₹<span
                                                    id="{{ $companyType }}-price">{{ $company_types_price[$companyType] }}</span>
                                            </p>
                                        </div>
                                    </label>
                                </div>
                            @endforeach
                        </div>
                        <input type="button" name="next" class="btn btn-dark d-block w-100 action-button"
                            id="confirmAndPay" value="Confirm and Continue" />
                    </fieldset>

                </form>
            </div>
        </div>
    </div>
    <!-- Button trigger modal -->
    <!-- Modal -->
    <div class="modal fade" id="otpModal" tabindex="-1" aria-labelledby="otpModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="otpModalLabel">Enter OTP</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="error-message mt-3 text-danger" style="display: none;"></div>
                <div class="success-message mt-3 text-success" style="display: none;"></div>
                <div class="modal-body">
                    <form class="otp-submit">
                        <input type="hidden" name="email" id="otp_email">
                        <div class="input_otp">
                            <input type="number" min="0" name="otp1" maxlength="1">
                            <input type="number" min="0" name="otp2" maxlength="1">
                            <input type="number" min="0" name="otp3" maxlength="1">
                            <input type="number" min="0" name="otp4" maxlength="1">
                            <input type="number" min="0" name="otp5" maxlength="1">
                            <input type="number" min="0" name="otp6" maxlength="1">
                        </div>
                        <div class="text-form_otp my-4">
                            <p>We have sent an OTP to your email</p>
                            <p>Haven't received? <a href="#" id="resend_otp">Resend</a></p>
                        </div>
                        <div class="text-center">
                            <button type="button" id="verify_otp" class="btn btn-dark">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://js.stripe.com/v3/"></script>
    <script type="text/javascript">
        function openSidebar() {
            document.getElementById("sidebar").style.width = "300px";
        }

        function closeSidebar() {
            document.getElementById("sidebar").style.width = "0";
        }
        $('#viewAllJob').click(function() {
            $.ajax({
                url: "{{ route('all.job') }}",
                type: "get",
                success: function(res) {
                    if (res.success == true) {
                        if (res.jobs.length > 0) {
                            var jobList = "";
                            var APP_URL = {!! json_encode(url('/')) !!};
                            $.each(res.jobs, function(key, value) {

                                var img = (value.job_icon) ? APP_URL + '/storage/images/' +
                                    value.job_icon : '';
                                jobList += `<div class="feature_wrap job_list">`;
                                if (img) {
                                    jobList += `<img class="job_image"  src="` + img + `">`;
                                }
                                jobList += `<p>` + value.title + `</p></div>`;
                            })

                            $('#all_job_list').empty();
                            $('#all_job_list').html(jobList);
                            $(".sarch_practice_model").show();
                        }


                    }

                }
            });
        });

        function getJobSkill(id) {
            var url = "{{ route('frontend.job.skill', ':id') }}";
            url = url.replace(':id', id);
            $.ajax({
                url: url,
                type: "get",
                success: function(res) {
                    $('#jobSkillList').empty();
                    if (res.success == true) {
                        $('#job_title').empty();
                        $('#job_title').text(res.job.title);
                        if (res.jobSkills.length > 0) {
                            var jobSkillList = "";
                            var APP_URL = {!! json_encode(url('/')) !!};

                            jobSkillList += `  <div style="color:red;">Note: Please select atleast one skill.</div><div class="heading_skil">
                                           <h3>Skill based</h3>
                                       </div>
   
                                       <div class="feature_items_home">`;
                            $.each(res.jobSkills, function(key, value) {

                                var img = (value.image) ? APP_URL + '/storage/images/' + value.image :
                                    APP_URL + '/assets/frontend/images/placeholder-img.jpg';

                                jobSkillList += `<div class="radio_check skilledDiv" onclick="skilledbtn()">
                                               <input class="form-check-input" type="checkbox" value="` + value
                                    .id + `" id="` + value.skill + `">
                                               <label class="form-check-label" for="` + value.skill + `">
                                                   <div class="skil_wrap">`;
                                if (img) {
                                    jobSkillList += `<div class="skil_icon">
                                                          
                                                              <img class="job_image"  src="` + img + `">
                                                              </div>`;
                                }

                                jobSkillList += ` <p>` + value.skill + `</p>
                                                   </div>
                                               </label>
                                           </div>`;

                            })
                            jobSkillList += `</div>
                   `;

                            $('#jobSkillList').html(jobSkillList);
                            $('#skilledbtn').attr('disabled', true);

                        }


                    }

                }
            });
        }
        $('.job_list').click(function() {
            $('#jobSkillRequestBtn').attr('disabled', false);
        })
        // send OTP
        $('#continue-details').click(function() {
            sendOtp();
        });

        // Resend OTP
        $('#resend_otp').click(function() {
            sendOtp(true);
        });
        $('#verify_otp').click(function(e) {
            e.preventDefault();
            var otp = '';
            $('.input_otp input').each(function() {
                otp += $(this).val();
            });
            var formData = {
                _token: "{{ csrf_token() }}",
                otp: otp,
                email: $('#email').val(),
                name: $('#name').val(),
                phone: $('#phone').val(),
                password: $('#password').val(),
                password_confirmation: $('#password_confirmation').val()
            };
            $.ajax({
                url: "{{ route('verifyOtp') }}",
                type: "POST",
                data: formData,
                success: function(res) {
                    if (res.success == true) {
                        $('#otpModal').modal('hide');
                        $("#hidden-button").click();
                    } else {
                        $('.error-message').text(res.message).show();
                        setTimeout(function() {
                            $('.error-message').fadeOut();
                        }, 3000);
                    }
                },
            });
        });

        function sendOtp(resend = false) {
            var formData = {
                _token: "{{ csrf_token() }}",
                name: $('#name').val(),
                email: $('#email').val(),
                phone: $('#phone').val(),
                password: $('#password').val(),
                password_confirmation: $('#password_confirmation').val()
            };

            $.ajax({
                url: "{{ route('sendOtp') }}",
                type: "POST",
                data: formData,
                success: function(res) {
                    if (res.success == true) {
                        $('#otpModal').modal({
                            backdrop: 'static',
                            keyboard: false
                        }).modal('show');
                        if (resend) {
                            $('.success-message').text('OTP Resent Successfully').show();
                            setTimeout(function() {
                                $('.success-message').fadeOut();
                            }, 3000);
                        }
                    }
                },
            });
        }

        $('.input_otp input').on('input', function() {
            this.value = this.value.slice(0, 1);
            var nextInput = $(this).next('input');
            if (nextInput.length) {
                nextInput.focus();
            }
        });
        $('.input_otp input').on('keydown', function(e) {
            if (e.key === "Backspace" && this.value === '') {
                var prevInput = $(this).prev('input');
                if (prevInput.length) {
                    prevInput.focus();
                }
            }
        });

        $('#confirmAndPay').click(function(e) {
            e.preventDefault();

            // Get selected company type and its price
            var selectedCompanyType = $('input[name=flexRadioDefault]:checked').attr('id');
            var selectedPrice = $('#' + selectedCompanyType + '-price').text();
            var userEmail = $('#email').val(); // Assuming you have an input field with id="email"

            var formData = {
                _token: "{{ csrf_token() }}",
                email: userEmail,
                companyType: selectedCompanyType,
                price: selectedPrice
            };

            $.ajax({
                url: "{{ route('check-out') }}",
                type: "POST",
                data: formData,
                success: function(res) {
                    if (res.success == true) {
                        var paymentIntent = res.data.paymentIntent;
                        NXCardPayment(paymentIntent);
                    } else {
                        // Handle error or do something else
                    }
                },
                error: function(xhr, status, error) {
                    // Handle AJAX errors
                }
            });
        });


        function parseDate(dateString) {
            return new Date(Date.parse(dateString + " 2024")); // Append year to handle Date parsing correctly
        }

        function formatDate(date) {
            const options = {
                day: 'numeric',
                month: 'short'
            };
            return date.toLocaleDateString('en-GB', options); // Using 'en-GB' locale to ensure day-first format
        }

        function formatDay(date) {
            const options = {
                weekday: 'short'
            };
            return date.toLocaleDateString('en-GB', options);
        }

        function formatFullDay(date) {
            const options = {
                weekday: 'long'
            };
            return date.toLocaleDateString('en-GB', options);
        }

        var addDays = @json($daysToAdd);

        function getCopyDay(startDate, clickedDay = '') {
            let html = '';
            for (let i = 0; i <= addDays; i++) {
                let current = new Date(startDate);
                current.setDate(startDate.getDate() + i);
                let fulldayname = formatFullDay(current);
                html += `
       <input type="checkbox" data-copyrowIndex="${i}" id="${(fulldayname.toLowerCase())}" ${(clickedDay == fulldayname) ? 'checked readonly' :''} name="day" value="${fulldayname}">
       <label for="${fulldayname}">${fulldayname}</label><br>`;
            }
            return html;
        }

        function parseTime(timeStr) {
            if (!timeStr || !timeStr.includes(':')) {
                console.error('Invalid time format:', timeStr);
                return '';
            }
            const [time, modifier] = timeStr.split(' ');
            let [hours, minutes] = time.split(':');
            if (hours === '12') {
                hours = '00';
            }
            if (modifier === 'PM') {
                hours = parseInt(hours, 10) + 12;
            }
            return `${hours.padStart(2, '0')}:${minutes}`;
        }
        $('body').on('change', '.starttime', function() {
            var startTimeValue = $(this).val();
            console.log("startTimeValue::", startTimeValue)
            // Update the value attribute of the starttime input
            $(this).attr('value', startTimeValue);
        });

        // When the endtime input changes
        $('body').on('change', '.endtime', function() {
            var endTimeValue = $(this).val();
            console.log("endTimeValue::", endTimeValue)
            // Update the value attribute of the endtime input
            $(this).attr('value', endTimeValue);
        });

        function applyTimes(rowIndex) {
            var dropdownContent = $(`#checkboxDiv${rowIndex}`);
            var selectedCheckboxes = dropdownContent.find('input[type="checkbox"]:checked');
            var startTimeInput = $(`#starttime${rowIndex}`);
            var endTimeInput = $(`#endtime${rowIndex}`);
            var mainHTML = $(`#timeDiv${rowIndex}`).html();
            var addMoreTrhtml = $(`#addMoreTr${rowIndex}`).html();

            if (startTimeInput.length && endTimeInput.length) {
                var startTime = startTimeInput.val();
                var endTime = endTimeInput.val();
                console.log(typeof startTime);
                selectedCheckboxes.each(function() {
                    var copyRowIndex = $(this).attr('data-copyrowindex');
                    console.log("copyRowIndex::", copyRowIndex, "Selected rowIndex::", rowIndex)
                    if (rowIndex != copyRowIndex) {
                        var formattedStartTime = parseTime(startTime);
                        var formattedEndTime = parseTime(endTime);

                        $(`#starttime${copyRowIndex}`).val(formattedStartTime);
                        $(`#endtime${copyRowIndex}`).val(formattedEndTime);
                        if ($(`#addMoreTr${copyRowIndex}`).length) {
                            // If it exists, append the HTML directly
                            $(`#timeDiv${copyRowIndex}`).empty().html(mainHTML);
                            $(`#addMoreTr${copyRowIndex}`).empty().html(addMoreTrhtml);
                        } else {
                            // If it doesn't exist, create the element first and then append the HTML
                            const newDiv = $(`<div id="addMoreTr${copyRowIndex}"></div>`);
                            newDiv.html(addMoreTrhtml);
                            // Append the new element wherever you want
                            // For example, if you want to append it to the body:
                            $('body').append(newDiv);
                        }
                    }
                });
            } else {
                console.error('Start or end time input not found for row:', rowIndex);
            }
        }

        function updateAvailabilityDates(startDate) {
            let html = '';
            for (let i = 0; i <= addDays; i++) {
                let current = new Date(startDate);
                current.setDate(startDate.getDate() + i);
                let day = formatDay(current);
                let fulldayname = formatFullDay(current);
                let date = formatDate(current);
                html += `
       <div class="table_tr">
           <div class="table_date"><strong>${day}</strong>${date}</div>
           <div class="table_time" id="timeDiv${i}">
               <div class="time_pair">
                   <input type="time" class="starttime" name="starttime[]" id="starttime${i}" value="">
                   <span>-</span>
                   <input type="time" class="endtime" name="endtime[]" id="endtime${i}" value="">
               </div>
           </div>
           <div class="table_add_more" onclick="addAvailability('addMoreTr${i}','${i}')" id="addMBtnDiv${i}">
               <div class="plus_items-table"><i class="bi bi-plus-circle-fill"></i></div>
           </div>
           <div class="table_add_more">
               <div class="dropdown">
                   <button type="button" class="copy_items-table dropbtn"><i class="bi bi-copy"></i></button>
                   <div class="dropdown-content" id="checkboxDiv${i}">
                       ${getCopyDay(startDate, fulldayname)}
                       <button type="button" class="btn btn-dark rounded-pill request_now" onclick="applyTimes(${i})">Apply</button>
                   </div>
               </div>
           </div>
       </div>
       <div id="addMoreTr${i}"></div>`;
            }
            $('.choose_availability-time').html(html);
        }

        function copyTime(day) {
            const startInput = document.getElementById(`${day}-start`);
            const endInput = document.getElementById(`${day}-end`);
            const startTime = startInput.value;
            const endTime = endInput.value;

            if (startTime && endTime) {
                // Store the copied times in a global variable or use other means to keep track
                window.copiedTimes = {
                    startTime,
                    endTime
                };
                alert(`Copied times: ${startTime} - ${endTime}`);
            } else {
                alert('Please enter both start and end times.');
            }
        }

        $(document).ready(function() {
            const todayDay = @json($currentDate);
            const currentDate = parseDate(@json($currentDate));
            const formattedDate = @json($formattedDate);

            let startDate = parseDate($('.start-date').text());
            updateAvailabilityDates(startDate);

            $('#prevBtn').click(function(e) {
                e.preventDefault();
                startDate.setDate(startDate.getDate() - 7);
                let endDate = new Date(startDate);
                endDate.setDate(endDate.getDate() + 6);

                if (startDate < currentDate) {
                    $('#prevBtn').css('display', 'none');
                    startDate = new Date(currentDate);
                    dateParts = todayDay.split(' ');
                    addDays = @json($daysToAdd);
                    console.log(addDays);
                } else {
                    $('#prevBtn').css('display', 'block');
                }

                $('.start-date').text(formatDate(startDate));
                $('.end-date').text(formatDate(endDate));
                updateAvailabilityDates(startDate);
            });

            $('.nextbtn').click(function(e) {
                e.preventDefault();
                addDays = 6;
                let oldendDate = parseDate($('.end-date').text());
                startDate.setDate(oldendDate.getDate() + 1);
                let endDate = new Date(startDate);
                endDate.setDate(endDate.getDate() + 6);

                $('#prevBtn').css('display', 'block');

                $('.start-date').text(formatDate(startDate));
                $('.end-date').text(formatDate(endDate));
                updateAvailabilityDates(startDate);
            });
        });

        function addAvailability(id, index) {
            var html = ` <div class="table_tr" id="">
               <div class="table_date"><strong></strong></div>
               <div class="table_time">
                   <div class="time_pair">
                       <input type="time" class="addmorestarttime starttime" name="starttime[]"  value="">
                       <span>-</span>
                       <input type="time" name="endtime[]" class="addmoreendtime endtime" value="" >
                   </div>
               </div>
               <div class="table_add_more">
                   <div class="plus_items-table remove_feature"><i class="bi bi-dash-circle-fill"></i></div>
               </div>
               <div class="table_add_more">
               </div>
           </div>`;
            $('#' + id).append(html)
        }
        $("body").on("click", ".remove_feature", function() {
            $(this).parent().parent().remove();
        });

        function skilledbtn() {
            $('#skilledbtn').attr('disabled', false);
        };

        function NXCardPayment(paymentIndent) {
            var base_url = "{{ url('') }}";
            var paymentModal = $('#payment-modal').modal({
                backdrop: 'static',
                keyboard: false
            }).modal('show');
            var stripe = Stripe('{{ config('services.stripe.key') }}');

            let elements;
            stripeInitialize();
            StripeCheckStatus();

            document
                .querySelector("#payment-form")
                .addEventListener("submit", handleSubmit);

            // Fetches a payment intent and captures the client secret
            async function stripeInitialize() {

                const appearance = {
                    theme: 'stripe',
                };
                elements = stripe.elements({
                    appearance,
                    clientSecret: paymentIndent.client_secret
                });
                const paymentElementOptions = {
                    layout: "tabs",
                };
                const paymentElement = elements.create("payment", paymentElementOptions);
                paymentElement.mount("#payment-element");
            }
            async function handleSubmit(e) {
                e.preventDefault();
                StripeSetLoading(true);
                const {
                    error
                } = await stripe.confirmPayment({
                        elements,
                        confirmParams: {
                            return_url: base_url + '/payment-transaction',
                        },
                    })
                    .then(function(result) {
                        console.log(result);
                        if (result.error) {
                            console.log(result);
                            // Inform the customer that there was an error.
                        }
                    });

                if (error.type === "card_error" || error.type === "validation_error") {
                    StipeShowMessage(error.message);
                } else {
                    console.log(error)
                    StipeShowMessage("An unexpected error occurred.");
                }
                StripeSetLoading(false);
            }
            async function StripeCheckStatus() {
                const clientSecret = new URLSearchParams(window.location.search).get(
                    "payment_intent_client_secret"
                );

                if (!clientSecret) {
                    return;
                }

                const {
                    paymentIntent
                } = await stripe.retrievePaymentIntent(clientSecret);

                switch (paymentIntent.status) {
                    case "succeeded":
                        StipeShowMessage("Payment succeeded!");
                        break;
                    case "processing":
                        StipeShowMessage("Your payment is processing.");
                        break;
                    case "requires_payment_method":
                        StipeShowMessage("Your payment was not successful, please try again.");
                        break;
                    default:
                        StipeShowMessage("Something went wrong.");
                        break;
                }
            }
            // ------- UI helpers -------
            function StipeShowMessage(messageText) {
                const messageContainer = document.querySelector("#payment-message");

                messageContainer.classList.remove("hidden");
                messageContainer.textContent = messageText;

                setTimeout(function() {
                    messageContainer.classList.add("hidden");
                    messageContainer.textContent = "";
                }, 4000);
            }
            // Show a spinner on payment submission
            function StripeSetLoading(isLoading) {
                if (isLoading) {
                    // Disable the button and show a spinner
                    document.querySelector("#submit").disabled = true;
                    document.querySelector("#spinner").classList.remove("hidden");
                    document.querySelector("#button-text").classList.add("hidden");
                } else {
                    document.querySelector("#submit").disabled = false;
                    document.querySelector("#spinner").classList.add("hidden");
                    document.querySelector("#button-text").classList.remove("hidden");
                }
            }

        }
    </script>
@endpush
