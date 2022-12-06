<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function enreg(Request $request)
    {
            $validatedData = $request->validate([
            'nom' => 'required|string|max:100',
                'prenom' => 'required|string|max:255',
                'contact' => 'required|string|max:15',
                //'role' => 'required|string|max:15',
                            'password' => 'required|string|min:8',
            ]);

            $user = User::create([
                    'nom' => $validatedData['nom'],
                    'prenom' => $validatedData['prenom'],
                    'contact' => $validatedData['contact'],
                   // 'role' => $validatedData['role'],
                        'password' => Hash::make($validatedData['password']),
            ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
                    'access_token' => $token,
                        'token_type' => 'Bearer',
        ]);
    }

public function connecte(Request $request)
 {
        if (!Auth::attempt($request->only('contact', 'password'))) {
        return response()->json([
        'message' => 'Invalid login details'
                ], 401);
            }
        
        $user = User::where('contact', $request['contact'])->firstOrFail();
        
        $token = $user->createToken('auth_token')->plainTextToken;
        
        return response()->json([
                'access_token' => $token,
                'token_type' => 'Bearer',
        ]);
  }

  public function me(Request $request)
    {
    return $request->user();
    }
  

    public function Logout(){

        auth()->user()->tokens()->delete();

        return response()->json(['message' => 'deconnecter avec succees'], 200);
    }



    //modifier le Password Utilisateur
    public function updatePasswordUser(Request $request, $user_id)
    {
     
        $change_password = User::where('id',$user_id)->first();

        if(!is_null($change_password)){

        if ($request->newpassword !== $request->confirmation) {
            return [
                'message' => 'Les mots de passe ne correspondent pas'
            ];
        }

         $change_password->update([
            'password' => Hash::make($request->newpassword)
        ]);

        return $change_password;
        }else{
            return response()->json([
                'user' => "Utilisateurs non trouver"
            ]);
        }

    }
}
