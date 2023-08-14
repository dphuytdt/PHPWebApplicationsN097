@extends('layouts.main')
@section('content')
@section('title', 'Search Result')


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
@if($paginator->count() == 0)
{{-- //display center, color red --}}
<style type="text/css">
    .alert-danger {
        text-align: center;
        color: red;
    }
</style>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="alert alert-danger" role="alert">
                    No products found
                </div>
            </div>
        </div>
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
                                                            <img src="data:image/png;base64,{{ $book['cover_image'] }}" alt="" class="product-default-img img-fluid">
                                                        </a>
                                                        <div class="product-action-icon-link">
                                                            <ul>
                                                                <li><a href="wishlist.html"><i class="icon-heart"></i></a></li>
                                                                <li><a href="compare.html"><i class="icon-repeat"></i></a></li>
                                                                <li><a href="#" data-toggle="modal" data-target="#modalQuickview-{{$book['id']}}"><i class="icon-eye"></i></a></li>
                                                                @if($book['price'] != 0)
                                                                <li><a href="#" data-toggle="modal" data-target="#modalAddcart-{{$book['id']}}"><i class="icon-shopping-cart"></i></a></li>
                                                                @endif
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="product-default-content">
                                                        <h6 class="product-default-link"><a href="{{URL::to('/book-details/'.$book['id'])}}">{{$book['title']}}</a></h6>
                                                        @if($book['price'] == 0)
                                                            <span class="product-default-price">Free for now</span>
                                                        @else
                                                            <span class="product-default-price">$ {{$book['price']}}</span>
                                                        @endif
                                                    </div>
                                                </div> <!-- End Product Defautlt Single -->
                                            </div>
                                            @endforeach
                                        </div>
                                    </div> <!-- End Grid View Product -->
                                    <div class="tab-pane sort-layout-single" id="layout-list">
                                        <div class="row">
                                            @foreach($paginator as $book)
                                            <div class="col-12">
                                                <!-- Start Product Defautlt Single -->
                                                <div class="product-list-single border-around">
                                                    <a href="{{URL::to('/book-details/'.$book['id'])}}" class="product-list-img-link">
                                                        <img src="data:image/png;base64,{{ $book['cover_image'] }}" alt="" class="img-fluid">
                                                    </a>
                                                    <div class="product-list-content">
                                                        <h5 class="product-list-link"><a href="{{URL::to('/book-details/'.$book['id'])}}">{{$book['title']}}</a></h5>
                                                        @if($book['price'] == 0)
                                                        <span class="product-list-price">Free for now</span>
                                                        @else
                                                        <span class="product-list-price">$ {{$book['price']}}</span>
                                                        @endif
                                                        <p>{{$book['description']}}</p>
                                                        <div class="product-action-icon-link-list">
                                                            <ul>
                                                                <li><a href="wishlist.html"><i class="icon-heart"></i></a></li>
                                                                <li><a href="compare.html"><i class="icon-repeat"></i></a></li>
                                                                <li><a href="#" data-toggle="modal" data-target="#modalQuickview-{{$book['id']}}"><i class="icon-eye"></i></a></li>
                                                                @if($book['price'] != 0)
                                                                    <li><a href="#" data-toggle="modal" data-target="#modalAddcart-{{$book['id']}}"><i class="icon-shopping-cart"></i></a></li>
                                                                @endif
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div> <!-- End Product Defautlt Single -->
                                            </div>
                                            @endforeach
                                        </div>
                                    </div> <!-- End List View Product -->
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
                        @if ($paginator->currentPage() != 1)
                            <a href="{{ $paginator->url(1) }}">First</a>
                        @endif
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
                        @if ($paginator->currentPage() != $paginator->lastPage())
                        <a href="{{ $paginator->url($paginator->lastPage()) }}">Last</a>
                    @endif
                    </div> <!-- End Pagination -->
                </div>
            </div> <!-- End Shop Product Sorting Section  -->
        </div>
    </div>
</div> <!-- ...:::: End Shop Section:::... -->
    @foreach($paginator as $book)
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
                                            <img class="img-fluid" src="data:image/png;base64,{{ $book['cover_image'] }}" alt="">
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
                                            {{-- <div class="variable-single-item ">
                                                <span>Quantity Available</span>
                                                <div class="product-variable-quantity">
                                                    <input  value="{{$book['quantity']}}" type="text" readonly disabled>
                                                </div>
                                            </div> --}}
                                            <div class="product-add-to-cart-btn">
                                                <a href="#" data-toggle="modal" data-target="#modalAddcart">Add To Cart</a>
                                            </div>
                                            <br>
                                        @endif
                                    </div> <!-- End Product Variable Area -->
                                    <!-- Start  Product Details Meta Area-->
                                    <div class="product-details-meta mb-20">
                                        <ul>
                                            <li><a href=""><i class="icon-heart"></i>Add to wishlist</a></li>
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
                                            <img class="img-fluid" src="data:image/png;base64,{{ $book['cover_image'] }}" alt="">
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
@endif
@endsection
