@extends('layouts.main')
@section('content')
@section('title', 'Book Store')
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
				{{-- select top 8 categories sort by name  --}}
				@php 
					//get first 8 category in array categories
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
							<span class="banner-text-tiny">Car Wheel</span>
							<h3 class="banner-text-large">30% Off</h3>
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
							<span class="banner-text-tiny">Car Vails</span>
							<h3 class="banner-text-large">40% Off</h3>
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
							<span class="banner-text-tiny">Car Vails</span>
							<h3 class="banner-text-large">50% Off</h3>
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
					{{-- <ul class="tablist nav product-tab-btn">
						<li><a class="nav-link active" data-toggle="tab" href="#car_and_drive">Car & Drive </a></li>
						<li><a class="nav-link" data-toggle="tab" href="#motorcycle">Motorcycle</a></li>
						<li><a class="nav-link" data-toggle="tab" href="#truck_drive">Truck & Drive</a></li>
					</ul> --}}
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
					{{-- <ul class="tablist nav product-tab-btn">
						<li><a class="nav-link active" data-toggle="tab" href="#car_and_drive">Car & Drive </a></li>
						<li><a class="nav-link" data-toggle="tab" href="#motorcycle">Motorcycle</a></li>
						<li><a class="nav-link" data-toggle="tab" href="#truck_drive">Truck & Drive</a></li>
					</ul> --}}
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
										{{-- <span class="product-default-price"><del class="product-default-price-off">$30.12</del> $25.12</span> --}}
										<span class="product-default-price">Free for now</span>
									</div>
								</div> <!-- End Product Defautlt Single -->
								{{-- <!-- Start Product Defautlt Single -->
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
								</div> <!-- End Product Defautlt Single --> --}}
								@endforeach
							</div>
						</div>
						{{-- <div class="tab-pane" id="motorcycle">
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
						</div> --}}
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
							<img class="banner-img banner-img-big" src="assets/images/banner_images/aments_big-banner.jpg" alt="">
						</a>
						<div class="banner-content">
							<span class="banner-text-small">2021 Latest Collection</span>
							<h2 class="banner-text-big"><span class="banner-text-big-highlight">-40%</span> Offer All Car Parts</h2>
						</div>
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
					{{-- <ul class="tablist nav product-tab-btn">
						<li><a class="nav-link active" data-toggle="tab" href="#drive_and_car">Drive & Car </a></li>
						<li><a class="nav-link" data-toggle="tab" href="#bike">Bikes</a></li>
						<li><a class="nav-link" data-toggle="tab" href="#drive_trucks">Drive & Truck</a></li>
					</ul> --}}
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

<!-- ...:::: Start Company Logo Section:::... -->
{{-- <div class="company-logo-section section-top-gap-100">
	<!-- Start Company Logo Wrapper -->
	<div class="company-logo-wrapper">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="company-logo-slider">
						<!-- Start Company logo Single -->
						<div class="company-logo-single">
							<img src="assets/images/company_logo/company_logo_1.png" alt="" class="img-fluid company-logo-image">
						</div> <!-- End Company logo Single -->
						<!-- Start Company logo Single -->
						<div class="company-logo-single">
							<img src="assets/images/company_logo/company_logo_2.png" alt="" class="img-fluid company-logo-image">
						</div> <!-- End Company logo Single -->
						<!-- Start Company logo Single -->
						<div class="company-logo-single">
							<img src="assets/images/company_logo/company_logo_3.png" alt="" class="img-fluid company-logo-image">
						</div> <!-- End Company logo Single -->
						<!-- Start Company logo Single -->
						<div class="company-logo-single">
							<img src="assets/images/company_logo/company_logo_4.png" alt="" class="img-fluid company-logo-image">
						</div> <!-- End Company logo Single -->
					</div>
				</div>
			</div>
		</div>
	</div> <!-- End Company Logo Wrapper -->
</div> <!-- ...:::: End Company Logo Section:::... --> --}}

<!-- ...:::: Start Blog Feed Section:::... -->
<div class="blog-feed-section section-top-gap-100">
	<!-- Start Section Content -->
	<div class="section-content-gap">
		<div class="container">
			<div class="row">
				<div class="section-content">
					<h3 class="section-title">Latest News</h3>
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
@endsection