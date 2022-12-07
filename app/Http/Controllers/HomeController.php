<?php

namespace App\Http\Controllers;

use App\Models\Temoignage;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        $temoignage = Temoignage::OrderBy('id','DESC')->take(4)->get();
        return view('welcome',compact('temoignage'));
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

    public function tarif(){
        return view('front.tarification');
    }
}
