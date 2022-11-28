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
}
