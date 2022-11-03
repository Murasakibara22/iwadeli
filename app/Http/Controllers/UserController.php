<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    


    public function UserWhOrder(){
        $user = User::query()
             ->join('orders', 'users.id', '=',  'orders.id_users')
             ->get();
        

         return response()->json([
                 'user' => $user,
                  200
             ]);

            }


            public function updateUser(Request  $request , $id){

                $user          =  User::find($id);
                $user->name  = $request->name;
                $user->prenom  = $request->prenom;
                $user->email  = $request->email;
                $user->contact  = $request->contact;

                $user->update();
        
                return response()->json([
                    'user' => 'succes',
                     200
                ]);
        
            }


            //delte un users
            public function  destroyUser($id){

                $user = User::find($id);
                $user->delete();
        
                return 'Utilisateur Supprimer';
            }


    function search($name)
    {
        return User::where("nom","like","%".$name."%")->get();
    }
}
