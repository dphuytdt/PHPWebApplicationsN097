@extends('layouts.main') @section('content') @section('title', 'Forgot Password')
<style>
    .account_form.register {
        margin: 0 auto;
        float: none;
    }
</style>
<script
    src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"
    integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw=="
    crossorigin="anonymous"
    referrerpolicy="no-referrer"
></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.js"></script>
<script type="text/javascript" src="{{asset('js/common/errors.js')}}"></script>
<div class="breadcrumb-section">
    <div class="breadcrumb-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-12 d-flex justify-content-between justify-content-md-between align-items-center flex-md-row flex-column">
                    <h3 class="breadcrumb-title">{{__('messages.Forgot Password')}}</h3>
                    {{ Breadcrumbs::render('forgotPassword') }}
                </div>
            </div>
        </div>
    </div>
</div>
<div class="customer_login">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6">
                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                <div class="account_form register">
                    <h3>{{__('messages.Forgot Password')}}</h3>
                    <form id="forgotPswForm" method="POST" action="{{ route('postForgotPassword') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="default-form-box mb-20">
                            <label>{{__('messages.Email address')}} <span>*</span></label>
                            <input id="email" type="text" name="email" value="{{ old('email') }}" data-label="Email" />
                        </div>
                        <div class="login_submit">
                            <button type="submit">{{__('messages.Get OTP')}}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="{{asset('js/auth/forgot-password.js')}}"></script>
@endsection
