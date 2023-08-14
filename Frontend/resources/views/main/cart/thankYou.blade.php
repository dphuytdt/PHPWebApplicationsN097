@extends('layouts.main')
@section('content')
@section('title', 'Thanks you')
<style>
    .thankyou-wrapper{
        width:100%;
        height:auto;
        margin:auto;
        background:#ffffff;
        padding:10px 0px 50px;
    }
    .thankyou-wrapper h1{
        font:100px Arial, Helvetica, sans-serif;
        text-align:center;
        color:#333333;
        padding:0px 10px 10px;
    }
    .thankyou-wrapper p{
        font:26px Arial, Helvetica, sans-serif;
        text-align:center;
        color:#333333;
        padding:5px 10px 10px;
    }
    .thankyou-wrapper a{
        font:26px Arial, Helvetica, sans-serif;
        text-align:center;
        color:#ffffff;
        display:block;
        text-decoration:none;
        width:250px;
        background:#E47425;
        margin:10px auto 0px;
        padding:15px 20px 15px;
        border-bottom:5px solid #F96700;
    }
    .thankyou-wrapper a:hover{
        font:26px Arial, Helvetica, sans-serif;
        text-align:center;
        color:#ffffff;
        display:block;
        text-decoration:none;
        width:250px;
        background:#F96700;
        margin:10px auto 0px;
        padding:15px 20px 15px;
        border-bottom:5px solid #F96700;
    }
</style>
<div class="breadcrumb-section">
    <div class="breadcrumb-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-12 d-flex justify-content-between justify-content-md-between  align-items-center flex-md-row flex-column">
                    <h3 class="breadcrumb-title">{{__('messages.Thankyou')}}</h3>
                    {{ Breadcrumbs::render('thankYou') }}
                </div>
            </div>
        </div>
    </div>
</div> <!-- ...:::: End Breadcrumb Section:::... -->
<section class="login-main-wrapper">
    <div class="main-container">
        <div class="login-process">
            <div class="login-main-container">
                <div class="thankyou-wrapper">
                    <h1><img src="http://montco.happeningmag.com/wp-content/uploads/2014/11/thankyou.png" alt="thanks"/></h1>
                    <p>{{__('messages.forChoosing')}} </p>
                    <a href="{{route('home')}}">{{__('messages.backHome')}}</a>
                    <div class="clr"></div>
                </div>
                <div class="clr"></div>
            </div>
        </div>
        <div class="clr"></div>
    </div>
</section>
@endsection
