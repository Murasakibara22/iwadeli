<?php

namespace App\Http\Controllers;

use App\Models\Blog;
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

        $blog = Blog::OrderBy('id','DESC')->get();
        return view('front.tarification',compact('blog'));
    }

    public function detailsBlogu($slug){


        $blogu = Blog::Where('slug',$slug)->first();
        if(!is_null($blogu)){
            $blog = Blog::OrderBy('id','DESC')->get();
            return view('front.blogDetails',compact('blog','blogu'));
        }else{
            return redirect()->back();
        }

     
    }
}
