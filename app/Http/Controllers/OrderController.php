<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Order;
use App\Models\Livreur;
use Illuminate\Http\Request;

class OrderController extends Controller
{
     //create une commande
      public function create(Request $request){
        
        $validatedData = $request->validate([
              'details' => 'required',
              'lieudedepart' =>'required',
              'lieudelivraison' => 'required',
              'contactdudestinataire'=> 'required',
              'montant' => 'required',
              'id_users' => 'required',     
      ]);
  
          $order  = new Order;
          $order->details  = $request->details;
          $order->lieudedepart  = $request->lieudedepart;
          $order->lieudelivraison  = $request->lieudelivraison;
          $order->contactdudestinataire  = $request->contactdudestinataire;
          $order->montant  = $request->montant;
          $order->id_users  = $request->id_users;
          $order->status  = 0;
          if($request->nature){
            $order->nature = $request->nature;
          }else{
            $order->nature = "moto";
          }
  
  
          $order->save();
          //$order->save() ? event(new OrderRealTimeEvent("livraison en cours")): null;
  
          return response()->json([
            'order' => $order
          ],200);
  
          
      }
  
      //update one order
      public function updateCom(Request $request, $id){
          
          $order  = Order::find($id);
          $order->details  = $request->details;
          $order->lieudedepart  = $request->lieudedepart;
          $order->lieudelivraison  = $request->lieudelivraison;
          $order->contactdudestinataire  = $request->contactdudestinataire;
          $order->montant  = $request->montant;
          $order->id_livreurs  = $request->id_livreurs;
          $order->status  = $request->status;
          if($request->nature){
            $order->nature = $request->nature;
          }else{
            $order->nature = "moto";
          }

        //   $order->contact = Auth()->user()->contact;
  
          $order->update();
  
          return 201;
  
          
      }
  
      //delete la commande 
      public function destroyCom($id){
  
          $order = Order::find($id);
          $order->delete();
  
          return reponse()->json('commande delete');
      }
      
  
  
      //retourner toutes les commandes avec le nom des utilisateurs 
      public function listAll(){
         $order = Order::query()
              ->select('orders.id','details', 'users.name','lieudedepart','lieudelivraison', 'contactdudestinataire', 'users.contact')
              ->join('users', 'orders.id_users', '=',  'users.id')
              ->get();
  
          return response()->json([
                  'order' => $order
              ]);
      }
  
  
      //toutes les commandes du jours
      public function todayR()
      {
          $order = Order::whereDate('created_at', Carbon::today())->get();
  
          return $order;
      }
  
  
      //toutes les commandes d'une date precise 
      public function PrecisedateOrder($dataa){
  
          $data = Carbon::createFromFormat('Y-m-d', $dataa);
  
          $order = Order::query()
          ->select('orders.id','details', 'users.name','lieudedepart','lieudelivraison', 'contactdudestinataire', 'users.contact')
          ->join('users', 'orders.id_users', '=',  'users.id')
          ->whereDate('orders.created_at', '=', $data)
          ->get();
  
      return response()->json([
              'order' => $order
          ]);
      }
  
  
      //tous les utilisateurs qui ont passé une commande a cette date 
      public function PrecisedateUserOrder($dataa){
  
          $data = Carbon::createFromFormat('Y-m-d', $dataa);
  
          $user = User::query()
          ->select('users.name', 'users.name','lieudedepart','lieudelivraison', 'orders.contactdudestinataire as contact destinataire', 'users.contact as contact source')
          ->join('orders', 'orders.id_users', '=',  'users.id')
          ->whereDate('users.created_at', '=', $data)
          ->get();
  
      return response()->json([
              'user' => $user
          ]);
      }
  
  
      //les utilisateurs qui on commander dans le mois X
      public function precisetheMonth($dataa){
  
          $data = Carbon::createFromFormat('m', $dataa);
  
          $user = User::query()
          ->select('users.name', 'users.name','lieudedepart','lieudelivraison', 'orders.contactdudestinataire as contact destinataire', 'users.contact as contact source')
          ->join('orders', 'orders.id_users', '=',  'users.id')
          ->whereMonth('users.created_at', '=', $data)
          ->get();
  
      return response()->json([
              'user' => $user
          ]);
      }
  
  
      //toutes les commandes passées le Mois X
      public function precisetheMonthOrder($dataa){
  
          $data = Carbon::createFromFormat('m', $dataa);
  
          $order = Order::query()
          ->select('orders.id','details', 'users.name','lieudedepart','lieudelivraison', 'contactdudestinataire', 'users.contact')
          ->join('users', 'orders.id_users', '=',  'users.id')
          ->whereDate('orders.created_at', '=', $data)
          ->get();
  
      return response()->json([
              'order' => $order
          ]);
      }
      


      //liste des commandes non valide
      public function listAllC(){
        $commande = Order::where('id_livreurs',null)->OrderBy('created_at','DESC')->get();
        $livreur = Livreur::all();
        return view('AdminPages.Commande.list',compact('commande','livreur'));
      }


      //valider une commande avec l'id du livreur
      public function valideCommWithLivreur(Request $request){
        $com = Order::where('id',$request->id_com)->first();
        if(!is_null($com)){

          $validateData = $request->validate([
              'id_livreurs' => ['required','integer']
          ]);
          if($validateData){
            $com->id_livreurs = $request->id_livreurs;
            $com->status = 1;
          }else{
            return redirect('/listAllCom')->with('NotAssociate', "veuillez associer un livreur avant de valider la commande");
          }
            

            
            $com->update();
            if($com->update()){
                return redirect()->back()->with('Valide',"La commande a ete valider");
            }else{
                return redirect()->back()->with('NotValide',"La commande n'a pas pu etre valider , verifier si le livreur n'a pas deja une commande en cours");
            }


        }else{
            return redirect()->back()->with('NotFound',"La commande selectionner n'a pas ete trouver ");
        }
      }

      //liste des commandes valide
      public function listAllCV(){
        $commande = Order::Where('terminate',0)->where('status',1)->OrderBy('created_at','DESC')->get();
        return view('AdminPages.Commande.listCV',compact('commande'));
      }


      //PUT terminer une commande
      public function TerminateCommWithLivreur(Request $request){
        $com = Order::where('id',$request->id_com)->first();
        if(!is_null($com)){

            $com->terminate = 1;

            
            $com->update();
            if($com->update()){
                return redirect()->back()->with('Valide',"La commande est Terminer");
            }else{
                return redirect()->back()->with('NotValide',"La commande n'a pas pu etre valider , verifier si le livreur n'a pas deja une commande en cours");
            }


        }else{
            return redirect()->back()->with('NotFound',"La commande selectionner n'a pas ete trouver ");
        }
      }

      //commande terminer la vue

      public function listAllComTerm(){
        $commande =  Order::Where('terminate',1)->OrderBy('updated_at','DESC')->get();
        return view('AdminPages.Commande.listCT',compact('commande'));
      }


      //pages delete commande
      function deleteCommande($id){
        $commande = Order::where('id',$id)->first();

        if(!is_null($commande)){
          return view('AdminPages.Commande.delete',compact('commande'));
        }else{
          return redirect()->back()->with('NotFound', "La commande selectionner n'existe pas");
        }
      }


      //destroy commande
      function destroyCommande($id){
        $commande = Order::where('id',$id)->first();
        if(!is_null($commande)){
          $commande->delete();
          return redirect('/listAllCom')->with('successDelete', 'La commande a ete supprimer avec succes ');
        }else{
          return redirect('/listAllCom')->with('NotFound', "La commande selectionner n'existe pas");
        }
      }



      //recherche dans les Commandes En attente
    public function findSearOrderEA(Request $request)
    {			
        $search = $request->search;		
        $commande = Order::where( 'lieudedepart', 'LIKE', '%' . $search . '%' )->orWhere( 'lieudelivraison', 'LIKE', '%' . $search . '%' )->where('status',0)->where('id_livreurs',null)->where('terminate',0)->get();
        if (count ($commande) > 0 && isset($commande)){
          $livreur = Livreur::all();
        return view ( 'AdminPages.SearchAndFiltre.searchorderEA',compact('livreur'))->with('commande',$commande);
        }else{
        return redirect( '/listAllCom')->with( 'Nodetails','No Details found. Try to search again !' );	
        }	
    }

      //recherche dans les Commandes En attente
    public function findSearOrderEC(Request $request)
    {			
        $search = $request->search;		
        $commande = Order::where( 'lieudedepart', 'LIKE', '%' . $search . '%' )->orWhere( 'lieudelivraison', 'LIKE', '%' . $search . '%' )->where('status',1)->where('terminate',0)->get();
        if (count ($commande) > 0 && isset($commande)){
        return view ( 'AdminPages.SearchAndFiltre.searchorderEncour')->with('commande',$commande);
        }else{
        return redirect( '/listAllComValide')->with( 'Nodetails','No Details found. Try to search again !' );	
        }	
    }

      //recherche dans les Commandes En attente
    public function findSearOrderT(Request $request)
    {			
        $search = $request->search;		
        $commande = Order::where( 'lieudedepart', 'LIKE', '%' . $search . '%' )->orWhere( 'lieudelivraison', 'LIKE', '%' . $search . '%' )->where('status',1)->where('terminate',1)->get();
        if (count ($commande) > 0 && isset($commande)){
        return view ( 'AdminPages.SearchAndFiltre.searchorderT')->with('commande',$commande);
        }else{
        return redirect( '/listAllComTerminer')->with( 'Nodetails','No Details found. Try to search again !' );	
        }	
    }
}
