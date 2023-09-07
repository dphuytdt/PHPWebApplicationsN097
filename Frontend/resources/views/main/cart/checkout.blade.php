@extends('layouts.main') @section('content') @section('title', 'Checkout')
<div class="breadcrumb-section">
    <div class="breadcrumb-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-12 d-flex justify-content-between justify-content-md-between align-items-center flex-md-row flex-column">
                    <h3 class="breadcrumb-title">{{__('messages.checkout')}}</h3>
                    {{ Breadcrumbs::render('checkOut') }}
                </div>
            </div>
        </div>
    </div>
</div>
<div class="checkout_section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="user-actions accordion">
                    <div id="checkout_coupon" class="collapse" data-parent="#checkout_coupon">
                        <div class="checkout_info">
                            <form action="#">
                                <input placeholder="Coupon code" type="text" />
                                <button type="submit">{{__('messages.Applycoupon')}}n</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="checkout_form">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <h3>{{__('messages.Yourorder')}}</h3>
                    <style>
                        /* Center-align the table within its container */
                        .table-container {
                            display: flex;
                            justify-content: center;
                            align-items: center;
                            height: 100vh; /* You can adjust the height to fit your design */
                        }

                        /* Optional: Style the table */
                        table {
                            border-collapse: collapse;
                            width: 100%;
                        }

                        th, td {
                            border: 1px solid #ddd;
                            padding: 8px;
                            text-align: left;
                        }

                        th {
                            background-color: #f2f2f2;
                        }

                        /* Additional styles can be added as needed */

                    </style>
                    <div class="table-container">
                        <table>
                            <thead>
                            <tr>
                                <th>{{__('messages.Product')}}</th>
                                <th>{{__('messages.Image')}}</th>
                                <th>{{__('messages.Total')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php $total = 0; @endphp @if(session()->has('user')) @php $user = session()->get('user'); @endphp
                                <input type="hidden" name="userName" value="{{$user['fullname']}}" />
                                <input type="hidden" name="useId" value="{{$user['id'   ]}}" />
                            @endif @foreach($cart as $item) @php $total += $item->price; @endphp
                                <tr>
                                    <td>{{$item->title}}</td>
                                    <td>
                                        <img src="{{$item->cover_image }}" alt="{{$item->title}}" width="50px" height="50px" />
                                    </td>
                                    <td>{{$item->price}} $</td>
                                </tr>
                                <input type="hidden" name="id" value="{{$item->id}}" />
                                <input type="hidden" name="bookId" value="{{$item->book_id}}" />
                                <input type="hidden" name="price" value="{{$item->price}}" />
                                @endforeach
                                <tr class="order_total">
                                    <td>Order Total</td>
                                    <td colspan="2"><strong> {{$total}} $</strong></td>
                                    <input type="hidden" name="total" value="{{$total}}" />
                                </tr>
                                <tr>
                                    <td>Payment with:</td>
                                    <td>
                                        @if(isset($cart))
                                            <form method="post" action="{{route('cart.payment.vnPay')}}">
                                                @csrf
                                                <input type="hidden" name="id" value="{{$item->id}}" />
                                                <input type="hidden" name="bookId" value="{{$item->book_id}}" />
                                                <input type="hidden" name="price" value="{{$item->price}}" />
                                                <input type="hidden" name="userName" value="{{$user['fullname']}}" />
                                                <input type="hidden" name="useId" value="{{$user['id']}}" />
                                                <input type="hidden" name="total" value="{{$total}}" />
                                                <input type="hidden" name="payment" value="vnpay" />
                                                <input type="hidden" name="__token" value="{{ csrf_token() }}" />
                                                <div class="payment_method">
                                                    <div class="order_button pt-15">
                                                        <button id="proceedToPayBtn" name="redirect" type="submit">{{__('messages.PurchasewithVNPay')}}</button>
                                                    </div>
                                                </div>
                                            </form>
                                        @endif
                                    </td>
                                    <td>
                                        @if(isset($cart))
                                            <form method="post" action="{{route('cart.payment.moMo')}}">
                                                @csrf
                                                <input type="hidden" name="id" value="{{$item->id}}" />
                                                <input type="hidden" name="bookId" value="{{$item->book_id}}" />
                                                <input type="hidden" name="price" value="{{$item->price}}" />
                                                <input type="hidden" name="userName" value="{{$user['fullname']}}" />
                                                <input type="hidden" name="useId" value="{{$user['id']}}" />
                                                <input type="hidden" name="total" value="{{$total}}" />
                                                <input type="hidden" name="__token" value="{{ csrf_token() }}" />
                                                <input type="hidden" name="payment" value="momo" />
                                                <div class="payment_method">
                                                    <div class="order_button pt-15">
                                                        <button name="payUrl" type="submit">{{__('messages.PurchasewithMomo')}}</button>
                                                    </div>
                                                </div>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@endsection
