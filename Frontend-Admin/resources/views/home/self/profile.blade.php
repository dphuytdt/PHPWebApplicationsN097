@extends('layouts.admin') @section('content') @section('title', 'My Profile')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">{{ Breadcrumbs::render('profile', session('admin')['id']) }}</h1>
</div>
@endsection
