@extends('layouts.main') @section('content') @section('title', 'Wishlist')
<div class="breadcrumb-section">
    <div class="breadcrumb-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-12 d-flex justify-content-between justify-content-md-between align-items-center flex-md-row flex-column">
                    <h3 class="breadcrumb-title">Wishlist</h3>
                    {{ Breadcrumbs::render('wishlist') }}
                </div>
            </div>
        </div>
    </div>
</div>
<div class="wishlist-section">->
    <div class="wishlish-table-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="table_desc">
                        <div class="table_page table-responsive">
                            <table>
                                <thead>
                                <tr>
                                    <th class="product_remove">Delete</th>
                                    <th class="product_thumb">Image</th>
                                    <th class="product_name">Product</th>
                                    <th class="product_stock">Stock Status</th>
                                    <th class="product-price">Price</th>
                                    <th class="product_addcart">Action</th>
                                </tr>
                                </thead>
                                <tbody id="wishlist_items">
                                @foreach($wishlists as $wishlist)
                                    <form action="{{route('wishlist.add')}}" method="POST">
                                        @csrf
                                        <input type="hidden" name="userID" value="{{$wishlist->user_id}}" />
                                        <input type="hidden" name="bookID" value="{{$wishlist->book_id}}" />
                                        <input type="hidden" name="bookTitle" value="{{$wishlist->title}}" />
                                        <input type="hidden" name="bookPrice" value="{{$wishlist->price}}" />
                                        <input type="hidden" name="bookImage" value="{{$wishlist->cover_image}}" />
                                        <tr>
                                            <td class="product_remove">
                                                <a href=""><i class="fa fa-trash-o"></i></a>
                                            </td>
                                            <td class="product_thumb">
                                                <a href="">
                                                    <img src="data:image/{{ $wishlist->image_extension }};base64,{{$wishlist->cover_image}}" alt="" />
                                                </a>
                                            </td>
                                            <td class="product_name"><a href="">{{$wishlist->title}}</a></td>
                                            <td class="product_stock"><span class="in-stock">in stock</span></td>
                                            <td class="product-price">£{{$wishlist->price}}</td>
                                            @if($wishlist->price > 0)
                                                <td class="product_addcart"><button class="btn btn-danger">Add to cart</button></td>
                                            @else
                                                <td class="product_addcart"><a href="{{route('bookDetails', $wishlist->book_id)}}">Details</a></td>
                                            @endif
                                        </tr>
                                    </form>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
