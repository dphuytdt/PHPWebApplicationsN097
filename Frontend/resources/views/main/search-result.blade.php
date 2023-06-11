@extends('layouts.main')
@section('content')
@section('title', 'Search Result')
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
                    <a href="wishlist.html" class="mobile-action-icon-link">
                        <i class="icon-heart"></i>
                        <span class="mobile-action-icon-item-count">3</span>
                    </a>
                </li>
                <li class="mobile-action-icon-item">
                    <a href="cart.html" class="mobile-action-icon-link">
                        <i class="icon-shopping-cart"></i>
                        <span class="mobile-action-icon-item-count">3</span>
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
            <li class="offcanvas-cart-item-single">
                <div class="offcanvas-cart-item-block">
                    <a href="" class="offcanvas-cart-item-image-link">
                        <img src="assets/images/products_images/aments_products_image_6.jpg" alt="" class="offcanvas-cart-image">
                    </a>
                    <div class="offcanvas-cart-item-content">
                        <a href="" class="offcanvas-cart-item-link">Car Wheel</a>
                        <div class="offcanvas-cart-item-details">
                            <span class="offcanvas-cart-item-details-quantity">1 x </span>
                            <span class="offcanvas-cart-item-details-price">$49.00</span>
                        </div>
                    </div>
                </div>
                <div class="offcanvas-cart-item-delete text-right">
                    <a href="#" class="offcanvas-cart-item-delete"><i class="fa fa-trash-o"></i></a>
                </div>
            </li>
            <li class="offcanvas-cart-item-single">
                <div class="offcanvas-cart-item-block">
                    <a href="" class="offcanvas-cart-item-image-link">
                        <img src="assets/images/categories_images/aments_categories_08.jpg" alt="" class="offcanvas-cart-image">
                    </a>
                    <div class="offcanvas-cart-item-content">
                        <a href="" class="offcanvas-cart-item-link">Car Vails</a>
                        <div class="offcanvas-cart-item-details">
                            <span class="offcanvas-cart-item-details-quantity">3 x </span>
                            <span class="offcanvas-cart-item-details-price">$500.00</span>
                        </div>
                    </div>
                </div>
                <div class="offcanvas-cart-item-delete text-right">
                    <a href="#" class="offcanvas-cart-item-delete"><i class="fa fa-trash-o"></i></a>
                </div>
            </li>
            <li class="offcanvas-cart-item-single">
                <div class="offcanvas-cart-item-block">
                    <a href="" class="offcanvas-cart-item-image-link">
                        <img src="assets/images/products_images/aments_products_image_2.jpg" alt="" class="offcanvas-cart-image">
                    </a>
                    <div class="offcanvas-cart-item-content">
                        <a href="" class="offcanvas-cart-item-link">Shock Absorber</a>
                        <div class="offcanvas-cart-item-details">
                            <span class="offcanvas-cart-item-details-quantity">1 x </span>
                            <span class="offcanvas-cart-item-details-price">$350.00</span>
                        </div>
                    </div>
                </div>
                <div class="offcanvas-cart-item-delete text-right">
                    <a href="#" class="offcanvas-cart-item-delete"><i class="fa fa-trash-o"></i></a>
                </div>
            </li>
        </ul>
        <div class="offcanvas-cart-total-price">
            <span class="offcanvas-cart-total-price-text">Subtotal:</span>
            <span class="offcanvas-cart-total-price-value">$170.00</span>
        </div>
        <ul class="offcanvas-cart-action-button">
            <li class="offcanvas-cart-action-button-list"><a href="" class="offcanvas-cart-action-button-link">View Cart</a></li>
            <li class="offcanvas-cart-action-button-list"><a href="" class="offcanvas-cart-action-button-link">Checkout</a></li>
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
        <ul class="offcanvas-wishlist">
            <li class="offcanvas-wishlist-item-single">
                <div class="offcanvas-wishlist-item-block">
                    <a href="" class="offcanvas-wishlist-item-image-link">
                        <img src="assets/images/products_images/aments_products_image_6.jpg" alt="" class="offcanvas-wishlist-image">
                    </a>
                    <div class="offcanvas-wishlist-item-content">
                        <a href="" class="offcanvas-wishlist-item-link">Car Wheel</a>
                        <div class="offcanvas-wishlist-item-details">
                            <span class="offcanvas-wishlist-item-details-quantity">1 x </span>
                            <span class="offcanvas-wishlist-item-details-price">$49.00</span>
                        </div>
                    </div>
                </div>
                <div class="offcanvas-wishlist-item-delete text-right">
                    <a href="#" class="offcanvas-wishlist-item-delete"><i class="fa fa-trash-o"></i></a>
                </div>
            </li>
            <li class="offcanvas-wishlist-item-single">
                <div class="offcanvas-wishlist-item-block">
                    <a href="" class="offcanvas-wishlist-item-image-link">
                        <img src="assets/images/categories_images/aments_categories_08.jpg" alt="" class="offcanvas-wishlist-image">
                    </a>
                    <div class="offcanvas-wishlist-item-content">
                        <a href="" class="offcanvas-wishlist-item-link">Car Vails</a>
                        <div class="offcanvas-wishlist-item-details">
                            <span class="offcanvas-wishlist-item-details-quantity">3 x </span>
                            <span class="offcanvas-wishlist-item-details-price">$500.00</span>
                        </div>
                    </div>
                </div>
                <div class="offcanvas-wishlist-item-delete text-right">
                    <a href="#" class="offcanvas-wishlist-item-delete"><i class="fa fa-trash-o"></i></a>
                </div>
            </li>
            <li class="offcanvas-wishlist-item-single">
                <div class="offcanvas-wishlist-item-block">
                    <a href="" class="offcanvas-wishlist-item-image-link">
                        <img src="assets/images/products_images/aments_products_image_2.jpg" alt="" class="offcanvas-wishlist-image">
                    </a>
                    <div class="offcanvas-wishlist-item-content">
                        <a href="" class="offcanvas-wishlist-item-link">Shock Absorber</a>
                        <div class="offcanvas-wishlist-item-details">
                            <span class="offcanvas-wishlist-item-details-quantity">1 x </span>
                            <span class="offcanvas-wishlist-item-details-price">$350.00</span>
                        </div>
                    </div>
                </div>
                <div class="offcanvas-wishlist-item-delete text-right">
                    <a href="#" class="offcanvas-wishlist-item-delete"><i class="fa fa-trash-o"></i></a>
                </div>
            </li>
        </ul>
        <ul class="offcanvas-wishlist-action-button">
            <li class="offcanvas-wishlist-action-button-list"><a href="" class="offcanvas-wishlist-action-button-link">View wishlist</a></li>
        </ul>
    </div> <!-- End Offcanvas Mobile Menu Wrapper -->

</div> <!-- ...:::: End Offcanvas Mobile Menu Section:::... -->

<div class="offcanvas-overlay"></div>

<!-- ...:::: Start Breadcrumb Section:::... -->
<div class="breadcrumb-section">
    <div class="breadcrumb-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-12 d-flex justify-content-between justify-content-md-between  align-items-center flex-md-row flex-column">
                    <h3 class="breadcrumb-title">Search</h3>
                    {{ Breadcrumbs::render('search') }}
                </div>
            </div>
        </div>
    </div>
</div> <!-- ...:::: End Breadcrumb Section:::... -->
@if(session('error'))
<div class="alert alert-danger">
    {{ session()->get('error') }}
</div>
@else 
<!-- ...:::: Start Shop Section:::... -->
<div class="shop-section">
    <div class="container">
        <div class="row flex-column-reverse flex-lg-row">
            <div class="col-lg-12">
                <!-- Start Shop Product Sorting Section -->
                <div class="shop-sort-section">
                    <div class="container">
                        <div class="row">
                            <!-- Start Sort Wrapper Box -->
                            <div class="sort-box d-flex justify-content-between align-items-md-center align-items-start flex-md-row flex-column">
                                <!-- Start Sort tab Button -->
                                <div class="sort-tablist">
                                    <ul class="tablist nav sort-tab-btn">
                                        <li><a class="nav-link active" data-toggle="tab" href="#layout-4-grid"><img src="assets/images/icon/bkg_grid.png" alt=""></a></li>
                                        <li><a class="nav-link" data-toggle="tab" href="#layout-list"><img src="assets/images/icon/bkg_list.png" alt=""></a></li>
                                    </ul>
                                </div> <!-- End Sort tab Button -->

                                <!-- Start Sort Select Option -->
                                <div class="sort-select-list">
                                    <form action="#">
                                        <fieldset>
                                            <select name="speed" id="speed">
                                                <option>Sort by average rating</option>
                                                <option>Sort by popularity</option>
                                                <option selected="selected">Sort by newness</option>
                                                <option>Sort by price: low to high</option>
                                                <option>Sort by price: high to low</option>
                                                <option>Product Name: Z</option>
                                            </select>
                                        </fieldset>
                                    </form>
                                </div> <!-- End Sort Select Option -->

                                <!-- Start Page Amount -->
                                <div class="page-amount">
                                    {{-- use paigante to get the number of pages --}}
                                    <span>@if($paginator->total() > 0) Showing {{ $paginator->firstItem() }}–{{ $paginator->lastItem() }} of {{ $paginator->total() }} results @endif</span>
                                </div> <!-- End Page Amount -->

                            </div> <!-- Start Sort Wrapper Box -->
                        </div>
                    </div>
                </div> <!-- End Section Content -->

                <!-- Start Tab Wrapper -->
                <div class="sort-product-tab-wrapper">
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <div class="tab-content tab-animate-zoom">
                                    <!-- Start Grid View Product -->
                                    <div class="tab-pane active show sort-layout-single" id="layout-4-grid">
                                        <div class="row">
                                            @foreach($paginator as $book)
                                            <div class="col-xl-3 col-lg-4 col-sm-6 col-12">
                                                <!-- Start Product Defautlt Single -->
                                                <div class="product-default-single border-around">
                                                    <div class="product-img-warp">
                                                        <a href="{{URL::to('/book-details/'.$book['id'])}}" class="product-default-img-link">
                                                            <img src="{{$book['cover_image']}}" alt="" class="product-default-img img-fluid">
                                                        </a>
                                                        <div class="product-action-icon-link">
                                                            <ul>
                                                                <li><a href="wishlist.html"><i class="icon-heart"></i></a></li>
                                                                <li><a href="compare.html"><i class="icon-repeat"></i></a></li>
                                                                <li><a href="#" data-toggle="modal" data-target="#modalQuickview"><i class="icon-eye"></i></a></li>
                                                                <li><a href="#" data-toggle="modal" data-target="#modalAddcart"><i class="icon-shopping-cart"></i></a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="product-default-content">
                                                        <h6 class="product-default-link"><a href="product-details-default.html">{{$book['title']}}</a></h6>
                                                        @if($book['price'] == 0) 
                                                        <span class="product-default-price">Free</span>
                                                        @else
                                                            < <span class="product-default-price">$ {{$book['price']}}</span>
                                                        @endif
                                                       
                                                    </div>
                                                </div> <!-- End Product Defautlt Single -->
                                            </div>
                                            @endforeach
                                        </div>
                                    </div> <!-- End Grid View Product -->
                                    <!-- Start List View Product -->
                                    {{-- <div class="tab-pane sort-layout-single" id="layout-list">
                                        <div class="row">
                                            <div class="col-12">
                                                <!-- Start Product Defautlt Single -->
                                                <div class="product-list-single border-around">
                                                    <a href="product-details-default.html" class="product-list-img-link">
                                                        <img src="assets/images/products_images/aments_products_image_5.jpg" alt="" class="img-fluid">
                                                    </a>
                                                    <div class="product-list-content">
                                                        <h5 class="product-list-link"><a href="product-details-default.html">New Balance Fresh Foam Kaymin Car Purts</a></h5>
                                                        <span class="product-list-price"><del class="product-list-price-off">$30.12</del> $25.12</span>
                                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nobis ad, iure incidunt. Ab consequatur temporibus non eveniet inventore doloremque necessitatibus sed, ducimus quisquam, ad asperiores</p>
                                                        <div class="product-action-icon-link-list">
                                                            <ul>
                                                                <li><a href="wishlist.html"><i class="icon-heart"></i></a></li>
                                                                <li><a href="compare.html"><i class="icon-repeat"></i></a></li>
                                                                <li><a href="#" data-toggle="modal" data-target="#modalQuickview"><i class="icon-eye"></i></a></li>
                                                                <li><a href="#" data-toggle="modal" data-target="#modalAddcart"><i class="icon-shopping-cart"></i></a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div> <!-- End Product Defautlt Single -->
                                            </div>
                                            <div class="col-12">
                                                <!-- Start Product Defautlt Single -->
                                                <div class="product-list-single border-around">
                                                    <a href="product-details-default.html" class="product-list-img-link">
                                                        <img src="assets/images/products_images/aments_products_image_2.jpg" alt="" class="img-fluid">
                                                    </a>
                                                    <div class="product-list-content">
                                                        <h5 class="product-list-link"><a href="product-details-default.html">New Balance Fresh Foam Kaymin Car Purts</a></h5>
                                                        <span class="product-list-price"><del class="product-list-price-off">$30.12</del> $25.12</span>
                                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nobis ad, iure incidunt. Ab consequatur temporibus non eveniet inventore doloremque necessitatibus sed, ducimus quisquam, ad asperiores</p>
                                                        <div class="product-action-icon-link-list">
                                                            <ul>
                                                                <li><a href="wishlist.html"><i class="icon-heart"></i></a></li>
                                                                <li><a href="compare.html"><i class="icon-repeat"></i></a></li>
                                                                <li><a href="#" data-toggle="modal" data-target="#modalQuickview"><i class="icon-eye"></i></a></li>
                                                                <li><a href="#" data-toggle="modal" data-target="#modalAddcart"><i class="icon-shopping-cart"></i></a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div> <!-- End Product Defautlt Single -->
                                            </div>
                                            <div class="col-12">
                                                <!-- Start Product Defautlt Single -->
                                                <div class="product-list-single border-around">
                                                    <a href="product-details-default.html" class="product-list-img-link">
                                                        <img src="assets/images/products_images/aments_products_image_1.jpg" alt="" class="img-fluid">
                                                    </a>
                                                    <div class="product-list-content">
                                                        <h5 class="product-list-link"><a href="product-details-default.html">New Balance Fresh Foam Kaymin Car Purts</a></h5>
                                                        <span class="product-list-price"><del class="product-list-price-off">$30.12</del> $25.12</span>
                                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nobis ad, iure incidunt. Ab consequatur temporibus non eveniet inventore doloremque necessitatibus sed, ducimus quisquam, ad asperiores</p>
                                                        <div class="product-action-icon-link-list">
                                                            <ul>
                                                                <li><a href="wishlist.html"><i class="icon-heart"></i></a></li>
                                                                <li><a href="compare.html"><i class="icon-repeat"></i></a></li>
                                                                <li><a href="#" data-toggle="modal" data-target="#modalQuickview"><i class="icon-eye"></i></a></li>
                                                                <li><a href="#" data-toggle="modal" data-target="#modalAddcart"><i class="icon-shopping-cart"></i></a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div> <!-- End Product Defautlt Single -->
                                            </div>
                                            <div class="col-12">
                                                <!-- Start Product Defautlt Single -->
                                                <div class="product-list-single border-around">
                                                    <a href="product-details-default.html" class="product-list-img-link">
                                                        <img src="assets/images/products_images/aments_products_image_4.jpg" alt="" class="img-fluid">
                                                    </a>
                                                    <div class="product-list-content">
                                                        <h5 class="product-list-link"><a href="product-details-default.html">New Balance Fresh Foam Kaymin Car Purts</a></h5>
                                                        <span class="product-list-price"><del class="product-list-price-off">$30.12</del> $25.12</span>
                                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nobis ad, iure incidunt. Ab consequatur temporibus non eveniet inventore doloremque necessitatibus sed, ducimus quisquam, ad asperiores</p>
                                                        <div class="product-action-icon-link-list">
                                                            <ul>
                                                                <li><a href="wishlist.html"><i class="icon-heart"></i></a></li>
                                                                <li><a href="compare.html"><i class="icon-repeat"></i></a></li>
                                                                <li><a href="#" data-toggle="modal" data-target="#modalQuickview"><i class="icon-eye"></i></a></li>
                                                                <li><a href="#" data-toggle="modal" data-target="#modalAddcart"><i class="icon-shopping-cart"></i></a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div> <!-- End Product Defautlt Single -->
                                            </div>
                                            <div class="col-12">
                                                <!-- Start Product Defautlt Single -->
                                                <div class="product-list-single border-around">
                                                    <a href="product-details-default.html" class="product-list-img-link">
                                                        <img src="assets/images/products_images/aments_products_image_3.jpg" alt="" class="img-fluid">
                                                    </a>
                                                    <div class="product-list-content">
                                                        <h5 class="product-list-link"><a href="product-details-default.html">New Balance Fresh Foam Kaymin Car Purts</a></h5>
                                                        <span class="product-list-price"><del class="product-list-price-off">$30.12</del> $25.12</span>
                                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nobis ad, iure incidunt. Ab consequatur temporibus non eveniet inventore doloremque necessitatibus sed, ducimus quisquam, ad asperiores</p>
                                                        <div class="product-action-icon-link-list">
                                                            <ul>
                                                                <li><a href="wishlist.html"><i class="icon-heart"></i></a></li>
                                                                <li><a href="compare.html"><i class="icon-repeat"></i></a></li>
                                                                <li><a href="#" data-toggle="modal" data-target="#modalQuickview"><i class="icon-eye"></i></a></li>
                                                                <li><a href="#" data-toggle="modal" data-target="#modalAddcart"><i class="icon-shopping-cart"></i></a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div> <!-- End Product Defautlt Single -->
                                            </div>
                                        </div>
                                    </div> <!-- End List View Product --> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!-- End Tab Wrapper -->
                <style >
                    .pagination-container {
                        text-align: center;
                    }

                    .pagination {
                        display: inline-block;
                        margin-top: 10px;
                    }

                    .pagination a, .pagination span {
                        display: inline-block;
                        padding: 5px 10px;
                        margin-right: 5px;
                        border: 1px solid #ccc;
                        text-decoration: none;
                        color: #333;
                    }

                    .pagination a:hover {
                        background-color: #f5f5f5;
                    }

                    .pagination .current {
                        background-color: #ccc;
                        color: #fff;
                    }

                </style>
                <br>
                <!-- Start Pagination -->
                <div class="pagination-container">
                    <div class="pagination">
                        {{-- Hiển thị nút Previous --}}
                        @if ($paginator->onFirstPage())
                            <span class="disabled">Previous</span>
                        @else
                            <a href="{{ $paginator->previousPageUrl() }}">Previous</a>
                        @endif

                        {{-- Hiển thị số trang --}}
                        @for ($i = 1; $i <= $paginator->lastPage(); $i++)
                        @if ($i === $paginator->currentPage())
                            <span class="current">{{ $i }}</span>
                        @else
                            <a href="{{ $paginator->url($i) }}">{{ $i }}</a>
                        @endif
                        @endfor

                        {{-- Hiển thị nút Next --}}
                        @if ($paginator->hasMorePages())
                            <a href="{{ $paginator->nextPageUrl() }}">Next</a>
                        @else
                            <span class="disabled">Next</span>
                        @endif
                    </div> <!-- End Pagination -->
                </div>
            </div> <!-- End Shop Product Sorting Section  -->
        </div>
    </div>
</div> <!-- ...:::: End Shop Section:::... -->
@endif
@endsection