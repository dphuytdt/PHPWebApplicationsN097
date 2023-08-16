@extends('layouts.main')
@section('content')
@section('title', 'Book Store')
@php
    $free = $books['free'];
    $new = $books['new'];
    $featured = $books['featured'];
@endphp
<!-- ...:::: Start Hero Area Section:::... -->
<div class="hero-area">
	<div class="hero-area-wrapper hero-slider-dots fix-slider-dots">
		<!-- Start Hero Slider Single -->
		<div class="hero-area-single">
			<div class="hero-area-bg">
				<img class="hero-img" src="https://img.freepik.com/premium-photo/turning-paper-book-pages-literature-banner-with-copy-space-text_361816-5089.jpg" alt="">
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
		</div> <!-- End Hero Slider Single -->
		<!-- Start Hero Slider Single -->
		<div class="hero-area-single">
			<div class="hero-area-bg">
				<img class="hero-img" src="https://t3.ftcdn.net/jpg/02/60/92/70/360_F_260927075_10lMM4OgNQ2emzsMhKQAlhsBsSGp4KNv.jpg" alt="">
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
		</div> <!-- End Hero Slider Single -->
	</div>
</div> <!-- ...:::: End Hero Area Section:::... -->

<!-- ...:::: Start Product Catagory Section:::... -->
<div class="product-catagory-section section-top-gap-100">
	<!-- Start Section Content -->
	<div class="section-content-gap">
		<div class="container">
			<div class="row">
				<div class="section-content">
					<h3 class="section-title">{{__('messages.PopularCategories')}}</h3>
				</div>
			</div>
		</div>
	</div> <!-- End Section Content -->

	<!-- Start Catagory Wrapper -->
	<div class="product-catagory-wrapper">
		<div class="container">
			<div class="row">
				@php
					foreach ($categories as $key => $value) {
						if ($key == 4) {
							break;
						}
                        $category_selected[] = $value;
					}
				@endphp

				@foreach ( $category_selected as $category )
					<div class="col-lg-3 col-md-4 col-sm-6 col-12">
						<a href="{{route('getBookByCategory', ['id' => $category['id']])}}" class="product-catagory-single">
							<div class="product-catagory-img">

								<img src="data:image/{{$category['image_extension']}};base64,{{ $category['image'] }}" alt="">
							</div>
							<div class="product-catagory-content">
								<h5 class="product-catagory-title">{{ $category['name'] }}</h5>
							</div>
						</a> <!-- End Product Catagory Single -->
					</div>
				@endforeach
			</div>
		</div>
	</div> <!-- End Catagory Wrapper -->
</div> <!-- ...:::: End Product Catagory Section:::... -->

<!-- ...:::: Start Banner Section:::... -->
<div class="banner-section section-top-gap-100">
	<!-- Start Banner Wrapper -->
	<div class="banner-wrapper">
		<div class="container">
			<div class="row">
				<div class="col-lg-4 col-md-6 col-12">
					<!-- Start Banner Single -->
					<div class="banner-single">
						<a href="#l" class="banner-img-link">
							<img class="banner-img" src="https://img.freepik.com/premium-vector/online-library-outline-isometric-education-concept-open-book-with-loupe-isolated-white_119523-8406.jpg" alt="">
						</a>
						<div class="banner-content">
							{{-- <span class="banner-text-tiny">The Best of</span>
							<h3 class="banner-text-large">30% Off</h3> --}}
							<a href="#" class="banner-link">Shop Now</a>
						</div>
					</div> <!-- End Banner Single -->
				</div>
				<div class="col-lg-4 col-md-6 col-12">
					<!-- Start Banner Single -->
					<div class="banner-single">
						<a href="#" class="banner-img-link">
							<img class="banner-img" src="https://img.freepik.com/premium-vector/collection-cat-with-pile-book-set_77984-276.jpg" alt="">
						</a>
						<div class="banner-content">
							{{-- <span class="banner-text-tiny">Where to</span>
							<h3 class="banner-text-large">40% Off</h3> --}}
							<a href="#" class="banner-link">Shop Now</a>
						</div>
					</div> <!-- End Banner Single -->
				</div>
				<div class="col-lg-4 col-md-6 col-12">
					<!-- Start Banner Single -->
					<div class="banner-single">
						<a href="#" class="banner-img-link">
							<img class="banner-img" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSbT_Tb79QYgsvr3knZa-cWA-6vxuv3ZFzh0clS46Y2QjPV2VLIRb1VR4-iXRbbwMZiDLM&usqp=CAU" alt="">
						</a>
						<div class="banner-content">
							{{-- <span class="banner-text-tiny">How to</span>
							<h3 class="banner-text-large">50% Off</h3> --}}
							<a href="#" class="banner-link">Shop Now</a>
						</div>
					</div> <!-- End Banner Single -->
				</div>
			</div>
		</div>
	</div> <!-- End Banner Wrapper -->
</div> <!-- ...:::: End Banner Section:::... -->

<!-- ...:::: Start Product Tab Section:::... -->
<div class="product-tab-section section-top-gap-100">
	<!-- Start Section Content -->
	<div class="section-content-gap">
		<div class="container">
			<div class="row">
				<div class="section-content d-flex justify-content-between align-items-md-center align-items-start flex-md-row flex-column">
					<h3 class="section-title">{{__('messages.NewBooks')}}</h3>
					<ul class="tablist nav product-tab-btn">
						<li><a class="nav-link active"  href="{{route('view.more' , ['dataType' => 'new'])}}">{{__('messages.Viewmore')}}</a></li>
					</ul>
				</div>
			</div>
		</div>
	</div> <!-- End Section Content -->

	<!-- Start Tab Wrapper -->
	<div class="product-tab-wrapper">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="tab-content tab-animate-zoom">
						<div class="tab-pane show active" id="car_and_drive">
							<div class="product-default-slider product-default-slider-4grids-1row">
								<!-- Start Product Defautlt Single -->
                                @foreach($new as $news)
                                    <div class="product-default-single border-around">
                                        <div class="product-img-warp">
                                            <a id="url-{{$news['id']}}" href="{{URL::to('/book-details/'.$news['id'])}}" class="product-default-img-link">
                                                <img src="data:image/{{$news['image_extension']}};base64,{{ $news['cover_image'] }}" id="image-{{$news['id']}}" alt="" class="product-default-img img-fluid">
                                            </a>
                                            <div class="product-action-icon-link">
                                                <ul>
                                                    <input type="hidden" id="bookID" value="{{$news['id']}}">
                                                    <input type="hidden" id="bookTitle" value="{{$news['title']}}">
                                                    <input type="hidden" id="bookImage" value="{{$news['cover_image']}}">
                                                    <input type="hidden" id="bookPrice" value="{{$news['price']}}">
                                                    <li><a id="addWishlist-{{$news['id']}}"  > <i class="icon-heart"></i></a></li>
                                                    <li><a href="#" data-toggle="modal" data-target="#modalQuickviewNewBook-{{$news['id']}}"><i class="icon-eye"></i></a></li>
                                                    @if($news['price'] != 0)
                                                        <li><a id="addCart-{{$news['id']}}"  data-toggle="modal" data-target="#modalAddcartNewBook-{{$news['id']}}"><i class="icon-shopping-cart"></i></a></li>
                                                    @endif
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="product-default-content">
                                            <h6 class="product-default-link"><a href="{{URL::to('/book-details/'.$news['id'])}}" >{{$news['title']}}</a></h6>
                                            <input type="text" disabled hidden value="{{$news['title']}}" id="name-{{$news['id']}}">
                                            @if($news['price'] != 0)
                                                <span class="product-default-price">{{number_format($news['price'])}} $</span>
                                                <input type="text" disabled hidden value="{{number_format($news['price'])}}" id="price-{{$news['id']}}">
                                            @else
                                            <span class="product-default-price" >Free for now</span>
                                            @endif
                                            <input type="text" disabled hidden value="Free for now" id="price-{{$news['id']}}">
                                        </div>
                                    </div> <!-- End Product Defautlt Single -->
                                @endforeach
                            </div>
						</div>

					</div>
				</div>
			</div>
		</div>
	</div> <!-- End Catagory Wrapper -->

</div> <!-- ...:::: Start Product Tab Section:::... -->

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
	</div> <!-- End Section Content -->

	<!-- Start Tab Wrapper -->
	<div class="product-tab-wrapper">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="tab-content tab-animate-zoom">
						<div class="tab-pane show active" id="car_and_drive">
							<div class="product-default-slider product-default-slider-4grids-1row">
								<!-- Start Product Defautlt Single -->
								@foreach ($free as $book)
                                    <div class="product-default-single border-around">
                                        <div class="product-img-warp">
                                            <a id="url-{{$book['id']}}" href="{{URL::to('/book-details/'.$book['id'])}}" class="product-default-img-link">

                                                <img src="data:image/{{ $book['image_extension'] }};base64,{{ $book['cover_image'] }}" id="image-{{$book['id']}}" alt="" class="product-default-img img-fluid">
                                            </a>
                                            <div class="product-action-icon-link">
                                                <ul>
                                                    <li><a id="addWishlist-{{$book['id']}}"><i class="icon-heart"></i></a></li>
                                                    <li><a href="#"><i class="icon-repeat"></i></a></li>
                                                    <li><a href="#" data-toggle="modal" data-target="#modalQuickview-{{$book['id']}}"><i class="icon-eye"></i></a></li>

                                                </ul>
                                            </div>
                                        </div>
                                        <div class="product-default-content">
                                            <h6 class="product-default-link"><a href="{{URL::to('/book-details/'.$book['id'])}}" >{{$book['title']}}</a></h6>
                                            <input type="text" disabled hidden value="{{$book['title']}}" id="name-{{$book['id']}}">
                                            <span class="product-default-price" >Free for now</span>
                                            <input type="text" disabled hidden value="Free for now" id="price-{{$book['id']}}">
                                        </div>
                                    </div> <!-- End Product Defautlt Single -->
								@endforeach
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div> <!-- End Catagory Wrapper -->

</div> <!-- ...:::: Start Product Tab Section:::... -->

<!-- ...:::: Start Product Catagory Section:::... -->
<div class="banner-section section-top-gap-100">
	<!-- Start Banner Wrapper -->
	<div class="banner-wrapper">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<!-- Start Banner Single -->
					<div class="banner-single">
						<a href="product-details-default.html" class="banner-img-link">
							<img class="banner-img banner-img-big" src="https://img.freepik.com/premium-photo/row-old-books-blue-shelf-horizontal-background-banner_118047-9024.jpg" alt="">
						</a>
					</div> <!-- End Banner Single -->
				</div>
			</div>
		</div>
	</div> <!-- End Banner Wrapper -->
</div> <!-- ...:::: End Product Catagory Section:::... -->


<div class="product-tab-section section-top-gap-100">
    <!-- Start Section Content -->
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
    </div> <!-- End Section Content -->

    <!-- Start Tab Wrapper -->
    <div class="product-tab-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="tab-content tab-animate-zoom">
                        <div class="tab-pane show active" id="car_and_drive">
                            <div class="product-default-slider product-default-slider-4grids-1row">
                                <!-- Start Product Defautlt Single -->
                                @foreach($featured as $news)
                                    <div class="product-default-single border-around">
                                        <div class="product-img-warp">
                                            <a id="url-{{$news['id']}}" href="{{URL::to('/book-details/'.$news['id'])}}" class="product-default-img-link">
                                                <img src="data:image/{{ $news['image_extension'] }};base64,{{ $news['cover_image'] }}" id="image-{{$news['id']}}" alt="" class="product-default-img img-fluid">

                                            </a>
                                            <div class="product-action-icon-link">
                                                <ul>
                                                    <input type="hidden" id="bookID" value="{{$news['id']}}">
                                                    <input type="hidden" id="bookTitle" value="{{$news['title']}}">
                                                    <input type="hidden" id="bookImage" value="{{$news['cover_image']}}">
                                                    <input type="hidden" id="bookPrice" value="{{$news['price']}}">
                                                    <li><a id="addWishlist-{{$news['id']}}"  > <i class="icon-heart"></i></a></li>
                                                    <li><a href="#"><i class="icon-repeat"></i></a></li>
                                                    <li><a href="#" data-toggle="modal" data-target="#modalQuickviewNewBook-{{$news['id']}}"><i class="icon-eye"></i></a></li>
                                                    @if($news['price'] != 0)
                                                        <li><a id="addCart-{{$news['id']}}"  data-toggle="modal" data-target="#modalAddcartNewBook-{{$news['id']}}"><i class="icon-shopping-cart"></i></a></li>
                                                    @endif
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="product-default-content">
                                            <h6 class="product-default-link"><a href="{{URL::to('/book-details/'.$news['id'])}}" >{{$news['title']}}</a></h6>
                                            <input type="text" disabled hidden value="{{$news['title']}}" id="name-{{$news['id']}}">
                                            @if($news['price'] != 0)
                                                <span class="product-default-price">{{number_format($news['price'])}} $</span>
                                                <input type="text" disabled hidden value="{{number_format($news['price'])}}" id="price-{{$news['id']}}">
                                            @else
                                                <span class="product-default-price" >Free for now</span>
                                            @endif
                                            <input type="text" disabled hidden value="Free for now" id="price-{{$news['id']}}">
                                        </div>
                                    </div> <!-- End Product Defautlt Single -->
                                @endforeach
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End Catagory Wrapper -->

</div> <!-- ...:::: Start Product Tab Section:::... -->
<!-- ...:::: Start Product Tab Section:::... -->

<!-- ...:::: Start Blog Feed Section:::... -->
@foreach($free as $book)
    <div class="modal fade" id="modalQuickview-{{$book['id']}}" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog  modal-dialog-centered" role="document">
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
                                            <img class="img-fluid" src="data:image/{{ $book['image_extension'] }};base64,{{ $book['cover_image'] }}" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="product-details-content-area">
                                    <!-- Start  Product Details Text Area-->
                                    <div class="product-details-text">
                                        <h4 class="title">{{$book['title']}}</h4>
                                        @if($book['price'] == 0)
                                            <div class="price">Free for now</div>
                                        @else
                                            <div class="price">${{$book['price']}}</div>

                                        @endif
                                        <p>{{$book['description']}}</p>
                                    </div> <!-- End  Product Details Text Area-->
                                    <!-- Start Product Variable Area -->
                                    <div class="product-details-variable">
                                        <!-- Product Variable Single Item -->
                                        <!-- Product Variable Single Item -->

                                        @if ($book['price'] == 0)
                                            <div class="product-add-to-cart-btn">
                                                <a href="#" data-toggle="modal" data-target="#modalAddcart">Read Now</a>
                                            </div>
                                            <br>
                                        @else
{{--                                            <div class="variable-single-item ">--}}
{{--                                                <span>Quantity Available</span>--}}
{{--                                                <div class="product-variable-quantity">--}}
{{--                                                    <input  value="{{$book['quantity']}}" type="text" readonly disabled>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
                                            <div class="product-add-to-cart-btn">
                                                <a href="#" data-toggle="modal" data-target="#modalAddcart">Add To Cart</a>
                                            </div>
                                            <br>
                                        @endif
                                    </div> <!-- End Product Variable Area -->
                                    <!-- Start  Product Details Meta Area-->
                                    <div class="product-details-meta mb-20">
                                        <ul>
                                            <li><button id="addWishlist-{{$book['id']}}" ><i class="icon-heart"></i>Add to wishlist</button></li>
                                            <li><a href=""><i class="icon-repeat"></i>Compare</a></li>
                                            <li><a href="#" data-toggle="modal" data-target="#modalQuickview-{{$book['id']}}"><i class="icon-eye"></i>Quick view</a></li>
                                        </ul>
                                    </div> <!-- End  Product Details Meta Area-->
                                    <!-- Start  Product Details Social Area-->
                                    <ul class="modal-product-details-social">
                                        <li><a href="#" class="facebook"><i class="fa fa-facebook"></i></a></li>
                                        <li><a href="#" class="twitter"><i class="fa fa-twitter"></i></a></li>
                                        <li><a href="#" class="pinterest"><i class="fa fa-pinterest"></i></a></li>
                                        <li><a href="#" class="google-plus"><i class="fa fa-google-plus"></i></a></li>
                                        <li><a href="#" class="linkedin"><i class="fa fa-linkedin"></i></a></li>
                                    </ul> <!-- End  Product Details Social Area-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End Modal Quickview cart -->
 @endforeach

@foreach($new as $book)
    <div class="modal fade" id="modalQuickviewNewBook-{{$book['id']}}" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog  modal-dialog-centered" role="document">
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
                                            <img class="img-fluid" src="data:image/{{ $book['image_extension'] }};base64,{{ $book['cover_image'] }}" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="product-details-content-area">
                                    <!-- Start  Product Details Text Area-->
                                    <div class="product-details-text">
                                        <h4 class="title">{{$book['title']}}</h4>
                                        @if($book['price'] == 0)
                                            <div class="price">Free for now</div>
                                        @else
                                            <div class="price">${{$book['price']}}</div>

                                        @endif
                                        <p>{{$book['description']}}</p>
                                    </div> <!-- End  Product Details Text Area-->
                                    <!-- Start Product Variable Area -->
                                    <div class="product-details-variable">
                                        <!-- Product Variable Single Item -->
                                        <!-- Product Variable Single Item -->

                                        @if ($book['price'] == 0)
                                            <div class="product-add-to-cart-btn">
                                                <a href="#" data-toggle="modal" data-target="#modalAddcart">Read Now</a>
                                            </div>
                                            <br>
                                        @else
                                            <div class="product-add-to-cart-btn">
                                                <a id="addCart-{{$book['id']}}" data-toggle="modal" data-target="#modalAddcartNewBook-{{$book['id']}}">Add To Cart</a>
                                            </div>
                                            <br>
                                        @endif
                                    </div> <!-- End Product Variable Area -->
                                    <!-- Start  Product Details Meta Area-->
                                    <div class="product-details-meta mb-20">
                                        <ul>
                                            <li><button id="addWishlist-{{$book['id']}}" ><i class="icon-heart"></i>Add to wishlist</button></li>
                                            <li><a href=""><i class="icon-repeat"></i>Compare</a></li>
                                            <li><a href="#" data-toggle="modal" data-target="#modalQuickview-{{$book['id']}}"><i class="icon-eye"></i>Quick view</a></li>
                                        </ul>
                                    </div> <!-- End  Product Details Meta Area-->
                                    <!-- Start  Product Details Social Area-->
                                    <ul class="modal-product-details-social">
                                        <li><a href="#" class="facebook"><i class="fa fa-facebook"></i></a></li>
                                        <li><a href="#" class="twitter"><i class="fa fa-twitter"></i></a></li>
                                        <li><a href="#" class="pinterest"><i class="fa fa-pinterest"></i></a></li>
                                        <li><a href="#" class="google-plus"><i class="fa fa-google-plus"></i></a></li>
                                        <li><a href="#" class="linkedin"><i class="fa fa-linkedin"></i></a></li>
                                    </ul> <!-- End  Product Details Social Area-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End Modal Quickview cart -->

    <div class="modal fade" id="modalAddcartNewBook-{{$book['id']}}" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog  modal-dialog-centered modal-xl" role="document">
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
                            @if(session()->has('user'))
                                @php
                                    $user_id = session()->get('user')['id'];
                                @endphp
                                <input type="hidden" id="user_id" value="{{$user_id}}">
                            <div class="col-md-7">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="modal-add-cart-product-img">
                                            <img class="img-fluid" src="data:image/{{ $book['image_extension'] }};base64,{{ $book['cover_image'] }}" alt="">
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
                                     <li> <strong><i class="icon-shopping-cart"></i> There Are 5 Items In Your Cart.</strong></li>
                                    <li> <strong>TOTAL PRICE: </strong> <span>$187.00</span></li>
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
    </div> <!-- End Modal Add cart -->
@endforeach

@foreach($featured as $book)
    <div class="modal fade" id="modalQuickviewFeaturedBook-{{$book['id']}}" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog  modal-dialog-centered" role="document">
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
                                            <img class="img-fluid" src="data:image/{{ $book['image_extension'] }};base64,{{ $book['cover_image'] }}" alt="">
                                        </div>

                                    </div>

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="product-details-content-area">
                                    <!-- Start  Product Details Text Area-->
                                    <div class="product-details-text">
                                        <h4 class="title">{{$book['title']}}</h4>
                                        @if($book['price'] == 0)
                                            <div class="price">Free for now</div>
                                        @else
                                            <div class="price">${{$book['price']}}</div>

                                        @endif
                                        <p>{{$book['description']}}</p>
                                    </div> <!-- End  Product Details Text Area-->
                                    <!-- Start Product Variable Area -->
                                    <div class="product-details-variable">
                                        <!-- Product Variable Single Item -->
                                        <!-- Product Variable Single Item -->

                                        @if ($book['price'] == 0)
                                            <div class="product-add-to-cart-btn">
                                                <a href="#" data-toggle="modal" data-target="#modalAddcart">Read Now</a>
                                            </div>
                                            <br>
                                        @else
                                            <div class="product-add-to-cart-btn">
                                                <a href="#" data-toggle="modal" data-target="#modalAddcart">Add To Cart</a>
                                            </div>
                                            <br>
                                        @endif
                                    </div> <!-- End Product Variable Area -->
                                    <!-- Start  Product Details Meta Area-->
                                    <div class="product-details-meta mb-20">
                                        <ul>
                                            <li><button id="addWishlist-{{$book['id']}}"><i class="icon-heart"></i>Add to wishlist</button></li>
                                            <li><a href=""><i class="icon-repeat"></i>Compare</a></li>
                                            <li><a href="#" data-toggle="modal" data-target="#modalQuickview-{{$book['id']}}"><i class="icon-eye"></i>Quick view</a></li>
                                        </ul>
                                    </div> <!-- End  Product Details Meta Area-->
                                    <!-- Start  Product Details Social Area-->
                                    <ul class="modal-product-details-social">
                                        <li><a href="#" class="facebook"><i class="fa fa-facebook"></i></a></li>
                                        <li><a href="#" class="twitter"><i class="fa fa-twitter"></i></a></li>
                                        <li><a href="#" class="pinterest"><i class="fa fa-pinterest"></i></a></li>
                                        <li><a href="#" class="google-plus"><i class="fa fa-google-plus"></i></a></li>
                                        <li><a href="#" class="linkedin"><i class="fa fa-linkedin"></i></a></li>
                                    </ul> <!-- End  Product Details Social Area-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End Modal Quickview cart -->

    <div class="modal fade" id="modalAddcartFeaturedBook-{{$book['id']}}" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog  modal-dialog-centered modal-xl" role="document">
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
                                            <img class="img-fluid" src="data:image/{{ $book['image_extension'] }};base64,{{ $book['cover_image'] }}" alt="">
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="modal-add-cart-info"><i class="fa fa-check-square"></i>Added to cart successfully!</div>
                                        <div class="modal-add-cart-product-cart-buttons">
                                            <a href="#">View Cart</a>
                                            <a href="#">Checkout</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5 modal-border">
                                <ul class="modal-add-cart-product-shipping-info">
                                    {{-- <li> <strong><i class="icon-shopping-cart"></i> There Are 5 Items In Your Cart.</strong></li>
                                    <li> <strong>TOTAL PRICE: </strong> <span>$187.00</span></li> --}}
                                    <li class="modal-continue-button"><a href="#" data-dismiss="modal">CONTINUE SHOPPING</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End Modal Add cart -->
@endforeach
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
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
                var bookImage = document.getElementById('image-' + bookId).src;
                var image_extension = bookImage.substring(bookImage.indexOf('/') + 1, bookImage.indexOf(';'));
                bookImage = bookImage.substring(22);
                var xhr = new XMLHttpRequest();
                var url = 'http://paymentservice.test:8080/api/cart/add';
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

            if(null == userID){
                swal({
                    title: "Please login to add to wishlist!",
                    icon: "warning",
                    button: "OK",
                });
            }else{
                var bookId = this.id.split('-')[1];
                var bookTitle = document.getElementById('name-' + bookId).value;
                var bookPrice = document.getElementById('price-' + bookId).value;
                var bookImage = document.getElementById('image-' + bookId).src;
                var image_extension = bookImage.substring(bookImage.indexOf('/') + 1, bookImage.indexOf(';'));
                bookImage = bookImage.substring(22);
                var xhr = new XMLHttpRequest();
                var url = 'http://paymentservice.test:8080/api/wishlist/add';

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
    $(document).ready(function(){
        $('#closeModal-close').click(function(){
            location.reload();
        });
    });
</script>
@endsection
