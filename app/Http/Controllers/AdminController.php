<?php

namespace App\Http\Controllers;

use App\Models\Pays;
use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\SousCategorie;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index(){
        $today = date('j M, Y', strtotime(Carbon::today())  );
        $com = Order::OrderBy('created_at','DESC')->take(5)->get();
        $comV = Order::Where('status',1)->get();
        $comT = Order::Where('terminate',1)->get();
        $user = User::query()
                ->select('*')
                ->join('orders','orders.id_users','=','users.id')
                ->get();



        $comAllValidate = count($comV);
        $comAllTerminer = count($comT);
        $comAll = count($com);
        return view('dashboard', compact('comAll','comAllValidate','comAllTerminer','com','today','user'));
    }

    public function store(){
        return view('registre');
    }




    
    public function deconnexion() {
        auth()->logout();
    
        return redirect('/');
    }
}
