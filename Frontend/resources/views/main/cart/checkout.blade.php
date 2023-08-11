@extends('layouts.main')
@section('content')
@section('title', 'Checkout')
    <!-- ...:::: Start Breadcrumb Section:::... -->
    <div class="breadcrumb-section">
        <div class="breadcrumb-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-12 d-flex justify-content-between justify-content-md-between  align-items-center flex-md-row flex-column">
                        <h3 class="breadcrumb-title">Checkout</h3>
                        {{ Breadcrumbs::render('checkOut') }}
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- ...:::: End Breadcrumb Section:::... -->

    <!-- ...:::: Start Checkout Section:::... -->
    <div class="checkout_section">
        <div class="container">
            <div class="row">
                <!-- User Quick Action Form -->
                <div class="col-12">
                    <div class="user-actions accordion">
                        <h3>
                            <i class="fa fa-file-o" aria-hidden="true"></i>
                            Returning customer?
                            <a class="Returning" href="#" data-toggle="collapse" data-target="#checkout_coupon" aria-expanded="true">Click here to enter your code</a>

                        </h3>
                        <div id="checkout_coupon" class="collapse" data-parent="#checkout_coupon">
                            <div class="checkout_info">
                                <form action="#">
                                    <input placeholder="Coupon code" type="text">
                                    <button type="submit">Apply coupon</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- User Quick Action Form -->
            </div>
            <!-- Start User Details Checkout Form -->
            <div class="checkout_form">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <form action="#">
                            <h3>Billing Details</h3>
                            <div class="row">
                                <div class="col-12 mb-20">
                                    <div class="default-form-box">
                                        <label>Card ID <span>*</span></label>
                                        <input type="text">
                                    </div>
                                </div>
                                <div class="col-12 mb-20">
                                    <div class="default-form-box">
                                        <label>Card Number <span>*</span></label>
                                        <input type="text">
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-20">
                                    <div class="default-form-box">
                                        <label>Date Expire<span>*</span></label>
                                        <input type="text">
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-20">
                                    <div class="default-form-box">
                                        <label>CVV<span>*</span></label>
                                        <input type="number">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <form method="post" action="{{route('cart.payment')}}">
                            @csrf
                            <h3>Your order</h3>
                            <div class="order_table table-responsive">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Product</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @php
                                        $total = 0;
                                    @endphp
                                    @foreach($cart as $item)
                                        @php
                                            $total += $item->price;
                                        @endphp
                                        <tr>
                                            <td> {{$item->title}}</td>
                                            <td> {{$item->price}}</td>
                                        </tr>
                                        <input type="hidden" name="bookiD[]" value="{{$item->book_id}}">
                                    @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr class="order_total">
                                            <th>Order Total</th>
                                            <td><strong> {{$total}}</strong></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <div class="payment_method">
                                <div class="order_button pt-15">
                                    <button id="proceedToPayBtn" name="redirect" type="submit">Proceed to Pay</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div> <!-- Start User Details Checkout Form -->
        </div>
    </div><!-- ...:::: End Checkout Section:::... -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

{{--<script>--}}
{{--    $(document).ready(function() {--}}
{{--        // function to handle the button click--}}
{{--        $("#proceedToPayBtn").click(function(e) {--}}
{{--            e.preventDefault();--}}
{{--            var bookId = $("input[name='bookiD[]']").map(function(){return $(this).val();}).get();--}}
{{--            var userID = @json(session('user_id', ['id' => 'id']));--}}
{{--            var url = "http://paymentservice.test:8080/api/cart/checkout";--}}
{{--            var __token = $('meta[name="csrf-token"]').attr('content');--}}
{{--            // make the AJAX request--}}
{{--            $.ajax({--}}
{{--                type: "POST",--}}
{{--                url: url,--}}
{{--                data: { bookId: bookId , userID: userID, __token: __token},--}}
{{--                success: function(data) {--}}
{{--                    // handle success response--}}
{{--                    console.log("Payment successful");--}}
{{--                },--}}
{{--                error: function(xhr, status, error) {--}}
{{--                    // handle error response--}}
{{--                    console.log("Error making payment: " + error);--}}
{{--                }--}}
{{--            });--}}
{{--        });--}}
{{--    });--}}
{{--</script>--}}
@endsection
