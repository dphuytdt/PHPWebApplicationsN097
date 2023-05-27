@extends('layouts.main')
@section('content')
@section('title', 'Home')
<h1> This is Home Page </h1>
{{-- search box --}}
<form action="{{ route('search') }}" method="GET">
    <input type="text" name="query" />
    <input type="submit" value="Search" />
</form>
@foreach($books as $key => $book)
<a href="{{ route('bookDetails', ['id' => $book['id']]) }}">
<div class="card" style="width: 18rem;">
    <img src="{{ $book['image'] }}" class="card-img-top" alt="...">
    <div class="card-body">
        <h5 class="card-title">{{ $book['title'] }}</h5>
        <p class="card-text">{{ $book['description'] }}</p>
        <a href="#" class="btn btn-primary">Go somewhere</a>
    </div>
</div>
</a>
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