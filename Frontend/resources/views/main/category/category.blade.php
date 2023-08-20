@extends('layouts.main') @section('content') @section('title', 'About')


<div class="breadcrumb-section">
    <div class="breadcrumb-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-12 d-flex justify-content-between justify-content-md-between align-items-center flex-md-row flex-column">
                    <h3 class="breadcrumb-title">Blog Grid Sidebar Left</h3>
                    <div class="breadcrumb-nav">
                        <nav aria-label="breadcrumb">
                            <ul>
                                <li><a href="{{route('home')}}">Home</a></li>
                                <li><a href="#">Blog</a></li>
                                <li class="active" aria-current="page">Blog Grid Sidebar Left</li>
                            </ul>
                        </nav>
                    </div>
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
                        <h6 class="sidebar-title">Search</h6>
                        <div class="sidebar-content">
                            <div class="search-bar">
                                <div class="default-search-style d-flex">
                                    <input class="default-search-style-input-box border-around border-right-none" type="search" placeholder="Search..." required />
                                    <button class="default-search-style-input-btn" type="submit"><i class="icon-search"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="sidebar-single-widget">
                        <h6 class="sidebar-title">Recent Post</h6>
                        <div class="sidebar-content">
                            <div class="recent-post">
                                <ul>

                                    <li class="recent-post-list">
                                        <a href="blog-single-sidebar-left.html" class="post-image">
                                            <img src="{{asset('assets/images/blog_recent_post/blog1.jpg')}}" alt="" />
                                        </a>
                                        <div class="post-content">
                                            <a class="post-link" href="#">Blog Image Post</a>
                                            <span class="post-date">March 16, 2018</span>
                                        </div>
                                    </li>

                                    <li class="recent-post-list">
                                        <a href="#" class="post-image">
                                            <img src="{{asset('assets/images/blog_recent_post/blog2.jpg')}}" alt="" />
                                        </a>
                                        <div class="post-content">
                                            <a class="post-link" href="#">Blog Image Post</a>
                                            <span class="post-date">March 16, 2018</span>
                                        </div>
                                    </li>
                                    <li class="recent-post-list">
                                        <a href="blog-single-sidebar-left.html" class="post-image">
                                            <img src="{{asset('assets/images/blog_recent_post/blog3.jpg')}}" alt="" />
                                        </a>
                                        <div class="post-content">
                                            <a class="post-link" href="#">Blog Image Post</a>
                                            <span class="post-date">March 16, 2018</span>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="sidebar-single-widget">
                        <h6 class="sidebar-title">Tag products</h6>
                        <div class="sidebar-content">
                            <div class="tag-link">
                                <a href="">asian</a>
                                <a href="">brown</a>
                                <a href="">euro</a>
                                <a href="">fashion</a>
                                <a href="">hat</a>
                                <a href="">t-shirt</a>
                                <a href="">teen</a>
                                <a href="">travel</a>
                                <a href="">white</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="blog-grid-wrapper">
                    <div class="row">
                        <div class="col-md-6 col-12">
                            <div class="blog-feed-single">
                                <a href="blog-single-sidebar-left.html" class="blog-feed-img-link">
                                    <img src="{{asset('assets/images/blog_images/aments_blog_01.jpg')}}" alt="" class="blog-feed-img" />
                                </a>
                                <div class="blog-feed-content">
                                    <div class="blog-feed-post-meta">
                                        <span>By:</span>
                                        <a href="" class="blog-feed-post-meta-author">Admin</a> -
                                        <a href="" class="blog-feed-post-meta-date">Sep 14, 2020</a>
                                    </div>
                                    <h5 class="blog-feed-link"><a href="#">Illum animi quo praesentium accusamus debitis</a></h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="blog-feed-single">
                                <div class="blog-image-slider">
                                    <img src="{{asset('assets/images/blog_images/blog-grid-img-3.jpg')}}" alt="" />
                                    <img src="{{asset('assets/images/blog_images/blog-grid-img-2.jpg')}}" alt="" />
                                    <img src="{{asset('assets/images/blog_images/blog-grid-img-1.jpg')}}" alt="" />
                                    <img src="{{asset('assets/images/blog_images/blog-grid-img-4.jpg')}}" alt="" />
                                </div>
                                <div class="blog-feed-content">
                                    <div class="blog-feed-post-meta">
                                        <span>By:</span>
                                        <a href="" class="blog-feed-post-meta-author">Admin</a> -
                                        <a href="" class="blog-feed-post-meta-date">Sep 14, 2020</a>
                                    </div>
                                    <h5 class="blog-feed-link"><a href="#">Repellendus repudiandae aliquid dolores unde</a></h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="blog-feed-single">
                                <div class="blog-image-video">
                                    <img src="{{asset('assets/images/blog_images/blog-grid-img-4.jpg')}}" alt="" />
                                    <a href="https://youtu.be/MKjhBO2xQzg" class="video-play-btn" data-autoplay="true" data-vbtype="video"><i class="fa fa-play"></i></a>
                                </div>
                                <div class="blog-feed-content">
                                    <div class="blog-feed-post-meta">
                                        <span>By:</span>
                                        <a href="" class="blog-feed-post-meta-author">Admin</a> -
                                        <a href="" class="blog-feed-post-meta-date">Sep 14, 2020</a>
                                    </div>
                                    <h5 class="blog-feed-link"><a href="#">Blanditiis mollitia laboriosam quas pariatur nesciunt.</a></h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="blog-feed-single">
                                <a href="#" class="blog-feed-img-link">
                                    <img src="{{asset('assets/images/blog_images/aments_blog_02.jpg')}}" alt="" class="blog-feed-img" />
                                </a>
                                <div class="blog-feed-content">
                                    <div class="blog-feed-post-meta">
                                        <span>By:</span>
                                        <a href="" class="blog-feed-post-meta-author">Admin</a> -
                                        <a href="" class="blog-feed-post-meta-date">Sep 14, 2020</a>
                                    </div>
                                    <h5 class="blog-feed-link"><a href="#">Molestiae impedit voluptatem accusantium magni veritatis</a></h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="blog-feed-single">
                                <a href="#" class="blog-feed-img-link">
                                    <img src="{{asset('assets/images/blog_images/aments_blog_02.jpg')}}" alt="" class="blog-feed-img" />
                                </a>
                                <div class="blog-feed-content">
                                    <div class="blog-feed-post-meta">
                                        <span>By:</span>
                                        <a href="" class="blog-feed-post-meta-author">Admin</a> -
                                        <a href="" class="blog-feed-post-meta-date">Sep 14, 2020</a>
                                    </div>
                                    <h5 class="blog-feed-link"><a href="#l">Iusto nostrum ratione quasi omnis harum modi facilis</a></h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">

                            <div class="blog-feed-single">
                                <a href="#" class="blog-feed-img-link">
                                    <img src="{{asset('assets/images/blog_images/aments_blog_03.jpg')}}" alt="" class="blog-feed-img" />
                                </a>
                                <div class="blog-feed-content">
                                    <div class="blog-feed-post-meta">
                                        <span>By:</span>
                                        <a href="" class="blog-feed-post-meta-author">Admin</a> -
                                        <a href="" class="blog-feed-post-meta-date">Sep 14, 2020</a>
                                    </div>
                                    <h5 class="blog-feed-link"><a href="#">Non recusandae incidunt enim, laboriosam consectetur illum</a></h5>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="page-pagination text-center">
                    <ul>
                        <li><a href="#">Previous</a></li>
                        <li><a class="active" href="#">1</a></li>
                        <li><a href="#">2</a></li>
                        <li><a href="#">3</a></li>
                        <li><a href="#">Next</a></li>
                    </ul>
                </div>

            </div>
        </div>
    </div>
</div>

@endsection
