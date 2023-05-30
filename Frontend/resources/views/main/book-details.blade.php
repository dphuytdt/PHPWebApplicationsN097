@extends('layouts.main')
@section('content')
@section('title', 'Book Details')

<section class="bg-sand padding-large">
	<div class="container">
		<div class="row">

			<div class="col-md-6">
				<a href="#" class="product-image"><img src="{{asset('images/main-banner2.jpg')}}"></a>
			</div>

			<div class="col-md-6 pl-5">
				<div class="product-detail">
					<h1>Birds Gonna Be Happy</h1>
					<p>Fiction</p>
					@if($book['price'] == 0)
						<span class="price colored">Free</span>
					@else
					<span class="price colored">$45.00</span>
					@endif
					<p>
						Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
						tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
						quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
						consequat. 
					</p>
					<p>
						Duis aute irure dolor in reprehenderit in voluptate velit esse
						cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
						proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
					</p>
					@if($book['price'] == 0)
						<button type="submit" name="add-to-cart" value="27545" class="button">Read Now!</button>
					@else
						<button type="submit" name="add-to-cart" value="27545" class="button">Add to cart</button>
					@endif
				</div>
			</div>

		</div>
	</div>
</section>

<section class="padding-large">
	<div class="container">
		<div class="row">

			<div class="col-md-12">

				<div class="post-content">
					<p>Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eisusmod tempor incidunt ut elit et.Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eisusmod tempor incidunt ut elit et.</p>
					<blockquote>This is blockquote consectetur adipisicing elit sed do eisusmod tempor incidunt ut elit et.</blockquote>

					<p>Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eisusmod tempor incidunt ut elit et.Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eisusmod tempor incidunt ut elit et.</p>

					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia eserunt mollit anim id est laborum.</p>
					
				</div><!--post-content-->

			</div>

		</div>

		<div class="row">
			<div class="col-md-12">
				
				<section class="comments-wrap mb-4">
					<h3>Comments</h3>
					<div class="comment-list mt-4">

						<article class="flex-container d-flex mb-3">
							<img src="{{asset('images/default.pn')}}g" alt="default" class="commentorImg">
							<div class="author-post">
								<div class="comment-meta d-flex">
									<h4>Michael Watson</h4>
									<span class="meta-date">Dec 2,2020</span>
									<small class="comments-reply"><a href="#"><i class="icon icon-mail-reply"></i>Reply</a></small>
								</div><!--meta-tags-->

								<p>Tristique tempis condimentum diam done ullancomroer sit element henddg sit he consequert.Tristique tempis condimentum diam done ullancomroer sit element henddg sit he consequert.</p>
							</div>

						</article><!--flex-container-->

						<div class="child-comments">
							<article class="flex-container d-flex">
								<img src="{{asset('images/default.png')}}" alt="sara" class="commentorImg">
								<div class="author-post">
									<div class="comment-meta d-flex">
										<h4>Chris Gyale</h4>
										<span class="meta-date">Dec 3,2020</span>
										<small class="comments-reply"><a href="#"><i class="icon icon-mail-reply"></i>Reply</a></small>
									</div><!--meta-tags-->

									<p>Lorem diam done ullancomroer sit element henddg sit he consequert.Tristique tempis condimentum diam done ullancomroer sit element henddg sit he consequert.</p>
								</div>

							</article><!--flex-container-->
						</div><!--child-comments-->

					</div><!--comment-list-->

				</section>

				<section class="comment-respond  mb-5">			
					<h3>Leave a Comment</h3>
					<form method="post" class="form-group mt-3">
						
						<div class="row">
							<div class="col-md-6">
								<input class="u-full-width" type="text" name="author" id="author" class="form-control mb-4 mr-4"  placeholder="Your full name">
							</div>
							<div class="col-md-6">
								<input class="u-full-width" type="email" name="email" id="email" class="form-control mb-4"  placeholder="E-mail Address">
							</div>
						</div>

						<div class="row">
							<div class="col-md-12">
								<textarea class="u-full-width" id="comment" class="form-control mb-4" name="comment" placeholder="Write your comment here" rows="20"></textarea>
							</div>
							<div class="col-md-12">
								<label class="example-send-yourself-copy">
								    <input type="checkbox">
								    <span class="label-body">Save my name, email, and website in this browser for the next time I comment.</span>
								</label>
							</div>
							<div class="col-md-12">
								<input class="btn btn-rounded btn-large btn-full" type="submit" value="Submit">
							</div>
						</div>

					</form>
				</section>

			</div>
		</div>

	</div>
</section>
@endsection