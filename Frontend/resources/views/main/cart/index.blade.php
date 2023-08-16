@extends('layouts.main')
@section('content')
@section('title', 'Your Cart')
<!-- ...:::: Start Breadcrumb Section:::... -->
<div class="breadcrumb-section">
    <div class="breadcrumb-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-12 d-flex justify-content-between justify-content-md-between  align-items-center flex-md-row flex-column">
                    <h3 class="breadcrumb-title">{{__('messages.caRt')}}</h3>
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
                                    <th class="product_remove">{{__('messages.Delete')}}</th>
                                    <th class="product_thumb">{{__('messages.Image')}}</th>
                                    <th class="product_name">{{__('messages.Title')}}</th>
                                    <th class="product-price">{{__('messages.Price')}}</th>
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
                                    <td class="product_remove"><a id="deleteCart-{{$item->book_id}}" onclick=" return deleteCartItem{{$item->book_id}}"><i class="fa fa-trash-o"></i></a></td>
                                    <td class="product_thumb"><a href="#"><img src="data:image/{{$item->image_extension}};base64,{{ $item->cover_image }}" alt=""></a></td>
                                    <td class="product_name"><a href="#">{{$item->title}}</a></td>
                                    <td class="product-price">£ {{$item->price}}</td>
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
                        <h3>{{__('messages.Delete')}}</h3>
                        <div class="coupon_inner">
                            <p>{{__('messages.Delete')}}</p>
                            <input placeholder="Coupon code" type="text">
                            <button type="submit">{{__('messages.Delete')}}</button>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="coupon_code right">
                        <h3>{{__('messages.cartTotals')}}</h3>
                        <div class="coupon_inner">
                            <div class="cart_subtotal">
                                <p>{{__('messages.Total')}}</p>
                                <p class="cart_amount">${{$subtotal}}</p>
                                <input type="hidden" id="subtotal" name="subtotal" value="{{$subtotal}}">
                            </div>

                            <div class="checkout_btn">
                                @php
                                    $user_id = session()->get('user')['id']
                                @endphp
                                <a href="{{route('cart.checkOut', $user_id)}}">{{__('messages.ProceedtoCheckout')}}</a>
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
