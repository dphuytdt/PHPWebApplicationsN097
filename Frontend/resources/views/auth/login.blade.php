@extends('layouts.main') @section('content') @section('title', 'Login - Register')
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
                    <h3 class="breadcrumb-title">{{__('messages.Login - Register')}}</h3>
                    {{ Breadcrumbs::render('login') }}
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
                @else
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                @endif
                <div class="account_form">
                    <h3>{{__('messages.Login')}}</h3>
                    <form id="loginForm" method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="default-form-box mb-20">
                            <label>{{__('messages.Email')}} <span>*</span></label>
                            <input type="text" name="email" value="{{ old('email') }}" data-label="Email" id="email" />
                        </div>
                        <div class="default-form-box mb-20">
                            <label>{{__('messages.Passwords')}} <span>*</span></label>
                            <label for="password"></label><input type="password" name="password" data-label="Password" id="password" value="{{ old('password') }}" />
                        </div>
                        <div class="login_submit">
                            <button class="mb-20" type="submit">{{__('messages.Login')}}</button>
                            <a href="{{ route('forgotPassword') }}">{{__('messages.Lost your password?')}}</a>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="account_form register">
                    <h3>{{__('messages.Register')}}</h3>
                    <form id="registerForm" action="{{ route('postRegister') }}" method="POST">
                        @csrf
                        <div class="default-form-box mb-20">
                            <label>{{__('messages.Full Name')}} <span>*</span></label>
                            <label for="fullname"></label><input type="text" name="fullname" id="fullname" data-label="Full Name" />
                        </div>
                        <div class="default-form-box mb-20">
                            <label>{{__('messages.Email address')}} <span>*</span></label>
                            <label for="email"></label><input type="text" name="email" id="email" data-label="Email Address" />
                        </div>
                        <div class="default-form-box mb-20">
                            <label>{{__('messages.Passwords')}} <span>*</span></label>
                            <label for="passwordRe"></label><input type="password" name="passwordRe" id="passwordRe" data-label="Password" />
                        </div>
                        <div class="default-form-box mb-20">
                            <label>{{__('messages.Passwords Confirm')}} <span>*</span></label>
                            <label for="password_confirmation"></label><input type="password" name="password_confirmation" id="password_confirmation" data-label="Password Confirm" />
                        </div>
                        <div class="login_submit">
                            <button type="submit">{{__('messages.Register')}}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="{{asset('js/auth/login.js')}}"></script>
<script type="text/javascript" src="{{asset('js/auth/register.js')}}"></script>
@endsection
