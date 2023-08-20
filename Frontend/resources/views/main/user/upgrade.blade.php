@extends('layouts.main') @section('content') @section('title', 'Upgrade to VIP')

<!-- ...:::: Start Breadcrumb Section:::... -->
<div class="breadcrumb-section">
    <div class="breadcrumb-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-12 d-flex justify-content-between justify-content-md-between align-items-center flex-md-row flex-column">
                    <h3 class="breadcrumb-title">Upgrade to VIP</h3>
                    {{ Breadcrumbs::render('upgrade') }}
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ...:::: End Breadcrumb Section:::... -->

<!-- ...:::: Start Checkout Section:::... -->
<div class="checkout_section">
    <div class="container">
        <div class="checkout_form">
            <div class="row">
                <div class="col-lg-6 col-md-6">
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
                                <td>Upgrade to <strong> VIP Member</strong></td>
                                <td>$16.00 per month</td>
                            </tr>
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>Choose your plane</th>
                                <td>
                                    <input name="numberMonth" type="number" placeholder="Number of months" value="1" min="1" />
                                </td>
                            </tr>
                            <tr class="order_total">
                                <th>Order Total</th>
                                {{-- write a script get input numberMonth value and calculate total --}}
                                <td name="total"><strong id="total">$16.00</strong></td>
                                <input type="hidden" name="total" value="368000" />
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                    @php $user = session()->get('user'); @endphp
                    <div class="col-lg-6 col-md-6">
                        <form action="{{route('checkout.VNPay')}}" method="POST">
                            @csrf
                            <input type="hidden" name="useId" value="{{$user['id']}}" />
                            <input type="hidden" name="userName" value="{{$user['fullname']}}" />
                            <input type="hidden" name="total" value="16" id="totalValueInput" />
                            <div class="payment_method">
                                <div class="order_button pt-15">
                                    <button name="redirect" type="submit">Proceed to Pay With VNPay</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <form action="{{route('checkout.Momo')}}" method="POST">
                            @csrf
                            <input type="hidden" name="useId" value="{{$user['id']}}" />
                            <input type="hidden" name="total" value="16" id="totalValueInput" />
                            <div class="payment_method">
                                <div class="order_button pt-15">
                                    <button name="payUrl" type="submit">Proceed to Pay With Momo</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Start User Details Checkout Form -->
    </div>
</div>
<!-- ...:::: End Checkout Section:::... -->
<script>
    // Lấy tham chiếu đến phần tử input
    var inputNumberMonth = document.querySelector('input[name="numberMonth"]');
    var totalValueInput = document.getElementById("totalValueInput");
    // Lắng nghe sự kiện khi giá trị trong input thay đổi
    inputNumberMonth.addEventListener("input", function () {
        // Lấy giá trị mới từ input
        var months = parseInt(inputNumberMonth.value);

        // Kiểm tra nếu giá trị không phải là một số hợp lệ, đặt giá trị total thành rỗng
        if (isNaN(months) || months < 1) {
            document.getElementById("total").textContent = "";
        } else {
            // Tính toán tổng số tiền
            var total = months * 16;

            // Đặt giá trị total mới vào thẻ strong có id là 'total'
            document.getElementById("total").textContent = "$" + total.toFixed(2);
            totalValueInput.value = total;
        }
        //set value for input total
        document.querySelector('input[name="total"]').value = total;
    });
</script>
@endsection
