@extends('layouts.main')
@section('content')
@section('title', 'Search Result')
@foreach ( $books as $key => $book )
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
@endsection