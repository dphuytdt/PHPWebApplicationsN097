@extends('layouts.main') @section('content') @section('title', 'VIP Benefits') @php $user = session()->get('user'); $is_vip = $user['is_vip']; $vip_experied_date = $user['valid_vip']; $today = date("Y-m-d"); $vip_experied_date =
date("d-m-Y", strtotime($vip_experied_date)); $today = date("d-m-Y", strtotime($today)); @endphp
<link rel="stylesheet" href="{{asset('css/vip/countdown.css')}}">
<script src="{{asset('js/countdown.js')}}"></script>
<div class="breadcrumb-section">
    <div class="breadcrumb-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-12 d-flex justify-content-between justify-content-md-between align-items-center flex-md-row flex-column">
                    <h3 class="breadcrumb-title">{{__('messages.VIP Benefits')}}</h3>
                    {{ Breadcrumbs::render('vipBenefits') }}
                </div>
            </div>
        </div>
    </div>
</div>
<div class="privacy-section">
    <div class="container">
        <section class="coming-soon">
            <div>
                <h2>
                    {{__('messages.Congratulations! You are a VIP member!')}}
                    <br>
                    <span>{{__('messages.Enjoy your benefits!')}}</span>
                </h2>
                <div class="countdown">
                    <div class="container-day">
                        <h3 class="day">-</h3>
                        <span>{{__('messages.Day')}}</span>
                    </div>
                    <div class="container-hour">
                        <h3 class="hour">-</h3>
                        <span>{{__('messages.Hour')}}</span>
                    </div>
                    <div class="container-minute">
                        <h3 class="minute">-</h3>
                        <span>{{__('messages.Minute')}}</span>
                    </div>
                    <div class="container-second">
                        <h3 class="second">-</h3>
                        <span>{{__('messages.Second')}}</span>
                    </div>
                </div>
            </div>
            <img class="waiting" src="https://therapyzen.com/Content/img/Calendar-hero.png" alt="">
        </section>
    </div>
</div>
@endsection
