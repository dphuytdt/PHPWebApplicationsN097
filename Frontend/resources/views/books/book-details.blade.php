@extends('layouts.main')
@section('content')
@section('title', 'Book Details')
<h1> {{ $book['title'] }} </h1>
<p> {{ $book['description'] }} </p>
{{-- <p> {{ $book['author'] }} </p> --}}
<a href="{{ route('home') }}"> Back to all books </a>
@endsection
