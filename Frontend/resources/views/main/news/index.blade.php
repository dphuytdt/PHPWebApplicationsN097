@extends('layouts.main') @section('content') @section('title', 'News')
<style>
    .pagination-container {
        text-align: center;
    }

    .pagination {
        display: inline-block;
        margin-top: 10px;
    }

    .pagination a,
    .pagination span {
        display: inline-block;
        padding: 5px 10px;
        margin-right: 5px;
        border: 1px solid #ccc;
        text-decoration: none;
        color: #333;
    }

    .pagination a:hover {
        background-color: #f5f5f5;
    }

    .pagination .current {
        background-color: #ccc;
        color: #fff;
    }
</style>
<div class="breadcrumb-section">
    <div class="breadcrumb-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-12 d-flex justify-content-between justify-content-md-between align-items-center flex-md-row flex-column">
                    <h3 class="breadcrumb-title">{{__('messages.news')}}</h3>
                    {{ Breadcrumbs::render('news') }}
                </div>
            </div>
        </div>
    </div>
</div>

<div class="blog-section">
    <div class="container">
        <div class="row flex-column-reverse flex-lg-row">
            <div class="col-lg-3">
                <div class="siderbar-section">
                    <div class="sidebar-single-widget">
                        <h6 class="sidebar-title">{{__('messages.Search')}}</h6>
                        <div class="sidebar-content">
                            <div class="search-bar">
                                <div class="default-search-style d-flex">
                                    <form action="{{route('news.search')}}" method="GET">
                                        <input name="keyword" class="default-search-style-input-box border-around border-right-none" type="search" placeholder="{{__('messages.typeKeyWord')}}">
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
                                    @foreach($recentNews as $news)
                                        <li class="recent-post-list">
                                            <a href="{{route('newsDetail' , $news['id'])}}" class="post-image">
                                                <img src="{{ $news['image'] }}" alt="" />
                                            </a>
                                            <div class="post-content">
                                                <a class="post-link" href="{{route('newsDetail' , $news['id'])}}">{{ $news['title'] }}</a>
                                                @php
                                                    $date = date_create($news['created_at']);
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
                        <h6 class="sidebar-title">{{__('messages.Tag News')}}</h6>
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
                <div class="blog-grid-wrapper">
                    <div class="row">
                    @if($paginator->count() == 0)
                        <style type="text/css">
                            .alert-danger {
                                text-align: center;
                                color: red;
                            }
                        </style>
                        <div class="container">
                            <div class="row">
                                <div class="col-12">
                                    <div class="alert alert-danger" role="alert">
                                        {{__('messages.No News available!')}}
                                    </div>
                                </div>
                            </div>
                        </div>
                        @else
                        @foreach($paginator as $article)
                            <div class="col-md-6 col-12">
                                <div class="blog-feed-single">
                                    <a href="{{route('newsDetail' , $article['id'])}}" class="blog-feed-img-link">
                                        <img src="{{ $article['image'] }}" alt="" class="blog-feed-img" />
                                    </a>
                                    <div class="blog-feed-content">
                                        <div class="blog-feed-post-meta">
                                            <span>{{__('messages.By:')}}</span>
                                            <a href="{{route('newsDetail' , $article['id'])}}" class="blog-feed-post-meta-author">{{$article['creadted_by']}}</a> -
                                            @php
                                                $date = date_create($article['created_at']);
                                                $date = date_format($date,"M d, Y");
                                            @endphp
                                            <a href="{{route('newsDetail' , $article['id'])}}" class="blog-feed-post-meta-date">{{ $date }}</a>
                                        </div>
                                        <h5 class="blog-feed-link"><a href="{{route('newsDetail' , $article['id'])}}">{{$article['title']}}</a></h5>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="pagination-container">
                        <div class="pagination">
                            @if ($paginator->currentPage() != 1)
                                <a href="{{ $paginator->url(1) }}">First</a>
                            @endif @if ($paginator->onFirstPage())
                                <span class="disabled">Previous</span>
                            @else
                                <a href="{{ $paginator->previousPageUrl() }}">Previous</a>
                            @endif {{-- Hiển thị số trang --}} @for ($i = 1; $i <= $paginator->lastPage(); $i++) @if ($i === $paginator->currentPage())
                                <span class="current">{{ $i }}</span>
                            @else
                                <a href="{{ $paginator->url($i) }}">{{ $i }}</a>
                            @endif @endfor {{-- Hiển thị nút Next --}} @if ($paginator->hasMorePages())
                                <a href="{{ $paginator->nextPageUrl() }}">Next</a>
                            @else
                                <span class="disabled">Next</span>
                            @endif @if ($paginator->currentPage() != $paginator->lastPage())
                                <a href="{{ $paginator->url($paginator->lastPage()) }}">Last</a>
                            @endif
                        </div>
                    </div>
                    @endif
                </div>

                <!-- Start Pagination -->
            </div>
        </div>
    </div>
</div>
@endsection
