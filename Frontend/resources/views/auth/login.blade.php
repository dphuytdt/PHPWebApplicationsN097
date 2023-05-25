<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login </title>
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> --}}
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}" />
    <style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    html,
    body {
        height: 100%;
    }

    html {
        background: linear-gradient(to right bottom, #fbdb89, #f48982);
        background-repeat: no-repeat;
        background-size: cover;
        width: 100%;
        height: 100%;
        background-attachment: fixed;
    }

    body {
        font-family: sans-serif;
        line-height: 1.4;
        display: flex;
    }

    .container {
        width: 400px;
        margin: auto;
        padding: 36px 48px 48px 48px;
        background-color: #f2efee;

        border-radius: 11px;
        box-shadow: 0 2.4rem 4.8rem rgba(0, 0, 0, 0.15);
    }

    .login-title {
        padding: 15px;
        font-size: 22px;
        font-weight: 600;
        text-align: center;
    }

    .login-form {
        display: grid;
        grid-template-columns: 1fr;
        row-gap: 16px;
    }

    .login-form label {
        display: block;
        margin-bottom: 8px;
    }

    .login-form input {
        width: 100%;
        padding: 1.2rem;
        border-radius: 9px;
        border: none;
    }

    .login-form input:focus {
        outline: none;
        box-shadow: 0 0 0 4px rgba(253, 242, 233, 0.5);
    }

    .btn--form {
        background-color: #f48982;
        color: #fdf2e9;
        align-self: end;
        padding: 8px;
    }

    .btn,
    .btn:link,
    .btn:visited {
        display: inline-block;
        text-decoration: none;
        font-size: 20px;
        font-weight: 600;
        border-radius: 9px;
        border: none;

        cursor: pointer;
        font-family: inherit;

        transition: all 0.3s;
    }

    button {
        outline: 1px solid #f48982;
    }

    .btn--form:hover {
        background-color: #fdf2e9;
        color: #f48982;
    }
</style>
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
    </div>
</body>
</html>