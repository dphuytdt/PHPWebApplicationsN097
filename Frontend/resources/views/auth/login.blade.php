@extends('layouts.main')
@section('content')
@section('title', 'Login - Register')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.js"></script>
<script type="text/javascript" src="{{asset('js/common/errors.js')}}"></script>

    <!-- ...:::: Start Breadcrumb Section:::... -->
    <div class="breadcrumb-section">
        <div class="breadcrumb-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-12 d-flex justify-content-between justify-content-md-between  align-items-center flex-md-row flex-column">
                        <h3 class="breadcrumb-title">Login - Register</h3>
                        <div class="breadcrumb-nav">
                            <nav aria-label="breadcrumb">
                                <ul>
                                    <li><a href="index.html">Home</a></li>
                                    <li><a href="shop-grid-sidebar-left.html">Shop</a></li>
                                    <li class="active" aria-current="page">Login</li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- ...:::: End Breadcrumb Section:::... -->

    <!-- ...:::: Start Customer Login Section :::... -->
    <div class="customer_login">
        <div class="container">
            <div class="row">
                <!--login area start-->
                <div class="col-lg-6 col-md-6">
                    @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                     @endif
                    <div class="account_form">
                        <h3>login</h3>
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="default-form-box mb-20">
                                <label>Email <span>*</span></label>
                                <input type="email" name="email">
                            </div>
                            <div class="default-form-box mb-20">
                                <label>Passwords <span>*</span></label>
                                <input type="password" name="password">
                                {{-- <i class="fas fa-eye password-toggle-icon" id="psw-toggle" onclick="togglePasswordVisibility('password')"></i> --}}
                            </div>
                            <div class="login_submit">
                                <button class="mb-20" type="submit">Login</button>
                                {{-- <label class="checkbox-default mb-20" for="offer">
                                    <input type="checkbox" id="offer">
                                    <span>Remember me</span>
                                </label> --}}
                                <a href="{{ route('forgotPassword') }}">Lost your password?</a>

                            </div>
                        </form>
                    </div>
                </div>
                <!--login area start-->

                <!--register area start-->
                <div class="col-lg-6 col-md-6">
                    <div class="account_form register">
                        <h3>Register</h3>
                        <form action="{{ route('postRegister') }}" method="POST">
                            @csrf
                            <div class="default-form-box mb-20">
                                <label>Full Name <span>*</span></label>
                                <input type="text" name="fullname">
                            </div>
                            <div class="default-form-box mb-20">
                                <label>Email address <span>*</span></label>
                                <input type="email" name="email">
                            </div>
                            <div class="default-form-box mb-20">
                                <label>Passwords <span>*</span></label>
                                <input type="password" name="password">
                            </div>
                            <div class="default-form-box mb-20">
                                <label>Passwords Confirm <span>*</span></label>
                                <input type="password" name="password_confirmation">
                            </div>
                            <div class="login_submit">
                                <button type="submit">Register</button>
                            </div>
                        </form>
                    </div>
                </div>
                <!--register area end-->
            </div>
        </div>
    </div> <!-- ...:::: End Customer Login Section :::... -->
    <script type="text/javascript" src="{{asset('js/auth/login.js')}}"></script>
@endsection