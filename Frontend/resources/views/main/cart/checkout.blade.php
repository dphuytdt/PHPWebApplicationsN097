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
                    <div class="col-lg-12 col-md-12">
                            <h3>Your order</h3>
                            <div class="order_table">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Product</th>
                                            <th>Image</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @php
                                        $total = 0;
                                    @endphp
                                    @if(session()->has('user'))
                                        @php
                                            $user = session()->get('user');
                                        @endphp
                                        <input type="hidden" name="userName" value="{{$user['fullname']}}">
                                        <input type="hidden" name="useId" value="{{$user['id']}}">
                                    @endif
                                    @foreach($cart as $item)
                                        @php
                                            $total += $item->price;
                                        @endphp
                                        <tr>
                                            <td> {{$item->title}}</td>
                                            <td><img src="{{$item->cover_image}}" alt="{{$item->title}}" width="50px" height="50px"></td>
                                            <td> {{$item->price}} $</td>
                                        </tr>
                                        <input type="hidden" name="id" value="{{$item->id}}">
                                        <input type="hidden" name="bookiD[]" value="{{$item->book_id}}">
                                        <input type="hidden" name="price" value="{{$item->price}}">
                                    @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr class="order_total">
                                            <th>Order Total</th>
                                            <td><strong> {{$total}} $</strong></td>
                                            <input type="hidden" name="total" value="{{$total}}">
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        <form method="post" action="{{route('cart.payment.vnPay')}}">
                            @csrf
                            <input type="hidden" name="id" value="{{$item->id}}">
                            <input type="hidden" name="bookiD[]" value="{{$item->book_id}}">
                            <input type="hidden" name="price" value="{{$item->price}}">
                            <input type="hidden" name="userName" value="{{$user['fullname']}}">
                            <input type="hidden" name="useId" value="{{$user['id']}}">
                            <input type="hidden" name="total" value="{{$total}}">
                            <div class="payment_method">
                                <div class="order_button pt-15">
                                    <button id="proceedToPayBtn" name="redirect" type="submit">Purchase with VNPay</button>
                                </div>
                            </div>
                        </form>
                        <form method="post" action="{{route('cart.payment.moMo')}}">
                            @csrf
                            <input type="hidden" name="id" value="{{$item->id}}">
                            <input type="hidden" name="bookiD[]" value="{{$item->book_id}}">
                            <input type="hidden" name="price" value="{{$item->price}}">
                            <input type="hidden" name="userName" value="{{$user['fullname']}}">
                            <input type="hidden" name="useId" value="{{$user['id']}}">
                            <input type="hidden" name="total" value="{{$total}}">
                            <div class="payment_method">
                                <div class="order_button pt-15">
                                    <button  name="payUrl" type="submit">Purchase with Momo</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div> <!-- Start User Details Checkout Form -->
        </div>
    </div><!-- ...:::: End Checkout Section:::... -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@endsection
