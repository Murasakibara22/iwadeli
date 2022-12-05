<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\Livreur;
use Illuminate\Http\Request;

class NoteController extends Controller
{

    
    public function createNote($etoiles, $livreur_id){

             $note = Note::create([
                'nbEtoile' => $etoiles,
                'id_livreurs' => $livreur_id,
            ]);
                $livreur = Livreur::find($livreur_id);
                return response()->json([
                    'note'=> "Vous venez d'attribuer une note de $etoiles /5 au livreur : $livreur->nom_livreurs , $livreur->prenom_livreurs , Merci!!"
                ]);
             
    }



    /****A  REPRENDRE 
    //toutes les notes d'un livreur
    public function get_all_note_livreur($livreur_id){
        $livreur = Livreur::where('id',$livreur_id)->firstOrFail();
        if(!is_null($livreur)){
            //toutes les commandes effectuer
            $nbNote = Note::all();
            if(!is_null($nbNote)){
                foreach($nbNote as $nbNotes){
                    if($nbNotes->id_livreurs == $livreur->id){
                        $nbNotes ;
                    }
                }
                
            }
        }
    }

    */
}
