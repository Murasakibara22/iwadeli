<?php

namespace App\Http\Controllers;

use App\Models\Livreur;
use Illuminate\Http\Request;

class LivreurController extends Controller
{
    public function createLivreur(Request $request)
    {

        $validatedData = $request->validate([
            'nom_livreurs' => 'required',
            'prenom_livreurs' =>'required',
            'contact' => 'required',
            'photo'=> 'required',     
    ]);


        $livreur   = new Livreur;
        $livreur->nom_livreurs = $request->nom_livreurs;
        $livreur->prenom_livreurs = $request->prenom_livreurs;
        $livreur->contact = $request->contact;
        $livreur->photo = $request->photo;
    

        $livreur->save();

       return 200 ;

    }

    //lister tous les livreurs
    public function listAll(){

        $livreur  = Livreur::all();

        return response()->json([
            'livreur' => $livreur
        ]);
    }



    //tous les livreurs associes a une commande
    public function listOrderLivreur(){
        $livreur = Livreur::query()
             ->select('nom_livreurs', 'prenom_livreurs', 'contact')
             ->join('orders', 'orders.id_livreurs', '=',  'livreurs.id')
             ->get();
 
         return response()->json([
                 'livreur' => $livreur
             ]);
     }


     //modifier un livreur
     public function updateLivreur(Request $request, $id){

        $livreur   = Livreur::find($id);
        $livreur->nom_livreurs = $request->nom_livreurs;
        $livreur->prenom_livreurs = $request->prenom_livreurs;
        $livreur->contact = $request->contact;
        $livreur->photo = $request->photo;

        $livreur->update();

        return 202;
     }




     //suprimer un livreur
     public function destroyLivreur($id){

        $livreur = Livreur::find($id);
        $livreur->delete();

        return reponse()->json('livreur delete');
    }


    //compter toute les livraison effectuer par un livreur 
    public function countCourse(){
        $livreur = Livreur::query()
             ->select('nom_livreurs', 'prenom_livreurs','lieudedepart',)
             ->join('orders', 'orders.id_livreurs', '=',  'livreurs.id')
             ->where('orders.id_livreurs', '=', '3')
             ->get();

 
         return response()->json([
                 'livreur' => $livreur
             ]);
     }
}
