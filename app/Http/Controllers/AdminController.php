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


    public function index(Request $request){
        $today = date('j M, Y', strtotime(Carbon::today())  );
        $com = Order::OrderBy('created_at','DESC')->take(5)->get();
        $comV = Order::Where('status',1)->get();// toutes les commandes valider
        $comT = Order::Where('terminate',1)->get();//commande terminer 
        $user = User::all(); //tous les utilisateurs

        $AllOrder = Order::all();//toutes les commandes depuis le debut
        $countAllOrder = count($AllOrder);

        $comma =  Order::WhereDate('created_at',Carbon::today())->get();//toutes les commandes du jours

        $comAllValidate = count($comV);
        $comAllTerminer = count($comT);
        $comAll = count($comma);
       


        //toutes les commandes d'hier
        $commandeH = Order::whereDate('created_at',Carbon::yesterday())->get();
        $commandeHCount = count($commandeH);//total de toutes les commandes d'hier

        //toutes les commandes de today
        $commandeT = Order::whereDate('created_at',Carbon::today())->get();
        $commandeTCount = count($commandeT);//total de toutes les commandes de today

       
        //toutes les commandes valider d'hier
        $commandeVH = Order::whereDate('created_at',Carbon::yesterday())->where('status',1)->get();
        $commandeVHCount = count($commandeVH);//total de toutes les commandes valider d'hier

            //toutes les commandes valider de today
        $commandeVT = Order::whereDate('created_at',Carbon::today())->where('status',1)->get();
        $commandeVTCount = count($commandeVT);//total de toutes les commandes valider de today

        //pourcentage des Commande Valider
        $resultPourcentageCVT = ($commandeVTCount * 100) / 200;
        $resultPourcentageCVH = ($commandeVHCount * 100) / 200;



        //toutes les commandes terminer d'hier
        $commandeTH = Order::whereDate('created_at',Carbon::yesterday())->where('terminate',1)->get();
        $commandeTHCount = count($commandeTH);//total de toutes les commandes terminer d'hier

         //toutes les commandes terminer de today
         $commandeTT = Order::whereDate('created_at',Carbon::today())->where('terminate',1)->get();
         $commandeTTCount = count($commandeTT);//total de toutes les commandes terminer de today


         //pourcentage des Commande Valider
        $resultPourcentageCTT = ($commandeTTCount * 100) / 200;
        $resultPourcentageCTH = ($commandeTHCount * 100) / 200;
                 
        return view('dashboard', compact('comAll','countAllOrder','comAllValidate','comAllTerminer','com','today','user','commandeHCount','commandeTCount','resultPourcentageCVT','resultPourcentageCVH','resultPourcentageCTT','resultPourcentageCTH'));
    }

    public function store(){
        return view('registre');
    }


    




    
    public function deconnexion() {
        auth()->logout();
    
        return redirect('/');
    }
}
