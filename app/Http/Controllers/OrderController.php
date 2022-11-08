<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Order;
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
              'id_livreurs' => 'required',      
      ]);
  
          $order  = new Order;
          $order->details  = $request->details;
          $order->lieudedepart  = $request->lieudedepart;
          $order->lieudelivraison  = $request->lieudelivraison;
          $order->contactdudestinataire  = $request->contactdudestinataire;
          $order->montant  = $request->montant;
          $order->id_users  = $request->id_users;
          $order->id_livreurs  = $request->id_livreurs;
          if($request->nature){
            $order->nature = $request->nature;
          }else{
            $order->nature = "moto";
          }

          $order->contact = Auth()->user()->contact;
  
          $order->save();
          //$order->save() ? event(new OrderRealTimeEvent("livraison en cours")): null;
  
          return 200;
  
          
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

          $order->contact = Auth()->user()->contact;
  
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
      
}
