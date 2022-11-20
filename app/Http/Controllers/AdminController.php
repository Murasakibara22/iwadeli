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
        $comV = Order::whereDate('updated_at',Carbon::today())->Where('status',1)->get();// commande valider aujourd'hui  pas une commande d'aujourd'hui qui ont ete valider
        $comT = Order::whereDate('updated_at',Carbon::today())->Where('terminate',1)->Where('status',1)->get();// commande Terminer aujourd'hui  pas une commande d'aujourd'hui qui ont ete Terminer
        $user = User::all(); //tous les utilisateurs

        $AllOrder = Order::all();//toutes les commandes depuis le debut
        $countAllOrder = count($AllOrder);//total des commandes

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




         /**POURCENTAGES DES COMMANDES Valider (TODAYS, YESTERDAY) */
        
        $AllOrderV = Order::where('status',1)->get(); //toutes les commandes Valider
        $resultPourcentageAllOrderV = count($AllOrderV); //poucentage de toutes les commandes Valider
        //pourcentage des Commande Valider
        $resultPourcentageCVT = ($commandeVTCount * 100) / $resultPourcentageAllOrderV;
        $resultPourcentageCVH = ($commandeVHCount * 100) / $resultPourcentageAllOrderV;



        //toutes les commandes terminer d'hier
        $commandeTH = Order::whereDate('created_at',Carbon::yesterday())->where('terminate',1)->get();
        $commandeTHCount = count($commandeTH);//total de toutes les commandes terminer d'hier

         //toutes les commandes terminer de today
         $commandeTT = Order::whereDate('created_at',Carbon::today())->where('terminate',1)->get();
         $commandeTTCount = count($commandeTT);//total de toutes les commandes terminer de today



        /**POURCENTAGES DES COMMANDES TERMINER (TODAYS, YESTERDAY) */

         $AllOrderT = Order::where('terminate',1)->where('status',1)->get(); //toutes les commandes terminer
         $resultPourcentageAllOrderT = count($AllOrderT); //poucentage de toutes les commandes terminer
         //pourcentage des Commande Terminer
        $resultPourcentageCTT = ($commandeTTCount * 100) / $resultPourcentageAllOrderT;
        $resultPourcentageCTH = ($commandeTHCount * 100) / $resultPourcentageAllOrderT;

        /**END  POURCENTAGE DES COMMANDES TERMINER */




        //commandes en cours
        $commandeEnCour = Order::WhereDate('created_at',Carbon::today())->where('status',1)->where('terminate',0)->get();
        $commandeEnCourCount = count($commandeEnCour);

        //commandes en Attente de validation
        $commandeEA = Order::WhereDate('created_at',Carbon::today())->where('status',0)->where('terminate',0)->where('id_livreurs',null)->get();
        $commandeEACount = count($commandeEA);

    
        return view('dashboard', compact('comAll','countAllOrder','commandeTTCount','commandeEACount','comAllValidate','comAllTerminer','com','today','user','commandeHCount','commandeTCount','resultPourcentageCVT','resultPourcentageCVH','resultPourcentageCTT','resultPourcentageCTH','commandeEnCourCount'));
    }

    public function store(){
        return view('registre');
    }


    




    
    public function deconnexion() {
        auth()->logout();
    
        return redirect('/');
    }
}
