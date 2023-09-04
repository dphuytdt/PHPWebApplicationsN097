@extends('layouts.main') @section('content') @section('title', 'Book Store') @php $free = $books['free']; $new = $books['new']; $featured = $books['featured']; @endphp
@php
    $numberLimit = 12;
@endphp
<div class="hero-area">
    <div class="hero-area-wrapper hero-slider-dots fix-slider-dots">
        <div class="hero-area-single">
            <div class="hero-area-bg">
                <img class="hero-img" src="https://img.freepik.com/premium-photo/turning-paper-book-pages-literature-banner-with-copy-space-text_361816-5089.jpg" alt="" />
            </div>
            <div class="hero-content">
                <div class="container">
                    <div class="row">
                        <div class="col-10 col-md-8 col-xl-6">
                            <h5>{{__('messages.TheQuality')}}</h5>
                            <h2>{{__('messages.BookStore')}}</h2>
                            <p>{{__('messages.aVariety')}}</p>
                            <a href="{{route('view.more' , ['dataType' => 'all'])}}" class="hero-button">{{__('messages.ShoppingNow')}}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="hero-area-single">
            <div class="hero-area-bg">
                <img class="hero-img" src="https://t3.ftcdn.net/jpg/02/60/92/70/360_F_260927075_10lMM4OgNQ2emzsMhKQAlhsBsSGp4KNv.jpg" alt="" />
            </div>
            <div class="hero-content">
                <div class="container">
                    <div class="row">
                        <div class="col-10 col-md-8 col-xl-6">
                            <h5>{{__('messages.WorldBestBooks')}}</h5>
                            <h2>{{__('messages.NewBooks')}}</h2>
                            <p>{{__('messages.winTheHelp')}}</p>
                            <a href="{{route('view.more' , ['dataType' => 'all'])}}" class="hero-button">{{__('messages.ShoppingNow')}}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="product-catagory-section section-top-gap-100">
    <div class="section-content-gap">
        <div class="container">
            <div class="row">
                <div class="section-content">
                    <h3 class="section-title">{{__('messages.PopularCategories')}}</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="product-catagory-wrapper">
        <div class="container">
            <div class="row">
                @php
                    $category_selected = [];
                    if(in_array([], $categories, true))
                        foreach ($categories as $key => $value) {
                            if ($key == 4) { break; }
                            $category_selected[] = $value;
                        }
                @endphp
                @if(count($category_selected) == 0 || $category_selected == null)
                    <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                        <a href="#" class="product-catagory-single">
                            <div class="product-catagory-img">
                                <img src="https://img.freepik.com/free-vector/online-library-concept_23-2148538594.jpg?size=626&ext=jpg" alt="" />
                            </div>
                            <div class="product-catagory-content">
                                <h5 class="product-catagory-title">{{__('messages.NoCategory')}}</h5>
                            </div>
                        </a>
                    </div>
                @else @foreach ( $category_selected as $category )
                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <a href="{{route('getBookByCategory', ['id' => $category['id']])}}" class="product-catagory-single">
                                <div class="product-catagory-img">

                                    <img src="{{ $category['image'] }}" alt="" />
                                </div>
                                <div class="product-catagory-content">
                                    <h5 class="product-catagory-title">{{ Illuminate\Support\Str::limit($category['name'], $numberLimit) }}</h5>
                                </div>
                            </a>
                        </div>
                    @endforeach @endif
            </div>
        </div>
    </div>
</div>
<div class="banner-section section-top-gap-100">
    <div class="banner-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6 col-12">
                    <div class="banner-single">
                        <a href="#l" class="banner-img-link">
                            <img class="banner-img" src="https://img.freepik.com/premium-vector/online-library-outline-isometric-education-concept-open-book-with-loupe-isolated-white_119523-8406.jpg" alt="" />
                        </a>
                        <div class="banner-content">
                            <a href="#" class="banner-link">Shop Now</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-12">
                    <div class="banner-single">
                        <a href="#" class="banner-img-link">
                            <img class="banner-img" src="https://img.freepik.com/premium-vector/collection-cat-with-pile-book-set_77984-276.jpg" alt="" />
                        </a>
                        <div class="banner-content">
                            <a href="#" class="banner-link">Shop Now</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-12">
                    <div class="banner-single">
                        <a href="#" class="banner-img-link">
                            <img class="banner-img" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSbT_Tb79QYgsvr3knZa-cWA-6vxuv3ZFzh0clS46Y2QjPV2VLIRb1VR4-iXRbbwMZiDLM&usqp=CAU" alt="" />
                        </a>
                        <div class="banner-content">
                            <a href="#" class="banner-link">Shop Now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="product-tab-section section-top-gap-100">
    <div class="section-content-gap">
        <div class="container">
            <div class="row">
                <div class="section-content d-flex justify-content-between align-items-md-center align-items-start flex-md-row flex-column">
                    <h3 class="section-title">{{__('messages.NewBooks')}}</h3>
                    <ul class="tablist nav product-tab-btn">
                        <li><a class="nav-link active" href="{{route('view.more' , ['dataType' => 'new'])}}">{{__('messages.Viewmore')}}</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="product-tab-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="tab-content tab-animate-zoom">
                        <div class="tab-pane show active" id="car_and_drive">
                            <div class="product-default-slider product-default-slider-4grids-1row">
                                @foreach($new as $news)
                                    <div class="product-default-single border-around">
                                        <div class="product-img-warp">
                                            <a id="url-{{$news['id']}}" href="{{URL::to('/book-details/'.$news['id'])}}" class="product-default-img-link">
                                                <img src="{{ $news['cover_image'] }}" alt="" class="product-default-img img-fluid" />
                                            </a>
                                            <div class="product-action-icon-link">
                                                <ul>
                                                    <input type="hidden" id="bookID" value="{{$news['id']}}" />
                                                    <input type="hidden" id="bookTitle" value="{{ Illuminate\Support\Str::limit($news['title'], $numberLimit) }}" />
                                                    <input type="hidden" id="bookImage" value="{{$news['cover_image']}}" />
                                                    <input type="hidden" id="bookPrice" value="{{$news['price']}}" />
                                                    <input type="hidden" id="image-{{$news['id']}}" value="{{$news['cover_image']}}" />
                                                    <li>
                                                        <a id="addWishlist-{{$news['id']}}"> <i class="icon-heart"></i></a>
                                                    </li>
                                                    <li>
                                                        <a href="#" data-toggle="modal" data-target="#modalQuickviewNewBook-{{$news['id']}}"><i class="icon-eye"></i></a>
                                                    </li>
                                                    @if($news['price'] != 0)
                                                        <li>
                                                            <a id="addCart-{{$news['id']}}" data-toggle="modal" data-target="#modalAddcartNewBook-{{$news['id']}}"><i class="icon-shopping-cart"></i></a>
                                                        </li>
                                                    @endif
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="product-default-content">
                                            <h6 class="product-default-link"><a href="{{URL::to('/book-details/'.$news['id'])}}">{{Illuminate\Support\Str::limit($news['title'], $numberLimit)}}</a></h6>
                                            <input type="text" disabled hidden value="{{$news['title']}}" id="name-{{$news['id']}}" />
                                            <input type="hidden" id="image-{{$news['id']}}" value="{{$news['cover_image']}}" />
                                            @if($news['price'] != 0)
                                                <span class="product-default-price">{{number_format($news['price'])}} $</span>
                                                <input type="text" disabled hidden value="{{number_format($news['price'])}}" id="price-{{$news['id']}}" />
                                            @else
                                                <span class="product-default-price">Free for now</span>
                                            @endif
                                            <input type="text" disabled hidden value="Free for now" id="price-{{$news['id']}}" />
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="product-tab-section section-top-gap-100">
    <!-- Start Section Content -->
    <div class="section-content-gap">
        <div class="container">
            <div class="row">
                <div class="section-content d-flex justify-content-between align-items-md-center align-items-start flex-md-row flex-column">
                    <h3 class="section-title">{{__('messages.FreeBooks')}}</h3>
                    <ul class="tablist nav product-tab-btn">
                        <li><a class="nav-link active" href="{{route('view.more' , ['dataType' => 'free'])}}">{{__('messages.Viewmore')}}</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="product-tab-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="tab-content tab-animate-zoom">
                        <div class="tab-pane show active" id="car_and_drive">
                            <div class="product-default-slider product-default-slider-4grids-1row">
                                @foreach ($free as $book)
                                    <div class="product-default-single border-around">
                                        <div class="product-img-warp">
                                            <a id="url-{{$book['id']}}" href="{{URL::to('/book-details/'.$book['id'])}}" class="product-default-img-link">
                                                <img src="{{ $book['cover_image'] }}" alt="" class="product-default-img img-fluid" />
                                                <input type="hidden" id="image-{{$book['id']}}" value="{{$news['cover_image']}}" />
                                            </a>
                                            <div class="product-action-icon-link">
                                                <ul>
                                                    <li>
                                                        <a id="addWishlist-{{$book['id']}}"><i class="icon-heart"></i></a>
                                                    </li>
                                                    <li>
                                                        <a href="#"><i class="icon-repeat"></i></a>
                                                    </li>
                                                    <li>
                                                        <a href="#" data-toggle="modal" data-target="#modalQuickview-{{$book['id']}}"><i class="icon-eye"></i></a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="product-default-content">
                                            <h6 class="product-default-link"><a href="{{URL::to('/book-details/'.$book['id'])}}">{{Illuminate\Support\Str::limit($book['title'], $numberLimit)}}</a></h6>
                                            <input type="text" disabled hidden value="{{$book['title']}}" id="name-{{$book['id']}}" />
                                            <input type="hidden" id="image-{{$news['id']}}" value="{{$news['cover_image']}}" />
                                            <span class="product-default-price">Free for now</span>
                                            <input type="text" disabled hidden value="Free for now" id="price-{{$book['id']}}" />
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="banner-section section-top-gap-100">
    <div class="banner-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="banner-single">
                        <a href="{{route('home')}}" class="banner-img-link">
                            <img class="banner-img banner-img-big" src="{{asset('assets/images/banner/6781341.jpg')}}" alt="" />
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="product-tab-section section-top-gap-100">
    <div class="section-content-gap">
        <div class="container">
            <div class="row">
                <div class="section-content d-flex justify-content-between align-items-md-center align-items-start flex-md-row flex-column">
                    <h3 class="section-title">{{__('messages.FeaturedBooks')}}</h3>
                    <ul class="tablist nav product-tab-btn">
                        <li><a class="nav-link active" href="{{route('view.more' , ['dataType' => 'featured'])}}">{{__('messages.Viewmore')}}s</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="product-tab-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="tab-content tab-animate-zoom">
                        <div class="tab-pane show active" id="car_and_drive">
                            <div class="product-default-slider product-default-slider-4grids-1row">
                                @foreach($featured as $news)
                                    <div class="product-default-single border-around">
                                        <div class="product-img-warp">
                                            <a id="url-{{$news['id']}}" href="{{URL::to('/book-details/'.$news['id'])}}" class="product-default-img-link">

                                                <img src="{{ $news['cover_image'] }}" alt="" class="product-default-img img-fluid" />
                                            </a>
                                            <div class="product-action-icon-link">
                                                <ul>
                                                    <input type="hidden" id="bookID" value="{{$news['id']}}" />
                                                    <input type="hidden" id="bookTitle" value="{{Illuminate\Support\Str::limit($news['title'], $numberLimit)}}" />
                                                    <input type="hidden" id="bookImage" value="{{$news['cover_image']}}" />
                                                    <input type="hidden" id="image-{{$news['id']}}" value="{{$news['cover_image']}}" />
                                                    <input type="hidden" id="bookPrice" value="{{$news['price']}}" />
                                                    <li>
                                                        <a id="addWishlist-{{$news['id']}}"> <i class="icon-heart"></i></a>
                                                    </li>
                                                    <li>
                                                        <a href="#" data-toggle="modal" data-target="#modalQuickviewNewBook-{{$news['id']}}"><i class="icon-eye"></i></a>
                                                    </li>
                                                    @if($news['price'] != 0)
                                                        <li>
                                                            <a id="addCart-{{$news['id']}}" data-toggle="modal" data-target="#modalAddcartNewBook-{{$news['id']}}"><i class="icon-shopping-cart"></i></a>
                                                        </li>
                                                    @endif
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="product-default-content">
                                            <h6 class="product-default-link"><a href="{{URL::to('/book-details/'.$news['id'])}}">{{Illuminate\Support\Str::limit($news['title'], $numberLimit)}}</a></h6>
                                            <input type="text" disabled hidden value="{{$news['title']}}" id="name-{{$news['id']}}" />
                                            <input type="hidden" id="image-{{$news['id']}}" value="{{$news['cover_image']}}" />
                                            @if($news['price'] != 0)
                                                <span class="product-default-price">{{number_format($news['price'])}} $</span>
                                                <input type="text" disabled hidden value="{{number_format($news['price'])}}" id="price-{{$news['id']}}" />
                                            @else
                                                <span class="product-default-price">Free for now</span>
                                            @endif
                                            <input type="text" disabled hidden value="Free for now" id="price-{{$news['id']}}" />
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@foreach($free as $book)
    <div class="modal fade" id="modalQuickview-{{$book['id']}}" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col text-right">
                                <button type="button" class="close modal-close" id="closeModal-close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true"> <i class="fa fa-times"></i></span>
                                </button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="product-details-gallery-area">
                                    <div class="product-large-image modal-product-image-large">
                                        <div class="product-image-large-single">
                                            <img class="img-fluid" src="{{ $book['cover_image'] }}" alt="" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="product-details-content-area">
                                    <div class="product-details-text">
                                        <h4 class="title">{{Illuminate\Support\Str::limit($book['title'], $numberLimit)}}</h4>
                                        @if($book['price'] == 0)
                                            <div class="price">Free for now</div>
                                        @else
                                            <div class="price">${{$book['price']}}</div>

                                        @endif
                                        <p>{{$book['description']}}</p>
                                    </div>
                                    <div class="product-details-variable">
                                        @if ($book['price'] == 0)
                                            <div class="product-add-to-cart-btn">
                                                <a href="#" data-toggle="modal" data-target="#modalAddcart">Read Now</a>
                                            </div>
                                            <br />
                                        @else
                                        <div class="product-add-to-cart-btn">
                                            <a href="#" data-toggle="modal" data-target="#modalAddcart">Add To Cart</a>
                                        </div>
                                        <br />
                                        @endif
                                    </div>
                                    <div class="product-details-meta mb-20">
                                        <ul>
                                            <li>
                                                <button id="addWishlist-{{$book['id']}}"><i class="icon-heart"></i>Add to wishlist</button>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach @foreach($new as $book)
    <div class="modal fade" id="modalQuickviewNewBook-{{$book['id']}}" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col text-right">
                                <button type="button" class="close modal-close" id="closeModal-close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true"> <i class="fa fa-times"></i></span>
                                </button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="product-details-gallery-area">
                                    <div class="product-large-image modal-product-image-large">
                                        <div class="product-image-large-single">
                                            <img class="img-fluid" src="{{ $book['cover_image'] }}" alt="" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="product-details-content-area">
                                    <div class="product-details-text">
                                        <h4 class="title">{{Illuminate\Support\Str::limit($book['title'], $numberLimit)}}</h4>
                                        @if($book['price'] == 0)
                                            <div class="price">Free for now</div>
                                        @else
                                            <div class="price">${{$book['price']}}</div>

                                        @endif
                                        <p>{{$book['description']}}</p>
                                    </div>
                                    <div class="product-details-variable">
                                        @if ($book['price'] == 0)
                                            <div class="product-add-to-cart-btn">
                                                <a href="#" data-toggle="modal" data-target="#modalAddcart">Read Now</a>
                                            </div>
                                            <br />
                                        @else
                                            <div class="product-add-to-cart-btn">
                                                <a id="addCart-{{$book['id']}}" data-toggle="modal" data-target="#modalAddcartNewBook-{{$book['id']}}">Add To Cart</a>
                                            </div>
                                            <br />
                                        @endif
                                    </div>
                                    <div class="product-details-meta mb-20">
                                        <ul>
                                            <li>
                                                <button id="addWishlist-{{$book['id']}}"><i class="icon-heart"></i>Add to wishlist</button>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalAddcartNewBook-{{$book['id']}}" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col text-right">
                                <button type="button" class="close modal-close" id="closeModal-close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true"> <i class="fa fa-times"></i></span>
                                </button>
                            </div>
                        </div>
                        <div class="row">
                            @if(session()->has('user')) @php $user_id = session()->get('user')['id']; @endphp
                            <input type="hidden" id="user_id" value="{{$user_id}}" />
                            <div class="col-md-7">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="modal-add-cart-product-img">
                                            <img class="img-fluid" src="{{ $book['cover_image'] }}" alt="" />
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="modal-add-cart-info"><i class="fa fa-check-square"></i>Added to cart successfully!</div>
                                        <div class="modal-add-cart-product-cart-buttons">
                                            <a href="{{route('cart.getUserCart',$user_id)}}">View Cart</a>
                                            <a href="{{route('cart.checkOut',$user_id)}}">Checkout</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5 modal-border">
                                <ul class="modal-add-cart-product-shipping-info">
                                    <li class="modal-continue-button"><a href="#" data-dismiss="modal">CONTINUE SHOPPING</a></li>
                                </ul>
                            </div>
                            @else
                                <style>
                                    .require-login {
                                        display: flex;
                                        justify-content: center;
                                        align-items: center;
                                        height: 100%;
                                    }
                                </style>
                                <div class="require-login">
                                    <div>
                                        <div class="modal-add-cart-info">Please login or register to add to cart!</div>
                                        <div class="modal-add-cart-product-cart-buttons">
                                            <a href="{{route('login')}}">Login</a>

                                            <a href="{{route('login')}}">Register</a>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach @foreach($featured as $book)
    <div class="modal fade" id="modalQuickviewFeaturedBook-{{$book['id']}}" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col text-right">
                                <button type="button" class="close modal-close" id="closeModal-close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true"> <i class="fa fa-times"></i></span>
                                </button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="product-details-gallery-area">
                                    <div class="product-large-image modal-product-image-large">
                                        <div class="product-image-large-single">
                                            <img class="img-fluid" src="{{ $book['cover_image'] }}" alt="" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="product-details-content-area">
                                    <div class="product-details-text">
                                        <h4 class="title">{{Illuminate\Support\Str::limit($book['title'], $numberLimit)}}</h4>
                                        @if($book['price'] == 0)
                                            <div class="price">Free for now</div>
                                        @else
                                            <div class="price">${{$book['price']}}</div>

                                        @endif
                                        <p>{{$book['description']}}</p>
                                    </div>
                                    <div class="product-details-variable">
                                        @if ($book['price'] == 0)
                                            <div class="product-add-to-cart-btn">
                                                <a href="#" data-toggle="modal" data-target="#modalAddcart">Read Now</a>
                                            </div>
                                            <br />
                                        @else
                                            <div class="product-add-to-cart-btn">
                                                <a href="#" data-toggle="modal" data-target="#modalAddcart">Add To Cart</a>
                                            </div>
                                            <br />
                                        @endif
                                    </div>
                                    <div class="product-details-meta mb-20">
                                        <ul>
                                            <li>
                                                <button id="addWishlist-{{$book['id']}}"><i class="icon-heart"></i>Add to wishlist</button>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalAddcartFeaturedBook-{{$book['id']}}" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col text-right">
                                <button type="button" class="close modal-close" id="closeModal-close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true"> <i class="fa fa-times"></i></span>
                                </button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-7">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="modal-add-cart-product-img">
                                            <img class="img-fluid" src="{{ $book['cover_image'] }}" alt="" />
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="modal-add-cart-info"><i class="fa fa-check-square"></i>Added to cart successfully!</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5 modal-border">
                                <ul class="modal-add-cart-product-shipping-info">
                                    <li class="modal-continue-button"><a href="#" data-dismiss="modal">CONTINUE SHOPPING</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach

<div class="blog-feed-section section-top-gap-100">
    <div class="section-content-gap">
        <div class="container">
            <div class="row">
                <div class="section-content d-flex justify-content-between align-items-md-center align-items-start flex-md-row flex-column">
                    <h3 class="section-title">{{__('messages.Latest News')}}</h3>
{{--                    <ul class="tablist nav product-tab-btn">--}}
{{--                        <li><a class="nav-link active" href="">{{__('messages.Viewmore')}}</a></li>--}}
{{--                    </ul>--}}
                </div>
            </div>
        </div>
    </div>
    <div class="blog-feed-wrapper">
        <div class="container">
            <div class="row">
                @foreach($latestNews as $latestNew)
                <div class="col-lg-4 col-md-6 col-12">
                    <div class="blog-feed-single">
                        <a href="{{route('newsDetail' , $latestNew['id'])}}" class="blog-feed-img-link">
                            <img src="{{ $latestNew['image'] }}" alt="" class="blog-feed-img">
                        </a>
                        @php
                            $date = date_create($latestNew['created_at']);
                            $date = date_format($date,"M d, Y");
                        @endphp
                        <div class="blog-feed-content">
                            <div class="blog-feed-post-meta">
                                <span>{{__('messages.By:')}}</span>
                                <a href="{{route('newsDetail' , $latestNew['id'])}}" class="blog-feed-post-meta-author">{{$latestNew['creadted_by']}}</a> -
                                <a href="{{route('newsDetail' , $latestNew['id'])}}" class="blog-feed-post-meta-date">{{$date}}</a>
                                <h5 class="blog-feed-link"><a href="{{route('newsDetail' , $latestNew['id'])}}">{{Illuminate\Support\Str::limit($latestNew['title'], $numberLimit)}}</a></h5>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<script
    src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"
    integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw=="
    crossorigin="anonymous"
    referrerpolicy="no-referrer"
></script>
<script
    src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"
    integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA=="
    crossorigin="anonymous"
    referrerpolicy="no-referrer"
></script>
<script type="text/javascript">
    document.querySelectorAll('[id^="addCart-"]').forEach(function(button) {
        button.addEventListener('click', function() {
            var userID = @json(session('user_id'));

            if(null == userID){
                console.log("Please login first");
            }else{
                var bookId = this.id.split('-')[1];
                var bookTitle = document.getElementById('name-' + bookId).value;
                var bookPrice = document.getElementById('price-' + bookId).value;
                bookPrice = parseFloat(bookPrice);
                var bookImage = document.getElementById('image-' + bookId).value;
                var image_extension = 'png';
                var xhr = new XMLHttpRequest();
                var url = 'http://127.0.0.1:8085/api/cart/add';
                xhr.open('POST', url, true);
                xhr.setRequestHeader('Content-Type', 'application/json');

                if (isNaN(bookPrice)) {
                    bookPrice = 0;
                }

                var requestBody = {
                    userID: userID,
                    bookID: bookId,
                    bookTitle: bookTitle,
                    bookPrice: bookPrice,
                    bookImage: bookImage,
                    image_extension: image_extension
                };

                xhr.send(JSON.stringify(requestBody));

                xhr.onreadystatechange = function() {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200) {
                            setTimeout(function() {
                                location.reload();
                            }, 1000);
                        } else {
                            setTimeout(function() {
                                location.reload();
                            }, 1000);
                        }
                    }
                };
            }
        });
    });
</script>
<script type="text/javascript">
    document.querySelectorAll('[id^="addWishlist-"]').forEach(function(button) {
        button.addEventListener('click', function() {
            var userID = @json(session('user_id'));


            if(null === userID){
                swal({
                    title: "Please login to add to wishlist!",
                    icon: "warning",
                    button: "OK",
                });
            }else{
                var bookId = this.id.split('-')[1];
                var bookTitle = document.getElementById('name-' + bookId).value;
                var bookPrice = document.getElementById('price-' + bookId).value;
                var bookImage = document.getElementById('image-' + bookId).value;
                var image_extension = 'png';
                var xhr = new XMLHttpRequest();
                var url = 'http://127.0.0.1:8085/api/wishlist/add';

                bookPrice = parseFloat(bookPrice);

                xhr.open('POST', url, true);
                xhr.setRequestHeader('Content-Type', 'application/json');

                if (isNaN(bookPrice)) {
                    bookPrice = 0;
                }

                var requestBody = {
                    userID: userID,
                    bookID: bookId,
                    bookTitle: bookTitle,
                    bookPrice: bookPrice,
                    bookImage: bookImage,
                    image_extension: image_extension,
                };

                xhr.send(JSON.stringify(requestBody));

                xhr.onreadystatechange = function() {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200) {
                            swal({
                                title: "Success!",
                                text: "Book added to wishlist!",
                                icon: "success",
                                button: "OK",
                            }).then(function() {
                                location.reload();
                            });
                        } else {
                            swal({
                                title: "Error!",
                                text: "Book already in wishlist!",
                                icon: "error",
                                button: "OK",
                            }).then(function() {
                                location.reload();
                            });
                        }
                    }
                };
            }
        });
    });
</script>

<script>
    $(document).ready(function () {
        $("#closeModal-close").click(function () {
            location.reload();
        });
    });
</script>
@endsection
