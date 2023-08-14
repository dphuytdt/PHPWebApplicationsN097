<?php

use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;

    Breadcrumbs::for('home', function ($trail) {
        $trail->push('Home', route('home'));
    });

    Breadcrumbs::for('category.index', function ($trail) {
        $trail->parent('home');
        $trail->push('Category List', route('category.index'));
    });

    Breadcrumbs::for('category.create', function ($trail) {
        $trail->parent('category.index');
        $trail->push('Create Category', route('category.create'));
    });

    Breadcrumbs::for('slides.index', function ($trail) {
        $trail->parent('home');
        $trail->push('Slide List', route('slides.index'));
    });

    Breadcrumbs::for('users.index', function ($trail) {
        $trail->parent('home');
        $trail->push('User List', route('users.index'));
    });

    Breadcrumbs::for('users.create', function ($trail) {
        $trail->parent('home');
        $trail->push('Create User', route('users.create'));
    });

    Breadcrumbs::for('books.index', function ($trail) {
        $trail->parent('home');
        $trail->push('Book List', route('books.index'));
    });

    Breadcrumbs::for('books.create', function ($trail) {
        $trail->parent('home');
        $trail->push('Create Book', route('books.create'));
    });

    Breadcrumbs::for('books.edit', function ($trail, $id) {
        $trail->parent('home');
        $trail->push('Edit Book', route('books.edit', $id));
    });

    Breadcrumbs::for('comments.index', function ($trail) {
        $trail->parent('home');
        $trail->push('Comment List', route('comments.index'));
    });

    Breadcrumbs::for('news.index', function ($trail) {
        $trail->parent('home');
        $trail->push('News List', route('news.index'));
    });

    Breadcrumbs::for('news.create', function ($trail) {
        $trail->parent('home');
        $trail->push('Create News', route('news.create'));
    });
