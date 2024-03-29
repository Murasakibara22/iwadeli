<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Livreur;
use Illuminate\Http\Request;
use Intervention\Image\Image;
use Illuminate\Support\Carbon;
use Image as InterventionImage;
use Illuminate\Support\Facades\DB;

class LivreurController extends Controller
{
    public function createLivreur(Request $request)
    {

        $validatedData = $request->validate([
            'nom_livreurs' => 'required',
            'prenom_livreurs' =>'required',
            'contact' => 'required',     
    ]);


        $livreur   = new Livreur;
        $livreur->nom_livreurs = $request->nom_livreurs;
        $livreur->prenom_livreurs = $request->prenom_livreurs;
        $livreur->mdp = $request->mdp;
        $livreur->contact = $request->contact;
        if (request()->file('photo')) {
            $img = request()->file('photo');
                $messi = md5($img->getClientOriginalExtension().time().$request->contact).".".$img->getClientOriginalExtension();
                $source = $img;
                $target = 'images/Livreur/'.$messi;
                InterventionImage::make($source)->fit(212,207)->save($target);
                $livreur->photo   =  $messi;
        }else{
            $livreur->photo   = "default.jpg";
        }
    
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
             ->count('*')
             ->join('orders', 'orders.id_livreurs', '=',  'livreurs.id')
             ->groupBy('livreurs.prenom_livreurs')
             ->get();

 
         return response()->json([
                 'livreur' => $livreur
             ]);
     }

//////////////////////////
///***APP LIVREUR ICI *///
//////////////////////////

//Toute les commande en Cour pour un livreur cible
     public function order_in_livreur($id){

        $exist = Livreur::where('id', $id)->first();

        if(is_null($exist)){
            return response()->json([
                "status" => " l'id specifier ne correspond a aucun livreur"
            ]);
        }

        $order = Order::select('orders.id','orders.status','orders.terminate','orders.details','orders.lieudedepart','orders.lieudelivraison','orders.contactdudestinataire','orders.montant','orders.montant','orders.nature','orders.code','orders.created_at','orders.id_users','orders.id_livreurs','users.nom','users.prenom', 'users.contact')
            ->join('users','orders.id_users','=','users.id')
            ->where('orders.id_livreurs', $id)
            ->where('orders.terminate', 0)
            ->OrderBy('created_at','DESC')
            ->get();

            return $order;
     }



     //Toute les commande Terminer pour un livreur cible
     public function order_livreur_terminate($id){

        $exist = Livreur::where('id', $id)->first();

        if(is_null($exist)){
            return response()->json([
                "status" => " l'id specifier ne correspond a aucun livreur"
            ]);
        }

        $order = Order::query()
            ->select('orders.id','orders.status','orders.terminate','orders.details','orders.lieudedepart','orders.lieudelivraison','orders.contactdudestinataire','orders.montant','orders.montant','orders.nature','orders.code','orders.created_at','orders.id_users','orders.id_livreurs','users.nom','users.prenom', 'users.contact')
            ->join('users','orders.id_users','=','users.id')
            ->where('orders.id_livreurs', $id)
            ->where('orders.terminate', 1)
            ->get();

            return $order;
     }


      //Toute les commande Refuser pour un livreur cible
      public function order_livreur_refused($id){

        $exist = Livreur::where('id', $id)->first();

        if(is_null($exist)){
            return response()->json([
                "status" => " l'id specifier ne correspond a aucun livreur"
            ]);
        }

        $order = Order::query()
            ->select('orders.id','orders.status','orders.terminate','orders.details','orders.lieudedepart','orders.lieudelivraison','orders.contactdudestinataire','orders.montant','orders.montant','orders.nature','orders.code','orders.created_at','orders.id_users','orders.id_livreurs','users.nom','users.prenom', 'users.contact')
            ->join('users','orders.id_users','=','users.id')
            ->where('orders.id_livreurs', $id)
            ->where('orders.refus', 1)
            ->get();

            return $order;
     }

     

     //GET
    function nouveau(){
        return view('AdminPages.Livreur.new');
    }

    //POST
    public function createNewLivreur(Request $request)
    {
        $exist = Livreur::where('contact', $request->contact)->get();
        if ($exist and $exist->count() > 0) {

            return redirect()->back()->with('ExistLivreur',"Le livreur Existe deja");
        }else{
            $validateData = $request->validate([
                'nom_livreurs' => ['required'],
                'prenom_livreurs' => ['required'],
                'contact' => ['required'],
            ]);

            if($validateData){
                $livreur   = new Livreur;
                $livreur->nom_livreurs = $request->nom_livreurs;
                $livreur->prenom_livreurs = $request->prenom_livreurs;
                $livreur->contact = $request->contact;
                if (request()->file('photo')) {
                    $img = request()->file('photo');
                        $messi = md5($img->getClientOriginalExtension().time().$request->contact).".".$img->getClientOriginalExtension();
                        $source = $img;
                        $target = 'images/Livreur/'.$messi; 
                        InterventionImage::make($source)->fit(106,100)->save($target);
                        $livreur->photo   =  $messi;
                }else{
                    $livreur->photo   = "default.jpg";
                }

               
                $livreur->save();

                if($livreur->save()){
                    return redirect()->back()->with('EnrgSuccess', "Le livreur a ete sauvegarder avec succes ");
                }else{
                    return redirect()->back()->with('pb',"Un probleme est survenue veuillez reprendre l'enregistrement");
                }

            }else{
                return redirect()->back()->with('champsNotField',"Tous les champs ne sont pas correctement Remplis");
            }
        }
    }

    //liste de tous les livreurs 
    public function listAllLiv(){

        $livreur = Livreur::OrderBy('nom_livreurs','ASC')->get();

        if(isset($livreur)) {
          
           return view('AdminPages.Livreur.list',compact('livreur'));
        }else{
            return redirect()->back()->with('AucunLivreur', "Aucun Livreur n'est enregistrer");
        }
    }

    function change($id){
        $livreur = Livreur::where('id',$id)->first();
        if(!is_null($livreur)){
            return view('AdminPages.Livreur.edit',compact('livreur'));
        }else{
            return redirect()->back()->with('NotExist', "Le Livreur selectionner n'existe pas ");
        }

    }

    public function updateL(Request $request, $id){
        $livreur = Livreur::where('id',$id)->first();
        if(!is_null($livreur))
        {
            $livreur->nom_livreurs = $request->nom_livreurs;
            $livreur->prenom_livreurs = $request->prenom_livreurs;
            $livreur->contact = $request->contact;
            if (request()->file('photo')) {
                $img = request()->file('photo');
                    $messi = md5($img->getClientOriginalExtension().time().$request->contact).".".$img->getClientOriginalExtension();
                    $source = $img;
                    $target = 'images/Livreur/'.$messi; 
                    InterventionImage::make($source)->fit(106,100)->save($target);
                    $livreur->photo   =  $messi;
            }

            
            $livreur->update();
            if($livreur->update()){
                return redirect('/listAllLivreur')->with('ModifySuccess', "Le livreur selectionner a ete modifer avec succes");
            }else{
                return redirect('/listAllLivreur')->with('NotModifySuccess', "les informations du livreur n'ont pas pu etre  modifer ");
            }
        }else{
            return redirect()->back()->with('NotExist', "Le Livreur selectionner n'existe pas ");
        }
    }


    //delete
    public function deleteL($id){
        $livreur = Livreur::where('id',$id)->first();

        if(isset($livreur)) { 
            return view('AdminPages.Livreur.delete',compact('livreur'));
        }else{
            return redirect()->back()->with('NotExist', "Le Livreur selectionner n'existe pas ");
        }
    }


    public function destroyL($id){
        $livreur = Livreur::find($id);
        if(isset($livreur)) { 
            $livreur->delete();
            return redirect('/listAllLivreur')->with('DeleteSuccess',"Le livreur a ete supprimer");
        }else{
            return redirect()->back()->with('NotExist', "Le Livreur selectionner n'existe pas ");
        }
    }


    //recherche d'un Livreur
    public function findSearchLivreur(Request $request)
        {			
            $search = $request->search;		
            $livreur = Livreur::where( 'nom_livreurs', 'LIKE', '%' . $search . '%' )->orWhere( 'prenom_livreurs', 'LIKE', '%' . $search . '%' )->get();
            if (count ($livreur) > 0 && isset($livreur)){
            return view ( 'AdminPages.Livreur.search')->with('livreur',$livreur);
            }else{
            return redirect( '/listAllLivreur')->with( 'Nodetails','No Details found. Try to search again !' );	
            }	
        }




        //return les commades effectuees par un livreur 
        public function detailsLivr($id){
            $livreur = Livreur::where('id',$id)->firstOrFail();
            if(!is_null($livreur)){
                //toutes les commandes effectuer
                $nombreAll = Order::where('terminate',1)->where('status',1)->get();
                if(!is_null($nombreAll)){
                    $allcom= 0 ;
                    foreach($nombreAll as $nombreAlls){
                        if($nombreAlls->id_livreurs == $livreur->id){
                            $allcom++ ;
                        }
                    }
                    
                }
                
            //toutes les commandes effectuer today
                $order = Order::Where('terminate',1)->where('status',1)->whereDate('created_at', Carbon::today())->get();
                    if(!is_null($order)){
                        $n= 0 ;
                        foreach($order as $orders){
                            if($orders->id_livreurs == $livreur->id){
                                $n++ ;
                            }
                        }
                       
                    }

                    //toutes les commandes effectuer hier
                $nombrecommHier = Order::where('terminate',1)->where('status',1)->WhereDate('created_at',Carbon::yesterday())->get();
                if(!is_null($nombrecommHier)){
                    $countMeHier= 0 ;
                    foreach($nombrecommHier as $nombrecommHiers){
                        if($nombrecommHiers->id_livreurs == $livreur->id){
                            $countMeHier++ ;
                        }
                    }
                   
                }

                return view('AdminPages.Livreur.DetailLivreur',compact('allcom','countMeHier', 'n', 'livreur'));
            }
        }


        
    //retourner un seul livreur 

     /**
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function get_livreurs_det($id){
         $livreur = Livreur::Where('id',$id)->first();

            if(!is_null($livreur)){
                return $livreur ;
            }else{
                return "Aucun livreur trouver pour ce id Specifier";
            }
        }



    }


