<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="_token" content="{{ csrf_token() }}">
    <title>@yield('title') | Ebook</title>

    <!-- ::::::::::::::Favicon icon::::::::::::::-->
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}" />

    <!-- ::::::::::::::All CSS Files here :::::::::::::: -->
    <!-- Vendor CSS -->
    <link rel="stylesheet" href="{{asset('assets/css/vendor/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/vendor/plaza-icon.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/vendor/jquery-ui.min.css')}}">

    <!-- Plugin CSS -->
    <link rel="stylesheet" href="{{asset('assets/css/plugins/slick.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/plugins/animate.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/plugins/nice-select.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/plugins/venobox.min.css')}}">

    <!-- Main CSS -->
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
    <!-- Use the minified version files listed below for better performance and remove the files listed above -->
    <!-- <link rel="stylesheet" href="assets/css/vendor/vendor.min.css">
    <link rel="stylesheet" href="assets/css/plugins/plugins.min.css">
    <link rel="stylesheet" href="assets/css/style.min.css"> -->



</head>

<body>

    <!-- ...:::: Start Header Section:::... -->
    <header class="header-section d-lg-block d-none">
        <!-- Start Header Top Area -->
        <div class="header-top">
            <div class="container">
                <div class="row d-flex justify-content-between align-items-center">
                    <div class="col-6">
                        <div class="header-top--left">
                            <span>Welcome to our store!</span>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="header-top--right">
                            <!-- Start Header Top Menu -->
                            <ul class="header-user-menu">
                                {{-- <li class="has-user-dropdown">
                                    <a href="">Setting</a>
                                    <!-- Header Top Menu's Dropdown -->
                                    <ul class="user-sub-menu">
                                        <li><a href="">Checkout</a></li>
                                        <li><a href="">My Account</a></li>
                                        <li><a href="">Shopping Cart</a></li>
                                        <li><a href="">Wishlist</a></li>
                                    </ul>
                                </li> --}}
                                <li class="has-user-dropdown">
                                    <a href="">$ USD</a>
                                    <!-- Header Top Menu's Dropdown -->
                                    <ul class="user-sub-menu">
                                        <li><a href="">EUR – Euro</a></li>
                                        <li><a href="">GBP – British Pound</a></li>
                                        <li><a href="">INR – India Rupee</a></li>
                                    </ul>
                                </li>
                                <li class="has-user-dropdown">
                                    <a href="">English</a>
                                    <!-- Header Top Menu's Dropdown -->
                                    <ul class="user-sub-menu">
                                        <style type="text/css">
                                            .user-sub-menu-in-icon {
                                                width: 20px;
                                                height: 20px;
                                            }
                                        </style>
                                        <li><a href=""><img class="user-sub-menu-in-icon" src="assets/images/icon/united-kingdom.png" alt=""> English</a></li>
                                        <li><a href=""><img class="user-sub-menu-in-icon" src="assets/images/icon/vietnam.png" alt=""> VietNam</a></li>
                                        <li><a href=""><img class="user-sub-menu-in-icon" src="assets/images/icon/japan.png" alt=""> Japan</a></li>
                                        <li><a href=""><img class="user-sub-menu-in-icon" src="assets/images/icon/korea.png" alt=""> Korea</a></li>

                                    </ul>
                                </li>
                                <li><a href=""><i class="icon-repeat"></i> Compare (0)</a></li>
                            </ul> <!-- End Header Top Menu -->
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- End Header Top Area -->

        <!-- Start Header Center Area -->
        <div class="header-center">
            <div class="container">
                <div class="row d-flex justify-content-between align-items-center">
                    <div class="col-3">
                        <!-- Logo Header -->
                        <style type="text/css">
                            /* ajust logo size */
                            .header-logo img {
                                width: 50px;
                                height: 50px;
                            }
                        </style>
                        <div class="header-logo">
                            <a href="{{route('home')}}"><img src="{{asset('images/logo.png')}}" alt=""></a>
                        </div>
                    </div>
                    <div class="col-6">
                        <!-- Start Header Search -->
                        <div class="header-search">
                            <form action="{{route('search')}}" method="GET">
                                {{-- @csrf --}}
                                <div class="header-search-box default-search-style d-flex">
                                    <input name="keyword" class="default-search-style-input-box border-around border-right-none" type="search" placeholder="Type any Keyword and press Enter ..." required>
                                    <button class="default-search-style-input-btn" type="submit"><i class="icon-search"></i></button>
                                </div>
                            </form>
                        </div> <!-- End Header Search -->
                    </div>
                    <div class="col-3 text-right">
                        <!-- Start Header Action Icon -->
                        <ul class="header-action-icon">
                            <li>
                                <a href="#offcanvas-wishlish" class="offcanvas-toggle">
                                    <i class="icon-heart"></i>
                                    <span class="header-action-icon-item-count count-wishlist" id="count-wishlist"></span>
                                </a>
                            </li>
                            <li>
                                <a href="#offcanvas-add-cart" class="offcanvas-toggle">
                                    <i class="icon-shopping-cart"></i>
                                    <span class="header-action-icon-item-count cart-count"></span>
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
                                        <style type="text/css">
                                            /* ajust icon language size */
                                            .user-sub-menu-in-icon {
                                                width: 20px;
                                                height: 20px;
                                            }
                                        </style>
                                        <li><a href="{{route('profile')}}">My Account</a></li>
                                        <li><a href="">Checkout</a></li>
                                        <li><a href="">Wishlist</a></li>
                                        @if($is_vip == 1)
                                            <li><a href="{{route('vipBenefits')}}">VIP Member</a></li>
                                        @else
                                            <li><a href="{{route('upgrade')}}">Upgrade to VIP</a></li>
                                        @endif
                                        <li><a href="{{route('logout')}}">Logout</a></li>
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
                        </ul> <!-- End Header Action Icon -->
                    </div>
                </div>
            </div>
        </div> <!-- End Header Center Area -->

        <!-- Start Bottom Area -->
        <div class="header-bottom sticky-header">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <!-- Header Main Menu -->
                        <div class="main-menu">
                            <nav>
                                <ul>
                                    <li class="has-dropdown">
                                        <a class="active main-menu-link" href="{{route('home')}}">Home</a>
                                    </li>
                                    <li class="has-dropdown">
                                        <a href="blog-single-sidebar-left.html">Category <i class="fa fa-angle-down"></i></a>
                                        <!-- Sub Menu -->
                                        <ul class="sub-menu">
                                            @foreach ( $categories as $category )
                                                <li><a href=""> {{$category['name']}} </a></li>
                                            @endforeach
                                            <li><a>View more</a></li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="{{route('about')}}">About Us</a>
                                    </li>
                                    <li>
                                        <a href="{{route('contact')}}">Contact Us</a>
                                    </li>
                                </ul>
                            </nav>
                        </div> <!-- Header Main Menu Start -->
                    </div>
                </div>
            </div>
        </div> <!-- End Bottom Area -->
    </header> <!-- ...:::: End Header Section:::... -->
    <!-- ...:::: Start Mobile Header Section:::... -->
    <div class="mobile-header-section d-block d-lg-none">
        <!-- Start Mobile Header Wrapper -->
        <div class="mobile-header-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-12 d-flex justify-content-between align-items-center">
                        <div class="mobile-header--left">
                            <a href="" class="mobile-logo-link">
                                <img src="assets/images/logo/logo.png" alt="" class="mobile-logo-img">
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
        </div> <!-- End Mobile Header Wrapper -->
    </div> <!-- ...:::: Start Mobile Header Section:::... -->

    <!-- ...:::: Start Offcanvas Mobile Menu Section:::... -->
    <div id="mobile-menu-offcanvas" class="offcanvas offcanvas-leftside offcanvas-mobile-menu-section">
        <!-- Start Offcanvas Header -->
        <div class="offcanvas-header text-right">
            <button class="offcanvas-close"><i class="fa fa-times"></i></button>
        </div> <!-- End Offcanvas Header -->
        <!-- Start Offcanvas Mobile Menu Wrapper -->
        <div class="offcanvas-mobile-menu-wrapper">
            <!-- Start Mobile Menu User Top -->
            <div class="mobile-menu-top">
                <span>Welcome to our store!</span>
                <!-- Start Header Top Menu -->
                <ul class="mobile-menu-user-menu">
                    <li><a class="header-user-menu-link" href=""><i class="icon-repeat"></i>Compare (0)</a></li>
                    <li class="has-mobile-user-dropdown">
                        <a class="mobile-user-menu-link" href="">Setting</a>
                        <!-- Header Top Menu's Dropdown -->
                        <ul class="mobile-user-sub-menu">
                            <li><a href="">Checkout</a></li>
                            <li><a href="">My Account</a></li>
                            <li><a href="">Shopping Cart</a></li>
                            <li><a href="">Wishlist</a></li>
                        </ul>
                    </li>
                    <li class=" has-mobile-user-dropdown">
                        <a class="mobile-user-menu-link" href="">$ USD</a>
                        <!-- Header Top Menu's Dropdown -->
                        <ul class="mobile-user-sub-menu">
                            <li><a href="">EUR – Euro</a></li>
                            <li><a href="">GBP – British Pound</a></li>
                            <li><a href="">Shopping Cart</a></li>
                            <li><a href="">INR – India Rupee</a></li>
                        </ul>
                    </li>
                    <li class="has-mobile-user-dropdown">
                        <a class="mobile-user-menu-link" href="">English</a>
                        <!-- Header Top Menu's Dropdown -->
                        <ul class="mobile-user-sub-menu">
                            <li><a href=""><img class="user-sub-menu-link-icon" src="assets/images/icon/lang-en.png" alt=""> English</a></li>
                            <li><a href=""><img class="user-sub-menu-link-icon" src="assets/images/icon/lang-gr.png" alt=""> Germany</a></li>
                        </ul>
                    </li>
                </ul> <!-- End Header Top Menu -->
            </div> <!-- End Mobile Menu User Top -->
            <!-- Start Mobile Menu User Center -->
            <div class="mobile-menu-center">
                <form action="#" method="post">
                    <div class="header-search-box default-search-style d-flex">
                        <input class="default-search-style-input-box border-around border-right-none" type="search" placeholder="Search entire store here ..." required>
                        <button class="default-search-style-input-btn" type="submit"><i class="icon-search"></i></button>
                    </div>
                </form>
                <div class="mobile-menu-customer-support">
                    <div class="mobile-menu-customer-support-icon">
                        <img src="assets/images/icon/support-icon.png" alt="">
                    </div>
                    <div class="mobile-menu-customer-support-text">
                        <span>Customer Support</span>
                        <a class="mobile-menu-customer-support-text-phone" href="tel:(08)123456789">(08) 123 456 789</a>
                    </div>
                </div>
                <!-- Start Header Action Icon -->
                <ul class="mobile-action-icon">
                    <li class="mobile-action-icon-item">
                        <a href="{{route('wishlist.index')}}" class="mobile-action-icon-link">
                            <i class="icon-heart"></i>
                            <span class="mobile-action-icon-item-count count-wishlist" id="count-wishlist"></span>
                        </a>
                    </li>
                    <li class="mobile-action-icon-item">
                        @if(session()->has('user'))
                            @php
                                $user_id = session()->get('user')['id']
                            @endphp
                            <a href="{{route('cart.getUserCart', $user_id)}}" class="mobile-action-icon-link">
                        @else
                            <a class="mobile-action-icon-link">
                        @endif
                                <i class="icon-shopping-cart"></i>
                                <span class="mobile-action-icon-item-count cart-count"></span>
                            </a>
                    </li>
                </ul> <!-- End Header Action Icon -->
            </div> <!-- End Mobile Menu User Center -->
            <!-- Start Mobile Menu Bottom -->
            <div class="mobile-menu-bottom">
                <!-- Start Mobile Menu Nav -->
                <div class="offcanvas-menu">
                    <ul>
                        <li>
                            <a href="#"><span>Home</span></a>
                            <ul class="mobile-sub-menu">
                                <li><a href="index.html">Home 1</a></li>
                                <li><a href="index-2.html">Home 2</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#"><span>Shop</span></a>
                            <ul class="mobile-sub-menu">
                                <li>
                                    <a href="#">Shop Layout</a>
                                    <ul class="mobile-sub-menu">
                                        <li><a href="shop-grid-sidebar-left.html">Grid Left Sidebar</a></li>
                                        <li><a href="shop-grid-sidebar-right.html">Grid Right Sidebar</a></li>
                                        <li><a href="shop-full-width.html">Full Width</a></li>
                                        <li><a href="shop-list-sidebar-left.html">List Left Sidebar</a></li>
                                        <li><a href="shop-list-sidebar-right.html">List Right Sidebar</a></li>
                                    </ul>
                                </li>
                            </ul>
                            <ul class="mobile-sub-menu">
                                <li>
                                    <a href="#">Shop Pages</a>
                                    <ul class="mobile-sub-menu">
                                        <li><a href="cart.html">Cart</a></li>
                                        <li><a href="wishlist.html">Wishlist</a></li>
                                        <li><a href="compare.html">Compare</a></li>
                                        <li><a href="checkout.html">Checkout</a></li>
                                        <li><a href="login.html">Login</a></li>
                                        <li><a href="my-account.html">My Account</a></li>
                                        <li><a href="404.html">Error 404</a></li>
                                    </ul>
                                </li>
                            </ul>
                            <ul class="mobile-sub-menu">
                                <li>
                                    <a href="#">Product Single</a>
                                    <ul class="mobile-sub-menu">
                                        <li><a href="product-details-default.html">Product Default</a></li>
                                        <li><a href="product-details-variable.html">Product Variable</a></li>
                                        <li><a href="product-details-affiliate.html">Product Referral</a></li>
                                        <li><a href="product-details-group.html">Product Group</a></li>
                                        <li><a href="product-details-single-slide.html">Product Slider</a></li>
                                        <li><a href="product-details-tab-left.html">Product Tab Left</a></li>
                                        <li><a href="product-details-tab-right.html">Product Tab Right</a></li>
                                        <li><a href="product-details-gallery-left.html">Product Gallery Left</a></li>
                                        <li><a href="product-details-gallery-right.html">Product Gallery Right</a></li>
                                        <li><a href="product-details-sticky-left.html">Product Sticky Left</a></li>
                                        <li><a href="product-details-sticky-right.html">Product Sticky right</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="#"><span>Blogs</span></a>
                            <ul class="mobile-sub-menu">
                                <li>
                                    <a href="#">Blog Grid</a>
                                    <ul class="mobile-sub-menu">
                                        <li><a href="blog-grid-sidebar-left.html">Blog Grid Sidebar left</a></li>
                                        <li><a href="blog-grid-sidebar-right.html">Blog Grid Sidebar Right</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="blog-full-width.html">Blog Full Width</a>
                                </li>
                                <li>
                                    <a href="#">Blog Single</a>
                                    <ul class="mobile-sub-menu">
                                        <li><a href="blog-single-sidebar-left.html">Blog Single Sidebar left</a></li>
                                        <li><a href="blog-single-sidebar-right.html">Blog Single Sidebar Right</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="#"><span>Pages</span></a>
                            <ul class="mobile-sub-menu">
                                <li><a href="about-us.html">About Us</a></li>
                                <li><a href="service.html">Service</a></li>
                                <li><a href="faq.html">Frequently Questions</a></li>
                                <li><a href="privacy-policy.html">Privacy Policy</a></li>
                                <li><a href="404.html">404 Page</a></li>
                            </ul>
                        </li>
                        <li><a href="contact-us.html">Contact Us</a></li>
                    </ul>
                </div> <!-- End Mobile Menu Nav -->

                <!-- Mobile Manu Mail Address -->
                <a class="mobile-menu-email icon-text-right" href="mailto:info@yourdomain.com"><i class="fa fa-envelope-o"> info@yourdomain.com</i></a>

                <!-- Mobile Manu Social Link -->
                <ul class="mobile-menu-social">
                    <li><a href="" class="facebook"><i class="fa fa-facebook"></i></a></li>
                    <li><a href="" class="twitter"><i class="fa fa-twitter"></i></a></li>
                    <li><a href="" class="youtube"><i class="fa fa-youtube"></i></a></li>
                    <li><a href="" class="pinterest"><i class="fa fa-pinterest"></i></a></li>
                    <li><a href="" class="instagram"><i class="fa fa-instagram"></i></a></li>
                </ul>
            </div> <!-- End Mobile Menu Bottom -->
        </div> <!-- End Offcanvas Mobile Menu Wrapper -->
    </div> <!-- ...:::: End Offcanvas Mobile Menu Section:::... -->

    <!-- ...:::: Start Offcanvas Addcart Section :::... -->
    <div id="offcanvas-add-cart" class="offcanvas offcanvas-rightside offcanvas-add-cart-section">
        <!-- Start Offcanvas Header -->
        <div class="offcanvas-header text-right">
            <button class="offcanvas-close"><i class="fa fa-times"></i></button>
        </div> <!-- End Offcanvas Header -->

        <!-- Start  Offcanvas Addcart Wrapper -->
        <div class="offcanvas-add-cart-wrapper">
            <h4 class="offcanvas-title">Shopping Cart</h4>
            <ul class="offcanvas-cart">
            </ul>
            <div class="offcanvas-cart-total-price">
                <span class="offcanvas-cart-total-price-text">Subtotal:</span>
                <span class="offcanvas-cart-total-price-value"></span>
            </div>
            <ul class="offcanvas-cart-action-button">
                @if(session()->has('user'))
                    @php
                        $user_id = session()->get('user')['id']
                    @endphp
                    <li class="offcanvas-cart-action-button-list"><a href="{{route('cart.getUserCart',$user_id)}}" class="offcanvas-cart-action-button-link">View Cart</a></li>
                    <li class="offcanvas-cart-action-button-list"><a href="{{route('cart.checkout')}}" class="offcanvas-cart-action-button-link">Checkout</a></li>
                @else
                <li class="offcanvas-cart-action-button-list"><a class="offcanvas-cart-action-button-link">View Cart</a></li>
                <li class="offcanvas-cart-action-button-list"><a  class="offcanvas-cart-action-button-link">Checkout</a></li>
                @endif
            </ul>
        </div> <!-- End  Offcanvas Addcart Wrapper -->

    </div> <!-- ...:::: End  Offcanvas Addcart Section :::... -->

    <!-- ...:::: Start Offcanvas Mobile Menu Section:::... -->
    <div id="offcanvas-wishlish" class="offcanvas offcanvas-rightside offcanvas-add-cart-section">
        <!-- Start Offcanvas Header -->
        <div class="offcanvas-header text-right">
            <button class="offcanvas-close"><i class="fa fa-times"></i></button>
        </div> <!-- ENd Offcanvas Header -->

        <!-- Start Offcanvas Mobile Menu Wrapper -->
        <div class="offcanvas-wishlist-wrapper">
            <h4 class="offcanvas-title">Wishlist</h4>
            <ul class="offcanvas-wishlist" id="offcanvas-wishlist">
            </ul>
            <ul class="offcanvas-wishlist-action-button">
                <li class="offcanvas-wishlist-action-button-list"><a href="{{route('wishlist.index')}}" class="offcanvas-wishlist-action-button-link">View Wishlist</a></li>
            </ul>
        </div> <!-- End Offcanvas Mobile Menu Wrapper -->

    </div> <!-- ...:::: End Offcanvas Mobile Menu Section:::... -->

    <div class="offcanvas-overlay"></div>
    @yield('content')
    <footer class="footer-section section-top-gap-100">
        <!-- Start Footer Top Area -->
        <div class="footer-top section-inner-bg">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-5">
                        <div class="footer-widget footer-widget-contact">
                            {{-- change logo size --}}
                            <style type="text/css">
                                .footer-logo img {
                                    width: 40%;
                                    height: 50%;
                                }
                            </style>
                            <div class="footer-logo">
                                <a href="index.html"><img src="{{ asset('images/logo.png') }}" alt="" class="img-fluid"></a>
                            </div>
                            <div class="footer-contact">
                                <p>We are a team of designers and developers that create high quality Magento, Prestashop, Opencart...</p>
                                <div class="customer-support">
                                    <div class="customer-support-icon">
                                        <img src="assets/images/icon/support-icon.png" alt="">
                                    </div>
                                    <div class="customer-support-text">
                                        <span>Customer Support</span>
                                        <a class="customer-support-text-phone" href="tel:(03)32420477">(03) 3242 0477</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5 col-md-5 col-sm-7">
                        <div class="footer-widget footer-widget-subscribe">
                            <h3 class="footer-widget-title">Subscribe newsletter to get updated</h3>
                            <form action="#" method="post">
                                <div class="footer-subscribe-box default-search-style d-flex">
                                    <input class="default-search-style-input-box border-around border-right-none subscribe-form" type="email" placeholder="Search entire store here ..." required>
                                    <button class="default-search-style-input-btn" type="submit">Subscribe</button>
                                </div>
                            </form>
                            <p class="footer-widget-subscribe-note">We’ll never share your email address <br> with a third-party.</p>
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
                            <h3 class="footer-widget-title">Information</h3>
                            <div class="footer-menu">
                                <ul class="footer-menu-nav">
                                    <li><a href="">Delivery</a></li>
                                    <li><a href="about-us.html">About Us</a></li>
                                    <li><a href="contact-us.html">Contact us</a></li>
                                    <li><a href="">Stores</a></li>
                                </ul>
                                <ul class="footer-menu-nav">
                                    <li><a href="">Legal Notice</a></li>
                                    <li><a href="">Secure payment</a></li>
                                    <li><a href="">Sitemap</a></li>
                                    <li><a href="my-account.html">My Account</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- End Footer Top Area -->
        <!-- Start Footer Bottom Area -->
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
                            <a href=""><img class="img-fluid" src="assets/images/icon/payment-icon.png" alt=""></a>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- End Footer Bottom Area -->
    </footer> <!-- ...:::: End Footer Section:::... -->

    <!-- material-scrolltop button -->
    <button class="material-scrolltop" type="button"></button>

    <!-- ::::::::::::::All JS Files here :::::::::::::: -->
    <!-- Global Vendor, plugins JS -->
    <script src="{{asset('assets/js/vendor/modernizr-3.11.2.min.js')}}"></script>
    <script src="{{asset('assets/js/vendor/jquery-3.5.1.min.js')}}"></script>
    <script src="{{asset('assets/js/vendor/jquery-migrate-3.3.0.min.js')}}"></script>
    <script src="{{asset('assets/js/vendor/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('assets/js/vendor/jquery-ui.min.js')}}"></script>

    <!--Plugins JS-->
    <script src="{{asset('assets/js/plugins/slick.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/material-scrolltop.js')}}"></script>
    <script src="{{asset('assets/js/plugins/jquery.nice-select.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/jquery.zoom.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/venobox.min.js')}}"></script>

    <!-- Use the minified version files listed below for better performance and remove the files listed above -->
    <!-- <script src="assets/js/vendor.min.js"></script>
    <script src="assets/js/plugins.min.js"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- Main JS -->
    <script src="{{asset('assets/js/main.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script type="text/javascript">
        var userID = @json(session('user_id', ['id' => 'id']));
        const url = "http://paymentservice.test:8080/api/cart/get/" + userID;

        axios.get(url)
            .then(response => {
                const cartItems = Object.values(response.data); // Assuming the cart items are stored as values in the response object
                // console.log(cartItems[0]);
                // Select the <ul> element with the class "offcanvas-cart"
                const offcanvasCart = document.querySelector('.offcanvas-cart');
                let totalPrice = 0;
                // Loop through the cart items and generate the <li> elements
                cartItems[0].forEach(item => {
                    // Create the <li> element
                    const li = document.createElement('li');
                    li.classList.add('offcanvas-cart-item-single');
                    // Create the inner HTML for the <li> element
                    //console.log(item);
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
                    // Append the <li> element to the <ul> element
                    totalPrice += parseFloat(item.price);
                    offcanvasCart.appendChild(li);
                });

                // Select the <span> element with the class "offcanvas-cart-total-price-value"
                const totalPriceElement = document.querySelector('.offcanvas-cart-total-price-value');

                // Set the total price value in the HTML
                totalPriceElement.textContent = totalPrice.toFixed(2) + '$';// Assuming you want to display the total with 2 decimal places

                const itemCountElement = document.querySelector('.cart-count');

                itemCountElement.textContent = cartItems[0].length; // Assuming cartItems[0] is an array of items

            })
            .catch(error => {
                console.error(error);
            });



        function deleteCartItem(itemId) {
            var userID = @json(session('user_id', ['id' => 'id']));
            const deleteUrl = "http://paymentservice.test:8080/api/cart/delete";
            const requestData = {
                bookID: itemId,
                userID: userID
            };
            // console.log(requestData);

            axios.post(deleteUrl, requestData)
                .then(response => {
                    // Item deleted successfully from the database
                    // Remove the item from the UI
                    const cartItem = document.querySelector(`#deleteCart-${itemId}`).closest('.offcanvas-cart-item-single');
                    cartItem.remove();

                    // Update the total price and item count
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
            const itemCountElement = document.querySelector('.cart-count');
            const items = document.querySelectorAll('.offcanvas-cart-item-single');
            itemCountElement.textContent = items.length;
        }
    </script>

    <script type="text/javascript">
        var userID = @json(session('user_id', ['id' => 'id']));
        const urlWishlist = "http://paymentservice.test:8080/api/wishlist/get/" + userID;

        axios.get(urlWishlist)
            .then(response => {
                const wishlistItems = Object.values(response.data);

                const offcanvasWishlist = document.querySelector('.offcanvas-wishlist');

                wishlistItems[0].forEach(item => {
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

                updateWishlistCount(); // Update the wishlist count initially
            })
            .catch(error => {
                console.error(error);
            });

        function deleteWishlistItem(itemId) {
            const deleteUrl = "http://paymentservice.test:8080/api/wishlist/delete";
            const requestData = {
                bookID: itemId,
                userID: userID
            };

            axios.post(deleteUrl, requestData)
                .then(response => {
                    // Item deleted successfully from the database
                    // Remove the item from the UI
                    const wishlistItem = document.querySelector(`#deleteWishlist-${itemId}`).closest('.offcanvas-wishlist-item-single');
                    wishlistItem.remove();

                    updateWishlistCount(); // Update the wishlist count after item deletion
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
