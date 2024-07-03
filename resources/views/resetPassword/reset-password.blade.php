@extends('dashboard.layouts.master')

@section('main-content-section')
<main id="user-login">
    <section class="user-login-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12 offset-lg-3 offset-md-3 offset-sm-0">
                    <div class="login-form p-5 bg-white shadow">
                        <h1 class="fw-bold text-center mb-5">Reset Password</h1>
                        <form method="POST" action="{{ route('forgetPasswordSend') }}" id="forget-password">
                            @csrf
                            <div class="mb-3">
                                <label for="InputEmail1" class="form-label">Email address</label>
                                <input type="email" class="form-control" name="email" id="InputEmail1" placeholder="Exmaple@gmail.com" value="{{ old('email') }}">
                                @error('email') 
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <button class="btn btn-primary mb-3">Send Reset Password</button>
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

@push('script')
<script>
    $(document).ready(function() {
        toastr.options.timeOut = 5000;
        @if(Session::has('error'))
        toastr.error('{{ Session::get('
            error ') }}');
        @elseif(Session::has('success'))
        toastr.success('{{ Session::get('
            success ') }}');
        @endif
    });
</script>
@endpush