<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Intervention\Image\Image;
use Image as InterventionImage;

class UserController extends Controller
{
    

    function getUser(){
        $user = User::OrderBy('nom','ASC')->get();

        $response = response()->json([
            'user' => $user,
        ]);

        return response($response,201);
    }

    public function UserWhOrder(){
        $user = User::query()
             ->join('orders', 'users.id', '=',  'orders.id_users')
             ->get();
        
         return response()->json([
                 'user' => $user,
                  200
             ]);

            }


            function change($id){
                $users = User::find($id);
                if(!is_null($users)){
                    return response()->json([
                        'user' => $user,
                         200
                    ]);
                }else{
                    return response()->json([
                        'user' => 'Not found',
                    ]);
                }
            }

            public function updateUser(Request  $request , $id){

                $user          =  User::find($id);
                $user->name  = $request->name;
                $user->prenom  = $request->prenom;
                $user->email  = $request->email;
                $user->contact  = $request->contact;
                if (request()->file('photo')) {
                    $img = request()->file('photo');
                        $messi = md5($img->getClientOriginalExtension().time().$request->email).".".$img->getClientOriginalExtension();
                        $source = $img;
                        $target = 'images/User/'.$messi;
                        InterventionImage::make($source)->fit(212,207)->save($target);
                        $user->photo   =  $messi;
                }else{
                    $user->photo   = "default.jpg";
                }

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
