@extends('layouts.main') @section('content') @section('title', $dataType == 'new' ? 'New Books' : ($dataType == 'free' ? 'Free Books' : ($dataType == 'featured' ? 'Featured Books' : ($dataType)))) )

<div class="breadcrumb-section">
    <div class="breadcrumb-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-12 d-flex justify-content-between justify-content-md-between align-items-center flex-md-row flex-column">
                    <h3 class="breadcrumb-title">
                        @if($dataType == 'new') New Books @elseif($dataType == 'free') Free Books @elseif($dataType == 'featured') Featured Books @else Category [{{ $dataType}}] @endif
                    </h3>
                    {{ Breadcrumbs::render('viewMore', $dataType) }}
                </div>
            </div>
        </div>
    </div>
</div>

<style type="text/css">
    .alert-danger {
        text-align: center;
        color: red;
    }
    .pagination-container {
        text-align: center;
    }

    .pagination {
        display: inline-block;
        margin-top: 10px;
    }

    .pagination a,
    .pagination span {
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
@if($paginator->count() == 0)
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="alert alert-danger" role="alert">
                {{__('messages.no_books_found')}}
            </div>
        </div>
    </div>
</div>
@else
    <div class="shop-section">
        <div class="container">
            <div class="row flex-column-reverse flex-lg-row">
                <div class="col-lg-12">
                    <div class="shop-sort-section">
                        <div class="container">
                            <div class="row">
                                <div class="sort-box d-flex justify-content-between align-items-md-center align-items-start flex-md-row flex-column">
                                    <div class="sort-tablist">
                                        <ul class="tablist nav sort-tab-btn">
                                            <li>
                                                <a class="nav-link active" data-toggle="tab" href="#layout-4-grid"><img src="{{asset('assets/images/icon/bkg_grid.png')}}" alt="" /></a>
                                            </li>
                                            <li>
                                                <a class="nav-link" data-toggle="tab" href="#layout-list"><img src="{{asset('assets/images/icon/bkg_list.png')}}" alt="" /></a>
                                            </li>
                                        </ul>
                                    </div>

                                    <div class="page-amount">
                                        <span>@if($paginator->total() > 0) Showing {{ $paginator->firstItem() }}–{{ $paginator->lastItem() }} of {{ $paginator->total() }} results @endif</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="sort-product-tab-wrapper">
                        <div class="container">
                            <div class="row">
                                <div class="col-12">
                                    <div class="tab-content tab-animate-zoom">
                                        <div class="tab-pane active show sort-layout-single" id="layout-4-grid">
                                            <div class="row">
                                                @foreach($paginator as $book)
                                                    <div class="col-xl-3 col-lg-4 col-sm-6 col-12">
                                                        <div class="product-default-single border-around">
                                                            <div class="product-img-warp">
                                                                <a href="{{URL::to('/book-details/'.$book['id'])}}" class="product-default-img-link">
                                                                    <img src="{{ $book['cover_image'] }}" alt="" class="product-default-img img-fluid" />
                                                                </a>
                                                            </div>
                                                            <div class="product-default-content">
                                                                <h6 class="product-default-link"><a href="{{URL::to('/book-details/'.$book['id'])}}">{{$book['title']}}</a></h6>
                                                                @if($book['price'] == 0)
                                                                    <span class="product-default-price">{{__('messages.free_for_now')}}</span>
                                                                @else
                                                                    <span class="product-default-price">$ {{$book['price']}}</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="tab-pane sort-layout-single" id="layout-list">
                                            <div class="row">
                                                @foreach($paginator as $book)
                                                    <div class="col-12">
                                                        <div class="product-list-single border-around">
                                                            <a href="{{URL::to('/book-details/'.$book['id'])}}" class="product-list-img-link">
                                                                <img src="{{ $book['cover_image'] }}" alt="" class="img-fluid" />
                                                            </a>
                                                            <div class="product-list-content">
                                                                <h5 class="product-list-link"><a href="{{URL::to('/book-details/'.$book['id'])}}">{{$book['title']}}</a></h5>
                                                                @if($book['price'] == 0)
                                                                    <span class="product-list-price">Free for now</span>
                                                                @else
                                                                    <span class="product-list-price">$ {{$book['price']}}</span>
                                                                @endif
                                                                <p>{{$book['description']}}</p>
                                                            </div>
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
                    <br>
                    <div class="pagination-container">
                        <div class="pagination">
                            @if ($paginator->currentPage() != 1)
                                <a href="{{ $paginator->url(1) }}">First</a>
                            @endif @if ($paginator->onFirstPage())
                                <span class="disabled">Previous</span>
                            @else
                                <a href="{{ $paginator->previousPageUrl() }}">Previous</a>
                            @endif {{-- Hiển thị số trang --}} @for ($i = 1; $i <= $paginator->lastPage(); $i++) @if ($i === $paginator->currentPage())
                                <span class="current">{{ $i }}</span>
                            @else
                                <a href="{{ $paginator->url($i) }}">{{ $i }}</a>
                            @endif @endfor {{-- Hiển thị nút Next --}} @if ($paginator->hasMorePages())
                                <a href="{{ $paginator->nextPageUrl() }}">Next</a>
                            @else
                                <span class="disabled">Next</span>
                            @endif @if ($paginator->currentPage() != $paginator->lastPage())
                                <a href="{{ $paginator->url($paginator->lastPage()) }}">Last</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @foreach($paginator as $book)
        <div class="modal fade" id="modalQuickview-{{$book['id']}}" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
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

                                                <img class="img-fluid" src="{{ $book['cover_image'] }}" alt="" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="product-details-content-area">
                                        <div class="product-details-text">
                                            <h4 class="title">{{$book['title']}}</h4>
                                            @if($book['price'] == 0)
                                                <div class="price">{{__('messages.free_for_now')}}</div>
                                            @else
                                                <div class="price">${{$book['price']}}</div>

                                            @endif
                                            <p>{{$book['description']}}</p>
                                        </div>

                                        <div class="product-details-variable">
                                            @if ($book['price'] == 0)
                                                <div class="product-add-to-cart-btn">
                                                    <a href="#" data-toggle="modal" data-target="#modalAddcart">{{__('messages.readNow')}}</a>
                                                </div>
                                                <br />
                                            @else
                                                <div class="product-add-to-cart-btn">
                                                    <a href="#" data-toggle="modal" data-target="#modalAddcart">{{__('messages.addToCart')}}</a>
                                                </div>
                                                <br />
                                            @endif
                                        </div>

                                        <div class="product-details-meta mb-20">
                                            <ul>
                                                <li>
                                                    <a href=""><i class="icon-heart"></i>{{__('messages.addToWishlist')}}</a>
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

        <div class="modal fade" id="modalAddcart-{{$book['id']}}" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
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
                                                <img class="img-fluid" src="data:image/{{$book['image_extension']}};base64,{{ $book['cover_image'] }}" alt="" />
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="modal-add-cart-info"><i class="fa fa-check-square"></i>{{__('messages.addCartSuccess')}}</div>
                                            <div class="modal-add-cart-product-cart-buttons">
                                                {{-- <a href="{{route('cart.add')}}">{{__('messages.addToCart')}}</a>--}} {{-- <a href="{{route('cart.checkOut')}}">{{__('messages.checkOut')}}</a>--}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-5 modal-border">
                                    <ul class="modal-add-cart-product-shipping-info">
                                        <li class="modal-continue-button"><a href="#" data-dismiss="modal">{{__('messages.CONTINUESHOPPING')}}</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach @endif @endsection
