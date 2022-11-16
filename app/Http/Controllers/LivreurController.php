<?php

namespace App\Http\Controllers;

use App\Models\Livreur;
use Illuminate\Http\Request;
use Intervention\Image\Image;
use Image as InterventionImage;

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


     

     //GET
    function nouveau(){
        return view('AdminPages.Livreur.new');
    }

    //POST
    public function createNewLivreur(Request $request)
    {
        $exist = Livreur::where('contact', $request->contact)->orWhere('prenom_livreurs',$request->prenom_livreurs)->get();
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
}
