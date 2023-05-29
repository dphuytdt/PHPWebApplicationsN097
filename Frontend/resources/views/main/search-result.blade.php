@extends('layouts.main')
@section('content')
@section('title', 'Search Result')
<div>
	<div class="container">
		<div class="row">
			<div class="col-md-12">			
				<div class="colored">
					<h1 class="page-title">Search Result</h1>
					<div class="breadcum-items">
						<span class="item"><a href="{{route('home')}}">Home /</a></span>
						<span class="item colored">Search Result</span>
					</div>
				</div>
			</div>
		</div>
	</div>
</div><!--site-banner-->

<section class="padding-large">
	<div class="container">
		<div class="row">
            <div class="products-grid grid">
                @foreach ( $books as $key => $book )
                <figure class="product-style">
                    <img src="images/tab-item1.jpg" alt="Books" class="product-item">
                    <button type="button" class="add-to-cart" data-product-tile="add-to-cart">Add to Cart</button>
                    <figcaption>
                        <h3>Portrait photography</h3>
                        <p>Adam Silber</p>
                        <div class="item-price">$ 40.00</div>
                    </figcaption>
                </figure>
                @endforeach
            </div>
		</div>
	</div>
</section>
@endsection