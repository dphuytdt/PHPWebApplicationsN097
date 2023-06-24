@extends('layouts.main')
@section('content')
@section('title', 'Wishlist')
<!-- ...:::: Start Breadcrumb Section:::... -->
<div class="breadcrumb-section">
    <div class="breadcrumb-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-12 d-flex justify-content-between justify-content-md-between  align-items-center flex-md-row flex-column">
                    <h3 class="breadcrumb-title">Wishlist</h3>
                    {{ Breadcrumbs::render('wishlist') }}
                </div>
            </div>
        </div>
    </div>
</div> <!-- ...:::: End Breadcrumb Section:::... -->

<!-- ...:::: Start Wishlist Section:::... -->
<div class="wishlist-section">
    <!-- Start Cart Table -->
    <div class="wishlish-table-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="table_desc">
                        <div class="table_page table-responsive">
                            <table>
                                <!-- Start Wishlist Table Head -->
                                <thead>
                                <tr>
                                    <th class="product_remove">Delete</th>
                                    <th class="product_thumb">Image</th>
                                    <th class="product_name">Product</th>
                                    <th class="product-price">Price</th>
                                    <th class="product_stock">Stock Status</th>
                                    <th class="product_addcart">Action</th>
                                </tr>
                                </thead> <!-- End Cart Table Head -->
                                <tbody id="wishlist_items">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End Cart Table -->
</div> <!-- ...:::: End Wishlist Section:::... -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script type="text/javascript">
        function getWishlistItems() {
            if (localStorage.getItem('wishlist') != null) {
                var data = JSON.parse(localStorage.getItem('wishlist'));
                var html = '';
                for (var i = 0; i < data.length; i++) {
                    html += '<tr>';
                    html += '<td class="product_remove"><a href=""><i class="fa fa-trash-o" id="' + data[i].id + '" onclick="deleteWishlist(this.id)"></i></a></td>';
                    html += '<td class="product_thumb"><a href="product-details-default.html"><img src="' + data[i].image + '" alt=""></a></td>';
                    html += '<td class="product_name"><a href="product-details-default.html">' + data[i].name + '</a></td>';
                    html += '<td class="product-price">$' + data[i].price + '</td>';
                    html += '<td class="product_stock">In Stock</td>';
                    if (isNaN(data[i].price)) {
                        html += '<td class="product_addcart"><a href="#">Read Now</a></td>';
                    } else {
                        html += '<td class="product_addcart"><a href="#">Add to cart</a></td>';
                    }
                    html += '</tr>';
                }
                $('#wishlist_items').html(html);
            }
        }

        $(document).ready(function () {
            getWishlistItems();
        });
    </script>
@endsection
