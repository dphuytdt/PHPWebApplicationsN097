@extends('layouts.main') @section('content') @section('title', 'Reset Password')
<script
    src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"
    integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw=="
    crossorigin="anonymous"
    referrerpolicy="no-referrer"
></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.js"></script>
<script type="text/javascript" src="{{asset('js/common/errors.js')}}"></script>

<!-- ...:::: Start Breadcrumb Section:::... -->
<div class="breadcrumb-section">
    <div class="breadcrumb-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-12 d-flex justify-content-between justify-content-md-between align-items-center flex-md-row flex-column">
                    <h3 class="breadcrumb-title">Reset Password</h3>
                    {{ Breadcrumbs::render('resetPassword') }}
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ...:::: End Breadcrumb Section:::... -->

<!-- ...:::: Start Customer Login Section :::... -->
<div class="customer_login">
    <div class="container">
        <div class="row">
            <!--register area start-->
            <div class="col-lg-6 col-md-6">
                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                <div class="account_form register">
                    <h3>Reset Password</h3>
                    <form id="resetPswForm" method="POST" action="{{route('postResetPassword')}}">
                        @csrf
                        <div class="default-form-box mb-20">
                            <label>New Password <span>*</span></label>
                            <input type="password" name="password" id="password" data-label="New Password" value="{{old('password')}}" />
                        </div>
                        <div class="default-form-box mb-20">
                            <label>Passwords Confirmation <span>*</span></label>
                            <input type="password" name="password_confirmation" id="password_confirmation" data-label="Passwords Confirmation" value="{{old('password_confirmation')}}" />
                        </div>
                        <div class="login_submit">
                            <button type="submit">Reset</button>
                        </div>
                    </form>
                </div>
            </div>
            <!--register area end-->
        </div>
    </div>
</div>
<script type="text/javascript" src="{{asset('js/auth/reset-password.js')}}"></script>
@endsection
