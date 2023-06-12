<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Input OTP | Ebook</title>
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> --}}
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}" />
    <link rel="stylesheet" href="{{asset('css/auth/login.css')}}" type="text/css"/>
    <style>
        .login-links{
            display: flex;
            justify-content: center;
        }
    </style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.js"></script>
</head>
<body>
    <div class="container">
        <h2 class="login-title">Forgot Password</h2>
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <form class="login-form" method="POST" action="{{ route('postForgotPassword') }}">
            @csrf
            <div>
                <label for="otp">Your OTP </label>
                <input id="otp" type="text" placeholder="Input Email Address" name="otp" required/>
            </div>
            <button class="btn btn--form" type="submit" value="Input OTP">
                Input OTP
            </button>
        </form>
        <br>
        <div class="login-links">
            <a href="{{ route('forgotPassword') }}">Back</a>
        </div>
    </div>
</body>
</html>