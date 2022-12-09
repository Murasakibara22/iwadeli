<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;
use Intervention\Image\Image;
use Image as InterventionImage;
use Illuminate\Support\Facades\Hash;

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


//page d'ajout de livreur
    public function nouveau(){
        return view('AdminPages.Utilisateurs.new');
    }
    //liste sur le web 
    function listAllU (){
        $user = User::OrderBy('created_at','DESC')->get();
        return view('AdminPages.Utilisateurs.list',compact('user'));
    }


    //POST livreur
    function createNewUser(Request $request)
    {
        $exist = User::where('contact', $request->contact)->orWhere('email',$request->email)->get();
        if ($exist and $exist->count() > 0) {

            return redirect()->back()->with('ExistUser',"L'utilisateur que vous essayez d'enregistrer Existe deja");
        }else{
            $validateData = $request->validate([
                'nom' => ['required'],
                'prenom' => ['required'],
                'contact' => ['required'],
            ]);

            if($validateData)
            {
                    $user = new User;
                    $user->nom = $request->nom;
                    $user->prenom = $request->prenom;
                    $user->contact = $request->contact;
                    $user->email = $request->email;
                    $user->role = $request->role;
                    $user->password = Hash::make($request->password);
                    if (request()->file('photo')) {
                        $img = request()->file('photo');
                            $messi = md5($img->getClientOriginalExtension().time().$request->contact).".".$img->getClientOriginalExtension();
                            $source = $img;
                            $target = 'images/User/'.$messi; 
                            InterventionImage::make($source)->fit(212,207)->save($target);
                            $user->photo   =  $messi;
                    }else{
                        $user->photo   = "default.jpg";
                    }

                    
                    $user->save();
                    if($user->save()){
                        return redirect()->back()->with('UserSuccess', "L'utilisateur a ete enregistrer aves success");
                    }else{
                        return redirect()->back()->with('NotUserSuccess', " un probleme est surveneue et L'utilisateur n'a pas pu etre enregistrer aves success");
                    }
            }else{
                return redirect()->back()->with('champsNotField',"L'un des champs n'est pas correctement remplis");      
            }
        }
    }


    //page de modification de l'utilsateur
    public function changeUs($id){
        $users = User::find($id);
        if(!is_null($users )){
            return view('AdminPages.Utilisateurs.edit', compact('users'));
        }else{
            return redirect()->back()->with('NotExist',"L'utilisateur selectionner n'existe pas");
        }
        
    }

//PUT un utilisateur
    public function updateU(Request $request, $id){
        try{
            $user = User::where('id',$id)->first();
            if(isset($user))
            {
                $user->nom    = $request->nom;
                $user->prenom    = $request->prenom;
                $user->email   = $request->email;
                $user->contact  = $request->contact;
                if (request()->file('photo')) {
                    $img = request()->file('photo');
                        $messi = md5($img->getClientOriginalExtension().time().$request->email).".".$img->getClientOriginalExtension();
                        $source = $img;
                        $target = 'images/User/'.$messi;
                        InterventionImage::make($source)->fit(212,207)->save($target);
                        $user->photo   =  $messi;
                }
        
                $user->role    = $request->role;
                
                $user->update();
                    if($user->update()){
                            return redirect('/listAllUs')->with('succesEdit', 'Utilisateurs modifier');
                    }else{
                        return redirect()->back()->with('erreur', "l'un des champs n'est pas correctement remplis");
                    }
            }

    }catch(Exception $err){
        report($err);
        return redirect()->back()->with('error', "probleme survenue veuillezreessayer plus tard");
         }
    }

    //page Utilisateur Delete
    function deleteU($id)
    {
        $UserSearch =  User::where('id',$id)->first();
        if(!is_null($UserSearch))
            {
                return view('AdminPages.Utilisateurs.delete', compact('UserSearch'));
            }else{
                return redirect('/listAllUs')->with('NotExist', "L'utilisateur spécifier n'existe pas");
            }
    }


    function destroyU($id){
        $user =  User::where('id',$id)->first();
        if(!is_null($user))
            {
                $user->delete();
                return redirect('/listAllUs')->with('successDele', 'Utilisateur Supprimer');
            }else{
                return redirect('/listAllUs')->with('NotExist', "L'utilisateur spécifier n'existe pas");
            }
    }


    //recherche d'un utilisateur
    public function findSearch(Request $request)
        {			
            $search = $request->search;		
            $user = User::where( 'nom', 'LIKE', '%' . $search . '%' )->orWhere( 'prenom', 'LIKE', '%' . $search . '%' )->get();
            if (count ($user) > 0 && isset($user)){
            return view ( 'AdminPages.Utilisateurs.search')->with('user',$user);
            }else{
            return redirect( '/listAllUs')->with( 'Nodetails','No Details found. Try to search again !' );	
            }	
        }




        //retourner la derniere commande d'un utilisateur 
        public function get_order_last($user_id){

            $commande = Order::query()
                        ->select('orders.details','orders.lieudedepart','orders.lieudelivraison','orders.contactdudestinataire','orders.montant','orders.id_users','orders.id_livreurs','orders.nature','orders.terminate','orders.status','orders.created_at','orders.updated_at')
                        ->join('users','orders.id_users','=','users.id')
                        ->where('users.id',$user_id)
                        ->latest()
                        ->first();

            if(!is_null($commande)){
                return response()->json([
                    "commande" => $commande
                ]);
            }else{
                return response()->json([
                    "commande" => "Aucune commande disponible pour ce utilisateur"
                ]);
            }
        }
}
