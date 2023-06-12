<?php 

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