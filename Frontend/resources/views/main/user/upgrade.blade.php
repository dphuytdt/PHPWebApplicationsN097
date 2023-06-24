@extends('layouts.main')
@section('content')
@section('title', 'Upgrade to VIP')

    <!-- ...:::: Start Breadcrumb Section:::... -->
    <div class="breadcrumb-section">
        <div class="breadcrumb-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-12 d-flex justify-content-between justify-content-md-between  align-items-center flex-md-row flex-column">
                        <h3 class="breadcrumb-title">Upgrade to VIP</h3>
                        {{ Breadcrumbs::render('upgrade') }}
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
                {{-- <div class="col-12">
                    <div class="user-actions accordion">
                        <h3>
                            <i class="fa fa-file-o" aria-hidden="true"></i>
                            Returning customer?
                            <a class="Returning" href="#" data-toggle="collapse" data-target="#checkout_login" aria-expanded="true">Click here to login</a>
                        </h3>
                        <div id="checkout_login" class="collapse" data-parent="#checkout_login">
                            <div class="checkout_info">
                                <p>If you have shopped with us before, please enter your details in the boxes below. If you are a new customer please proceed to the Billing &amp; Shipping section.</p>
                                <form action="#">
                                    <div class="form_group default-form-box">
                                        <label>Username or email <span>*</span></label>
                                        <input type="text">
                                    </div>
                                    <div class="form_group default-form-box">
                                        <label>Password <span>*</span></label>
                                        <input type="password">
                                    </div>
                                    <div class="form_group group_3 default-form-box">
                                        <button type="submit">Login</button>
                                        <label class="checkbox-default">
                                            <input type="checkbox">
                                            <span>Remember me</span>
                                        </label>
                                    </div>
                                    <a href="#">Lost your password?</a>
                                </form>
                            </div>
                        </div>
                    </div>
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
                </div> --}}
                <!-- User Quick Action Form -->
            </div>
            <!-- Start User Details Checkout Form -->
            <div class="checkout_form">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <form action="#">
                            <h3>Billing Details</h3>
                            <div class="row">
                                <div class="col-lg-6 mb-20">
                                    <div class="default-form-box">
                                        <label>First Name <span>*</span></label>
                                        <input type="text">
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-20">
                                    <div class="default-form-box">
                                        <label>Last Name <span>*</span></label>
                                        <input type="text">
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-20">
                                    <div class="default-form-box">
                                        <label>Phone<span>*</span></label>
                                        <input type="text">
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-20">
                                    <div class="default-form-box">
                                        <label> Email Address <span>*</span></label>
                                        <input type="text">
                                    </div>
                                </div>
                                {{-- <div class="col-12">
                                    <div class="order-notes">
                                        <label for="order_note">Order Notes</label>
                                        <textarea id="order_note" placeholder="Notes about your order, e.g. special notes for delivery."></textarea>
                                    </div>
                                </div> --}}
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <form action="{{route('checkout') }}" method="POST">
                            @csrf
                            <h3>Your order</h3>
                            <div class="order_table table-responsive">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Service</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td> Upgrade to <strong> VIP Member</strong></td>
                                            <td> $16.00 per month</td>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Choose your plane</th>
                                            <td>
                                                <input name="numberMonth" type="number" placeholder="Number of months" value="1" min="1">
                                            </td>
                                        </tr>
                                        <tr class="order_total">
                                            <th>Order Total</th>
                                            {{-- write a script get input numberMonth value and calculate total --}}
                                            <td name="total"><strong id="total">$16.00</strong></td>
                                            <input type="hidden" name="total" value="368000">
                                        </tr>
                                    </tfoot>
                                </table>
                                <script>
                                    // Lấy tham chiếu đến phần tử input
                                    var inputNumberMonth = document.querySelector('input[name="numberMonth"]');

                                    // Lắng nghe sự kiện khi giá trị trong input thay đổi
                                    inputNumberMonth.addEventListener('input', function() {
                                        // Lấy giá trị mới từ input
                                        var months = parseInt(inputNumberMonth.value);

                                        // Kiểm tra nếu giá trị không phải là một số hợp lệ, đặt giá trị total thành rỗng
                                        if (isNaN(months) || months < 1) {
                                            document.getElementById('total').textContent = '';
                                        } else {
                                            // Tính toán tổng số tiền
                                            var total = months * 16;

                                            // Đặt giá trị total mới vào thẻ strong có id là 'total'
                                            document.getElementById('total').textContent = '$' + total.toFixed(2);
                                        }
                                        //set value for input total
                                        document.querySelector('input[name="total"]').value = total;
                                    });
                                </script>
                            </div>
                            <div class="payment_method">
                                <div class="order_button pt-15">
                                    <button name="payUrl" type="submit">Proceed to Pay</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div> <!-- Start User Details Checkout Form -->
        </div>
    </div><!-- ...:::: End Checkout Section:::... -->
@endsection
