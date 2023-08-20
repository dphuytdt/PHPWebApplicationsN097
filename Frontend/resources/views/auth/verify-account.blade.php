@extends('layouts.main') @section('content') @section('title', 'Acount Verify')
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
                    <h3 class="breadcrumb-title">Acount Verify</h3>
                    {{ Breadcrumbs::render('inputOtp') }}
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
            {{-- display item center --}}
            <style>
                .account_form.register {
                    margin: 0 auto;
                    float: none;
                }
            </style>
            <div class="col-lg-6 col-md-6">
                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                <div class="account_form register">
                    <h3>Acount Verify</h3>
                    <form id="verifyOtpForm" method="POST" action="{{ route('postInputOtp') }}">
                        @csrf
                        <div class="default-form-box mb-20">
                            <label>Your OTP <span>*</span></label>
                            <input id="otp" type="text" name="otp" value="{{ old('otp') }}" data-label="OTP" />
                        </div>
                        <div class="login_submit">
                            <button type="submit">Verify OTP</button>
                        </div>
                    </form>
                </div>
            </div>
            <!--register area end-->
        </div>
    </div>
</div>
<script type="text/javascript" src="{{asset('js/auth/verify-otp.js')}}"></script>
@endsection
