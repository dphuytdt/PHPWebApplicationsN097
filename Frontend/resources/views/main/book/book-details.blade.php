@extends('layouts.main') @section('title', $result['book']['title']) @section('content')
    <style>
        .highlight {
            background-color: yellow;
        }
        .btn-continue,
        .btn-restart {
            display: none;
        }
        .disable-print .toolbarButton.print {
            display: none !important;
        }
        .no-scroll {
            overflow: hidden;
        }

        #pdf-wrapper {
            height: 100%;
        }

        #pdf-iframe {
            width: 100%;
            height: 100%;
            border: none;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.8.335/pdf.min.js"></script>
    <div class="breadcrumb-section">
        <div class="breadcrumb-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-12 d-flex justify-content-between justify-content-md-between align-items-center flex-md-row flex-column">
                        <h3 class="breadcrumb-title">{{__('messages.productDetails')}} {{ $result['book']['title'] }}</h3>
                        {{ Breadcrumbs::render('bookDetails', $result['book']) }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="product-details-section">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="product-details-gallery-area">
                        <div class="product-large-image product-large-image-horaizontal">
                            <div class="product-image-large-single zoom-image-hover">
                                <img src="data:image/{{$result['book']['image_extension']}};base64,{{ $result['book']['cover_image'] }}" alt="" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="product-details-content-area">
                        <div class="product-details-text">
                            <h4 class="title">{{$result['book']['title']}}</h4>
                            <div class="d-flex align-items-center">
                                <div class="product-review">
                                    @php $rating = $result['book']['rating']; $rating = round($rating); @endphp @if($rating == 0)
                                        <span class="review-none">No review (Review now)</span>
                                        <br />
                                    @else for ($i = 1; $i <= 5; $i++) { if ($i <= $rating) { echo ' <span class="review-fill"><i class="fa fa-star"></i></span>'; } else { echo '<span class=""><i class="fa fa-star"></i></span>'; } } @endif
                                    <span class=""><i class="fa fa-star"></i></span>
                                    <span class=""><i class="fa fa-star"></i></span>
                                    <span class=""><i class="fa fa-star"></i></span>
                                    <span class=""><i class="fa fa-star"></i></span>
                                    <span class=""><i class="fa fa-star"></i></span>
                                </div>
                            </div>
                            @if($result['book']['price'] == 0)
                                <div class="price">Free</div>
                            @else
                                <div class="price">$ {{$result['book']['price']}}</div>
                            @endif
                            <p>{{$result['book']['description']}}</p>
                        </div>
                        <div class="product-details-variable">
                            <h4 class="title">Available Options</h4>
                            <div class="d-flex align-items-center">
                                @if(session()->has('user')) @php $user = session()->get('user'); $is_vip = $user['is_vip']; @endphp @if($user['role'] === 'ROLE_ADMIN')
                                    <div class="product-add-to-cart-btn">
                                        <a href="#" data-toggle="modal" data-target=".bd-example-modal-lg-{{$result['book']['id']}}">{{__('messages.readNow')}}</a>
                                    </div>
                                @elseif($is_vip == 1) @php $vip_experied_date = $user['valid_vip']; $today = date("Y-m-d"); $vip_experied_date = date("d-m-Y", strtotime($vip_experied_date)); $today = date("d-m-Y", strtotime($today)); $diff =
                            floor(strtotime($vip_experied_date) - strtotime($today))/ (60 * 60 * 24); @endphp @if ($diff < 0)
                                        <div class="product-add-to-cart-btn">
                                            <a id="addCartDetails" href="{{route('cart.add')}}" data-toggle="modal" data-target="#modalAddcart">{{__('messages.addToCart')}}</a>
                                        </div>
                                    @else @if($result['book']['is_vip_valid'] == 1)
                                            <div class="product-add-to-cart-btn">
                                                <a href="#" data-toggle="modal" data-target=".bd-example-modal-lg-{{$result['book']['id']}}">{{__('messages.readNow')}}</a>
                                            </div>
                                        @else
                                            <div class="product-add-to-cart-btn">
                                                <a id="addCartDetails" href="#" data-toggle="modal" data-target="#modalAddcart">{{__('messages.addToCart')}}</a>
                                            </div>
                                        @endif @endif @else @if ($result['book']['price'] == 0)
                                        <div class="product-add-to-cart-btn">
                                            <a href="#" data-toggle="modal" data-target=".bd-example-modal-lg-{{$result['book']['id']}}">{{__('messages.readNow')}}</a>
                                        </div>
                                    @else
                                        <div class="product-add-to-cart-btn">
                                            <a id="addCartDetails" href="" data-toggle="modal" data-target="#modalAddcart">{{__('messages.addToCart')}}</a>
                                        </div>
                                    @endif @endif @else
                                    <div class="product-add-to-cart-btn">
                                        <a href="{{route('login')}}">{{__('messages.plsLogin')}}</a>
                                    </div>
                                @endif
                                <div class="product-add-to-cart-btn">
                                    <button class="btn-continue">{{__('messages.Continue')}}</button>
                                </div>
                                <div class="product-add-to-cart-btn">
                                    <button class="btn-restart">{{__('messages.Restart')}}</button>
                                </div>
                                <input type="hidden" name="_token" value="{{csrf_token()}}" />
                            </div>

                            @if(session()->has('user'))
                                <script type="text/javascript">
                                    //write axios to add to cart
                                    $(document).ready(function(){
                                        $('#addCartDetails').click(function(e){
                                            e.preventDefault();
                                            var userID = {{session()->get('user')['id']}};
                                            var bookID = {{$result['book']['id']}};
                                            var bookTitle = "{{$result['book']['title']}}";
                                            var bookPrice = {{$result['book']['price']}};
                                            var bookImage = "{{$result['book']['cover_image']}}";
                                            var _token = $('input[name="_token"]').val();
                                            $.ajax({
                                                url: "{{route('cart.add')}}",
                                                type: "POST",
                                                data: {
                                                    userID: userID,
                                                    bookID: bookID,
                                                    bookTitle: bookTitle,
                                                    bookPrice: bookPrice,
                                                    bookImage: bookImage,
                                                    _token: _token
                                                },
                                                success: function(response){
                                                    if(response){
                                                        swal({
                                                            title: "Success!",
                                                            text: "Add to cart successfully!",
                                                            icon: "success",
                                                            button: "OK",
                                                        }).then((value) => {
                                                            location.reload();
                                                        });
                                                    } else {
                                                        swal({
                                                            title: "Error!",
                                                            text: "Add to cart failed!",
                                                            icon: "error",
                                                            button: "OK",
                                                        }).then((value) => {
                                                            location.reload();
                                                        });
                                                    }
                                                }
                                            });
                                        });
                                    });
                                </script>
                            @endif
                        </div>
                        <br />
                        <div class="product-details-meta mb-20">
                            <ul>
                                @if(session()->has('user'))
                                    <li>
                                        <a href="" id="addToWishlistDetails"><i class="icon-heart"></i>{{__('messages.addToWishlist')}}s</a>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="product-details-content-tab-section section-inner-bg section-top-gap-100">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="product-details-content-tab-wrapper">
                        <!-- Start Product Details Tab Button -->
                        <ul class="nav tablist product-details-content-tab-btn d-flex justify-content-center">
                            <li>
                                <a class="nav-link active" data-toggle="tab" href="#description">
                                    <h5>{{__('messages.Description')}}</h5>
                                </a>
                            </li>
                            <li>
                                <a class="nav-link" data-toggle="tab" href="#specification">
                                    <h5>{{__('messages.Specification')}}</h5>
                                </a>
                            </li>
                            <li>
                                <a class="nav-link" data-toggle="tab" href="#review">
                                    <h5>{{__('messages.Reviews')}}</h5>
                                </a>
                            </li>
                        </ul>
                        <!-- End Product Details Tab Button -->

                        <!-- Start Product Details Tab Content -->
                        <div class="product-details-content-tab">
                            <div class="tab-content">
                                <!-- Start Product Details Tab Content Singel -->
                                <div class="tab-pane active show" id="description">
                                    <div class="single-tab-content-item">
                                        <p>{{$result['book']['description']}}</p>
                                    </div>
                                </div>
                                <!-- End Product Details Tab Content Singel -->
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
                                            </tr>

                                            <tr>
                                                <th scope="row">Properties</th>
                                                <td>Short Dress</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                        <p>
                                            Fashion has been creating well-designed collections since 2010. The brand offers feminine designs delivering stylish separates and statement dresses which have since evolved into a full ready-to-wear
                                            collection in which every item is a vital part of a woman's wardrobe. The result? Cool, easy, chic looks with youthful elegance and unmistakable signature style. All the beautiful pieces are made in
                                            Italy and manufactured with the greatest attention. Now Fashion extends to a range of accessories including shoes, hats, belts and more!
                                        </p>
                                    </div>
                                </div>
                                <!-- End Product Details Tab Content Singel -->
                                <!-- Start Product Details Tab Content Singel -->
                                <div class="tab-pane" id="review">
                                    <div class="single-tab-content-item">
                                        <!-- Start - Review Comment -->
                                        <ul class="comment">
                                            <!-- Start - Review Comment list-->
                                            <li class="comment-list">
                                                @foreach ($result['comments'] as $comment) @if(null === $comment['comment_parent_id'])
                                                    <div class="comment-wrapper">
                                                        <div class="comment-img">
                                                            <img src="{{asset('assets/images/user/image-1.png')}}" alt="" />
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
                                                                    <a href="#"><i class="fa fa-reply"></i>{{__('messages.Reply')}}</a>
                                                                </div>
                                                            </div>

                                                            <div class="para-content">
                                                                <p>
                                                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempora inventore dolorem a unde modi iste odio amet, fugit fuga aliquam, voluptatem maiores animi dolor nulla magnam ea!
                                                                    Dignissimos aspernatur cumque nam quod sint provident modi alias culpa, inventore deserunt accusantium amet earum soluta consequatur quasi eum eius laboriosam, maiores praesentium
                                                                    explicabo enim dolores quaerat! Voluptas ad ullam quia odio sint sunt. Ipsam officia, saepe repellat.
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif @endforeach
                                            </li>
                                            <!-- End - Review Comment list-->
                                        </ul>
                                        <!-- End - Review Comment -->
                                        <div class="review-form">
                                            @if(session()->has('user'))
                                                <div class="review-form-text-top">
                                                    <h5>{{__('messages.ADDAREVIEW')}}</h5>
                                                    <p>{{__('messages.emailNotPublish')}}</p>
                                                </div>

                                                <form action="#" method="post">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="default-form-box mb-20">
                                                                <label for="comment-name">{{__('messages.Yourname')}}<span>*</span></label>
                                                                <input id="comment-name" type="text" placeholder="Enter your name" required />
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="default-form-box mb-20">
                                                                <label for="comment-email">Your Email <span>*</span></label>
                                                                <input id="comment-email" type="email" placeholder="Enter your email" required />
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
                                                    <p>Only logged in customers who have purchased this product may leave a review.</p>
                                                </div>
                                                <div class="row">
                                                    <div class="col-12">
                                                        <a href="{{ route('login') }}" class="btn btn-lg btn-block btn-primary">{{__('messages.LoginNow')}}</a>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <!-- End Product Details Tab Content Singel -->
                            </div>
                        </div>
                        <!-- End Product Details Tab Content -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade bd-example-modal-lg-{{$result['book']['id']}}">
        <div class="modal-dialog modal-fullscreen no-scroll">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{$result['book']['title']}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div id="pdf-wrapper">
                        <embed src="data:application/pdf;base64,{{ $result['book']['content'] }}#toolbar=0" width="100%" height="100%"></embed>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" id="bookmarked" class="btn btn-primary">Bookmarked</button>
                </div>
                <input type="hidden" id="bookId" value="{{$result['book']['id']}}" />
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.11.338/pdf.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            $(document).bind("keydown", function (e) {
                if (e.ctrlKey && e.which === 80) {
                    e.preventDefault();
                    return false;
                }
            });
        });
    </script>
    @if(session()->has('user'))
        <script type="text/javascript">
            $(document).ready(function(){
                $('#addToWishlistDetails').click(function(e){
                    e.preventDefault();
                    var userID = {{session()->get('user')['id']}};
                    var bookID = {{$result['book']['id']}};
                    var bookTitle = "{{$result['book']['title']}}";
                    var bookPrice = {{$result['book']['price']}};
                    var bookImage = "{{$result['book']['cover_image']}}";
                    bookImage = bookImage.substring(22);
                    var _token = $('input[name="_token"]').val();
                    const urlParams = 'http://paymentservice.test:8080/api/wishlist/add';
                    $.ajax({
                        url: urlParams,
                        type: "POST",
                        data: {
                            userID: userID,
                            bookID: bookID,
                            bookTitle: bookTitle,
                            bookPrice: bookPrice,
                            bookImage: bookImage,
                            _token: _token
                        },
                        success: function(response){
                            if(response){
                                swal({
                                    title: "Success!",
                                    text: "Add to wishlist successfully!",
                                    icon: "success",
                                    button: "OK",
                                }).then((value) => {
                                    location.reload();
                                });
                            } else {
                                swal({
                                    title: "Error!",
                                    text: "Add to wishlist failed!",
                                    icon: "error",
                                    button: "OK",
                                }).then((value) => {
                                    location.reload();
                                });
                            }
                        }
                    });
                });
            });
        </script>
    @endif @endsection
