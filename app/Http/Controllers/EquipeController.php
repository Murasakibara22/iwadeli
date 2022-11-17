<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Image;
use Image as InterventionImage;
use Illuminate\Support\Facades\Hash;
use App\Models\Equipe;
use Illuminate\Support\Str;

class EquipeController extends Controller
{
       function nouvelle()
    {
        return view('AdminPages.Equipe.new');
    }

    function ajoutTeam(Request $request)
    {
        $validateData =  $request->validate([
            'nom' => ['required', 'string', 'max:150'],
            'prenom' => ['required', 'string', 'max:255'],
            'contact'=>['required'],
            'email'=>['required'],
        ]);


        if($validateData)
        {
            $equipe = new Equipe;
            $equipe->nom = $request->nom;
            $equipe->prenom = $request->prenom;
            $equipe->email = $request->email;
            $equipe->contact = $request->contact;
            $equipe->slug   = Str::slug("$request->token".Hash::make($request->nom),"-");  
            if($request->hasfile('photo')){
                $img = request()->file('photo');
                    $messi = md5($img->getClientOriginalExtension().time().$request->email).".".$img->getClientOriginalExtension();
                    $source = $img;
                    $target = 'images/Equipe/'.$messi;
                    InterventionImage::make($source)->fit(252,282)->save($target);
                    $equipe->photo   =  $messi;
            }else{
                $equipe->photo   = "default.jpg";
            }
            
            if($request->fonction){
                $equipe->fonction = $request->fonction;
            }else{
                $equipe->fonction = "Emplyé(e)";
            }

            $equipe->save();
                if($equipe->save()){
                    return redirect()->back()->with('saveSuccessequipe', 'equipe sauvegarder avec succes');
                }else{
                    return redirect()->back()->with('NotsaveSuccessequipe', " un probelme est survenue lors de l'enregistrement d'une equipe ");
                }

        }else{
            return redirect()->back()->with('AucunChamps', 'les champs ne peuvent pas etre vide');
        }
    }

    function listAll()
    {
        $equipe = Equipe::OrderBy('nom', 'ASC')->get();
        return view('AdminPages.Equipe.list', compact('equipe'));
    }


    function change($slug)
    {
        $equipe = Equipe::where('slug',$slug)->first();
        if(!is_null($equipe))
        {
            return view('AdminPages.Equipe.edit',compact('equipe'));
        }else
        {
            return redirect()->back()->with('NotExist', "L'utilisateur selectionner n'existe pas , si le probleme persiste veuillez rafraichir votre page");
        }
    }


    function modifyEquipe(Request $request, $slug)
    {
        $equipe = Equipe::where('slug',$slug)->first();
        if(!is_null($equipe))
        {
            $equipe->nom = $request->nom;
            $equipe->prenom = $request->prenom;
            $equipe->email = $request->email;
            $equipe->contact = $request->contact;
            $equipe->slug   = Str::slug("$request->token".Hash::make($request->nom),"-");  
            if($request->hasfile('photo')){
                $img = request()->file('photo');
                    $messi = md5($img->getClientOriginalExtension().time().$request->email).".".$img->getClientOriginalExtension();
                    $source = $img;
                    $target = 'images/Equipe/'.$messi;
                    InterventionImage::make($source)->fit(252,282)->save($target);
                    $equipe->photo   =  $messi;
            }else{
                $equipe->photo   = "default.jpg";
            }
            if($request->fonction){
                $equipe->fonction = $request->fonction;
            }else{
                $equipe->fonction = "Emplyé(e)";
            }

            
            
            $equipe->update();
            if($equipe->update()){
                return redirect('/equipe_list')->with('ModifySccuessequipe', "les informations de l'utilisateur ont ete modifier avec succes");
            }else{
                return redirect()->back()->with('NotmodifySuccessequipe', "un probelme est survenue lors de la modification de l'utilisateur ");
            }
        }else{
            return redirect()->back()->with('NotExist', "L'utilisateur selectionner n'existe pas ,si le probleme persiste  veuillez rafraichir votre page");
        }

    }

    function supprime($slug)
    {
        $equipe = Equipe::where('slug',$slug)->first();
        if(!is_null($equipe))
        {
            return view('AdminPages.Equipe.delete',compact('equipe'));

        }else{
                return redirect()->back()->with('NotExist', "L'utilisateur selectionner n'existe pas ,si le probleme persiste veuillez rafraichir votre page");
            }
    }

    function supprimeeEquipe($slug)
    {
        $equipe = Equipe::where('slug',$slug)->first();
        if(!is_null($equipe))
        {
            $equipe->delete();
            return redirect('/equipe_list')->with('SupprimerAvecSuccess', "L'utilisateur selectionner a ete supprimer avec success");
        }else{
                return redirect()->back()->with('NotExist', "L'utilisateur selectionner n'existe pas ,si le probleme persiste veuillez rafraichir votre page");
            }
    }



    function findSearchEquipe(Request $request)
    {			
        $search = $request->search;		
        $equipe = Equipe::where( 'nom', 'LIKE', '%' . $search . '%' )->orWhere( 'email', 'LIKE', '%' . $search . '%' )->orWhere( 'prenom', 'LIKE', '%' . $search . '%' )->get();
        if (count ($equipe) > 0 && isset($equipe)){
        return view ( 'AdminPages.Equipe.search')->with('equipe',$equipe);
        }else{
        return redirect( '/equipe_list')->with( 'Nodetails','No Details found. Esaayez encore !' );	
        }	
    }
}
