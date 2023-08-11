@extends('layouts.main')
@section('content')
@section('title', 'Your Cart')
<!-- ...:::: Start Breadcrumb Section:::... -->
<div class="breadcrumb-section">
    <div class="breadcrumb-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-12 d-flex justify-content-between justify-content-md-between  align-items-center flex-md-row flex-column">
                    <h3 class="breadcrumb-title">Cart</h3>
                    {{ Breadcrumbs::render('cart') }}
                </div>
            </div>
        </div>
    </div>
</div> <!-- ...:::: End Breadcrumb Section:::... -->

<!-- ...:::: Start Cart Section:::... -->
<div class="cart-section">
    <!-- Start Cart Table -->
    <div class="cart-table-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="table_desc">
                        <div class="table_page table-responsive">
                            <table>
                                <!-- Start Cart Table Head -->
                                <thead>
                                <tr>
                                    <th class="product_remove">Delete</th>
                                    <th class="product_thumb">Image</th>
                                    <th class="product_name">Product</th>
                                    <th class="product-price">Price</th>
{{--                                    <th class="product_quantity">Quantity</th>--}}
{{--                                    <th class="product_total">Total</th>--}}
                                </tr>
                                </thead> <!-- End Cart Table Head -->
                                <tbody>
                                @php
                                    $subtotal = 0;
                                @endphp
                            <!-- Start Cart Single Item-->
                            @foreach($cart as $item)
                                @php
                                    $subtotal += $item->price;
                                @endphp
                                <tr>
                                    <td class="product_remove"><a href="#" id="delete-{{$item->id}}"><i class="fa fa-trash-o"></i></a></td>
                                    <td class="product_thumb"><a href="product-details-default.html"><img src="{{$item->cover_image}}" alt=""></a></td>
                                    <td class="product_name"><a href="product-details-default.html">{{$item->title}}</a></td>
                                    <td class="product-price">£ {{$item->price}}</td>
{{--                                    <td class="product_quantity"><label>Quantity</label> <input min="1" max="100" value="1" type="number"></td>--}}
{{--                                    <td class="product_total">£ {{$item->price}}</td>--}}
                                </tr> <!-- End Cart Single Item-->
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End Cart Table -->

    <!-- Start Coupon Start -->
    <div class="coupon_area">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="coupon_code left">
                        <h3>Coupon</h3>
                        <div class="coupon_inner">
                            <p>Enter your coupon code if you have one.</p>
                            <input placeholder="Coupon code" type="text">
                            <button type="submit">Apply coupon</button>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="coupon_code right">
                        <h3>Cart Totals</h3>
                        <div class="coupon_inner">
                            <div class="cart_subtotal">
                                <p>Total</p>
                                <p class="cart_amount">${{$subtotal}}</p>
                            </div>

                            <div class="checkout_btn">
                                @php
                                    $user_id = session()->get('user')['id']
                                @endphp
                                <a href="{{route('cart.checkOut', $user_id)}}">Proceed to Checkout</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End Coupon Start -->

</div> <!-- ...:::: End Cart Section:::... -->
<script type="text/javascript">

</script>
@endsection
