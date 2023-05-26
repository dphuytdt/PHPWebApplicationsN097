@extends('layouts.main')
@section('content')
<h1> This is Home Page </h1>

@foreach($books as $key => $book)
<div class="card" style="width: 18rem;">
    <img src="{{ $book['image'] }}" class="card-img-top" alt="...">
    <div class="card-body">
        <h5 class="card-title">{{ $book['title'] }}</h5>
        <p class="card-text">{{ $book['description'] }}</p>
        <a href="#" class="btn btn-primary">Go somewhere</a>
    </div>
</div>
@endforeach
{{ $books->links() }}
@if (session('token'))
{{-- logout --}}
<a href="{{ route('logout') }}">Logout</a>
@else
{{-- login --}}
<a href="{{ route('login') }}">Login</a>
@endif
@endsection