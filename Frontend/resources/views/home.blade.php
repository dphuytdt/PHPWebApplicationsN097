@extends('layouts.main')
@section('content')
<h1> This is Home Page </h1>

@if (session('token'))
{{-- logout --}}
<a href="{{ route('logout') }}">Logout</a>
@else
{{-- login --}}
<a href="{{ route('login') }}">Login</a>
@endif
@endsection