<?php

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