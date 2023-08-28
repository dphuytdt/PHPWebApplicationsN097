@extends('layouts.main') @section('title', $result['book']['title']) @section('content')
<link rel="stylesheet" href="{{asset('assets/css/rate.css')}}" />
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
                            <img src="{{ Storage::disk('dropbox')->url($result['book']['cover_image']) }}" alt="" />
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
                                @if($totalRate == 0)
                                <span class="review-none">No review (Review now)</span>
                                <br />
                                @else
                                    @for($i = 1; $i <= 5; $i++)
                                        @if ($i <= $totalRate)
                                            @php
                                                echo ' <span class="review-fill"><i class="fa fa-star"></i></span>';
                                            @endphp
                                        @else
                                            @php
                                                echo '<span class=""><i class="fa fa-star"></i></span>';
                                            @endphp
                                        @endif
                                    @endfor
                                @endif
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
                        @if($result['book']['is_vip_valid'] == 1)
                        <span class="badge badge-success">Is valid for VIP</span>
                        @endif
                        <div class="d-flex align-items-center">
                            @php $user = session()->get('user'); $vip_expired_date = isset($user) ? date("d-m-Y", strtotime($user['valid_vip'])) : date("d-m-Y", strtotime(date("Y-m-d"))); $today = date("d-m-Y", strtotime(date("Y-m-d")));
                            $isReadNow = ($result['book']['price'] == 0) || (($vip_expired_date > $today) && ($result['book']['is_vip_valid'] == 1)) || ($isPayment['data']) || $user['role'] === 'ROLE_ADMIN'; @endphp @if(!session()->has('user'))
                            <div class="product-add-to-cart-btn">
                                <a href="{{route('login')}}">{{__('messages.plsLogin')}}</a>
                            </div>
                            @else @if ($isReadNow)
                            <div class="product-add-to-cart-btn">
                                <a href="{{route('readBook', $result['book']['id'])}}" target="_blank">{{__('messages.readNow')}}</a>
                            </div>
                            @else
                            <div class="product-add-to-cart-btn">
                                <a id="addCartDetails" href="{{route('cart.add')}}" data-toggle="modal" data-target="#modalAddcart">{{__('messages.addToCart')}}</a>
                            </div>
                            @endif @endif
                            <input type="hidden" name="_token" value="{{csrf_token()}}" />
                        </div>

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
                    <ul class="nav tablist product-details-content-tab-btn d-flex justify-content-center">
                        <li>
                            <a class="nav-link" data-toggle="tab" href="#description">
                                <h5>{{__('messages.Description')}}</h5>
                            </a>
                        </li>
                        <li>
                            <a class="nav-link" data-toggle="tab" href="#specification">
                                <h5>{{__('messages.Specification')}}</h5>
                            </a>
                        </li>
                        <li>
                            <a class="nav-link active" data-toggle="tab" href="#review">
                                <h5>{{__('messages.Reviews')}}</h5>
                            </a>
                        </li>
                    </ul>
                    <div class="product-details-content-tab">
                        <div class="tab-content">
                            <div class="tab-pane" id="description">
                                <div class="single-tab-content-item">
                                    <p>{{$result['book']['description']}}</p>
                                </div>
                            </div>
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
                            <div class="tab-pane active show" id="review">
                                <div class="single-tab-content-item">
                                    @if(session()->has('user') && ($isPayment['data'] || $result['book']['price'] == 0))
                                        @if(!isset($yourComment) && $user['role'] != 'ROLE_ADMIN')
                                            <div class="review-form">
                                                <div class="review-form-text-top">
                                                    <h5>{{__('messages.ADDAREVIEW')}}</h5>
                                                </div>
                                                <form action="{{route("review")}}" method="post">
                                                    @csrf
                                                    <input type="hidden" name="book_id" value="{{$result['book']['id']}}">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="default-form-box mb-20">
                                                                <div class="rate">
                                                                    <input type="radio" id="star5" name="rate" value="5" required />
                                                                    <label for="star5" title="text">5 stars</label>
                                                                    <input type="radio" id="star4" name="rate" value="4" required />
                                                                    <label for="star4" title="text">4 stars</label>
                                                                    <input type="radio" id="star3" name="rate" value="3" required />
                                                                    <label for="star3" title="text">3 stars</label>
                                                                    <input type="radio" id="star2" name="rate" value="2" required />
                                                                    <label for="star2" title="text">2 stars</label>
                                                                    <input type="radio" id="star1" name="rate" value="1" required />
                                                                    <label for="star1">1 star</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="default-form-box mb-20">
                                                                <label for="comment-review-text">Your review <span>*</span></label>
                                                                <textarea id="comment-review-text" placeholder="Write a review" name="comment" required></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <button class="form-submit-btn" type="submit">Submit</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        @endif
                                        <ul class="comment">
                                            @if(isset($yourComment))
                                                <li class="comment-list">
                                                    <div class="comment-wrapper">
                                                        <div class="comment-img">
                                                            <img src="{{asset('assets/images/user/image-1.png')}}" alt="">
                                                        </div>
                                                        <div class="comment-content">
                                                            <div class="comment-content-top">
                                                                <div class="comment-content-left">
                                                                    <h6 class="comment-name">{{$yourComment[0]['comment_name']}}</h6>
                                                                    <div class="product-review">
                                                                        <span class="review-fill"><i class="fa fa-star"></i></span>
                                                                        <span class="review-fill"><i class="fa fa-star"></i></span>
                                                                        <span class="review-fill"><i class="fa fa-star"></i></span>
                                                                        <span class="review-fill"><i class="fa fa-star"></i></span>
                                                                        <span class="review-empty"><i class="fa fa-star"></i></span>
                                                                    </div>
                                                                </div>
                                                                @if(!isset($yourComment[1]) && (isset($user['role']) && $user['role'] == 'ROLE_ADMIN'))
                                                                    <div class="comment-content-right" id="reply-parent-comment">
                                                                        <button>
                                                                            <i class="fa fa-reply"
                                                                               onclick="replyComment('<?php echo $yourComment[0]['id'] . '\', \'' . $result['book']['id'] ?>', this);"
                                                                            >  {{__('messages.Reply')}}</i>
                                                                        </button>
                                                                    </div>
                                                                @endif
                                                            </div>
                                                            <div class="para-content">
                                                                <p>{{$yourComment[0]['content']}}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @if(isset($yourComment[1]))
                                                        <!-- Start - Review Comment Reply-->
                                                        <ul class="comment-reply">
                                                            <li class="comment-reply-list">
                                                                <div class="comment-wrapper">
                                                                    <div class="comment-img">
                                                                        <img src="{{asset('assets/images/user/image-2.png')}}" alt="">
                                                                    </div>
                                                                    <div class="comment-content">
                                                                        <div class="comment-content-top">
                                                                            <div class="comment-content-left">
                                                                                <h6 class="comment-name">{{$yourComment[1]['comment_name']}}</h6>
                                                                            </div>
                                                                        </div>
                                                                        <div class="para-content">
                                                                            <p>{{$yourComment[1]['content']}}</p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                        </ul> <!-- End - Review Comment Reply-->
                                                    @endif
                                                </li> <!-- End - Review Comment list-->
                                            @endif
                                            <!-- Start - Review Comment list-->
                                            @foreach ($comments as $comment)
                                                <li class="comment-list">
                                                    <div class="comment-wrapper">
                                                        <div class="comment-img">
                                                            <img src="{{asset('assets/images/user/image-1.png')}}" alt="">
                                                        </div>
                                                        <div class="comment-content">
                                                            <div class="comment-content-top">
                                                                <div class="comment-content-left">
                                                                    <h6 class="comment-name">{{$comment[0]['comment_name']}}</h6>
                                                                    <div class="product-review">
                                                                        <span class="review-fill"><i class="fa fa-star"></i></span>
                                                                        <span class="review-fill"><i class="fa fa-star"></i></span>
                                                                        <span class="review-fill"><i class="fa fa-star"></i></span>
                                                                        <span class="review-fill"><i class="fa fa-star"></i></span>
                                                                        <span class="review-empty"><i class="fa fa-star"></i></span>
                                                                    </div>
                                                                </div>
                                                                @if(!isset($comment[1]) && (isset($user['role']) && $user['role'] == 'ROLE_ADMIN'))
                                                                    <div class="comment-content-right" id="reply-parent-comment">
                                                                        <button>
                                                                            <i class="fa fa-reply"
                                                                               onclick="replyComment('<?php echo $comment[0]['id'] . '\', \'' . $result['book']['id'] ?>', this);"
                                                                            >  {{__('messages.Reply')}}</i>
                                                                        </button>
                                                                    </div>
                                                                @endif
                                                            </div>
                                                            <div class="para-content">
                                                                <p>{{$comment[0]['content']}}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @if(isset($comment[1]))
                                                        <!-- Start - Review Comment Reply-->
                                                        <ul class="comment-reply">
                                                            <li class="comment-reply-list">
                                                                <div class="comment-wrapper">
                                                                    <div class="comment-img">
                                                                        <img src="{{asset('assets/images/user/image-2.png')}}" alt="">
                                                                    </div>
                                                                    <div class="comment-content">
                                                                        <div class="comment-content-top">
                                                                            <div class="comment-content-left">
                                                                                <h6 class="comment-name">{{$comment[1]['comment_name']}}</h6>
                                                                            </div>
                                                                        </div>
                                                                        <div class="para-content">
                                                                            <p>{{$comment[1]['content']}}</p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                        </ul> <!-- End - Review Comment Reply-->
                                                    @endif
                                                </li> <!-- End - Review Comment list-->
                                            @endforeach
                                        </ul> <!-- End - Review Comment -->
                                    @else
                                        <div class="review-form-text-top">
                                            <h5>ADD A REVIEW</h5>
                                            <p>Only logged in customers who have purchased this product may leave a review. </p>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <a href="{{ route('login') }}" class="btn btn-lg btn-block btn-primary">{{__('messages.LoginNow')}}</a>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div> <!-- End Product Details Tab Content Singel -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="product-section section-top-gap-100">
    <div class="section-content-gap">
        <div class="container">
            <div class="row">
                <div class="section-content">
                    <h3 class="section-title">Related Products</h3>
                </div>
            </div>
        </div>
    </div>

    <div class="product-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="product-default-slider product-default-slider-4grids-1row">
                        @foreach($relatedBooks as $book)
                        <div class="product-default-single border-around">
                            <div class="product-img-warp">
                                <a href="{{route('bookDetails', $book['id'])}}" class="product-default-img-link">
                                    <img src="{{ Storage::disk('dropbox')->url($book['cover_image']) }}" alt="" class="product-default-img img-fluid">
                                </a>
                                <div class="product-action-icon-link">
                                    <ul>
                                        <li><a href=""><i class="icon-heart"></i></a></li>
                                        <li><a href="#" data-toggle="modal" data-target="#modalQuickview"><i class="icon-eye"></i></a></li>
                                        @if($book['price'] != 0)
                                        <li><a id="addToWishlistDetails" href="" data-toggle="modal" data-target="#modalAddcart"><i class="icon-shopping-cart"></i></a></li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                            <div class="product-default-content">
                                <h6 class="product-default-link"><a href="{{route('bookDetails', $book['id'])}}">{{$book['title']}}</a></h6>
                                <span class="product-default-price">{{$book['price']}}$</span>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
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
            const urlParams = 'http://127.0.0.1:8085/api/wishlist/add';
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

<script type="text/javascript">
    function replyComment(id, bookId, element) {
        var parent = element.closest(".comment-wrapper");

        // Create the new reply container
        var replyContainer = document.createElement("ul");
        replyContainer.className = "comment-reply";

        var replyListItem = document.createElement("li");
        replyListItem.className = "comment-reply-list";

        var newCommentWrapper = document.createElement("div");
        newCommentWrapper.className = "comment-wrapper";

        var commentContentDiv = document.createElement("div");
        commentContentDiv.className = "comment-content";

        var paraContentDiv = document.createElement("div");
        paraContentDiv.className = "para-content";

        var form = document.createElement("form");
        form.action = "#";
        form.onsubmit = function() {
            onSubmitReplyReview(this);
            return false;
        };

        var hiddenInput = document.createElement("input");
        hiddenInput.type = "hidden";
        hiddenInput.name = "parent_id";
        hiddenInput.value = id; // Use the parent comment's ID

        var hiddenInputBookId = document.createElement("input");
        hiddenInputBookId.type = "hidden";
        hiddenInputBookId.name = "book_id";
        hiddenInputBookId.value = bookId; // Use the parent comment's ID

        var col12Div = document.createElement("div");
        col12Div.className = "col-12";

        var defaultFormBoxDiv = document.createElement("div");
        defaultFormBoxDiv.className = "default-form-box mb-20";

        var label = document.createElement("label");
        label.setAttribute("for", "comment-review-text");
        label.innerHTML = "Your review <span>*</span>";

        var textarea = document.createElement("textarea");
        textarea.id = "comment-review-text";
        textarea.placeholder = "Write a review";
        textarea.name = "comment";
        textarea.required = true;

        var submitButton = document.createElement("button");
        submitButton.className = "form-submit-btn";
        submitButton.type = "submit";
        submitButton.innerHTML = "Submit";

        defaultFormBoxDiv.appendChild(label);
        defaultFormBoxDiv.appendChild(textarea);
        col12Div.appendChild(defaultFormBoxDiv);
        col12Div.appendChild(submitButton);
        form.appendChild(hiddenInput);
        form.appendChild(hiddenInputBookId);
        form.appendChild(col12Div);
        paraContentDiv.appendChild(form);
        commentContentDiv.appendChild(paraContentDiv);
        newCommentWrapper.appendChild(commentContentDiv);
        replyListItem.appendChild(newCommentWrapper);
        replyContainer.appendChild(replyListItem);

        parent.parentNode.insertBefore(replyContainer, parent.nextSibling);
    }

    function onSubmitReplyReview(form) {
        const formData = new FormData(form);
        alert(formData.get('parent_id'));
        alert(formData.get('comment'));
        alert(formData.get('book_id'));
    }
</script>

@if(session()->has('user'))
    <script type="text/javascript">
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
@endif @endsection
