@extends('dashboard.layouts.master')

@section('main-content-section')
<main id="user-login">
    <section class="user-login-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12 offset-lg-3 offset-md-3 offset-sm-0">
                    <div class="login-form p-5 bg-white shadow">
                        <h1 class="fw-bold text-center mb-5">New Password</h1>
                        <form method="POST" action="{{ route('newPasswordStore') }}" id="forget-password">
                            @csrf
                            <input type="hidden" class="form-control" name="email" id="InputEmail" @if($email) value="{{ $email }}" @endif>
                            <div class="mb-3">
                                <label for="InputPassword1" class="form-label">Password</label>
                                <input type="password" class="form-control" name="password" id="InputPassword">
                                <span class="text-danger error hide-element" id="errorMsg">The password field is required.</span>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <button type="button" id="submit-password" class="btn btn-primary mb-3">Send Reset Password</button>
                                </div>
                            </div>
                        </form>
                        
                        @if (session('message'))
                            <div class="alert alert-success">
                                {{ session('message') }}
                            </div>
                        @endif
                        
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#submit-password').click(function(event) {
            // Prevent the default form submission
            event.preventDefault();

            let form = $('#forget-password');
            let email = $('#InputEmail').val();
            let password = $('#InputPassword').val();


            if (password.trim() === '') {
                $('#errorMsg').removeClass('hide-element');
            } else if(password.trim().length <= 5) {
                $('#errorMsg').text('The password must be at least 6 characters.');
                $('#errorMsg').removeClass('hide-element');
            } else {
                // Reset error message if valid password
                $('#errorMsg').addClass('hide-element');

                // Manually submit the form
                form.submit();
            }
        });
    });
</script>


