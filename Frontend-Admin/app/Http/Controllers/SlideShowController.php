<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SlideShowController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('home.slide.list');
    }
}
