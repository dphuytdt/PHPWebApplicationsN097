<?php

use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;

    Breadcrumbs::for('home', function ($trail) {
        $trail->push('Home', route('home'));
    });

    Breadcrumbs::for('bookDetails', function ($trail, $book) {
        $trail->parent('home');
        $trail->push($book['title'], route('bookDetails', $book['id']));
    });

    Breadcrumbs::for('search', function ($trail) {
        $trail->parent('home');
        $trail->push('Search', route('search'));
    });

    Breadcrumbs::for('handleError', function ($trail) {
        $trail->parent('home');
        $trail->push('404', route('handleError', 404));
    });

    Breadcrumbs::for('forgotPassword', function ($trail) {
        $trail->parent('home');
        $trail->push('Forgot Password', route('forgotPassword'));
    });

    Breadcrumbs::for('inputOtp', function ($trail) {
        $trail->parent('forgotPassword');
        $trail->push('Input OTP', route('inputOtp'));
    });

    Breadcrumbs::for('resetPassword', function ($trail) {
        $trail->parent('inputOtp');
        $trail->push('Reset Password', route('resetPassword'));
    });

    Breadcrumbs::for('profile', function ($trail) {
        $trail->parent('home');
        $trail->push('Profile', route('profile'));
    });

    Breadcrumbs::for('upgrade', function ($trail) {
        $trail->parent('home');
        $trail->push('Upgrade', route('upgrade'));
    });

    Breadcrumbs::for('vipBenefits', function ($trail) {
        $trail->parent('home');
        $trail->push('VIP Benefits', route('vipBenefits'));
    });

    Breadcrumbs::for('wishlist', function ($trail) {
        $trail->parent('home');
        $trail->push('Wishlist', route('wishlist.index', session()->get('user')['id']));
    });

    Breadcrumbs::for('cart', function ($trail) {
        $trail->parent('home');
        $trail->push('Your Cart', route('cart.getUserCart', session()->get('user')['id']));
    });

    Breadcrumbs::for('checkOut', function ($trail) {
        $trail->parent('cart');
        $trail->push('Checkout', route('cart.checkOut', session()->get('user')['id']));
    });

    Breadcrumbs::for('thankYou', function ($trail) {
        $trail->parent('home');
        $trail->push('Thanks You', route('thankYou'));
    });

    Breadcrumbs::for('viewMore', function ($trail, $dataType) {
        $trail->parent('home');
        $trail->push($dataType, route('view.more', $dataType));
    });

    Breadcrumbs::for('login', function ($trail) {
        $trail->parent('home');
        $trail->push('Login', route('login'));
    });

    Breadcrumbs::for('readBook', function ($trail, $book) {
        $trail->parent('bookDetails', $book);
        $trail->push('Read Book', route('readBook', $book['id']));
    });

    Breadcrumbs::for('contact', function ($trail) {
        $trail->parent('home');
        $trail->push('Contact', route('contact'));
    });

    Breadcrumbs::for('about', function ($trail) {
        $trail->parent('home');
        $trail->push('About', route('about'));
    });

    Breadcrumbs::for('news', function ($trail) {
        $trail->parent('home');
        $trail->push('News', route('news'));
    });

    Breadcrumbs::for('newsDetail', function ($trail, $news) {
        $trail->parent('news');
        $trail->push($news['title'], route('newsDetail', $news['id']));
    });

    Breadcrumbs::for('news.search', function ($trail) {
        $trail->parent('news');
        $trail->push('Search', route('news.search'));
    });

    Breadcrumbs::for('faq', function ($trail) {
        $trail->parent('home');
        $trail->push('FAQ', route('faq'));
    });
