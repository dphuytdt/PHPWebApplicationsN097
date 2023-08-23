@extends('layouts.main') @section('content') @section('title', 'Page Not Found') @section('meta_description', 'Page Not Found') @section('meta_keywords', 'Page Not Found')
<div class="breadcrumb-section">
    <div class="breadcrumb-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-12 d-flex justify-content-between justify-content-md-between align-items-center flex-md-row flex-column">
                    <h3 class="breadcrumb-title">{{__('messages.404 Not Found')}}</h3>

                    {{ Breadcrumbs::render('handleError') }}
                </div>
            </div>
        </div>
    </div>
</div>
<div class="error-section">
    <div class="container">
        <div class="row">
            <div class="error_form">
                <h1>404</h1>
                <h4>{{__('messages.PNF')}}</h4>
                <p>
                    {{__('messages.PNF')}}<br />
                    {{__('messages.remmove')}}
                </p>
                <div class="row">
                    <div class="col-10 offset-1 col-md-6 offset-md-3">
                        <div class="default-search-style d-flex">
                            <input class="default-search-style-input-box border-around border-right-none" type="search" placeholder="{{__('messages.typeKeyWord')}}" required />
                            <button class="default-search-style-input-btn" type="submit"><i class="icon-search"></i></button>
                        </div>
                        <a href="{{route('home')}}">{{__('messages.backHome')}}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
