<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\Livreur;
use Illuminate\Http\Request;

class NoteController extends Controller
{

    
    public function createNote(Request $request,$livreur_id){
        $livreur = Livreur::find($livreur_id);
            if(!is_null($livreur)){
                    $note = new Note;
                    $note->nbEtoile = $request->nbEtoile;
                    if($request->details){
                        $note->details = $request->details;
                    }else{
                        $note->details = "Aucun details";
                    }
                    $note->id_livreurs = $livreur_id;
        
                $note->save();
                if($note->save()){
                    $livreur = Livreur::find($livreur_id);
                    return response()->json([
                        'note'=> "Vous venez d'attribuer une note de $etoiles /5 au livreur : $livreur->nom_livreurs , $livreur->prenom_livreurs , Merci!!"
                    ]);
                }else{
                    return response()->json([
                        'status'=> "une erreur c'est produite lors de l'envoie de la note"
                    ]);
                }
            }else{
                return response()->json([
                    'status'=> "Le livreur selectionner n'a pas ete trouver"
                ]);
            }

           

    }



    
    //toutes les notes d'un livreur
    public function get_all_note_livreur($livreur_id){
        $livreur = Livreur::where('id',$livreur_id)->firstOrFail();
        if(!is_null($livreur)){
           
          
            // $nbNote = Note::all();
            // if(!is_null($nbNote)){
            //     foreach($nbNote as $nbNotes){
            //         if($nbNotes->id_livreurs == $livreur->id){
            //             $nbNotes ;
            //         }
            //     }
                
            // }
        }
    }

    
}
