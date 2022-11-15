<?php

namespace App\Http\Controllers;

use App\Models\Pays;
use App\Models\User;
use App\Models\Annonces;
use Illuminate\Http\Request;
use App\Models\SousCategorie;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index(){
        return view('dashboard');
    }

    public function store(){
        return view('registre');
    }




    
    public function deconnexion() {
        auth()->logout();
    
        return redirect('/');
    }
}
