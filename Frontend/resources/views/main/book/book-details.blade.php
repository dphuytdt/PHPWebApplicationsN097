@extends('layouts.main')
@section('title', $result['book']['title'])
@section('content')
<style>
    .highlight {
        background-color: yellow;
    }
    .btn-continue,
    .btn-restart {
        display: none;
    }
</style>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- ...:::: Start Breadcrumb Section:::... -->
    <div class="breadcrumb-section">
        <div class="breadcrumb-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-12 d-flex justify-content-between justify-content-md-between  align-items-center flex-md-row flex-column">
                        <h3 class="breadcrumb-title">Product Details - {{ $result['book']['title'] }}</h3>
                        {{ Breadcrumbs::render('bookDetails', $result['book']) }}
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- ...:::: End Breadcrumb Section:::... -->

    <!-- Start Product Details Section -->
    <div class="product-details-section">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="product-details-gallery-area">
                        <div class="product-large-image product-large-image-horaizontal">
                            <div class="product-image-large-single zoom-image-hover">
                                <img src="{{$result['book']['cover_image']}}" alt="">
                            </div>

                        </div>
                        <div class="product-image-thumb product-image-thumb-horizontal pos-relative">
                            <div class="zoom-active product-image-thumb-single">
                                <img class="img-fluid" src="{{asset('assets/images/products_images/aments_products_image_1.jpg')}}" alt="">
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="product-details-content-area">
                        <!-- Start  Product Details Text Area-->
                        <div class="product-details-text">
                            <h4 class="title">{{$result['book']['title']}}</h4>
                            <div class="d-flex align-items-center">
                                <div class="product-review">
                                    <span class="review-fill"><i class="fa fa-star"></i></span>
                                    <span class="review-fill"><i class="fa fa-star"></i></span>
                                    <span class="review-fill"><i class="fa fa-star"></i></span>
                                    <span class="review-fill"><i class="fa fa-star"></i></span>
                                    <span class="review-empty"><i class="fa fa-star"></i></span>
                                </div>
                                <a href="" class="customer-review">(customer review )</a>
                            </div>
                            {{-- <div class="price"><del>$70.00</del>$80.00</div> --}}
                            @if($result['book']['price'] == 0)
                                <div class="price">Free</div>
                            @else
                                <div class="price">$ {{$result['book']['price']}}</div>
                            @endif
                            <p>{{$result['book']['description']}}</p>
                        </div> <!-- End  Product Details Text Area-->
                        <!-- Start Product Variable Area -->
                        <div class="product-details-variable">
                            <h4 class="title">Available Options</h4>
                            <!-- Product Variable Single Item -->
                            {{-- <div class="variable-single-item">
                                <span>Color</span>
                                <div class="product-variable-color">
                                    <label for="product-color-red">
                                        <input name="product-color" id="product-color-red" class="color-select" type="radio" checked>
                                        <span class="product-color-red"></span>
                                    </label>
                                    <label for="product-color-tomato">
                                        <input name="product-color" id="product-color-tomato" class="color-select" type="radio">
                                        <span class="product-color-tomato"></span>
                                    </label>
                                    <label for="product-color-green">
                                        <input name="product-color" id="product-color-green" class="color-select" type="radio">
                                        <span class="product-color-green"></span>
                                    </label>
                                    <label for="product-color-light-green">
                                        <input name="product-color" id="product-color-light-green" class="color-select" type="radio">
                                        <span class="product-color-light-green"></span>
                                    </label>
                                    <label for="product-color-blue">
                                        <input name="product-color" id="product-color-blue" class="color-select" type="radio">
                                        <span class="product-color-blue"></span>
                                    </label>
                                    <label for="product-color-light-blue">
                                        <input name="product-color" id="product-color-light-blue" class="color-select" type="radio">
                                        <span class="product-color-light-blue"></span>
                                    </label>
                                </div>
                            </div> --}}
                            <!-- Product Variable Single Item -->
                            <div class="d-flex align-items-center">
                                @if(session()->has('user'))
                                    @php
                                        $user = session()->get('user');
                                        $is_vip = $user['is_vip'];
                                    @endphp
                                    @if ($is_vip == 1)
                                        @php
                                            $vip_experied_date = $user['valid_vip'];
                                            $today = date("Y-m-d");
                                            $vip_experied_date = date("d-m-Y", strtotime($vip_experied_date));
                                            $today = date("d-m-Y", strtotime($today));
                                            //use strtotime function to convert date into timestamp then subtract the two dates then use floor function to convert seconds into days
                                            $diff = floor(strtotime($vip_experied_date) - strtotime($today))/ (60 * 60 * 24);
                                        @endphp
                                        @if ($diff < 0)
{{--                                            <div class="variable-single-item ">--}}
{{--                                                <span>Quantity Available</span>--}}
{{--                                                <div class="product-variable-quantity">--}}
{{--                                                    <input  value="{{$result['book']['quantity']}}" type="text" readonly disabled>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
                                            <div class="product-add-to-cart-btn">
                                                <a href="#" data-toggle="modal" data-target="#modalAddcart">Add To Cart</a>
                                            </div>
                                        @else
                                            @if($result['book']['is_vip_valid'] == 1)
                                                <div class="product-add-to-cart-btn">
                                                    <a href="#" data-toggle="modal" data-target=".bd-example-modal-lg-{{$result['book']['id']}}">Read now</a>
                                                </div>
                                            @else
{{--                                                <div class="variable-single-item ">--}}
{{--                                                    <span>Quantity Available</span>--}}
{{--                                                    <div class="product-variable-quantity">--}}
{{--                                                        <input  value="{{$result['book']['quantity']}}" type="text" readonly disabled>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
                                                <div class="product-add-to-cart-btn">
                                                    <a href="#" data-toggle="modal" data-target="#modalAddcart">Add To Cart</a>
                                                </div>
                                            @endif
                                        @endif
                                    @else
                                        @if ($result['book']['price'] == 0)
                                            <div class="product-add-to-cart-btn">
                                                <a href="#" data-toggle="modal" data-target=".bd-example-modal-lg-{{$result['book']['id']}}">Read now</a>
                                            </div>
                                        @else
{{--                                            <div class="variable-single-item ">--}}
{{--                                                <span>Quantity Available</span>--}}
{{--                                                <div class="product-variable-quantity">--}}
{{--                                                    <input  value="{{$result['book']['quantity']}}" type="text" readonly disabled>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
                                            <div class="product-add-to-cart-btn">
                                                <a href="#" data-toggle="modal" data-target="#modalAddcart">Add To Cart</a>
                                            </div>
                                        @endif
                                    @endif
                                @else
                                    @if ($result['book']['price'] == 0)
                                        <div class="product-add-to-cart-btn">
                                            <a href="#" data-toggle="modal" data-target=".bd-example-modal-lg-{{$result['book']['id']}}">Read now</a>
                                        </div>
                                    @else
{{--                                        <div class="variable-single-item ">--}}
{{--                                            <span>Quantity Available</span>--}}
{{--                                            <div class="product-variable-quantity">--}}
{{--                                                <input  value="{{$result['book']['quantity']}}" type="text" readonly disabled>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
                                        <div class="product-add-to-cart-btn">
                                            <a href="#" data-toggle="modal" data-target="#modalAddcart">Add To Cart</a>
                                        </div>
                                    @endif
                                @endif
                                <div class="product-add-to-cart-btn">
                                    <button class="btn-continue">Continue</button>
                                </div>
                                <div class="product-add-to-cart-btn">
                                    <button class="btn-restart">Restart</button>
                                </div>
                            </div>
                        </div> <!-- End Product Variable Area -->
                        <!-- Start  Product Details Meta Area-->
                        <br>
                        <div class="product-details-meta mb-20">
                            <ul>
                                <li><a href=""><i class="icon-heart"></i>Add to wishlist</a></li>
                                <li><a href=""><i class="icon-repeat"></i>Compare</a></li>
                            </ul>
                        </div> <!-- End  Product Details Meta Area-->
                        <!-- Start  Product Details Social Area-->
                        {{-- <div class="product-details-social">
                            <ul>
                                <li><a href="#" class="facebook"><i class="fa fa-facebook"></i>Like</a></li>
                                <li><a href="#" class="twitter"><i class="fa fa-twitter"></i>Tweet</a></li>
                                <li><a href="#" class="pinterest"><i class="fa fa-pinterest"></i>Save</a></li>
                                <li><a href="#" class="google-plus"><i class="fa fa-google-plus"></i>Save</a></li>
                                <li><a href="#" class="linkedin"><i class="fa fa-linkedin"></i>Linked</a></li>
                            </ul>
                        </div> <!-- End  Product Details Social Area--> --}}
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End Product Details Section -->

    <!-- Start Product Content Tab Section -->
    <div class="product-details-content-tab-section section-inner-bg section-top-gap-100">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="product-details-content-tab-wrapper">

                        <!-- Start Product Details Tab Button -->
                        <ul class="nav tablist product-details-content-tab-btn d-flex justify-content-center">
                            <li><a class="nav-link active" data-toggle="tab" href="#description">
                                    <h5>Description</h5>
                                </a></li>
                            <li><a class="nav-link" data-toggle="tab" href="#specification">
                                    <h5>Specification</h5>
                                </a></li>
                            <li><a class="nav-link" data-toggle="tab" href="#review">
                                    <h5>Reviews (1)</h5>
                                </a></li>
                        </ul> <!-- End Product Details Tab Button -->

                        <!-- Start Product Details Tab Content -->
                        <div class="product-details-content-tab">
                            <div class="tab-content">
                                <!-- Start Product Details Tab Content Singel -->
                                <div class="tab-pane active show" id="description">
                                    <div class="single-tab-content-item">
                                        <p>{{$result['book']['description']}}</p>
                                    </div>
                                </div> <!-- End Product Details Tab Content Singel -->
                                <!-- Start Product Details Tab Content Singel -->
                                <div class="tab-pane" id="specification">
                                    <div class="single-tab-content-item">
                                        <table class="table table-bordered mb-20">
                                            <tbody>
                                                <tr>
                                                    <th scope="row">Compositions</th>
                                                    <td>Polyester</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Styles</th>
                                                    <td>Girly</td>
                                                <tr>
                                                    <th scope="row">Properties</th>
                                                    <td>Short Dress</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <p>Fashion has been creating well-designed collections since 2010. The brand offers feminine designs delivering stylish separates and statement dresses which have since evolved into a full ready-to-wear collection in which every item is a vital part of a woman's wardrobe. The result? Cool, easy, chic looks with youthful elegance and unmistakable signature style. All the beautiful pieces are made in Italy and manufactured with the greatest attention. Now Fashion extends to a range of accessories including shoes, hats, belts and more!</p>
                                    </div>
                                </div> <!-- End Product Details Tab Content Singel -->
                                <!-- Start Product Details Tab Content Singel -->
                                <div class="tab-pane" id="review">
                                    <div class="single-tab-content-item">
                                        <!-- Start - Review Comment -->
                                        <ul class="comment">
                                            <!-- Start - Review Comment list-->
                                            <li class="comment-list">
                                                @foreach ($result['comments'] as $comment)
                                                    @if($comment['comment_parent_id'] == null)
                                                    <div class="comment-wrapper">
                                                        <div class="comment-img">
                                                            <img src="assets/images/user/image-1.png" alt="">
                                                        </div>
                                                        <div class="comment-content">
                                                            <div class="comment-content-top">
                                                                <div class="comment-content-left">
                                                                    <h6 class="comment-name">Kaedyn Fraser</h6>
                                                                    <div class="product-review">
                                                                        <span class="review-fill"><i class="fa fa-star"></i></span>
                                                                        <span class="review-fill"><i class="fa fa-star"></i></span>
                                                                        <span class="review-fill"><i class="fa fa-star"></i></span>
                                                                        <span class="review-fill"><i class="fa fa-star"></i></span>
                                                                        <span class="review-empty"><i class="fa fa-star"></i></span>
                                                                    </div>
                                                                </div>
                                                                <div class="comment-content-right">
                                                                    <a href="#"><i class="fa fa-reply"></i>Reply</a>
                                                                </div>
                                                            </div>

                                                            <div class="para-content">
                                                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempora inventore dolorem a unde modi iste odio amet, fugit fuga aliquam, voluptatem maiores animi dolor nulla magnam ea! Dignissimos aspernatur cumque nam quod sint provident modi alias culpa, inventore deserunt accusantium amet earum soluta consequatur quasi eum eius laboriosam, maiores praesentium explicabo enim dolores quaerat! Voluptas ad ullam quia odio sint sunt. Ipsam officia, saepe repellat. </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @else

                                                    <!-- Start - Review Comment Reply-->
                                                    <ul class="comment-reply">
                                                        <li class="comment-reply-list">
                                                            <div class="comment-wrapper">
                                                                <div class="comment-img">
                                                                    <img src="assets/images/user/image-2.png" alt="">
                                                                </div>
                                                                <div class="comment-content">
                                                                    <div class="comment-content-top">
                                                                        <div class="comment-content-left">
                                                                            <h6 class="comment-name">Oaklee Odom</h6>
                                                                        </div>
                                                                        <div class="comment-content-right">
                                                                            <a href="#"><i class="fa fa-reply"></i>Reply</a>
                                                                        </div>
                                                                    </div>

                                                                    <div class="para-content">
                                                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempora inventore dolorem a unde modi iste odio amet, fugit fuga aliquam, voluptatem maiores animi dolor nulla magnam ea! Dignissimos aspernatur cumque nam quod sint provident modi alias culpa, inventore deserunt accusantium amet earum soluta consequatur quasi eum eius laboriosam, maiores praesentium explicabo enim dolores quaerat! Voluptas ad ullam quia odio sint sunt. Ipsam officia, saepe repellat. </p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    </ul> <!-- End - Review Comment Reply-->
                                                    @endif
                                                @endforeach
                                            </li> <!-- End - Review Comment list-->
                                            {{-- <!-- Start - Review Comment list-->
                                            <li class="comment-list">
                                                <div class="comment-wrapper">
                                                    <div class="comment-img">
                                                        <img src="assets/images/user/image-3.png" alt="">
                                                    </div>
                                                    <div class="comment-content">
                                                        <div class="comment-content-top">
                                                            <div class="comment-content-left">
                                                                <h6 class="comment-name">Jaydin Jones</h6>
                                                                <div class="product-review">
                                                                    <span class="review-fill"><i class="fa fa-star"></i></span>
                                                                    <span class="review-fill"><i class="fa fa-star"></i></span>
                                                                    <span class="review-fill"><i class="fa fa-star"></i></span>
                                                                    <span class="review-fill"><i class="fa fa-star"></i></span>
                                                                    <span class="review-empty"><i class="fa fa-star"></i></span>
                                                                </div>
                                                            </div>
                                                            <div class="comment-content-right">
                                                                <a href="#"><i class="fa fa-reply"></i>Reply</a>
                                                            </div>
                                                        </div>

                                                        <div class="para-content">
                                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempora inventore dolorem a unde modi iste odio amet, fugit fuga aliquam, voluptatem maiores animi dolor nulla magnam ea! Dignissimos aspernatur cumque nam quod sint provident modi alias culpa, inventore deserunt accusantium amet earum soluta consequatur quasi eum eius laboriosam, maiores praesentium explicabo enim dolores quaerat! Voluptas ad ullam quia odio sint sunt. Ipsam officia, saepe repellat. </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li> <!-- End - Review Comment list--> --}}
                                        </ul> <!-- End - Review Comment -->
                                        <div class="review-form">
                                            @if(session()->has('user'))
                                                <div class="review-form-text-top">
                                                    <h5>ADD A REVIEW</h5>
                                                    <p>Your email address will not be published. Required fields are marked *</p>
                                                </div>

                                                <form action="#" method="post">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="default-form-box mb-20">
                                                                <label for="comment-name">Your name <span>*</span></label>
                                                                <input id="comment-name" type="text" placeholder="Enter your name" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="default-form-box mb-20">
                                                                <label for="comment-email">Your Email <span>*</span></label>
                                                                <input id="comment-email" type="email" placeholder="Enter your email" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="default-form-box mb-20">
                                                                <label for="comment-review-text">Your review <span>*</span></label>
                                                                <textarea id="comment-review-text" placeholder="Write a review" required></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <button class="form-submit-btn" type="submit">Submit</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            @else
                                                <div class="review-form-text-top">
                                                    <h5>ADD A REVIEW</h5>
                                                    <p>Only logged in customers who have purchased this product may leave a review. </p>
                                                </div>
                                                <div class="row">
                                                    <div class="col-12">
                                                        <a href="{{ route('login') }}" class="btn btn-lg btn-block btn-primary">Login Now</a>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div> <!-- End Product Details Tab Content Singel -->
                            </div>
                        </div> <!-- End Product Details Tab Content -->

                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End Product Content Tab Section -->

    <!-- ...:::: Start Product  Section:::... -->
    <div class="product-section section-top-gap-100">
        <!-- Start Section Content -->
        <div class="section-content-gap">
            <div class="container">
                <div class="row">
                    <div class="section-content">
                        <h3 class="section-title">Related Products</h3>
                    </div>
                </div>
            </div>
        </div> <!-- End Section Content -->

        <!-- Start Product Wrapper -->
        <div class="product-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="product-default-slider product-default-slider-4grids-1row">
                            <!-- Start Product Defautlt Single -->
                            <div class="product-default-single border-around">
                                <div class="product-img-warp">
                                    <a href="product-details-default.html" class="product-default-img-link">
                                        <img src="assets/images/products_images/aments_products_image_1.jpg" alt="" class="product-default-img img-fluid">
                                    </a>
                                    <div class="product-action-icon-link">
                                        <ul>
                                            <li><a href="wishlist.html"><i class="icon-heart"></i></a></li>
                                            <li><a href="compare.html"><i class="icon-repeat"></i></a></li>
                                            <li><a href="#" data-toggle="modal" data-target="#modalQuickview"><i class="icon-eye"></i></a></li>
                                            <li><a href="#" data-toggle="modal" data-target="#modalAddcart"><i class="icon-shopping-cart"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="product-default-content">
                                    <h6 class="product-default-link"><a href="product-details-default.html">New Balance Fresh Foam Kaymin Car Purts</a></h6>
                                    <span class="product-default-price"><del class="product-default-price-off">$30.12</del> $25.12</span>
                                </div>
                            </div> <!-- End Product Defautlt Single -->
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- End Product Wrapper -->
    </div> <!-- ...:::: End Product Section:::... -->

    <!-- ...:::: Start Product Section:::... -->
    <div class="product-section section-top-gap-100">
        <!-- Start Section Content -->
        <div class="section-content-gap">
            <div class="container">
                <div class="row">
                    <div class="section-content">
                        <h3 class="section-title">Upsell Products</h3>
                    </div>
                </div>
            </div>
        </div> <!-- End Section Content -->

        <!-- Start Product Wrapper -->
        <div class="product-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="product-default-slider product-default-slider-4grids-1row">
                            <!-- Start Product Defautlt Single -->
                            <div class="product-default-single border-around">
                                <div class="product-img-warp">
                                    <a href="product-details-default.html" class="product-default-img-link">
                                        <img src="assets/images/products_images/aments_products_image_1.jpg" alt="" class="product-default-img img-fluid">
                                    </a>
                                    <div class="product-action-icon-link">
                                        <ul>
                                            <li><a href="wishlist.html"><i class="icon-heart"></i></a></li>
                                            <li><a href="compare.html"><i class="icon-repeat"></i></a></li>
                                            <li><a href="#" data-toggle="modal" data-target="#modalQuickview"><i class="icon-eye"></i></a></li>
                                            <li><a href="#" data-toggle="modal" data-target="#modalAddcart"><i class="icon-shopping-cart"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="product-default-content">
                                    <h6 class="product-default-link"><a href="product-details-default.html">New Balance Fresh Foam Kaymin Car Purts</a></h6>
                                    <span class="product-default-price"><del class="product-default-price-off">$30.12</del> $25.12</span>
                                </div>
                            </div> <!-- End Product Defautlt Single -->
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- End product Wrapper -->
    </div> <!-- ...:::: End Product Section:::... -->

    <!-- Large modal -->

    <div class="modal fade bd-example-modal-lg-{{$result['book']['id']}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">>
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{$result['book']['title']}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{-- display content here with scroll bar --}}
                    <div class="row">
                        <div class="col-md-6">
                            <img src="{{$result['book']['cover_image']}}" alt="" class="img-fluid">
                        </div>
                        <div class="col-md-6">
                            <h3>{{$result['book']['title']}}</h3>
                            <p>{{$result['book']['description']}}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <style type="text/css">
                                .center {
                                    display: block;
                                    margin-left: auto;
                                    margin-right: auto;
                                    width: 50%;
                                }
                                .content {
                                    text-align: justify;
                                    text-justify: inter-word;
                                    /* căn đều 2 bên */
                                    padding-left: 30px;
                                    padding-right: 30px;

                                }
                            </style>
                            <br>
                            <h3 class="text-center">Start Reading</h3>
                            @if($result['book']['content_type'] == '1')
                            <div class="content">
                                <p>{{$result['book']['content']}}</p>
                            @else
                            <div class="content">
                                <img src="{{$result['book']['content']}}" alt="" class="center">
                            @endif
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Bookmarked</button>
                </div>
            </div>
                </div>
            </div>
        </div>
    </div>
@endsection
