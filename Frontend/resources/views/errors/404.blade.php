@extends('layouts.main')
@section('content')
@section('title', 'Cart')
<!-- ...:::: Start Breadcrumb Section:::... -->
    <div class="breadcrumb-section">
        <div class="breadcrumb-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-12 d-flex justify-content-between justify-content-md-between  align-items-center flex-md-row flex-column">
                        <h3 class="breadcrumb-title">404 Pages</h3>

                            {{ Breadcrumbs::render('handleError') }}

                    </div>
                </div>
            </div>
        </div>
    </div> <!-- ...:::: End Breadcrumb Section:::... -->

    <!-- ...:::: Start Error Section :::... -->
    <div class="error-section">
        <div class="container">
            <div class="row">
                <div class="error_form">
                    <h1>404</h1>
                    <h4>Opps! PAGE NOT BE FOUND</h4>
                    <p>Sorry but the page you are looking for does not exist, have been<br> removed, name changed or is temporarily unavailable.</p>
                    <div class="row">
                        <div class="col-10 offset-1 col-md-6 offset-md-3">
                            <div class="default-search-style d-flex">
                                <input class="default-search-style-input-box border-around border-right-none" type="search" placeholder="Search entire store here ..." required>
                                <button class="default-search-style-input-btn" type="submit"><i class="icon-search"></i></button>
                            </div>
                            <a href="index.html">Back to home page</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- ...:::: End Error Section :::... -->
@endsection
