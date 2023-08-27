@extends('layouts.auth')
@section('content')
@section('title', 'Request Password')
@section('heading', 'Request Password')
    @if(Session::has('error'))
        <div class="alert alert-danger">
            {{Session::get('error')}}
        </div>
    @endif
    <form id="requestForm" class="user" action="{{route('postRequestResetPassword')}}" method="POST">
        @csrf
        <div class="form-group">
        <input type="email" class="form-control form-control-user" id="email" aria-describedby="emailHelp" name="email" data-label="Email Address"
            placeholder="Enter Email Address..."> </div>
        <div class="form-group">
        <div id="emailError" class="error"></div></div>
        <button type="submit" class="btn btn-primary btn-user btn-block">Send request</button>
        <hr>
    </form>
    <div class="text-center">
        <a class="small" href="{{route('login')}}">Back</a>
    </div>
    <script type="text/javascript" src="{{asset('admin/js/auth/request.js')}}"></script>
@endsection
