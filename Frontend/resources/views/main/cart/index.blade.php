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
                    {{ Breadcrumbs::render('checkout') }}
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
                                    <th class="product_quantity">Quantity</th>
                                    <th class="product_total">Total</th>
                                </tr>
                                </thead> <!-- End Cart Table Head -->
                                <tbody>
                                <!-- Start Cart Single Item-->
                                <tr>
                                    <td class="product_remove"><a href="#"><i class="fa fa-trash-o"></i></a></td>
                                    <td class="product_thumb"><a href="product-details-default.html"><img src="assets/images/products_images/aments_products_image_1.jpg" alt=""></a></td>
                                    <td class="product_name"><a href="product-details-default.html">Handbag fringilla</a></td>
                                    <td class="product-price">$65.00</td>
                                    <td class="product_quantity"><label>Quantity</label> <input min="1" max="100" value="1" type="number"></td>
                                    <td class="product_total">$130.00</td>
                                </tr> <!-- End Cart Single Item-->
                                <!-- Start Cart Single Item-->
                                <tr>
                                    <td class="product_remove"><a href="#"><i class="fa fa-trash-o"></i></a></td>
                                    <td class="product_thumb"><a href="product-details-default.html"><img src="assets/images/products_images/aments_products_image_2.jpg" alt=""></a></td>
                                    <td class="product_name"><a href="product-details-default.html">Handbags justo</a></td>
                                    <td class="product-price">$90.00</td>
                                    <td class="product_quantity"><label>Quantity</label> <input min="1" max="100" value="1" type="number"></td>
                                    <td class="product_total">$180.00</td>
                                </tr> <!-- End Cart Single Item-->
                                <!-- Start Cart Single Item-->
                                <tr>
                                    <td class="product_remove"><a href="#"><i class="fa fa-trash-o"></i></a></td>
                                    <td class="product_thumb"><a href="product-details-default.html"><img src="assets/images/products_images/aments_products_image_3.jpg" alt=""></a></td>
                                    <td class="product_name"><a href="product-details-default.html">Handbag elit</a></td>
                                    <td class="product-price">$80.00</td>
                                    <td class="product_quantity"><label>Quantity</label> <input min="1" max="100" value="1" type="number"></td>
                                    <td class="product_total">$160.00</td>
                                </tr> <!-- End Cart Single Item-->
                                </tbody>
                            </table>
                        </div>
                        <div class="cart_submit">
                            <button type="submit">update cart</button>
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
                                <p>Subtotal</p>
                                <p class="cart_amount">$215.00</p>
                            </div>
                            <div class="cart_subtotal ">
                                <p>Shipping</p>
                                <p class="cart_amount"><span>Flat Rate:</span> $255.00</p>
                            </div>
                            <a href="#">Calculate shipping</a>

                            <div class="cart_subtotal">
                                <p>Total</p>
                                <p class="cart_amount">$215.00</p>
                            </div>
                            <div class="checkout_btn">
                                <a href="#">Proceed to Checkout</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End Coupon Start -->

</div> <!-- ...:::: End Cart Section:::... -->
@endsection
