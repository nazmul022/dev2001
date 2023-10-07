<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    function about(){
        $about = "This is my about page content";
        return view('about', compact('about'));
    }
    function maya(){
        return view('maya');
    }
    function form(){
        return view('backend.category.abc.form');
    }
    function MyPortfolio(){
        return view('allpage/my-portfolio');
    }
}


