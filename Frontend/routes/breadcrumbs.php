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

    //forgot password
    Breadcrumbs::for('forgotPassword', function ($trail) {
        $trail->parent('home');
        $trail->push('Forgot Password', route('forgotPassword'));
    });

    //input otp
    Breadcrumbs::for('inputOtp', function ($trail) {
        $trail->parent('forgotPassword');
        $trail->push('Input OTP', route('inputOtp'));
    });

    //reset password
    Breadcrumbs::for('resetPassword', function ($trail) {
        $trail->parent('inputOtp');
        $trail->push('Reset Password', route('resetPassword'));
    });

    //profile
    Breadcrumbs::for('profile', function ($trail) {
        $trail->parent('home');
        $trail->push('Profile', route('profile'));
    });

    //upgrade
    Breadcrumbs::for('upgrade', function ($trail) {
        $trail->parent('home');
        $trail->push('Upgrade', route('upgrade'));
    });

    //vip benefits
    Breadcrumbs::for('vipBenefits', function ($trail) {
        $trail->parent('home');
        $trail->push('VIP Benefits', route('vipBenefits'));
    });

    //wishlist
    Breadcrumbs::for('wishlist', function ($trail) {
        $trail->parent('home');
        $trail->push('Wishlist', route('wishlist.index', session()->get('user')['id']));
    });

    //cart
    Breadcrumbs::for('cart', function ($trail) {
        $trail->parent('home');
        $trail->push('Your Cart', route('cart.getUserCart', session()->get('user')['id']));
    });

    //checkout
    Breadcrumbs::for('checkOut', function ($trail) {
        $trail->parent('cart');
        $trail->push('Checkout', route('cart.checkOut', session()->get('user')['id']));
    });

    //thanksyou
    Breadcrumbs::for('thankYou', function ($trail) {
        $trail->parent('home');
        $trail->push('Thanks You', route('thankYou'));
    });

    //view-more
    Breadcrumbs::for('viewMore', function ($trail, $dataType) {
        $trail->parent('home');
        $trail->push($dataType, route('view.more', $dataType));
    });

    //login
    Breadcrumbs::for('login', function ($trail) {
        $trail->parent('home');
        $trail->push('Login', route('login'));
    });

    Breadcrumbs::for('readBook', function ($trail, $book) {
        $trail->parent('bookDetails', $book);
        $trail->push('Read Book', route('readBook', $book['id']));
    });
