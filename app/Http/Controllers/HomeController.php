<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        return view('welcome');
    }

    public function store(){
        return view('front.about');
    }
    
    public function contact(){
        return view('front.contact');
    }

    public function notfound(){
        return view('front.NotFound');
    }
}
