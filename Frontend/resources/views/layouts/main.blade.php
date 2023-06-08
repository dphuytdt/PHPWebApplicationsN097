<!DOCTYPE html>
<html lang="en">
<head>
	<title>@yield('title')</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="format-detection" content="telephone=no">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="author" content="">
	<meta name="keywords" content="">
	<meta name="description" content="">
	<link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}" />
	<link rel="stylesheet" type="text/css" href="{{asset('css/home/normalize.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('icomoon/icomoon.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('css/home/vendor.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('css/home/style.css')}}">
	<script src="{{asset('js/home/modernizr.js')}}"></script>
</head>
<body>
	<div id="header-wrap">
	
		<div class="top-content">
			<div class="container">
				<div class="row">
					<div class="col-md-6">
						<div class="social-links">
							<ul>
								<li>
									<a href="#"><i class="icon icon-facebook"></i></a>
								</li>
								
								<li>
									<a href="#"><i class="icon icon-youtube-play"></i></a>
								</li>
								
							</ul>
						</div><!--social-links-->
					</div>
					<div class="col-md-6">
						<div class="right-element">
							@if(Session::has('token'))
								<a href="{{route('logout')}}" class="login for-buy"><i class="icon icon-user"></i><span>Logout</span></a>
							@else
								<a href="{{route('login')}}" class="login for-buy"><i class="icon icon-user"></i><span>Login</span></a>
							@endif
							<a href="#" class="cart for-buy"><i class="icon icon-clipboard"></i><span>Cart</span></a>
							<a href="#" class="language for-buy"><i class="icon icon-notes"></i><span>Language</span></a>
							@if(Session::has('user'))
								@php 
									$is_vip = Session::get('user')['is_vip'];
								@endphp
								@if($is_vip == 1)
									<a href="#" class="language for-buy"><i class="icon icon-currency-dollar"></i><span>VIP</span></a>
								@else 
									<a href="#" class="language for-buy"><i class="icon icon-currency-dollar"></i><span>Upgrade to VIP</span></a>
								@endif
							@endif
							<div class="action-menu">
	
								<div class="search-bar">
									<a href="#" class="search-button search-toggle" data-selector="#header-wrap">
										<i class="icon icon-search"></i>
									</a>
									<form role="search" method="get" action="{{route('search')}}" class="search-box">
										<input class="search-field text search-input" name="keyword" placeholder="Search" type="search">
									</form>
								</div>
							</div>
	
						</div><!--top-right-->
					</div>
					
				</div>
			</div>
		</div><!--top-content-->
	
		<header id="header">
			<div class="container">
				<div class="row">
	
					<div class="col-md-2">
						<div class="main-logo">
							<a href="{{route('home')}}"><img src="{{asset('images/main-logo.png')}}" alt="logo"></a>
						</div>
	
					</div>
	
					<div class="col-md-10">
						
						<nav id="navbar">
							<div class="main-menu stellarnav">
								<ul class="menu-list">
									<li class="menu-item active"><a href="{{route('home')}}" data-effect="Home">Home</a></li>
									<li class="menu-item"><a href="{{route('about')}}" class="nav-link" data-effect="About">About</a></li>
									<li class="menu-item has-sub">
										<a href="#pages" class="nav-link" data-effect="Pages">Pages</a>
	
										{{-- <ul>
											<li class="active"><a href="index.html">Home</a></li>
											<li><a href="about.html">About</a></li>
											<li><a href="styles.html">Styles</a></li>
											<li><a href="blog.html">Blog</a></li>
											<li><a href="single-post.html">Post Single</a></li>
											<li><a href="shop.html">Our Store</a></li>
											<li><a href="single-product.html">Product Single</a></li>
											<li><a href="contact.html">Contact</a></li>
											<li><a href="thank-you.html">Thank You</a></li>
										 </ul>
	 --}}
									</li>
									<li class="menu-item"><a href="#popular-books" class="nav-link" data-effect="Shop">Shop</a></li>
									<li class="menu-item"><a href="#latest-blog" class="nav-link" data-effect="Articles">Articles</a></li>
									<li class="menu-item"><a href="{{route('contact')}}" class="nav-link" data-effect="Contact">Contact</a></li>
								</ul>
	
								<div class="hamburger">
									<span class="bar"></span>
									<span class="bar"></span>
									<span class="bar"></span>
								</div>
	
							</div>
						</nav>
	
					</div>
	
				</div>
			</div>
		</header>
			
	</div><!--header-wrap-->
		@yield('content')
	<footer id="footer">
		<div class="container">
			<div class="row">
	
				<div class="col-md-4">
					
					<div class="footer-item">
						<div class="company-brand">
							<img src="{{asset('images/main-logo.png')}}" alt="logo" class="footer-logo">
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sagittis sed ptibus liberolectus nonet psryroin. Amet sed lorem posuere sit iaculis amet, ac urna. Adipiscing fames semper erat ac in suspendisse iaculis.</p>
						</div>
					</div>
					
				</div>
	
				<div class="col-md-2">
	
					<div class="footer-menu">
						<h5>About Us</h5>
						<ul class="menu-list">
							<li class="menu-item">
								<a href="#">vision</a>
							</li>
							<li class="menu-item">
								<a href="#">articles </a>
							</li>
							<li class="menu-item">
								<a href="#">careers</a>
							</li>
							<li class="menu-item">
								<a href="#">service terms</a>
							</li>
							<li class="menu-item">
								<a href="#">donate</a>
							</li>
						</ul>
					</div>
	
				</div>
				<div class="col-md-2">
	
					<div class="footer-menu">
						<h5>Discover</h5>
						<ul class="menu-list">
							<li class="menu-item">
								<a href="#">Home</a>
							</li>
							<li class="menu-item">
								<a href="#">Books</a>
							</li>
							<li class="menu-item">
								<a href="#">Authors</a>
							</li>
							<li class="menu-item">
								<a href="#">Subjects</a>
							</li>
							<li class="menu-item">
								<a href="#">Advanced Search</a>
							</li>
						</ul>
					</div>
	
				</div>
				<div class="col-md-2">
	
					<div class="footer-menu">
						<h5>My account</h5>
						<ul class="menu-list">
							<li class="menu-item">
								<a href="#">Sign In</a>
							</li>
							<li class="menu-item">
								<a href="#">View Cart</a>
							</li>
							<li class="menu-item">
								<a href="#">My Wishtlist</a>
							</li>
							<li class="menu-item">
								<a href="#">Track My Order</a>
							</li>
						</ul>
					</div>
	
				</div>
				<div class="col-md-2">
	
					<div class="footer-menu">
						<h5>Help</h5>
						<ul class="menu-list">
							<li class="menu-item">
								<a href="#">Help center</a>
							</li>
							<li class="menu-item">
								<a href="#">Report a problem</a>
							</li>
							<li class="menu-item">
								<a href="#">Suggesting edits</a>
							</li>
							<li class="menu-item">
								<a href="#">Contact us</a>
							</li>
						</ul>
					</div>
	
				</div>
	
			</div>
			<!-- / row -->
	
		</div>
	</footer>
	
	<div id="footer-bottom">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
	
					<div class="copyright">
						<div class="row">
	
							<div class="col-md-6">
								<p>© 2023 All rights reserved By N097 - HuyDP and CBT</p>
							</div>
	
							<div class="col-md-6">
								<div class="social-links align-right">
									<ul>
										<li>
											<a href="#"><i class="icon icon-facebook"></i></a>
										</li>
										{{-- <li>
											<a href="#"><i class="bi bi-github"></i></a>
										</li> --}}
										<li>
											<a href="#"><i class="icon icon-youtube-play"></i></a>
										</li>
									</ul>
								</div>
							</div>
	
						</div>
					</div><!--grid-->
	
				</div><!--footer-bottom-content-->
			</div>
		</div>
	</div>
</body>
<script src="{{asset('js/home/jquery-1.11.0.min.js')}}"></script>
<script src="{{asset('js/home/plugins.js')}}"></script>
<script src="{{asset('js/home/script.js')}}"></script>
</html>