@extends('layouts.main') @section('content') @section('title', 'Profile')
<script
    src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"
    integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw=="
    crossorigin="anonymous"
    referrerpolicy="no-referrer"
></script>
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
        transition: all ease-in-out 0.3s;
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
        transition: all ease-in-out 0.3s;
    }
    .personal-figcaption:hover {
        opacity: 1;
        background-color: rgba(0, 0, 0, 0.5);
    }
    .personal-figcaption > img {
        margin-top: 32.5px;
        width: 50px;
        height: 50px;
    }
</style>

<div class="breadcrumb-section">
    <div class="breadcrumb-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-12 d-flex justify-content-between justify-content-md-between align-items-center flex-md-row flex-column">
                    <h3 class="breadcrumb-title">{{__('messages.MyProfile')}}</h3>
                    {{ Breadcrumbs::render('profile') }}
                </div>
            </div>
        </div>
    </div>
</div>
<div class="account_dashboard">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-3 col-lg-3">
                <div class="dashboard_tab_button">
                    <ul role="tablist" class="nav flex-column dashboard-list">
                        <li><a href="#dashboard" data-toggle="tab" class="nav-link active">{{__('messages.Dashboard')}}</a></li>
                        <li><a href="#account-details" data-toggle="tab" class="nav-link">{{__('messages.AccountDetails')}}</a></li>
                        <li><a href="#orders" data-toggle="tab" class="nav-link">{{__('messages.Orders')}}</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-sm-12 col-md-9 col-lg-9">
                <div class="tab-content dashboard_content">
                    <div class="tab-pane fade show active" id="dashboard">
                        <h4>{{__('messages.Dashboard')}}</h4>
                        <p>
                            {{__('messages.FromYourAccount')}} &amp; {{__('messages.viewyour')}} <a href="#">{{__('messages.recentorders')}} </a>{{__('messages.manageyour')}}
                            <a href="#">{{__('messages.shipping and billing addresses')}}</a>
                            {{__('messages.and')}}
                            <a href="#">{{__('messages.Edit your account details')}} </a>
                        </p>
                    </div>
                    <div class="tab-pane fade" id="orders">
                        <h4>{{__('messages.Orders')}}</h4>
                        <div class="table_page table-responsive">
                            <table>
                                <thead>
                                <tr>
                                    <th>{{__('messages.Order')}}</th>
                                    <th>{{__('messages.Date')}}</th>
                                    <th>{{__('messages.PaymentMethod')}}</th>
                                    <th>{{__('messages.Total')}}</th>
                                    <th>{{__('messages.Actions')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($orderHistory as $order)
                                    <tr>
                                        <td>{{$order['id']}}</td>
                                        <td>{{$order['created_at']}}</td>
                                        <td><span class="success">{{$order['payment_method']}}</span></td>
                                        <td>{{$order['total_price']}}</td>
                                        <td><a href="{{URL::to('/book-details/'.$order['book_id'])}}">{{__('messages.View')}}</a></td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="account-details">
                        <h3>{{__('messages.Accountdetails')}}</h3>
                        <div class="login">
                            <div class="login_form_container">
                                <div class="account_login_form">
                                    @if(session()->has('user')) @php $user_id = session()->get('user')['id']; @endphp @endif
                                    <form action="{{route('profile.update' , $user_id)}}" method="POST">
                                        @csrf
                                        <div class="input-radio">
                                            <span class="custom-radio">
                                                <label for="male"></label>
                                                <input type="radio" value="0" id="male" name="gender" @if($user['user']['user_detail']['gender'] === 1) @endif /> Mr.</span>
                                            <span class="custom-radio">
                                                <label for="female"></label>
                                                <input type="radio" value="0" id="female" name="gender" @if($user['user']['user_detail']['gender'] === 0) @endif /> Mrs.</span>
                                        </div>
                                        <br />

                                        <div class="row">
                                            <div class="col-md-6 col-12">
                                                <div class="default-form-box mb-20">
                                                    <label for="fullname">{{__('messages.Full Name')}}</label>
                                                    <input type="text" name="fullname" id="fullname" data-label="Full Name" placeholder="Full Name" value="{{$user['user']['fullname']}}" required />
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="personal-image">
                                                    <label class="label">
                                                        <input type="file" accept="image/*" />
                                                        <figure class="personal-figure">
                                                            @if($user['user']['user_detail']['avatar'] === null)
                                                                <img src="https://static.thenounproject.com/png/5034901-200.png" class="personal-avatar" id="imageAvatar" name="image" alt="avatar" />
                                                            @else
                                                                <img src="{{ Storage::disk('dropbox')->url($user['user']['user_detail']['avatar']) }}" class="personal-avatar" id="imageAvatar" name="image" alt="avatar" />
                                                            @endif
                                                            <figcaption class="personal-figcaption">
                                                                <img src="https://raw.githubusercontent.com/ThiagoLuizNunes/angular-boilerplate/master/src/assets/imgs/camera-white.png" id="imageUpload" alt="camera" />
                                                            </figcaption>
                                                        </figure>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="default-form-box mb-20">
                                            <label>{{__('messages.Email')}}</label>
                                            <input type="text" id="email" name="email" data-label="Email" placeholder="Email" value="{{$user['user']['email']}}" disabled />
                                        </div>
                                        <div class="default-form-box mb-20">
                                            <label>{{__('messages.Birthday')}}</label>
                                            <input type="date" name="birthday" id="birthday" data-label="Birthday" value="{{$user['user']['user_detail']['birthday']}}" required />
                                        </div>
                                        <span class="example">
                                            (E.g.: 05/31/1970)
                                        </span>
                                        <br />
                                        <div class="default-form-box mb-20">
                                            <label>{{__('messages.Address')}}</label>
                                            <input type="text" id="address" name="address" data-label="Address" value="{{$user['user']['user_detail']['address']}}" required />
                                        </div>
                                        <div class="default-form-box mb-20">
                                            <label for="phone">{{__('messages.Phone')}}</label>
                                            <input type="text" name="phone" id="phone" data-label="Phone" placeholder="Phone" value="{{$user['user']['user_detail']['phone']}}" required />
                                        </div>
                                        <div class="save_button primary_btn default_button">
                                            <button type="submit">{{__('messages.Save')}}</button>
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
</div>
<script type="text/javascript" src="{{asset('js/auth/profile.js')}}"></script>
<script type="text/javascript">
    const fileInput = document.querySelector('input[type="file"]');
    fileInput.addEventListener("change", function () {
        const file = fileInput.files[0];

        if (file) {
            const reader = new FileReader();
            reader.addEventListener("load", function () {
                const image = document.querySelector(".personal-avatar");
                image.src = reader.result;
            });
            reader.readAsDataURL(file);
        }
    });
</script>
@endsection
