@extends('layouts.main')
@section('content')
@section('title', 'Book Store')

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
							<h5>The Quality of Our Products is Unmatched</h5>
							<h2>Book Store</h2>
							<p>Books with a variety of genres and the best quality</p>
							<a href="product-details-default.html" class="hero-button">Shopping Now</a>
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
							<h5>World Best Book</h5>
							<h2>New Book</h2>
							<p>With the help of consectetur adipisicing elit sed do eiu</p>
							<a href="product-details-default.html" class="hero-button">Shopping Now</a>
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
					<h3 class="section-title">Popular Categories</h3>
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
						$category_selected[] = $value;
						if ($key == 7) {
							break;
						}
					}
				@endphp

				@foreach ( $category_selected as $category )
					<div class="col-lg-3 col-md-4 col-sm-6 col-12">
						<!-- Start Product Catagory Single -->
						<a href="product-details-default.html" class="product-catagory-single">
							<div class="product-catagory-img">
								<img src="{{ asset($category['image']) }}" alt="">
							</div>
							<div class="product-catagory-content">
								<h5 class="product-catagory-title">{{ $category['name'] }}</h5>
								<span class="product-catagory-items">(20 Items)</span>
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
						<a href="product-details-default.html" class="banner-img-link">
							<img class="banner-img" src="https://img.freepik.com/premium-vector/online-library-outline-isometric-education-concept-open-book-with-loupe-isolated-white_119523-8406.jpg" alt="">
						</a>
						<div class="banner-content">
							{{-- <span class="banner-text-tiny">The Best of</span>
							<h3 class="banner-text-large">30% Off</h3> --}}
							<a href="product-details-default.html" class="banner-link">Shop Now</a>
						</div>
					</div> <!-- End Banner Single -->
				</div>
				<div class="col-lg-4 col-md-6 col-12">
					<!-- Start Banner Single -->
					<div class="banner-single">
						<a href="product-details-default.html" class="banner-img-link">
							<img class="banner-img" src="https://img.freepik.com/premium-vector/collection-cat-with-pile-book-set_77984-276.jpg" alt="">
						</a>
						<div class="banner-content">
							{{-- <span class="banner-text-tiny">Where to</span>
							<h3 class="banner-text-large">40% Off</h3> --}}
							<a href="product-details-default.html" class="banner-link">Shop Now</a>
						</div>
					</div> <!-- End Banner Single -->
				</div>
				<div class="col-lg-4 col-md-6 col-12">
					<!-- Start Banner Single -->
					<div class="banner-single">
						<a href="product-details-default.html" class="banner-img-link">
							<img class="banner-img" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSbT_Tb79QYgsvr3knZa-cWA-6vxuv3ZFzh0clS46Y2QjPV2VLIRb1VR4-iXRbbwMZiDLM&usqp=CAU" alt="">
						</a>
						<div class="banner-content">
							{{-- <span class="banner-text-tiny">How to</span>
							<h3 class="banner-text-large">50% Off</h3> --}}
							<a href="product-details-default.html" class="banner-link">Shop Now</a>
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
					<h3 class="section-title">New Books</h3>
					<ul class="tablist nav product-tab-btn">
						<li><a class="nav-link active" data-toggle="tab" href="#car_and_drive">View more</a></li>
						{{-- <li><a class="nav-link" data-toggle="tab" href="#motorcycle">Motorcycle</a></li>
						<li><a class="nav-link" data-toggle="tab" href="#truck_drive">Truck & Drive</a></li> --}}
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
								<div class="product-default-single border-around">
									<div class="product-img-warp">
										<a href="product-details-default.html" class="product-default-img-link">
											<img src="assets/images/products_images/aments_products_image_2.jpg" alt="" class="product-default-img img-fluid">
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
										<h6 class="product-default-link"><a href="product-details-default.html">New Balance Fresh Foam Kaymin Car Purts</a></h6>
										<span class="product-default-price"><del class="product-default-price-off">$30.12</del> $25.12</span>
									</div>
								</div> <!-- End Product Defautlt Single -->
								<!-- Start Product Defautlt Single -->
								<div class="product-default-single border-around">
									<div class="product-img-warp">
										<a href="product-details-default.html" class="product-default-img-link">
											<img src="assets/images/products_images/aments_products_image_1.jpg" alt="" class="product-default-img img-fluid">
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
										<h6 class="product-default-link"><a href="product-details-default.html">New Balance Fresh Foam Kaymin Car Purts</a></h6>
										<span class="product-default-price"><del class="product-default-price-off">$30.12</del> $25.12</span>
									</div>
								</div> <!-- End Product Defautlt Single -->
								<!-- Start Product Defautlt Single -->
								<div class="product-default-single border-around">
									<div class="product-img-warp">
										<a href="product-details-default.html" class="product-default-img-link">
											<img src="assets/images/products_images/aments_products_image_4.jpg" alt="" class="product-default-img img-fluid">
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
										<h6 class="product-default-link"><a href="product-details-default.html">New Balance Fresh Foam Kaymin Car Purts</a></h6>
										<span class="product-default-price"><del class="product-default-price-off">$30.12</del> $25.12</span>
									</div>
								</div> <!-- End Product Defautlt Single -->
								<!-- Start Product Defautlt Single -->
								<div class="product-default-single border-around">
									<div class="product-img-warp">
										<a href="product-details-default.html" class="product-default-img-link">
											<img src="assets/images/products_images/aments_products_image_3.jpg" alt="" class="product-default-img img-fluid">
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
										<h6 class="product-default-link"><a href="product-details-default.html">New Balance Fresh Foam Kaymin Car Purts</a></h6>
										<span class="product-default-price"><del class="product-default-price-off">$30.12</del> $25.12</span>
									</div>
								</div> <!-- End Product Defautlt Single -->
								<!-- Start Product Defautlt Single -->
								<div class="product-default-single border-around">
									<div class="product-img-warp">
										<a href="product-details-default.html" class="product-default-img-link">
											<img src="assets/images/products_images/aments_products_image_6.jpg" alt="" class="product-default-img img-fluid">
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
										<h6 class="product-default-link"><a href="product-details-default.html">New Balance Fresh Foam Kaymin Car Purts</a></h6>
										<span class="product-default-price"><del class="product-default-price-off">$30.12</del> $25.12</span>
									</div>
								</div> <!-- End Product Defautlt Single -->
								<!-- Start Product Defautlt Single -->
								<div class="product-default-single border-around">
									<div class="product-img-warp">
										<a href="product-details-default.html" class="product-default-img-link">
											<img src="assets/images/products_images/aments_products_image_5.jpg" alt="" class="product-default-img img-fluid">
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
										<h6 class="product-default-link"><a href="product-details-default.html">New Balance Fresh Foam Kaymin Car Purts</a></h6>
										<span class="product-default-price"><del class="product-default-price-off">$30.12</del> $25.12</span>
									</div>
								</div> <!-- End Product Defautlt Single -->
								<!-- Start Product Defautlt Single -->
								<div class="product-default-single border-around">
									<div class="product-img-warp">
										<a href="product-details-default.html" class="product-default-img-link">
											<img src="assets/images/products_images/aments_products_image_8.jpg" alt="" class="product-default-img img-fluid">
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
										<h6 class="product-default-link"><a href="product-details-default.html">New Balance Fresh Foam Kaymin Car Purts</a></h6>
										<span class="product-default-price"><del class="product-default-price-off">$30.12</del> $25.12</span>
									</div>
								</div> <!-- End Product Defautlt Single -->
								<!-- Start Product Defautlt Single -->
								<div class="product-default-single border-around">
									<div class="product-img-warp">
										<a href="product-details-default.html" class="product-default-img-link">
											<img src="assets/images/products_images/aments_products_image_7.jpg" alt="" class="product-default-img img-fluid">
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
										<h6 class="product-default-link"><a href="product-details-default.html">New Balance Fresh Foam Kaymin Car Purts</a></h6>
										<span class="product-default-price"><del class="product-default-price-off">$30.12</del> $25.12</span>
									</div>
								</div> <!-- End Product Defautlt Single -->
							</div>
						</div>
						<div class="tab-pane" id="motorcycle">
							<div class="product-default-slider product-default-slider-4grids-1row">
								<!-- Start Product Defautlt Single -->
								<div class="product-default-single border-around">
									<div class="product-img-warp">
										<a href="product-details-default.html" class="product-default-img-link">
											<img src="assets/images/products_images/aments_products_image_1.jpg" alt="" class="product-default-img img-fluid">
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
										<h6 class="product-default-link"><a href="product-details-default.html">New Balance Fresh Foam Kaymin Car Purts</a></h6>
										<span class="product-default-price"><del class="product-default-price-off">$30.12</del> $25.12</span>
									</div>
								</div> <!-- End Product Defautlt Single -->
								<!-- Start Product Defautlt Single -->
								<div class="product-default-single border-around">
									<div class="product-img-warp">
										<a href="product-details-default.html" class="product-default-img-link">
											<img src="assets/images/products_images/aments_products_image_2.jpg" alt="" class="product-default-img img-fluid">
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
										<h6 class="product-default-link"><a href="product-details-default.html">New Balance Fresh Foam Kaymin Car Purts</a></h6>
										<span class="product-default-price"><del class="product-default-price-off">$30.12</del> $25.12</span>
									</div>
								</div> <!-- End Product Defautlt Single -->
								<!-- Start Product Defautlt Single -->
								<div class="product-default-single border-around">
									<div class="product-img-warp">
										<a href="product-details-default.html" class="product-default-img-link">
											<img src="assets/images/products_images/aments_products_image_3.jpg" alt="" class="product-default-img img-fluid">
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
										<h6 class="product-default-link"><a href="product-details-default.html">New Balance Fresh Foam Kaymin Car Purts</a></h6>
										<span class="product-default-price"><del class="product-default-price-off">$30.12</del> $25.12</span>
									</div>
								</div> <!-- End Product Defautlt Single -->
								<!-- Start Product Defautlt Single -->
								<div class="product-default-single border-around">
									<div class="product-img-warp">
										<a href="product-details-default.html" class="product-default-img-link">
											<img src="assets/images/products_images/aments_products_image_4.jpg" alt="" class="product-default-img img-fluid">
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
										<h6 class="product-default-link"><a href="product-details-default.html">New Balance Fresh Foam Kaymin Car Purts</a></h6>
										<span class="product-default-price"><del class="product-default-price-off">$30.12</del> $25.12</span>
									</div>
								</div> <!-- End Product Defautlt Single -->
								<!-- Start Product Defautlt Single -->
								<div class="product-default-single border-around">
									<div class="product-img-warp">
										<a href="product-details-default.html" class="product-default-img-link">
											<img src="assets/images/products_images/aments_products_image_5.jpg" alt="" class="product-default-img img-fluid">
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
										<h6 class="product-default-link"><a href="product-details-default.html">New Balance Fresh Foam Kaymin Car Purts</a></h6>
										<span class="product-default-price"><del class="product-default-price-off">$30.12</del> $25.12</span>
									</div>
								</div> <!-- End Product Defautlt Single -->
								<!-- Start Product Defautlt Single -->
								<div class="product-default-single border-around">
									<div class="product-img-warp">
										<a href="product-details-default.html" class="product-default-img-link">
											<img src="assets/images/products_images/aments_products_image_6.jpg" alt="" class="product-default-img img-fluid">
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
										<h6 class="product-default-link"><a href="product-details-default.html">New Balance Fresh Foam Kaymin Car Purts</a></h6>
										<span class="product-default-price"><del class="product-default-price-off">$30.12</del> $25.12</span>
									</div>
								</div> <!-- End Product Defautlt Single -->
								<!-- Start Product Defautlt Single -->
								<div class="product-default-single border-around">
									<div class="product-img-warp">
										<a href="product-details-default.html" class="product-default-img-link">
											<img src="assets/images/products_images/aments_products_image_8.jpg" alt="" class="product-default-img img-fluid">
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
										<h6 class="product-default-link"><a href="product-details-default.html">New Balance Fresh Foam Kaymin Car Purts</a></h6>
										<span class="product-default-price"><del class="product-default-price-off">$30.12</del> $25.12</span>
									</div>
								</div> <!-- End Product Defautlt Single -->
								<!-- Start Product Defautlt Single -->
								<div class="product-default-single border-around">
									<div class="product-img-warp">
										<a href="product-details-default.html" class="product-default-img-link">
											<img src="assets/images/products_images/aments_products_image_7.jpg" alt="" class="product-default-img img-fluid">
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
										<h6 class="product-default-link"><a href="product-details-default.html">New Balance Fresh Foam Kaymin Car Purts</a></h6>
										<span class="product-default-price"><del class="product-default-price-off">$30.12</del> $25.12</span>
									</div>
								</div> <!-- End Product Defautlt Single -->
							</div>
						</div>
						<div class="tab-pane" id="truck_drive">
							<div class="product-default-slider product-default-slider-4grids-1row">
								<!-- Start Product Defautlt Single -->
								<div class="product-default-single border-around">
									<div class="product-img-warp">
										<a href="product-details-default.html" class="product-default-img-link">
											<img src="assets/images/products_images/aments_products_image_8.jpg" alt="" class="product-default-img img-fluid">
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
										<h6 class="product-default-link"><a href="product-details-default.html">New Balance Fresh Foam Kaymin Car Purts</a></h6>
										<span class="product-default-price"><del class="product-default-price-off">$30.12</del> $25.12</span>
									</div>
								</div> <!-- End Product Defautlt Single -->
								<!-- Start Product Defautlt Single -->
								<div class="product-default-single border-around">
									<div class="product-img-warp">
										<a href="product-details-default.html" class="product-default-img-link">
											<img src="assets/images/products_images/aments_products_image_7.jpg" alt="" class="product-default-img img-fluid">
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
										<h6 class="product-default-link"><a href="product-details-default.html">New Balance Fresh Foam Kaymin Car Purts</a></h6>
										<span class="product-default-price"><del class="product-default-price-off">$30.12</del> $25.12</span>
									</div>
								</div> <!-- End Product Defautlt Single -->
								<!-- Start Product Defautlt Single -->
								<div class="product-default-single border-around">
									<div class="product-img-warp">
										<a href="product-details-default.html" class="product-default-img-link">
											<img src="assets/images/products_images/aments_products_image_6.jpg" alt="" class="product-default-img img-fluid">
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
										<h6 class="product-default-link"><a href="product-details-default.html">New Balance Fresh Foam Kaymin Car Purts</a></h6>
										<span class="product-default-price"><del class="product-default-price-off">$30.12</del> $25.12</span>
									</div>
								</div> <!-- End Product Defautlt Single -->
								<!-- Start Product Defautlt Single -->
								<div class="product-default-single border-around">
									<div class="product-img-warp">
										<a href="product-details-default.html" class="product-default-img-link">
											<img src="assets/images/products_images/aments_products_image_5.jpg" alt="" class="product-default-img img-fluid">
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
										<h6 class="product-default-link"><a href="product-details-default.html">New Balance Fresh Foam Kaymin Car Purts</a></h6>
										<span class="product-default-price"><del class="product-default-price-off">$30.12</del> $25.12</span>
									</div>
								</div> <!-- End Product Defautlt Single -->
								<!-- Start Product Defautlt Single -->
								<div class="product-default-single border-around">
									<div class="product-img-warp">
										<a href="product-details-default.html" class="product-default-img-link">
											<img src="assets/images/products_images/aments_products_image_4.jpg" alt="" class="product-default-img img-fluid">
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
										<h6 class="product-default-link"><a href="product-details-default.html">New Balance Fresh Foam Kaymin Car Purts</a></h6>
										<span class="product-default-price"><del class="product-default-price-off">$30.12</del> $25.12</span>
									</div>
								</div> <!-- End Product Defautlt Single -->
								<!-- Start Product Defautlt Single -->
								<div class="product-default-single border-around">
									<div class="product-img-warp">
										<a href="product-details-default.html" class="product-default-img-link">
											<img src="assets/images/products_images/aments_products_image_3.jpg" alt="" class="product-default-img img-fluid">
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
										<h6 class="product-default-link"><a href="product-details-default.html">New Balance Fresh Foam Kaymin Car Purts</a></h6>
										<span class="product-default-price"><del class="product-default-price-off">$30.12</del> $25.12</span>
									</div>
								</div> <!-- End Product Defautlt Single -->
								<!-- Start Product Defautlt Single -->
								<div class="product-default-single border-around">
									<div class="product-img-warp">
										<a href="product-details-default.html" class="product-default-img-link">
											<img src="assets/images/products_images/aments_products_image_2.jpg" alt="" class="product-default-img img-fluid">
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
										<h6 class="product-default-link"><a href="product-details-default.html">New Balance Fresh Foam Kaymin Car Purts</a></h6>
										<span class="product-default-price"><del class="product-default-price-off">$30.12</del> $25.12</span>
									</div>
								</div> <!-- End Product Defautlt Single -->
								<!-- Start Product Defautlt Single -->
								<div class="product-default-single border-around">
									<div class="product-img-warp">
										<a href="product-details-default.html" class="product-default-img-link">
											<img src="assets/images/products_images/aments_products_image_1.jpg" alt="" class="product-default-img img-fluid">
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
										<h6 class="product-default-link"><a href="product-details-default.html">New Balance Fresh Foam Kaymin Car Purts</a></h6>
										<span class="product-default-price"><del class="product-default-price-off">$30.12</del> $25.12</span>
									</div>
								</div> <!-- End Product Defautlt Single -->
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
					<h3 class="section-title">Free Books</h3>
					<ul class="tablist nav product-tab-btn">
						<li><a class="nav-link active" data-toggle="tab" href="#car_and_drive">View more</a></li>
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
								@foreach ($books as $book)
								<div class="product-default-single border-around">
									<div class="product-img-warp">
										<a id="url-{{$book['id']}}" href="{{URL::to('/book-details/'.$book['id'])}}" class="product-default-img-link">
											<img src="{{$book['cover_image']}}" id="image-{{$book['id']}}" alt="" class="product-default-img img-fluid">
										</a>
										<div class="product-action-icon-link">
											<ul>
												<li><a id="{{$book['id']}}"onclick="addWishlist(this.id);"><i class="icon-heart"></i></a></li>
												<li><a href="compare.html"><i class="icon-repeat"></i></a></li>
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
						{{-- <div class="banner-content">
							<span class="banner-text-small">2021 Latest Collection</span>
							<h2 class="banner-text-big"><span class="banner-text-big-highlight">-40%</span> Offer All Car Parts</h2>
						</div> --}}
					</div> <!-- End Banner Single -->
				</div>
			</div>
		</div>
	</div> <!-- End Banner Wrapper -->
</div> <!-- ...:::: End Product Catagory Section:::... -->

<!-- ...:::: Start Product Tab Section:::... -->
<div class="product-tab-section section-top-gap-100">
	<!-- Start Section Content -->
	<div class="section-content-gap">
		<div class="container">
			<div class="row">
				<div class="section-content d-flex justify-content-between align-items-md-center align-items-start flex-md-row flex-column">
					<h3 class="section-title">Hot Deals</h3>
					<ul class="tablist nav product-tab-btn">
						<li><a class="nav-link active" data-toggle="tab" href="#drive_and_car">View more</a></li>
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
						<div class="tab-pane" id="drive_and_car">
							<div class="product-default-slider product-default-slider-4grids-1row">
								<!-- Start Product Defautlt Single -->
								<div class="product-default-single border-around">
									<div class="product-img-warp">
										<a href="product-details-default.html" class="product-default-img-link">
											<img src="assets/images/products_images/aments_products_image_1.jpg" alt="" class="product-default-img img-fluid">
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
										<h6 class="product-default-link"><a href="product-details-default.html">New Balance Fresh Foam Kaymin Car Purts</a></h6>
										<span class="product-default-price"><del class="product-default-price-off">$30.12</del> $25.12</span>
									</div>
								</div> <!-- End Product Defautlt Single -->
								<!-- Start Product Defautlt Single -->
								<div class="product-default-single border-around">
									<div class="product-img-warp">
										<a href="product-details-default.html" class="product-default-img-link">
											<img src="assets/images/products_images/aments_products_image_2.jpg" alt="" class="product-default-img img-fluid">
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
										<h6 class="product-default-link"><a href="product-details-default.html">New Balance Fresh Foam Kaymin Car Purts</a></h6>
										<span class="product-default-price"><del class="product-default-price-off">$30.12</del> $25.12</span>
									</div>
								</div> <!-- End Product Defautlt Single -->
								<!-- Start Product Defautlt Single -->
								<div class="product-default-single border-around">
									<div class="product-img-warp">
										<a href="product-details-default.html" class="product-default-img-link">
											<img src="assets/images/products_images/aments_products_image_3.jpg" alt="" class="product-default-img img-fluid">
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
										<h6 class="product-default-link"><a href="product-details-default.html">New Balance Fresh Foam Kaymin Car Purts</a></h6>
										<span class="product-default-price"><del class="product-default-price-off">$30.12</del> $25.12</span>
									</div>
								</div> <!-- End Product Defautlt Single -->
								<!-- Start Product Defautlt Single -->
								<div class="product-default-single border-around">
									<div class="product-img-warp">
										<a href="product-details-default.html" class="product-default-img-link">
											<img src="assets/images/products_images/aments_products_image_4.jpg" alt="" class="product-default-img img-fluid">
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
										<h6 class="product-default-link"><a href="product-details-default.html">New Balance Fresh Foam Kaymin Car Purts</a></h6>
										<span class="product-default-price"><del class="product-default-price-off">$30.12</del> $25.12</span>
									</div>
								</div> <!-- End Product Defautlt Single -->
								<!-- Start Product Defautlt Single -->
								<div class="product-default-single border-around">
									<div class="product-img-warp">
										<a href="product-details-default.html" class="product-default-img-link">
											<img src="assets/images/products_images/aments_products_image_5.jpg" alt="" class="product-default-img img-fluid">
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
										<h6 class="product-default-link"><a href="product-details-default.html">New Balance Fresh Foam Kaymin Car Purts</a></h6>
										<span class="product-default-price"><del class="product-default-price-off">$30.12</del> $25.12</span>
									</div>
								</div> <!-- End Product Defautlt Single -->
								<!-- Start Product Defautlt Single -->
								<div class="product-default-single border-around">
									<div class="product-img-warp">
										<a href="product-details-default.html" class="product-default-img-link">
											<img src="assets/images/products_images/aments_products_image_6.jpg" alt="" class="product-default-img img-fluid">
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
										<h6 class="product-default-link"><a href="product-details-default.html">New Balance Fresh Foam Kaymin Car Purts</a></h6>
										<span class="product-default-price"><del class="product-default-price-off">$30.12</del> $25.12</span>
									</div>
								</div> <!-- End Product Defautlt Single -->
								<!-- Start Product Defautlt Single -->
								<div class="product-default-single border-around">
									<div class="product-img-warp">
										<a href="product-details-default.html" class="product-default-img-link">
											<img src="assets/images/products_images/aments_products_image_8.jpg" alt="" class="product-default-img img-fluid">
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
										<h6 class="product-default-link"><a href="product-details-default.html">New Balance Fresh Foam Kaymin Car Purts</a></h6>
										<span class="product-default-price"><del class="product-default-price-off">$30.12</del> $25.12</span>
									</div>
								</div> <!-- End Product Defautlt Single -->
								<!-- Start Product Defautlt Single -->
								<div class="product-default-single border-around">
									<div class="product-img-warp">
										<a href="product-details-default.html" class="product-default-img-link">
											<img src="assets/images/products_images/aments_products_image_7.jpg" alt="" class="product-default-img img-fluid">
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
										<h6 class="product-default-link"><a href="product-details-default.html">New Balance Fresh Foam Kaymin Car Purts</a></h6>
										<span class="product-default-price"><del class="product-default-price-off">$30.12</del> $25.12</span>
									</div>
								</div> <!-- End Product Defautlt Single -->
							</div>
						</div>
						<div class="tab-pane" id="bike">
							<div class="product-default-slider product-default-slider-4grids-1row">
								<!-- Start Product Defautlt Single -->
								<div class="product-default-single border-around">
									<div class="product-img-warp">
										<a href="product-details-default.html" class="product-default-img-link">
											<img src="assets/images/products_images/aments_products_image_8.jpg" alt="" class="product-default-img img-fluid">
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
										<h6 class="product-default-link"><a href="product-details-default.html">New Balance Fresh Foam Kaymin Car Purts</a></h6>
										<span class="product-default-price"><del class="product-default-price-off">$30.12</del> $25.12</span>
									</div>
								</div> <!-- End Product Defautlt Single -->
								<!-- Start Product Defautlt Single -->
								<div class="product-default-single border-around">
									<div class="product-img-warp">
										<a href="product-details-default.html" class="product-default-img-link">
											<img src="assets/images/products_images/aments_products_image_7.jpg" alt="" class="product-default-img img-fluid">
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
										<h6 class="product-default-link"><a href="product-details-default.html">New Balance Fresh Foam Kaymin Car Purts</a></h6>
										<span class="product-default-price"><del class="product-default-price-off">$30.12</del> $25.12</span>
									</div>
								</div> <!-- End Product Defautlt Single -->
								<!-- Start Product Defautlt Single -->
								<div class="product-default-single border-around">
									<div class="product-img-warp">
										<a href="product-details-default.html" class="product-default-img-link">
											<img src="assets/images/products_images/aments_products_image_6.jpg" alt="" class="product-default-img img-fluid">
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
										<h6 class="product-default-link"><a href="product-details-default.html">New Balance Fresh Foam Kaymin Car Purts</a></h6>
										<span class="product-default-price"><del class="product-default-price-off">$30.12</del> $25.12</span>
									</div>
								</div> <!-- End Product Defautlt Single -->
								<!-- Start Product Defautlt Single -->
								<div class="product-default-single border-around">
									<div class="product-img-warp">
										<a href="product-details-default.html" class="product-default-img-link">
											<img src="assets/images/products_images/aments_products_image_5.jpg" alt="" class="product-default-img img-fluid">
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
										<h6 class="product-default-link"><a href="product-details-default.html">New Balance Fresh Foam Kaymin Car Purts</a></h6>
										<span class="product-default-price"><del class="product-default-price-off">$30.12</del> $25.12</span>
									</div>
								</div> <!-- End Product Defautlt Single -->
								<!-- Start Product Defautlt Single -->
								<div class="product-default-single border-around">
									<div class="product-img-warp">
										<a href="product-details-default.html" class="product-default-img-link">
											<img src="assets/images/products_images/aments_products_image_4.jpg" alt="" class="product-default-img img-fluid">
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
										<h6 class="product-default-link"><a href="product-details-default.html">New Balance Fresh Foam Kaymin Car Purts</a></h6>
										<span class="product-default-price"><del class="product-default-price-off">$30.12</del> $25.12</span>
									</div>
								</div> <!-- End Product Defautlt Single -->
								<!-- Start Product Defautlt Single -->
								<div class="product-default-single border-around">
									<div class="product-img-warp">
										<a href="product-details-default.html" class="product-default-img-link">
											<img src="assets/images/products_images/aments_products_image_3.jpg" alt="" class="product-default-img img-fluid">
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
										<h6 class="product-default-link"><a href="product-details-default.html">New Balance Fresh Foam Kaymin Car Purts</a></h6>
										<span class="product-default-price"><del class="product-default-price-off">$30.12</del> $25.12</span>
									</div>
								</div> <!-- End Product Defautlt Single -->
								<!-- Start Product Defautlt Single -->
								<div class="product-default-single border-around">
									<div class="product-img-warp">
										<a href="product-details-default.html" class="product-default-img-link">
											<img src="assets/images/products_images/aments_products_image_2.jpg" alt="" class="product-default-img img-fluid">
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
										<h6 class="product-default-link"><a href="product-details-default.html">New Balance Fresh Foam Kaymin Car Purts</a></h6>
										<span class="product-default-price"><del class="product-default-price-off">$30.12</del> $25.12</span>
									</div>
								</div> <!-- End Product Defautlt Single -->
								<!-- Start Product Defautlt Single -->
								<div class="product-default-single border-around">
									<div class="product-img-warp">
										<a href="product-details-default.html" class="product-default-img-link">
											<img src="assets/images/products_images/aments_products_image_1.jpg" alt="" class="product-default-img img-fluid">
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
										<h6 class="product-default-link"><a href="product-details-default.html">New Balance Fresh Foam Kaymin Car Purts</a></h6>
										<span class="product-default-price"><del class="product-default-price-off">$30.12</del> $25.12</span>
									</div>
								</div> <!-- End Product Defautlt Single -->
							</div>
						</div>
						<div class="tab-pane show active" id="drive_trucks">
							<div class="product-default-slider product-default-slider-4grids-1row">
								<!-- Start Product Defautlt Single -->
								<div class="product-default-single border-around">
									<div class="product-img-warp">
										<a href="product-details-default.html" class="product-default-img-link">
											<img src="assets/images/products_images/aments_products_image_2.jpg" alt="" class="product-default-img img-fluid">
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
										<h6 class="product-default-link"><a href="product-details-default.html">New Balance Fresh Foam Kaymin Car Purts</a></h6>
										<span class="product-default-price"><del class="product-default-price-off">$30.12</del> $25.12</span>
									</div>
								</div> <!-- End Product Defautlt Single -->
								<!-- Start Product Defautlt Single -->
								<div class="product-default-single border-around">
									<div class="product-img-warp">
										<a href="product-details-default.html" class="product-default-img-link">
											<img src="assets/images/products_images/aments_products_image_1.jpg" alt="" class="product-default-img img-fluid">
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
										<h6 class="product-default-link"><a href="product-details-default.html">New Balance Fresh Foam Kaymin Car Purts</a></h6>
										<span class="product-default-price"><del class="product-default-price-off">$30.12</del> $25.12</span>
									</div>
								</div> <!-- End Product Defautlt Single -->
								<!-- Start Product Defautlt Single -->
								<div class="product-default-single border-around">
									<div class="product-img-warp">
										<a href="product-details-default.html" class="product-default-img-link">
											<img src="assets/images/products_images/aments_products_image_4.jpg" alt="" class="product-default-img img-fluid">
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
										<h6 class="product-default-link"><a href="product-details-default.html">New Balance Fresh Foam Kaymin Car Purts</a></h6>
										<span class="product-default-price"><del class="product-default-price-off">$30.12</del> $25.12</span>
									</div>
								</div> <!-- End Product Defautlt Single -->
								<!-- Start Product Defautlt Single -->
								<div class="product-default-single border-around">
									<div class="product-img-warp">
										<a href="product-details-default.html" class="product-default-img-link">
											<img src="assets/images/products_images/aments_products_image_3.jpg" alt="" class="product-default-img img-fluid">
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
										<h6 class="product-default-link"><a href="product-details-default.html">New Balance Fresh Foam Kaymin Car Purts</a></h6>
										<span class="product-default-price"><del class="product-default-price-off">$30.12</del> $25.12</span>
									</div>
								</div> <!-- End Product Defautlt Single -->
								<!-- Start Product Defautlt Single -->
								<div class="product-default-single border-around">
									<div class="product-img-warp">
										<a href="product-details-default.html" class="product-default-img-link">
											<img src="assets/images/products_images/aments_products_image_6.jpg" alt="" class="product-default-img img-fluid">
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
										<h6 class="product-default-link"><a href="product-details-default.html">New Balance Fresh Foam Kaymin Car Purts</a></h6>
										<span class="product-default-price"><del class="product-default-price-off">$30.12</del> $25.12</span>
									</div>
								</div> <!-- End Product Defautlt Single -->
								<!-- Start Product Defautlt Single -->
								<div class="product-default-single border-around">
									<div class="product-img-warp">
										<a href="product-details-default.html" class="product-default-img-link">
											<img src="assets/images/products_images/aments_products_image_5.jpg" alt="" class="product-default-img img-fluid">
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
										<h6 class="product-default-link"><a href="product-details-default.html">New Balance Fresh Foam Kaymin Car Purts</a></h6>
										<span class="product-default-price"><del class="product-default-price-off">$30.12</del> $25.12</span>
									</div>
								</div> <!-- End Product Defautlt Single -->
								<!-- Start Product Defautlt Single -->
								<div class="product-default-single border-around">
									<div class="product-img-warp">
										<a href="product-details-default.html" class="product-default-img-link">
											<img src="assets/images/products_images/aments_products_image_8.jpg" alt="" class="product-default-img img-fluid">
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
										<h6 class="product-default-link"><a href="product-details-default.html">New Balance Fresh Foam Kaymin Car Purts</a></h6>
										<span class="product-default-price"><del class="product-default-price-off">$30.12</del> $25.12</span>
									</div>
								</div> <!-- End Product Defautlt Single -->
								<!-- Start Product Defautlt Single -->
								<div class="product-default-single border-around">
									<div class="product-img-warp">
										<a href="product-details-default.html" class="product-default-img-link">
											<img src="assets/images/products_images/aments_products_image_7.jpg" alt="" class="product-default-img img-fluid">
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
										<h6 class="product-default-link"><a href="product-details-default.html">New Balance Fresh Foam Kaymin Car Purts</a></h6>
										<span class="product-default-price"><del class="product-default-price-off">$30.12</del> $25.12</span>
									</div>
								</div> <!-- End Product Defautlt Single -->
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div> <!-- End Catagory Wrapper -->
</div> <!-- ...:::: End Product Tab Section:::... -->

<!-- ...:::: Start Blog Feed Section:::... -->
<div class="blog-feed-section section-top-gap-100">
	<!-- Start Section Content -->
	<div class="section-content-gap">
	<div class="container">
		<div class="row">
			<div class="section-content d-flex justify-content-between align-items-md-center align-items-start flex-md-row flex-column">
				<h3 class="section-title">Latest News</h3>
				<ul class="tablist nav product-tab-btn">
					<li><a class="nav-link active" data-toggle="tab" href="#car_and_drive">Read more</a></li>
				</ul>
			</div>
		</div>
	</div>
</div> <!-- End Section Content -->

	<!-- Start Blog Feed Wrapper -->
	<div class="blog-feed-wrapper">
		<div class="container">
			<div class="row">
				<div class="col-lg-4 col-md-6 col-12">
					<!-- Start Blog Feed Single -->
					<div class="blog-feed-single">
						<a href="blog-single-sidebar-left.html" class="blog-feed-img-link">
							<img src="assets/images/blog_images/aments_blog_01.jpg" alt="" class="blog-feed-img">
						</a>
						<div class="blog-feed-content">
							<div class="blog-feed-post-meta">
								<span>By:</span>
								<a href="" class="blog-feed-post-meta-author">Admin</a> -
								<a href="" class="blog-feed-post-meta-date">Sep 14, 2020</a>
							</div>
							<h5 class="blog-feed-link"><a href="blog-single-sidebar-left.html">Lorem ipsum dolor amet cons adipisicing elit</a></h5>
						</div>
					</div><!-- End Blog Feed Single -->
				</div>
				<div class="col-lg-4 col-md-6 col-12">
					<!-- Start Blog Feed Single -->
					<div class="blog-feed-single">
						<a href="blog-single-sidebar-left.html" class="blog-feed-img-link">
							<img src="assets/images/blog_images/aments_blog_02.jpg" alt="" class="blog-feed-img">
						</a>
						<div class="blog-feed-content">
							<div class="blog-feed-post-meta">
								<span>By:</span>
								<a href="" class="blog-feed-post-meta-author">Admin</a> -
								<a href="" class="blog-feed-post-meta-date">Sep 14, 2020</a>
							</div>
							<h5 class="blog-feed-link"><a href="blog-single-sidebar-left.html">Lorem ipsum dolor amet cons adipisicing elit</a></h5>
						</div>
					</div><!-- End Blog Feed Single -->
				</div>
				<div class="col-lg-4 col-md-6 col-12">
					<!-- Start Blog Feed Single -->
					<div class="blog-feed-single">
						<a href="blog-single-sidebar-left.html" class="blog-feed-img-link">
							<img src="assets/images/blog_images/aments_blog_03.jpg" alt="" class="blog-feed-img">
						</a>
						<div class="blog-feed-content">
							<div class="blog-feed-post-meta">
								<span>By:</span>
								<a href="" class="blog-feed-post-meta-author">Admin</a> -
								<a href="" class="blog-feed-post-meta-date">Sep 14, 2020</a>
							</div>
							<h5 class="blog-feed-link"><a href="blog-single-sidebar-left.html">Lorem ipsum dolor amet cons adipisicing elit</a></h5>
						</div>
					</div><!-- End Blog Feed Single -->
				</div>
			</div>
		</div>
	</div> <!-- End Blog Feed Wrapper -->


</div> <!-- ...:::: End Blog Feed Section:::... -->

    @foreach($books as $book)
    <div class="modal fade" id="modalQuickview-{{$book['id']}}" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog  modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col text-right">
                                <button type="button" class="close modal-close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true"> <i class="fa fa-times"></i></span>
                                </button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="product-details-gallery-area">
                                    <div class="product-large-image modal-product-image-large">
                                        <div class="product-image-large-single">
                                            <img class="img-fluid" src="{{$book['cover_image']}}" alt="">
                                        </div>
                                        <div class="product-image-large-single">
                                            <img class="img-fluid" src="assets/images/products_images/aments_products_image_2.jpg" alt="">
                                        </div>
                                    </div>
                                    <div class="product-image-thumb modal-product-image-thumb">
                                        <div class="zoom-active product-image-thumb-single">
                                            <img class="img-fluid" src="assets/images/products_images/aments_products_image_1.jpg" alt="">
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
                                            <div class="variable-single-item ">
                                                <span>Quantity Available</span>
                                                <div class="product-variable-quantity">
                                                    <input  value="{{$book['quantity']}}" type="text" readonly disabled>
                                                </div>
                                            </div>
                                            <div class="product-add-to-cart-btn">
                                                <a href="#" data-toggle="modal" data-target="#modalAddcart">Add To Cart</a>
                                            </div>
                                            <br>
                                        @endif
                                    </div> <!-- End Product Variable Area -->
                                    <!-- Start  Product Details Meta Area-->
                                    <div class="product-details-meta mb-20">
                                        <ul>
                                            <li><button id="{{$book['id']}}" ><i class="icon-heart"></i>Add to wishlist</button></li>
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

    <div class="modal fade" id="modalAddcart-{{$book['id']}}" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog  modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col text-right">
                                <button type="button" class="close modal-close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true"> <i class="fa fa-times"></i></span>
                                </button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-7">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="modal-add-cart-product-img">
                                            <img class="img-fluid" src="{{$book['cover_image']}}" alt="">
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="modal-add-cart-info"><i class="fa fa-check-square"></i>Added to cart successfully!</div>
                                        <div class="modal-add-cart-product-cart-buttons">
                                            <a href="cart.html">View Cart</a>
                                            <a href="checkout.html">Checkout</a>
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
@endsection
