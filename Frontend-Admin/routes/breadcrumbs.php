<?php 

    Breadcrumbs::for('home', function ($trail) {
        $trail->push('Home', route('home'));
    });

    Breadcrumbs::for('category.index', function ($trail) {
        $trail->parent('home');
        $trail->push('Category List', route('category.index'));
    });