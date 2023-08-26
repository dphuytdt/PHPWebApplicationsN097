@extends('layouts.main')
@section('content')
    @section('title', 'About')

    <div class="breadcrumb-section">
        <div class="breadcrumb-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-12 d-flex justify-content-between justify-content-md-between  align-items-center flex-md-row flex-column">
                        <h3 class="breadcrumb-title">{{__('messages.About Us')}}</h3>
                        {{ Breadcrumbs::render('about') }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="about-us-top-area section-top-gap-100">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="about-us-top-img">
                        <img class="img-fluid" src="{{asset('assets/images/about/about.jpg')}}" alt="">
                    </div>
                    <div class="about-us-top-content text-center">
                        <h4>{{__('messages.Welcome To Our Store!')}}</h4>
                        <p>{{__('messages.Welcome To Our Store passage')}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="about-us-center-area section-top-gap-100">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="about-us-center-content text-center">
                        <h4>{{__('messages.Why Chose Us?')}}</h4>
                    </div>
                </div>
            </div>
            <style>
                .justified {
                    text-align: justify;
                }
                .same-size-image {
                    width: 50px; /* Adjust the width as needed */
                    height: 150px; /* Adjust the height as needed */
                }
            </style>
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="about-promo-single-item">
                        <img src="{{asset('assets/images/icon/about-icon-1.jpg')}}" class="same-size-image" alt="">
                        <h6>{{__('messages.Best Price Guarantee')}}</h6>
                        <p class="justified">
                            {{__('messages.Best Price Guarantee Passage')}}
                        </p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <!-- Start About Promo Single Item -->
                    <div class="about-promo-single-item">
                        <img src="{{asset('assets/images/icon/about-icon-2.jpg')}}" class="same-size-image" alt="">
                        <h6>{{__('messages.Secure Payment')}}</h6>
                        <p class="justified">
                            {{__('messages.Secure Payment Passage')}}
                        </p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <!-- Start About Promo Single Item -->
                    <div class="about-promo-single-item">
                        <img src="{{asset('assets/images/icon/about-icon-3.jpg')}}" class="same-size-image" alt="">
                        <h6>{{__('messages.Online Support 24/7')}}</h6>
                        <p class="justified">
                            {{__('messages.Online Support 24/7 Passage')}}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="about-us-bottom-area section-top-gap-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="about-feature-single-item">
                        <img class="img-fluid" src="{{asset('assets/images/about/about-icon-1.jpg')}}" alt="">
                        <h6>{{__('messages.What Do We Do?')}}</h6>
                        <p class="justified">
                            {{__('messages.What Do We Do Passage')}}
                        </p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="about-feature-single-item">
                        <img class="img-fluid" src="{{asset('assets/images/about/about-icon-2.jpg')}}" alt="">
                        <h6>{{__('messages.Our Mission')}}</h6>
                        <p class="justified">
                            {{__('messages.Our Mission Passage')}}
                        </p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="about-feature-single-item">
                        <img class="img-fluid" src="{{asset('assets/images/about/about-icon-3.jpg')}}" alt="">
                        <h6>{{__('messages.History Of Us')}}</h6>
                        <p class="justified">
                            {{__('messages.History Of Us Passage')}}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
