<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login </title>
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> --}}
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}" />
    <link rel="stylesheet" href="{{asset('css/auth/login.css')}}" type="text/css"/>
</head>
<body>
    <div class="container">
        <h2 class="login-title">Log in</h2>
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <form class="login-form" method="POST" action="{{ route('login') }}">
            @csrf
          <div>
            <label for="email">Email </label>
            <input
                   id="email"
                   type="email"
                   placeholder="me@example.com"
                   name="email"
                   required
                   />
          </div>
    
          <div>
            <label for="password">Password </label>
            <input
                   id="password"
                   type="password"
                   placeholder="password"
                   name="password"
                   required
                   />
          </div>
    
          <button class="btn btn--form" type="submit" value="Log in">
            Log in
          </button>
        </form>
        <div class="login-links">
            <a href="{{ route('register') }}">Create an account</a>
            <a href="{{ route('forgotPassword') }}">Forgot your password?</a>
        </div>
    </div>
</body>
</html>