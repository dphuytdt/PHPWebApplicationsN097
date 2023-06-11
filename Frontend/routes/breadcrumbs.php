<?php

    Breadcrumbs::for('home', function ($trail) {
        $trail->push('Home', route('home'));
    });

    Breadcrumbs::for('bookDetails', function ($trail, $book) {
        $trail->parent('home');
        $trail->push($book['title'], route('bookDetails', $book['id']));
    });