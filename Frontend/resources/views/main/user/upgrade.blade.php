@extends('layouts.main') @section('content') @section('title', 'Upgrade to VIP')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
<link rel="stylesheet" href="{{asset('css/vip/style.css')}}" />
<div class="breadcrumb-section">
    <div class="breadcrumb-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-12 d-flex justify-content-between justify-content-md-between align-items-center flex-md-row flex-column">
                    <h3 class="breadcrumb-title">{{__('messages.Upgrade to VIP')}}</h3>
                    {{ Breadcrumbs::render('upgrade') }}
                </div>
            </div>
        </div>
    </div>
</div>
<section class="pricing-section">
    <div class="container">
        <div class="sec-title text-center">
            <span class="title">{{__('messages.Get plan')}}</span>
            <h2>{{__('messages.Choose a Plan')}}</h2>
        </div>

        <div class="outer-box">
            <div class="row">
                <div class="pricing-block col-lg-4 col-md-6 col-sm-12 wow fadeInUp">
                    <div class="inner-box">
                        <div class="icon-box">
                            <div class="icon-outer"><i class="fas fa-paper-plane"></i></div>
                        </div>
                        <div class="price-box">
                            <div class="title">Monthly Pass</div>
                            <h4 class="price">$35.99</h4>
                        </div>
                        <ul class="features">
                            <li class="true">Conference plans</li>
                            <li class="true">Free Lunch And Coffee</li>
                            <li class="true">Certificate</li>
                            <li class="false">Easy Access</li>
                            <li class="false">Free Contacts</li>
                        </ul>
                        <div class="btn-box">
                            <a href="" class="theme-btn">BUY plan</a>
                        </div>
                    </div>
                </div>
                <div class="pricing-block col-lg-4 col-md-6 col-sm-12 wow fadeInUp" data-wow-delay="400ms">
                    <div class="inner-box">
                        <div class="icon-box">
                            <div class="icon-outer"><i class="fas fa-gem"></i></div>
                        </div>
                        <div class="price-box">
                            <div class="title">Year Pass</div>
                            <h4 class="price">$99.99</h4>
                        </div>
                        <ul class="features">
                            <li class="true">Conference plans</li>
                            <li class="true">Free Lunch And Coffee</li>
                            <li class="true">Certificate</li>
                            <li class="true">Easy Access</li>
                            <li class="false">Free Contacts</li>
                        </ul>
                        <div class="btn-box">
                            <a href="" class="theme-btn">BUY plan</a>
                        </div>
                    </div>
                </div>
                <div class="pricing-block col-lg-4 col-md-6 col-sm-12 wow fadeInUp" data-wow-delay="800ms">
                    <div class="inner-box">
                        <div class="icon-box">
                            <div class="icon-outer"><i class="fas fa-rocket"></i></div>
                        </div>
                        <div class="price-box">
                            <div class="title">Group Pass</div>
                            <h4 class="price">$199.99</h4>
                        </div>
                        <ul class="features">
                            <li class="true">Conference plans</li>
                            <li class="true">Free Lunch And Coffee</li>
                            <li class="true">Certificate</li>
                            <li class="true">Easy Access</li>
                            <li class="true">Free Contacts</li>
                        </ul>
                        <div class="btn-box">
                            <a href="" class="theme-btn">BUY plan</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
