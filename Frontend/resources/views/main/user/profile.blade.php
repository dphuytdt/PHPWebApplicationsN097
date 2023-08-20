@extends('layouts.main')
@section('content')
@section('title', 'Profile')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.js"></script>
<script type="text/javascript" src="{{asset('js/common/errors.js')}}"></script>
<style>
.personal-image {
  text-align: center;
}
.personal-image input[type="file"] {
  display: none;
}
.personal-figure {
  position: relative;
  width: 120px;
  height: 120px;
}
.personal-avatar {
  cursor: pointer;
  width: 120px;
  height: 120px;
  box-sizing: border-box;
  border-radius: 100%;
  border: 2px solid transparent;
  box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.2);
  transition: all ease-in-out .3s;
}
.personal-avatar:hover {
  box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.5);
}
.personal-figcaption {
  cursor: pointer;
  position: absolute;
  top: 0px;
  width: inherit;
  height: inherit;
  border-radius: 100%;
  opacity: 0;
  background-color: rgba(0, 0, 0, 0);
  transition: all ease-in-out .3s;
}
.personal-figcaption:hover {
  opacity: 1;
  background-color: rgba(0, 0, 0, .5);
}
.personal-figcaption > img {
  margin-top: 32.5px;
  width: 50px;
  height: 50px;
}
</style>

    <!-- ...:::: Start Breadcrumb Section:::... -->
    <div class="breadcrumb-section">
        <div class="breadcrumb-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-12 d-flex justify-content-between justify-content-md-between  align-items-center flex-md-row flex-column">
                        <h3 class="breadcrumb-title">My Profile</h3>
                        {{ Breadcrumbs::render('profile') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        document.addEventListener("DOMContentLoaded", function() {
            const userData = JSON.parse(localStorage.getItem('userProfile'));

            $('#fullname').val(userData.user.fullname);

            if(null === userData.user.user_detail.avatar){
                $('#imageAvatar').attr('src', 'https://static.thenounproject.com/png/5034901-200.png');
            } else {
                $('#imageAvatar').attr('src', 'data:image/'+userData.user.user_detail.image_extension+';base64,'+userData.user.user_detail.avatar);
            }

            $('#email').val(userData.user.email);
            $('#birthday').val(userData.user.user_detail.birthday);
            $('#phone').val(userData.user.user_detail.phone);
            $('#address').val(userData.user.user_detail.address);
            $('#wallet').val(userData.user.user_detail.wallet);

            if (userData && userData.user.user_detail.gender !== null) {
                const maleRadio = document.getElementById('male');
                const femaleRadio = document.getElementById('female');

                if (userData.user.user_detail.gender === 0) {
                    maleRadio.checked = true;
                } else if (userData.user.user_detail.gender === 1) {
                    femaleRadio.checked = true;
                }
            }
        });
    </script>
    <div class="account_dashboard">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-3 col-lg-3">
                    <!-- Nav tabs -->
                    <div class="dashboard_tab_button">
                        <ul role="tablist" class="nav flex-column dashboard-list">
                            <li><a href="#dashboard" data-toggle="tab" class="nav-link active">Dashboard</a></li>
                            <li><a href="#account-details" data-toggle="tab" class="nav-link ">Account details</a></li>
                            <li> <a href="#orders" data-toggle="tab" class="nav-link">Orders</a></li>
                            <li><a href="#address" data-toggle="tab" class="nav-link">History</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-12 col-md-9 col-lg-9">
                    <!-- Tab panes -->
                    <div class="tab-content dashboard_content">
                        <div class="tab-pane fade show active " id="dashboard">
                            <h4>Dashboard </h4>
                            <p>From your account dashboard. you can easily check &amp; view your <a href="#">recent orders</a>, manage your <a href="#">shipping and billing addresses</a> and <a href="#">Edit your password and account details.</a></p>
                        </div>
                        <div class="tab-pane fade" id="orders">
                            <h4>Orders</h4>
                            <div class="table_page table-responsive">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Order</th>
                                            <th>Date</th>
                                            <th>Status</th>
                                            <th>Total</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>May 10, 2018</td>
                                            <td><span class="success">Completed</span></td>
                                            <td>$25.00 for 1 item </td>
                                            <td><a href="cart.html" class="view">view</a></td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>May 10, 2018</td>
                                            <td>Processing</td>
                                            <td>$17.00 for 1 item </td>
                                            <td><a href="cart.html" class="view">view</a></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="downloads">
                            <h4>Downloads</h4>
                            <div class="table_page table-responsive">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Product</th>
                                            <th>Downloads</th>
                                            <th>Expires</th>
                                            <th>Download</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Shopnovilla - Free Real Estate PSD Template</td>
                                            <td>May 10, 2018</td>
                                            <td><span class="danger">Expired</span></td>
                                            <td><a href="#" class="view">Click Here To Download Your File</a></td>
                                        </tr>
                                        <tr>
                                            <td>Organic - ecommerce html template</td>
                                            <td>Sep 11, 2018</td>
                                            <td>Never</td>
                                            <td><a href="#" class="view">Click Here To Download Your File</a></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane" id="address">
                            <p>The following addresses will be used on the checkout page by default.</p>
                            <h5 class="billing-address">Billing address</h5>
                            <a href="#" class="view">Edit</a>
                            <p><strong>Bobby Jackson</strong></p>
                            <address>
                                House #15<br>
                                    Road #1<br>
                                    Block #C <br>
                                    Banasree <br>
                                    Dhaka <br>
                                    1212
                            </address>
                            <p>Bangladesh</p>
                        </div>
                        <div class="tab-pane fade " id="account-details">
                            <h3>Account details </h3>
                            <div class="login">
                                <div class="login_form_container">
                                    <div class="account_login_form">
                                        @if(session()->has('user'))
                                            @php
                                                $user_id = session()->get('user')['id'];
                                            @endphp
                                        @endif
                                        <form action="{{route('profile.update' , $user_id)}}" method="POST">
                                            @csrf
                                            <div class="input-radio">
                                                <span class="custom-radio"><label for="male"></label><input type="radio" value="0" id="male" name="gender"> Mr.</span>
                                                <span class="custom-radio"><label for="female"></label><input type="radio" value="1" id="female" name="gender"> Mrs.</span>
                                            </div>
                                            <br>

                                            <div class="row">
                                                <div class="col-md-6 col-12">
                                                    <div class="default-form-box mb-20">
                                                        <label for="fullname">Full Name</label>
                                                        <input type="text" name="fullname" id="fullname" data-label="Full Name" placeholder="Full Name" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <div class="personal-image">
                                                        <label class="label">
                                                          <input type="file" accept="image/*"  />
                                                          <figure class="personal-figure">
                                                            <img src="https://static.thenounproject.com/png/5034901-200.png" class="personal-avatar" id="imageAvatar" name="imager" alt="avatar">
                                                            <figcaption class="personal-figcaption">
                                                              <img src="https://raw.githubusercontent.com/ThiagoLuizNunes/angular-boilerplate/master/src/assets/imgs/camera-white.png" id="imageUpload" alt="camera">
                                                            </figcaption>
                                                          </figure>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <script type="text/javascript">
                                                // Get the file input element
                                                const fileInput = document.querySelector('input[type="file"]');

                                                // Add an event listener for when a new image is selected
                                                fileInput.addEventListener('change', function() {
                                                const file = fileInput.files[0];

                                                // Check if a file is selected
                                                if (file) {
                                                    const reader = new FileReader();

                                                    // Read the contents of the file
                                                    reader.addEventListener('load', function() {
                                                    const image = document.querySelector('.personal-avatar');

                                                    // Change the source of the image to the newly uploaded image
                                                    image.src = reader.result;
                                                    });

                                                    // Read the file as a data URL
                                                    reader.readAsDataURL(file);
                                                }
                                                });

                                            </script>
                                            <div class="default-form-box mb-20">
                                                <label>Email</label>
                                                <input type="text" id="email" name="email" disabled>
                                            </div>
                                            <div class="default-form-box mb-20">
                                                <label>Birthday</label>
                                                <input type="date" name="birthday" id="birthday" data-label="Birthday" required>
                                            </div>
                                            <span class="example">
                                                  (E.g.: 05/31/1970)
                                                </span>
                                            <br>
                                            <div class="default-form-box mb-20">
                                                <label>Wallet</label>
                                                <input type="text" id="wallet" name="wallet"  disabled>
                                            </div>
                                            <div class="default-form-box mb-20">
                                                <label>Address</label>
                                                <input type="text" id="address" name="address" data-label="Address" required>
                                            </div>
                                            <div class="default-form-box mb-20">
                                                <label for="phone">Phone</label>
                                                <input type="text" name="phone" id="phone" data-label="Phone" required>
                                            </div>
                                            <div class="save_button primary_btn default_button">
                                                <button type="submit">Save</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- ...:::: End Account Dashboard Section:::... -->
    <script type="text/javascript" src="{{asset('js/auth/profile.js')}}"></script>
@endsection
