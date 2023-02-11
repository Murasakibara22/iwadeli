<?php

namespace App\Http\Controllers;

use App\Models\Livreur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthLivreurController extends Controller
{
    public function enreg_livreur(Request $request)
    {
            $validatedData = $request->validate([
            'nom_livreurs' => 'required|string|max:100',
                'prenom_livreurs' => 'required|string|max:255',
                'contact' => 'required|string|max:15',
      
                            'mdp' => 'required|string|min:8',
            ]);

            $livreur = Livreur::create([
                    'nom_livreurs' => $validatedData['nom_livreurs'],
                    'prenom_livreurs' => $validatedData['prenom_livreurs'],
                    'contact' => $validatedData['contact'],
                   // 'role' => $validatedData['role'],
                        'mdp' => $validatedData['mdp'],
                        'photo' => "default.jpg"
            ]);

        $token = $livreur->createToken('auth_token')->plainTextToken;

        return response()->json([
                    'access_token' => $token,
                        'token_type' => 'Bearer',
        ]);
    }





    public function connecte_livreur(Request $request)
 {

    $livreur = Livreur::where('contact', $request['contact'])->where('mdp', $request['mdp'])->first();
        

                if(!isset($livreur)){
                    return response()->json([
                        'status' => "le numero cible n'est pas associer a un livreur"
                     ]);
                }

                    $token = $livreur->createToken('auth_token')->plainTextToken;
                    
                    return response()->json([
                            'access_token' => $token,
                            'token_type' => 'Bearer',
                    ]);
    
  }


  public function me_livreur(Request $request)
  {
    return $request->user();
  }



  public function Logout_livreur(){

    auth()->user()->tokens()->delete();

    return response()->json(['message' => 'deconnecter avec succees'], 200);
}




    //modifier le Password Utilisateur
    public function updatePasswordLivreur(Request $request, $livreur_id)
    {
     
        $change_password = Livreur::where('id',$livreur_id)->first();

        if(!is_null($change_password)){

        if ($request->newpassword !== $request->confirmation) {
            return [
                'message' => 'Les mots de passe ne correspondent pas'
            ];
        }

         $change_password->update([
            'mdp' => Hash::make($request->newpassword)
        ]);

        return $change_password;
        
        }else{
            return response()->json([
                'user' => "Utilisateurs non trouver"
            ]);
        }

    }

}
