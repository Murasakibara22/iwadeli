<?php

namespace App\Http\Controllers;

use App\Models\OrderCopie;
use Illuminate\Http\Request;
use App\Events\OrderRealTimeEvent;

class OrderControllerCopie extends Controller
{
     
    public function createTest(Request $request){
        
        $validatedData = $request->validate([
              'details' => 'required',
              'lieudedepart' =>'required',
              'lieudelivraison' => 'required',
              'contactdudestinataire'=> 'required',
              'montant' => 'required',
              'id_users' => 'required',     
      ]);
  
          $order  = new OrderCopie;
          $order->details  = $request->details;
          $order->lieudedepart  = $request->lieudedepart;
          $order->lieudelivraison  = $request->lieudelivraison;
          $order->contactdudestinataire  = $request->contactdudestinataire;
          $order->montant  = $request->montant;
          $order->id_users  = $request->id_users;
  
         $order->save() ? event(new OrderRealTimeEvent("ConfirmOrder")) : null ;
  
          return 200;
  
          
      }

      public function listAllCopie(){
        $orderCopie = OrderCopie::query()
             ->select('order_copies.id','details', 'users.name','lieudedepart','lieudelivraison', 'contactdudestinataire','montant', 'users.contact','order_copies.created_at as date')
             ->join('users', 'order_copies.id_users', '=',  'users.id')
             ->get();
 
         return response()->json([
                 'order' => $orderCopie
             ]);
     }

     public function CancelCopie($id) {
        $orderCopie = OrderCopie::find($id);
        $orderCopie->delete();

        return reponse()->json('commande delete');
     }
}
