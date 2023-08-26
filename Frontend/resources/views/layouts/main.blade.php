<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="_token" content="{{ csrf_token() }}">
    <title>@yield('title') | Ebook</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}" />
    <link rel="stylesheet" href="{{asset('assets/css/vendor/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/vendor/plaza-icon.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/vendor/jquery-ui.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/plugins/slick.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/plugins/animate.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/plugins/nice-select.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/plugins/venobox.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
    <style>
        .user-sub-menu-in-icon {
            width: 20px;
            height: 20px;
        }
        .header-logo img {
            width: 50px;
            height: 50px;
        }
        .user-sub-menu-in-icon {
            width: 20px;
            height: 20px;
        }
        .footer-logo img {
            width: 40%;
            height: 50%;
        }
    </style>
</head>

<body>

<header class="header-section d-lg-block d-none">
    <div class="header-top">
        <div class="container">
            <div class="row d-flex justify-content-between align-items-center">
                <div class="col-6">
                    <div class="header-top--left">
                        <span>{{__('messages.welcome')}}</span>
                    </div>
                </div>
                <div class="col-6">
                    <div class="header-top--right">
                        <ul class="header-user-menu">
                            <li class="has-user-dropdown">
                                <i class="fa fa-language"></i>
                                <a>{{__('messages.Language')}}</a>
                                <ul class="user-sub-menu">
                                    <li><a href="{!! route('changeLanguage', ['en']) !!}"><img class="user-sub-menu-in-icon" src="{{asset('assets/images/icon/united-kingdom.png')}}" alt=""> English</a></li>
                                    <li><a href="{!! route('changeLanguage', ['vi']) !!}"><img class="user-sub-menu-in-icon" src="{{asset('assets/images/icon/vietnam.png')}}" alt=""> VietNam</a></li>
                                    <li><a href="{!! route('changeLanguage', ['jp']) !!}"><img class="user-sub-menu-in-icon" src="{{asset('assets/images/icon/japan.png')}}" alt=""> Japan</a></li>
                                    <li><a href="{!! route('changeLanguage', ['kr']) !!}"><img class="user-sub-menu-in-icon" src="{{asset('assets/images/icon/korea.png')}}" alt=""> Korea</a></li>
                                </ul>
                            </li>
                            <li class="has-user-dropdown">
                                <i class="fa fa-cog"></i>
                                <a href="">{{__('messages.setting')}}</a>
                                <ul class="user-sub-menu">
                                    <li><a href="#"><i class="fa fa-moon-o"></i> {{__('messages.darkmode')}}</a></li>
                                    <li><a href="#"><i class="fa fa-sun-o"></i> {{__('messages.lightmode')}}</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="header-center">
        <div class="container">
            <div class="row d-flex justify-content-between align-items-center">
                <div class="col-3">
                    <div class="header-logo">
                        <a href="{{route('home')}}"><img src="{{asset('images/logo.png')}}" alt=""></a>
                    </div>
                </div>
                <div class="col-6">
                    <div class="header-search">
                        <form action="{{route('search')}}" method="GET">
                            <div class="header-search-box default-search-style d-flex">
                                <input name="keyword" class="default-search-style-input-box border-around border-right-none" type="search" placeholder="{{__('messages.typeKeyWord')}}">
                                <button class="default-search-style-input-btn" type="submit"><i class="icon-search"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-3 text-right">

                    <ul class="header-action-icon">
                        <li>
                            <a href="#offcanvas-wishlish" class="offcanvas-toggle">
                                <i class="icon-heart"></i>
                                <span class="header-action-icon-item-count count-wishlist" id="count-wishlist">0</span>
                            </a>
                        </li>
                        <li>
                            <a href="#offcanvas-add-cart" class="offcanvas-toggle">
                                <i class="icon-shopping-cart"></i>
                                <span class="header-action-icon-item-count cart-count">0</span>
                            </a>
                        </li>
                        @if(session()->has('user'))
                            @php
                                $user = session()->get('user');
                                $is_vip = $user['is_vip'];
                            @endphp
                            <li class="has-user-dropdown">
                                <a href="">
                                    <i class="icon-user has-user-dropdow"></i>
                                    <ul class="user-sub-menu">
                                        <li>
                                            <a id="callMicroservicesLink" href="{{route('profile')}}">
                                                {{__('messages.myAccount')}}
                                            </a>
                                        </li>
                                        @php
                                            $user_id = session()->get('user')['id'];
                                        @endphp
                                        @if($is_vip == 1)
                                            <li><a href="{{route('vipBenefits')}}">{{__('messages.vipMember')}}</a></li>
                                        @else
                                            <li><a href="{{route('upgrade')}}">{{__('messages.upgradeVip')}}</a></li>
                                        @endif
                                        <li><a href="{{route('logout')}}">{{__('messages.logout')}}</a></li>
                                    </ul>
                                </a>
                            </li>
                        @else
                            <li>
                                <a href="{{route('login')}}">
                                    <i class="fa fa-sign-in" aria-hidden="true"></i>
                                </a>
                                @endif
                            </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>


    <div class="header-bottom sticky-header">
        <div class="container">
            <div class="row">
                <div class="col-12">

                    <div class="main-menu">
                        <nav>
                            <ul>
                                <li class="has-dropdown">
                                    <a class="active main-menu-link" href="{{route('home')}}">{{ __('messages.home') }}</a>
                                </li>
                                <li class="has-dropdown">
                                    <a href="#">{{ __('messages.category') }} <i class="fa fa-angle-down"></i></a>

                                    <ul class="sub-menu">
                                        @foreach ( $categories as $category )
                                            @php
                                                $name = __('messages.'.$category['name']);
                                            @endphp
                                            <li><a  href="{{route('getBookByCategory', ['id' => $category['id']])}}"> {{ $category['name'] }}</a></li>
                                        @endforeach
                                        <li><a href="{{route('category')}}"> {{ __('messages.viewMore') }}</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="{{route('news')}}">{{ __('messages.news') }}</a>
                                </li>
                                <li>
                                    <a href="{{route('about')}}">{{ __('messages.about') }}</a>
                                </li>
                                <li>
                                    <a href="{{route('contact')}}"> {{ __('messages.contact') }}</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<div class="mobile-header-section d-block d-lg-none">
    <div class="mobile-header-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-12 d-flex justify-content-between align-items-center">
                    <div class="mobile-header--left">
                        <a href="" class="mobile-logo-link">
                            <img src="{{asset('assets/images/logo/logo.png')}}" alt="" class="mobile-logo-img">
                        </a>
                    </div>
                    <div class="mobile-header--right">
                        <a href="#mobile-menu-offcanvas" class="mobile-menu offcanvas-toggle">
                            <span class="mobile-menu-dash"></span>
                            <span class="mobile-menu-dash"></span>
                            <span class="mobile-menu-dash"></span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="mobile-menu-offcanvas" class="offcanvas offcanvas-leftside offcanvas-mobile-menu-section">
    <div class="offcanvas-header text-right">
        <button class="offcanvas-close"><i class="fa fa-times"></i></button>
    </div>
    <div class="offcanvas-mobile-menu-wrapper">
        <div class="mobile-menu-top">
            <span>{{ __('messages.welcome') }}</span>
            <ul class="mobile-menu-user-menu">
                <li><a class="header-user-menu-link" href=""><i class="fa fa-cog"></i>{{ __('messages.setting') }}</a></li>
                <li class="has-mobile-user-dropdown">
                    <a class="mobile-user-menu-link" href="">{{ __('messages.myAccount') }}</a>
                    <ul class="mobile-user-sub-menu">
                        <li><a href="{{route('profile')}}">{{__('messages.myAccount')}}</a></li>
                        @if(session()->has('user'))
                            @php
                                $user_id = session()->get('user')['id'];
                            @endphp
                            @if($is_vip == 1)
                                <li><a href="{{route('vipBenefits')}}">{{__('messages.vipMember')}}</a></li>
                            @else
                                <li><a href="{{route('upgrade')}}">{{__('messages.upgradeVip')}}</a></li>
                            @endif
                        @endif
                        <li><a href="{{route('logout')}}">{{__('messages.logout')}}</a></li>
                    </ul>
                </li>
                <li class="has-mobile-user-dropdown">
                    <a class="mobile-user-menu-link" href="">{{__('messages.Language')}}</a>
                    <ul class="mobile-user-sub-menu">
                        <li><a href="{!! route('changeLanguage', ['en']) !!}"><img class="user-sub-menu-in-icon" src="{{asset('assets/images/icon/united-kingdom.png')}}" alt=""> English</a></li>
                        <li><a href="{!! route('changeLanguage', ['vi']) !!}"><img class="user-sub-menu-in-icon" src="{{asset('assets/images/icon/vietnam.png')}}" alt=""> VietNam</a></li>
                        <li><a href="{!! route('changeLanguage', ['jp']) !!}"><img class="user-sub-menu-in-icon" src="{{asset('assets/images/icon/japan.png')}}" alt=""> Japan</a></li>
                        <li><a href="{!! route('changeLanguage', ['kr']) !!}"><img class="user-sub-menu-in-icon" src="{{asset('assets/images/icon/korea.png')}}" alt=""> Korea</a></li>
                    </ul>
                </li>
            </ul>
        </div>

        <div class="mobile-menu-center">
            <form action="#" method="post">
                <div class="header-search-box default-search-style d-flex">
                    <i class="fa-solid fa-filter"></i>
                    <input class="default-search-style-input-box border-around border-right-none" type="search" placeholder="{{__('messages.typeKeyWord')}}" required>
                    <button class="default-search-style-input-btn" type="submit"><i class="icon-search"></i></button>
                </div>
            </form>
            <div class="mobile-menu-customer-support">
                <div class="mobile-menu-customer-support-icon">
                    <img src="{{asset('assets/images/icon/support-icon.png')}}" alt="">
                </div>
                <div class="mobile-menu-customer-support-text">
                    <span>{{__('messages.customerSupport')}}</span>
                    <a class="mobile-menu-customer-support-text-phone" href="tel:(08)123456789">(08) 123 456 789</a>
                </div>
            </div>
            <ul class="mobile-action-icon">
                <li class="mobile-action-icon-item">
                    @if(session()->has('user'))
                        <a href="{{route('wishlist.index', $user_id)}}" class="mobile-action-icon-link">
                            <i class="icon-heart"></i>
                            <span class="mobile-action-icon-item-count count-wishlist" id="count-wishlist"></span>
                        </a>
                    @else
                        <a class="mobile-action-icon-link">
                            <i class="icon-heart"></i>
                            <span class="mobile-action-icon-item-count count-wishlist" id="count-wishlist"></span>
                        </a>
                    @endif
                </li>
                <li class="mobile-action-icon-item">

                </li>
            </ul>
        </div>
        <div class="mobile-menu-bottom">
            <div class="offcanvas-menu">
                <ul>
                    <li>
                        <a href="{{route('home')}}"><span>{{ __('home') }}</span></a>
                    </li>
                    <li>
                        <a href="#"><span>>{{ __('messages.category') }}</span></a>
                        <ul class="mobile-sub-menu">
                            <li>
                                <a href="#">>{{ __('messages.category') }}t</a>
                                <ul class="mobile-sub-menu">
                                    @foreach ( $categories as $category )
                                        @php
                                            $name = __('messages.'.$category['name']);
                                        @endphp
                                        <li><a  href="{{route('getBookByCategory', ['id' => $category['id']])}}"> {{ $category['name'] }}</a></li>
                                    @endforeach
                                    <li><a href="{{route('category')}}"> {{ __('messages.viewMore') }}</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="{{route('news')}}">{{ __('messages.news') }}</a>
                    </li>
                    <li>
                        <a href="{{route('about')}}">{{ __('messages.about') }}</a>
                    </li>
                    <li>
                        <a href="{{route('contact')}}"> {{ __('messages.contact') }}</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div id="offcanvas-add-cart" class="offcanvas offcanvas-rightside offcanvas-add-cart-section">
    <div class="offcanvas-header text-right">
        <button class="offcanvas-close"><i class="fa fa-times"></i></button>
    </div>
    <div class="offcanvas-add-cart-wrapper">
        <h4 class="offcanvas-title"{{__('messages.cart')}}></h4>
        <ul class="offcanvas-cart">
        </ul>
        @if(session()->has('user'))
        <div class="offcanvas-cart-total-price">
            <span class="offcanvas-cart-total-price-text">{{__('messages.subtotal')}}:</span>
            <span class="offcanvas-cart-total-price-value total_price" id="total_price"></span>
        </div>
        <ul class="offcanvas-cart-action-button">
                @php
                    $user_id = session()->get('user')['id']
                @endphp
                <li class="offcanvas-cart-action-button-list"><a href="{{route('cart.getUserCart',$user_id)}}" class="offcanvas-cart-action-button-link">{{__('messages.viewCart')}}</a></li>
                <li class="offcanvas-cart-action-button-list"><a href="{{route('cart.checkOut',$user_id)}}" class="offcanvas-cart-action-button-link">{{__('messages.checkout')}}</a></li>
            @else
                <li class="offcanvas-cart-action-button-list"><a href="{{route('login')}}" class="offcanvas-cart-action-button-link">{{__('messages.requestLogin')}}</a></li>
            @endif
        </ul>
    </div>

</div>
<div id="offcanvas-wishlish" class="offcanvas offcanvas-rightside offcanvas-add-cart-section">
    <div class="offcanvas-header text-right">
        <button class="offcanvas-close"><i class="fa fa-times"></i></button>
    </div>
    <div class="offcanvas-wishlist-wrapper">
        <h4 class="offcanvas-title">{{__('messages.wishlist')}}</h4>
        <ul class="offcanvas-wishlist" id="offcanvas-wishlist">
        </ul>
        <ul class="offcanvas-wishlist-action-button">
            @if(session()->has('user'))
            <li class="offcanvas-wishlist-action-button-list"><a href="{{route('wishlist.index', $user_id )}}" class="offcanvas-wishlist-action-button-link">{{__('messages.View Wishlist')}}</a></li>
            @else
            <li class="offcanvas-wishlist-action-button-list"><a href="{{route('login')}}" class="offcanvas-wishlist-action-button-link">{{__('messages.Please login or register to view wishlist!')}}</a></li>
            @endif
        </ul>
    </div>
</div>

<div class="offcanvas-overlay"></div>
@yield('content')
<footer class="footer-section section-top-gap-100">
    <div class="footer-top section-inner-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-5">
                    <div class="footer-widget footer-widget-contact">
                        <div class="footer-logo">
                            <a href="{{route('home')}}"><img src="{{ asset('images/logo.png') }}" alt="" class="img-fluid"></a>
                        </div>
                        <div class="footer-contact">
                            <p>{{__('messages.intro')}}</p>
                            <div class="customer-support">
                                <div class="customer-support-icon">
                                    <img src="{{asset('assets/images/icon/support-icon.png')}}" alt="">
                                </div>
                                <div class="customer-support-text">
                                    <span>{{__('messages.customerSupport')}}</span>
                                    <a class="customer-support-text-phone" href="tel:(03)32420477">(03) 3242 0477</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 col-md-5 col-sm-7">
                    <div class="footer-widget footer-widget-subscribe">
                        <h3 class="footer-widget-title">{{__('messages.subscribeNow')}}</h3>
                        <div class="footer-subscribe-box default-search-style d-flex">
                            <form action="{{route('search')}}" method="GET">
                                <input name="keyword" type="search" class="default-search-style-input-box border-around border-right-none subscribe-form"placeholder="{{__('messages.typeKeyWord')}}">
                                <button class="default-search-style-input-btn" type="submit">{{__('messages.subscribe')}}</button>
                            </form>
                        </div>
                        <p class="footer-widget-subscribe-note">{{__('messages.notShareEmail')}} <br> {{__('messages.thirdParty')}}</p>
                        <ul class="footer-social">
                            <li><a href="" class="facebook"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="" class="twitter"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="" class="youtube"><i class="fa fa-youtube"></i></a></li>
                            <li><a href="" class="pinterest"><i class="fa fa-pinterest"></i></a></li>
                            <li><a href="" class="instagram"><i class="fa fa-instagram"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="footer-widget footer-widget-menu">
                        <h3 class="footer-widget-title">{{__('messages.information')}}</h3>
                        <div class="footer-menu">
                            <ul class="footer-menu-nav">
                                <li><a href="{{route('about')}}">{{ __('messages.about') }}</a></li>
                                <li><a href="{{route('contact')}}">{{ __('messages.contact') }}</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-6">
                    <div class="copyright-area">
                        <p class="copyright-area-text">Copyright © 2020 <a class="copyright-link" ></a></p>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="footer-payment">
                        <a href=""><img class="img-fluid" src="{{asset('assets/images/icon/payment-icon.png')}}" alt=""></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

<button class="material-scrolltop" type="button"></button>

<script src="{{asset('assets/js/vendor/modernizr-3.11.2.min.js')}}"></script>
<script src="{{asset('assets/js/vendor/jquery-3.5.1.min.js')}}"></script>
<script src="{{asset('assets/js/vendor/jquery-migrate-3.3.0.min.js')}}"></script>
<script src="{{asset('assets/js/vendor/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('assets/js/vendor/jquery-ui.min.js')}}"></script>
<script src="{{asset('assets/js/plugins/slick.min.js')}}"></script>
<script src="{{asset('assets/js/plugins/material-scrolltop.js')}}"></script>
<script src="{{asset('assets/js/plugins/jquery.nice-select.min.js')}}"></script>
<script src="{{asset('assets/js/plugins/jquery.zoom.min.js')}}"></script>
<script src="{{asset('assets/js/plugins/venobox.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="{{asset('assets/js/main.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script type="text/javascript">
        var userID = @json(session('user_id', ['id' => 'id']));
        const url = "http://127.0.0.1:8085/api/cart/get/" + userID;

        if(null === userID || undefined === userID){
            console.log("Please login first");
            const cartCount = document.querySelector('.cart-count');
            const cartItems = document.querySelectorAll('.offcanvas-cart-item-single');
            cartCount.textContent = '0';
        } else {

            axios.get(url)
                .then(response => {
                    const cartItems = Object.values(response.data);
                    const offcanvasCart = document.querySelector('.offcanvas-cart');

                    let totalPrice = 0;

                    cartItems[0].forEach(item => {
                        const li = document.createElement('li');
                        li.classList.add('offcanvas-cart-item-single');
                        li.innerHTML = `
                        <div class="offcanvas-cart-item-block">
                          <a href="" class="offcanvas-cart-item-image-link">
                            <img src="${item.cover_image}" alt="" class="offcanvas-cart-image">
                          </a>
                          <div class="offcanvas-cart-item-content">
                            <a href="" class="offcanvas-cart-item-link">${item.title}</a>
                            <div class="offcanvas-cart-item-details">
                              <span class="offcanvas-cart-item-details-price">$${item.price}</span>

                            </div>
                          </div>
                        </div>
                        <div class="offcanvas-cart-item-delete text-right">
                          <a  class="offcanvas-cart-item-delete" id="deleteCart-${item.book_id}" onclick="deleteCartItem(${item.book_id})"><i class="fa fa-trash-o"></i></a>
                        </div>
                      `;

                        totalPrice += parseFloat(item.price);
                        offcanvasCart.appendChild(li);
                    });

                    const totalPriceElement = document.querySelector('.offcanvas-cart-total-price-value');

                    totalPriceElement.textContent = totalPrice.toFixed(2) + '$';

                    const itemCountElement = document.querySelector('.cart-count');

                    itemCountElement.textContent = cartItems[0].length;

                    updateTotalPrice();

                    updateItemCount();
                })
                .catch(error => {
                    console.error(error);
                });
        }
    function deleteCartItem(itemId) {
        var userID = @json(session('user_id', ['id' => 'id']));
        const deleteUrl = "http://127.0.0.1:8085/api/cart/delete";
        const requestData = {
            bookID: itemId,
            userID: userID
        };

        axios.post(deleteUrl, requestData)
            .then(response => {
                const cartItem = document.querySelector(`#deleteCart-${itemId}`).closest('.offcanvas-cart-item-single');
                cartItem.remove();

                updateTotalPrice();
                updateItemCount();
            })
            .catch(error => {
                console.error(error);
            });
    }

    function updateTotalPrice() {
        const items = document.querySelectorAll('.offcanvas-cart-item-details-price');
        let totalPrice = 0;

        items.forEach(item => {
            const price = parseFloat(item.textContent.replace('$', ''));
            totalPrice += price;
        });

        const totalPriceElement = document.querySelector('.offcanvas-cart-total-price-value');
        totalPriceElement.textContent = totalPrice.toFixed(2) + '$';
    }

    function updateItemCount() {

        const items = document.querySelectorAll('.offcanvas-cart-item-single');
        const itemCountElement = document.querySelector('.cart-count');
        itemCountElement.textContent = items.length;

    }
</script>

<script type="text/javascript">
        var userID = @json(session('user_id', ['id' => 'id']));
        const urlWishlist = "http://127.0.0.1:8085/api/wishlist/get/" + userID;

        if(null === userID || undefined === userID){
            console.log("Please login first");
            const wishlistCount = document.querySelector('.count-wishlist');
            const wishlistItems = document.querySelectorAll('.offcanvas-wishlist-item-single');
            wishlistCount.textContent = '0';
        } else{
            axios.get(urlWishlist)
                .then(response => {
                    const wishlistItems = Object.values(response.data);

                    const offcanvasWishlist = document.querySelector('.offcanvas-wishlist');

                    wishlistItems.forEach(item => {
                        const li = document.createElement('li');
                        li.classList.add('offcanvas-wishlist-item-single');

                        li.innerHTML = `
                              <div class="offcanvas-wishlist-item-block">
                                <a href="" class="offcanvas-wishlist-item-image-link">
                                  <img src="${item.cover_image}" alt="" class="offcanvas-cart-image">
                                </a>
                                <div class="offcanvas-wishlist-item-content">
                                  <a href="" class="offcanvas-wishlist-item-link">${item.title}</a>
                                  <div class="offcanvas-wishlist-item-details">
                                    <span class="offcanvas-wishlist-item-details-price">$${item.price}</span>
                                  </div>
                                </div>
                              </div>
                              <div class="offcanvas-wishlist-item-delete text-right">
                                <a class="offcanvas-wishlist-item-delete" id="deleteWishlist-${item.book_id}" onclick="deleteWishlistItem(${item.book_id})"><i class="fa fa-trash-o"></i></a>
                              </div>
                            `;

                        offcanvasWishlist.appendChild(li);
                    });

                    updateWishlistCount();
                })
                .catch(error => {
                    console.error(error);
                });
        }

    function deleteWishlistItem(itemId) {
        const deleteUrl = "http://127.0.0.1:8085/api/wishlist/delete";
        const requestData = {
            bookID: itemId,
            userID: userID
        };

        axios.post(deleteUrl, requestData)
            .then(response => {
                const wishlistItem = document.querySelector(`#deleteWishlist-${itemId}`).closest('.offcanvas-wishlist-item-single');
                wishlistItem.remove();

                updateWishlistCount();
            })
            .catch(error => {
                console.error(error);
            });
    }

    function updateWishlistCount() {
        const wishlistCount = document.querySelector('.count-wishlist');
        const wishlistItems = document.querySelectorAll('.offcanvas-wishlist-item-single');
        wishlistCount.textContent = wishlistItems.length;
    }
</script>
</body>
</html>
