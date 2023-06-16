@extends('layouts.auth')
@section('content')
@section('title', 'Login Admin')
@section('heading', 'Login Admin')
 @if(Session::has('error'))
 <div class="alert alert-danger">
    {{Session::get('error')}}
 </div>
 @endif
    <form id="loginForm" class="user" action="{{route('login')}}" method="POST">
        @csrf
        <div class="form-group">
        <input type="email" class="form-control form-control-user" id="email" aria-describedby="emailHelp" name="email" data-label="Email Address" placeholder="Enter Email Address...">
        </div>
        <div class="form-group">
        <input type="password" class="form-control form-control-user" name="password" data-label="Password" id="password" placeholder="Password"> </div>
        <button type="submit" class="btn btn-primary btn-user btn-block">Login </button>
        <hr>
    </form>
    <div class="text-center">
        <a class="small" href="{{route('requestResetPassword')}}">Request a new password!</a>
    </div>
    <div class="text-center">
        <a class="small" href="{{URL::to('http://frontend.test:8080/')}}">Back to Home!</a>
    </div>
    <script type="text/javascript" src="{{asset('admin/js/auth/login.js')}}"></script>
@endsection
                              