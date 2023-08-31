@extends('layouts.main') @section('content') @section('title', 'News')
<div class="breadcrumb-section">
    <div class="breadcrumb-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-12 d-flex justify-content-between justify-content-md-between align-items-center flex-md-row flex-column">
                    <h3 class="breadcrumb-title">News Detail</h3>
{{--                    {{ Breadcrumbs::render('newsDetail' , $news['id']) }}--}}
                </div>
            </div>
        </div>
    </div>
</div>
<div class="blog-single-section">
    <div class="container">
        <div class="row flex-column-reverse flex-lg-row">
            <div class="col-lg-3">
                <div class="siderbar-section">
                    <div class="sidebar-single-widget">
                        <h6 class="sidebar-title">Search</h6>
                        <div class="sidebar-content">
                            <div class="search-bar">
                                <div class="default-search-style d-flex">
                                    <form action="{{route('news.search')}}" method="GET">
                                        <label>
                                            <input name="keyword" class="default-search-style-input-box border-around border-right-none" type="search" placeholder="{{__('messages.typeKeyWord')}}">
                                        </label>
                                        <button class="default-search-style-input-btn" type="submit"><i class="icon-search"></i></button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="sidebar-single-widget">
                        <h6 class="sidebar-title">{{__('messages.Recent Posts')}}</h6>
                        <div class="sidebar-content">
                            <div class="recent-post">
                                <ul>
                                    @foreach($recentNews as $recentNew)
                                        <li class="recent-post-list">
                                            <a href="{{route('newsDetail' , $recentNew['id'])}}" class="post-image">
                                                <img src="{{ $recentNew['image'] }}" alt="" />
                                            </a>
                                            <div class="post-content">
                                                <a class="post-link" href="">{{ $recentNew['title'] }}</a>
                                                @php
                                                    $date = date_create($recentNew['created_at']);
                                                    $date = date_format($date,"M d, Y");
                                                @endphp
                                                <span class="post-date">{{ $date }}</span>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="sidebar-single-widget">
                        <h6 class="sidebar-title">Tag products</h6>
                        <div class="sidebar-content">
                            <div class="tag-link">
                                @foreach($tags as $tag)
                                    <a href="">{{ $tag['tag_name'] }}</a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="blog-single-wrapper">
                    <div class="blog-single-img">
                        <img class="img-fluid" src="{{ $news['image'] }}" alt="" />
                    </div>
                    <div class="blog-feed-post-meta">
                        <span>{{__('messages.By:')}}</span>
                        <a href="{{route('newsDetail' , $news['id'])}}" class="blog-feed-post-meta-author">{{$news['creadted_by']}}</a> -
                        @php
                            $date = date_create($news['created_at']);
                            $date = date_format($date,"M d, Y");
                        @endphp
                        <a href="{{route('newsDetail' , $news['id'])}}" class="blog-feed-post-meta-date">{{ $date }}</a>
                    </div>
                    <h4 class="post-title">{{$news['title']}}</h4>
                    <div class="para-content">
                        @if($news['description'] != null)
                        <blockquote class="blockquote-content">
                            {{$news['description']}}
                        </blockquote>
                        @endif
                        <p>
                            {{$news['content']}}
                        </p>
                    </div>
                    <div class="para-tags">
                        <span>Tags: </span>
                        <ul>
                            @php
                                $tags = explode(',', $news['tags']);
                            @endphp
                            @foreach($tags as $tag)
                                <li><a href="">{{ $tag }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="comment-area">
                    @php
                        $commentsCount = count($comment);
                    @endphp
                    <h4 class="mb-30">{{$commentsCount}} Comments</h4>
                    <ul class="comment">
                        @foreach($comment as $cmt)
                        <li class="comment-list">
                            <div class="comment-wrapper">
                                <div class="comment-img">
                                    <img src="assets/images/user/image-1.png" alt="" />
                                </div>
                                <div class="comment-content">
                                    <div class="comment-content-top">
                                        <div class="comment-content-left">
                                            <h6 class="comment-name">Kaedyn Fraser</h6>
                                        </div>
                                        <div class="comment-content-right">
                                            <a href="#"><i class="fa fa-reply"></i>Reply</a>
                                        </div>
                                    </div>

                                    <div class="para-content">
                                        <p>
                                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempora inventore dolorem a unde modi iste odio amet, fugit fuga aliquam, voluptatem maiores animi dolor nulla magnam ea! Dignissimos
                                            aspernatur cumque nam quod sint provident modi alias culpa, inventore deserunt accusantium amet earum soluta consequatur quasi eum eius laboriosam, maiores praesentium explicabo enim dolores
                                            quaerat! Voluptas ad ullam quia odio sint sunt. Ipsam officia, saepe repellat.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <ul class="comment-reply">
                                <li class="comment-reply-list">
                                    <div class="comment-wrapper">
                                        <div class="comment-img">
                                            <img src="assets/images/user/image-2.png" alt="" />
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
                                                <p>
                                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempora inventore dolorem a unde modi iste odio amet, fugit fuga aliquam, voluptatem maiores animi dolor nulla magnam ea!
                                                    Dignissimos aspernatur cumque nam quod sint provident modi alias culpa, inventore deserunt accusantium amet earum soluta consequatur quasi eum eius laboriosam, maiores praesentium
                                                    explicabo enim dolores quaerat! Voluptas ad ullam quia odio sint sunt. Ipsam officia, saepe repellat.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </li>
                        @endforeach
                    </ul>
                    <div class="comment-form">
                        <div class="coment-form-text-top mt-30">
                            <h4>Leave a Reply</h4>
                        </div>

                        <form action="#" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <div class="default-form-box mb-20">
                                        <label for="comment-review-text">Your review <span>*</span></label>
                                        <textarea id="comment-review-text" placeholder="Write a review" required></textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button class="form-submit-btn" type="submit">Post Comment</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
