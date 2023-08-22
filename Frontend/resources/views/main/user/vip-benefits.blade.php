@extends('layouts.main') @section('content') @section('title', 'VIP Benefits') @php $user = session()->get('user'); $is_vip = $user['is_vip']; $vip_experied_date = $user['valid_vip']; $today = date("Y-m-d"); $vip_experied_date =
date("d-m-Y", strtotime($vip_experied_date)); $today = date("d-m-Y", strtotime($today)); @endphp
<link href="{{asset('css/vip/countdown.css')}}" rel="stylesheet">
<div class="breadcrumb-section">
    <div class="breadcrumb-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-12 d-flex justify-content-between justify-content-md-between align-items-center flex-md-row flex-column">
                    <h3 class="breadcrumb-title">VIP Benefits</h3>
                    {{ Breadcrumbs::render('vipBenefits') }}
                </div>
            </div>
        </div>
    </div>
</div>
<div class="privacy-section">
    <div class="container">
        <section class="w-full h-full flex flex-col justify-center items-center">
            <div class="mt-[80px] flex justify-center items-center gap-[40px]">
                <div class="flex flex-col-reverse justify-center items-center space-y-10">
                    <h1 class="mt-[30px] text-2xl text-grayishBlue font-bold">
                        DAYS
                    </h1>
                    <div class="flex justify-center items-center">
                        <div class="flex flex-col text-softRed space-y-[1px] rounded-xl container-shadow" data-days>
                            <span class="relative w-[180px] h-[90px] bg-slightlyDarkerDesBlue overflow-hidden rounded-tl-xl rounded-tr-xl flex justify-center items-end text-8xl">
                                <div class="absolute w-full h-full flex justify-start items-end">
                                    <div class="w-[10px] h-[8px] rounded-tr-full bg-veryDarkBlue"></div>
                                </div>
                                <div class="absolute w-full h-full flex justify-end items-end">
                                    <div class="w-[10px] h-[8px] rounded-tl-full bg-veryDarkBlue"></div>
                                </div>
                                <span class="translate-y-[46px]" data-card-top>
                                    09
                                </span>
                                <span class="absolute w-[180px] h-[90px] bg-slightlyDarkerDesBlue overflow-hidden rounded-tl-xl rounded-tr-xl flex justify-center items-end text-8xl top-flip-shadow" data-flip-top>
                                    <div class="absolute w-full h-full flex justify-start items-end">
                                        <div class="w-[10px] h-[8px] rounded-tr-full bg-veryDarkBlue"></div>
                                    </div>
                                    <div class="absolute w-full h-full flex justify-end items-end">
                                        <div class="w-[10px] h-[8px] rounded-tl-full bg-veryDarkBlue"></div>
                                    </div>
                                    <span class="translate-y-[46px]" data-flip-top-num data-card-top>
                                        00
                                    </span>
                                </span>
                            </span>
                            <span class="relative w-[180px] h-[90px] bg-darkDesaturatedBlue overflow-hidden rounded-bl-xl rounded-br-xl flex justify-center items-end text-8xl bottom-flip-shadow">
                                <div class="absolute w-full h-full flex justify-start items-start">
                                    <div class="w-[10px] h-[8px] rounded-br-full bg-veryDarkBlue"></div>
                                </div>
                                <div class="absolute w-full h-full flex justify-end items-start">
                                    <div class="w-[10px] h-[8px] rounded-bl-full bg-veryDarkBlue"></div>
                                </div>
                                <span class="-translate-y-[45px]" data-card-bot>00</span>
                                <span class="absolute w-[180px] h-[90px] bg-darkDesaturatedBlue overflow-hidden rounded-bl-xl rounded-br-xl flex justify-center items-end text-8xl bottom-flip-shadow" data-flip-bot>
                                    <div class="absolute w-full h-full flex justify-start items-start">
                                        <div class="w-[10px] h-[8px] rounded-br-full bg-veryDarkBlue"></div>
                                    </div>
                                    <div class="absolute w-full h-full flex justify-end items-start">
                                        <div class="w-[10px] h-[8px] rounded-bl-full bg-veryDarkBlue"></div>
                                    </div>
                                    <span class="-translate-y-[45px]" data-flip-bot-num>00</span>
                                </span>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="flex flex-col-reverse justify-center items-center space-y-10">
                    <h1 class="mt-[30px] text-2xl text-grayishBlue font-bold">
                        HOURS
                    </h1>
                    <div class="flex justify-center items-center">
                        <div class="flex flex-col text-softRed space-y-[1px] rounded-xl container-shadow" data-hours>
                            <span class="relative w-[180px] h-[90px] bg-slightlyDarkerDesBlue overflow-hidden rounded-tl-xl rounded-tr-xl flex justify-center items-end text-8xl">
                                <div class="absolute w-full h-full flex justify-start items-end">
                                    <div class="w-[10px] h-[8px] rounded-tr-full bg-veryDarkBlue"></div>
                                </div>
                                <div class="absolute w-full h-full flex justify-end items-end">
                                    <div class="w-[10px] h-[8px] rounded-tl-full bg-veryDarkBlue"></div>
                                </div>
                                <span class="translate-y-[46px]" data-card-top>
                                    00
                                </span>
                                <span class="absolute w-[180px] h-[90px] bg-slightlyDarkerDesBlue overflow-hidden rounded-tl-xl rounded-tr-xl flex justify-center items-end text-8xl top-flip-shadow" data-flip-top>
                                    <div class="absolute w-full h-full flex justify-start items-end">
                                        <div class="w-[10px] h-[8px] rounded-tr-full bg-veryDarkBlue"></div>
                                    </div>
                                    <div class="absolute w-full h-full flex justify-end items-end">
                                        <div class="w-[10px] h-[8px] rounded-tl-full bg-veryDarkBlue"></div>
                                    </div>
                                    <span class="translate-y-[46px]" data-flip-top-num data-card-top>
                                        00
                                    </span>
                                </span>
                            </span>
                            <span class="relative w-[180px] h-[90px] bg-darkDesaturatedBlue overflow-hidden rounded-bl-xl rounded-br-xl flex justify-center items-end text-8xl bottom-flip-shadow">
                                <div class="absolute w-full h-full flex justify-start items-start">
                                    <div class="w-[10px] h-[8px] rounded-br-full bg-veryDarkBlue"></div>
                                </div>
                                <div class="absolute w-full h-full flex justify-end items-start">
                                    <div class="w-[10px] h-[8px] rounded-bl-full bg-veryDarkBlue"></div>
                                </div>
                                <span class="-translate-y-[45px]" data-card-bot>00</span>
                                <span class="absolute w-[180px] h-[90px] bg-darkDesaturatedBlue overflow-hidden rounded-bl-xl rounded-br-xl flex justify-center items-end text-8xl bottom-flip-shadow" data-flip-bot>
                                    <div class="absolute w-full h-full flex justify-start items-start">
                                        <div class="w-[10px] h-[8px] rounded-br-full bg-veryDarkBlue"></div>
                                    </div>
                                    <div class="absolute w-full h-full flex justify-end items-start">
                                        <div class="w-[10px] h-[8px] rounded-bl-full bg-veryDarkBlue"></div>
                                    </div>
                                    <span class="-translate-y-[45px]" data-flip-bot-num>00</span>
                                </span>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="flex flex-col-reverse justify-center items-center space-y-10">
                    <h1 class="mt-[30px] text-2xl text-grayishBlue font-bold">
                        MINUTES
                    </h1>
                    <div class="flex justify-center items-center">
                        <div class="flex flex-col text-softRed space-y-[1px] rounded-xl container-shadow" data-minutes>
                            <span class="relative w-[180px] h-[90px] bg-slightlyDarkerDesBlue overflow-hidden rounded-tl-xl rounded-tr-xl flex justify-center items-end text-8xl">
                                <div class="absolute w-full h-full flex justify-start items-end">
                                    <div class="w-[10px] h-[8px] rounded-tr-full bg-veryDarkBlue"></div>
                                </div>
                                <div class="absolute w-full h-full flex justify-end items-end">
                                    <div class="w-[10px] h-[8px] rounded-tl-full bg-veryDarkBlue"></div>
                                </div>
                                <span class="translate-y-[46px]" data-card-top>
                                    00
                                </span>
                                <span class="absolute w-[180px] h-[90px] bg-slightlyDarkerDesBlue overflow-hidden rounded-tl-xl rounded-tr-xl flex justify-center items-end text-8xl top-flip-shadow" data-flip-top>
                                    <div class="absolute w-full h-full flex justify-start items-end">
                                        <div class="w-[10px] h-[8px] rounded-tr-full bg-veryDarkBlue"></div>
                                    </div>
                                    <div class="absolute w-full h-full flex justify-end items-end">
                                        <div class="w-[10px] h-[8px] rounded-tl-full bg-veryDarkBlue"></div>
                                    </div>
                                    <span class="translate-y-[46px]" data-flip-top-num data-card-top>
                                        00
                                    </span>
                                </span>
                            </span>
                            <span class="relative w-[180px] h-[90px] bg-darkDesaturatedBlue overflow-hidden rounded-bl-xl rounded-br-xl flex justify-center items-end text-8xl bottom-flip-shadow">
                                <div class="absolute w-full h-full flex justify-start items-start">
                                    <div class="w-[10px] h-[8px] rounded-br-full bg-veryDarkBlue"></div>
                                </div>
                                <div class="absolute w-full h-full flex justify-end items-start">
                                    <div class="w-[10px] h-[8px] rounded-bl-full bg-veryDarkBlue"></div>
                                </div>
                                <span class="-translate-y-[45px]" data-card-bot>00</span>
                                <span class="absolute w-[180px] h-[90px] bg-darkDesaturatedBlue overflow-hidden rounded-bl-xl rounded-br-xl flex justify-center items-end text-8xl bottom-flip-shadow" data-flip-bot>
                                    <div class="absolute w-full h-full flex justify-start items-start">
                                        <div class="w-[10px] h-[8px] rounded-br-full bg-veryDarkBlue"></div>
                                    </div>
                                    <div class="absolute w-full h-full flex justify-end items-start">
                                        <div class="w-[10px] h-[8px] rounded-bl-full bg-veryDarkBlue"></div>
                                    </div>
                                    <span class="-translate-y-[45px]" data-flip-bot-num>00</span>
                                </span>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="flex flex-col-reverse justify-center items-center space-y-10">
                    <h1 class="mt-[30px] text-2xl text-grayishBlue font-bold">
                        SECONDS
                    </h1>
                    <div class="flex justify-center items-center">
                        <div class="flex flex-col text-softRed space-y-[1px] rounded-xl container-shadow" data-seconds>
                            <span class="relative w-[180px] h-[90px] bg-slightlyDarkerDesBlue overflow-hidden rounded-tl-xl rounded-tr-xl flex justify-center items-end text-8xl">
                                <div class="absolute w-full h-full flex justify-start items-end">
                                    <div class="w-[10px] h-[8px] rounded-tr-full bg-veryDarkBlue"></div>
                                </div>
                                <div class="absolute w-full h-full flex justify-end items-end">
                                    <div class="w-[10px] h-[8px] rounded-tl-full bg-veryDarkBlue"></div>
                                </div>
                                <span class="translate-y-[46px]" data-card-top>
                                    00
                                </span>
                                <span class="absolute w-[180px] h-[90px] bg-slightlyDarkerDesBlue overflow-hidden rounded-tl-xl rounded-tr-xl flex justify-center items-end text-8xl top-flip-shadow">
                                    <div class="absolute w-full h-full flex justify-start items-end" data-flip-top>
                                        <div class="w-[10px] h-[8px] rounded-tr-full bg-veryDarkBlue"></div>
                                    </div>
                                    <div class="absolute w-full h-full flex justify-end items-end">
                                        <div class="w-[10px] h-[8px] rounded-tl-full bg-veryDarkBlue"></div>
                                    </div>
                                    <span class="translate-y-[46px]" data-flip-top-num data-card-top>
                                        00
                                    </span>
                                </span>
                            </span>
                            <span class="relative w-[180px] h-[90px] bg-darkDesaturatedBlue overflow-hidden rounded-bl-xl rounded-br-xl flex justify-center items-end text-8xl bottom-flip-shadow">
                                <div class="absolute w-full h-full flex justify-start items-start">
                                    <div class="w-[10px] h-[8px] rounded-br-full bg-veryDarkBlue"></div>
                                </div>
                                <div class="absolute w-full h-full flex justify-end items-start">
                                    <div class="w-[10px] h-[8px] rounded-bl-full bg-veryDarkBlue"></div>
                                </div>
                                <span class="-translate-y-[45px]" data-card-bot>00</span>
                                <span class="absolute w-[180px] h-[90px] bg-darkDesaturatedBlue overflow-hidden rounded-bl-xl rounded-br-xl flex justify-center items-end text-8xl bottom-flip-shadow" data-flip-bot>
                                    <div class="absolute w-full h-full flex justify-start items-start">
                                        <div class="w-[10px] h-[8px] rounded-br-full bg-veryDarkBlue"></div>
                                    </div>
                                    <div class="absolute w-full h-full flex justify-end items-start">
                                        <div class="w-[10px] h-[8px] rounded-bl-full bg-veryDarkBlue"></div>
                                    </div>
                                    <span class="-translate-y-[45px]" data-flip-bot-num>00</span>
                                </span>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <div class="row">
            <div id="FF-container">
                <header>
                    <h1>Your <span>VIP</span> Treatment <sup>starts here</sup></h1>
                    <img src="https://i.ibb.co/GWLPqyd/scroll-indicator.png" />
                </header>

                <section class="One border">
                    <div class="center">
                        <h2>You're part of something special</h2>
                        <h3>Welcome to the vip club</h3>
                        <p>We think our customers deserve to be rewarded. So as a thank you for your loyalty over the past 12 months, we’re giving you the red carpet treatment.</p>
                        <p>Our VIP club is designed to give customers even more, with VIP club benefits that only a handful of customers have access to. Plus, our VIP elite customers can expect bonus rewards as part of their experience.</p>
                    </div>
                </section>

                <section class="Three">
                    <div class="flexbox">
                        <img src="https://i.ibb.co/N3PCtgN/appreciated.jpg" />
                        <img src="https://i.ibb.co/SfXC8q0/inspired.jpg" />
                        <img src="https://i.ibb.co/LRVrWz7/treated.jpg" />
                        <img src="https://i.ibb.co/Swz8WTD/wowed.jpg" />
                    </div>
                </section>

                <section class="Two border">
                    <div class="center">
                        <h2>
                            Great customers <br />
                            deserve great<br />
                            rewards
                        </h2>
                        <h3>You’ll have VIP access to</h3>
                        <p>Specially selected offers, gifts and competitions – the VIP Club has it all. What’s more, this VIP year we’ve made your experience ‘better than ever’ with exciting improvements to our promotions.</p>
                    </div>
                </section>

                <hr />

                <section class="Four border">
                    <div class="center">
                        <h2>How to become a VIP?</h2>
                        <h3>
                            How to qualify as <br />
                            a vip every year:
                        </h3>
                        <div>
                            <div class="roundal"><img src="https://i.ibb.co/CBDpPW9/become-vip.png" /></div>
                            <p>Place 4 or more orders with a total value over £300 on one of your customer accounts (after returns)†</p>
                        </div>
                        <div>
                            <div class="roundal"><img src="https://i.ibb.co/KrLQsdp/become-vip-elite.png" /></div>
                            <p>Place at least 4 orders with a total value of £650 or more on one of your customer accounts (after returns)†</p>
                        </div>
                    </div>
                </section>

                <section class="Five border">
                    <h2>
                        Comparing <br />
                        the Rewards
                    </h2>
                    <div class="table">
                        <div class="logos">
                            <div class="space"></div>
                            <div class="roundal vip-elite"></div>
                            <div class="roundal vip"></div>
                        </div>
                        <ul>
                            <li><span>Exclusive VIP mailings and newsletters</span> <sup></sup><sup></sup></li>
                            <li><span>New &amp; improved access to VIP online area</span><sup></sup><sup></sup></li>
                            <li><span>Regular VIP-only competitions and offers</span><sup></sup><sup></sup></li>
                            <li><span>Exclusive email offers</span><sup></sup><sup></sup></li>
                            <li><span>VIP birthday treat</span><sup></sup><sup></sup></li>
                            <li><span>VIP free gifts</span><sup></sup><sup></sup></li>
                            <li><span>Product review panel</span><sup></sup><sup></sup></li>
                            <li><span>Exclusive delivery discounts</span><sup></sup></li>
                            <li><span>Sale and new season previews</span><sup></sup></li>
                            <li><span>Christmas treat</span><sup></sup></li>
                            <li><span>‘It’s On Us’ monthly treats*</span><sup></sup></li>
                            <li><span>Freephone priority number</span><sup></sup></li>
                        </ul>
                    </div>
                </section>

                <hr />

                <section class="Six mobile">
                    <div class="home">
                        <img src="https://i.ibb.co/7nC9bTv/mob-home.jpg" />
                        <lm key="#" class="link">shop womens</lm>
                    </div>
                    <div class="womens">
                        <img src="https://i.ibb.co/w44qVd5/mob-womens.jpg" />
                        <lm key="#" class="link"><span>shop home</span></lm>
                    </div>
                    <div class="mens">
                        <img src="https://i.ibb.co/3FngjyN/mob-mens.jpg" />
                        <lm key="#" class="link"><span>shop mens</span></lm>
                    </div>
                </section>

                <section class="SixTwo desktop grid flexbox">
                    <div class="box one">
                        <lm key="#" class="link"><img class="one" src="https://i.ibb.co/pJzTPt8/womens.jpg" /></lm>
                    </div>

                    <div class="box two">
                        <div class="one">
                            <lm key="#" class="link">
                                <img class="one" src="https://i.ibb.co/wymdsxr/home.jpg" />
                                <img class="two" src="https://i.ibb.co/TK12BQP/shop-home.png" />
                            </lm>
                        </div>

                        <div class="two">
                            <lm key="#" class="link one">
                                <img src="https://i.ibb.co/MSNstCQ/shop-womens.png" />
                            </lm>
                            <lm key="#" class="link two">
                                <img style="margin-right: 1%;" src="https://i.ibb.co/VDTV1Hq/mens.jpg"  alt=""/>
                                <img src="https://i.ibb.co/RbXh01M/shop-mens.png"  alt=""/>
                            </lm>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>
<script src="{{asset('js/countdown.js')}}"
@endsection
