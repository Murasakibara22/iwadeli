<?php

namespace App\Http\Controllers;

use App\Models\Temoignage;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Image;
use Image as InterventionImage;
use Illuminate\Support\Facades\Hash;

class TemoignageController extends Controller
{
    
    public function NewTemoignage(){
        return view('AdminPages.Site.Temoignage.new');
      }

      public function addTemoignage(Request $request){
            try{
                $temoignage              = new Temoignage ;
                $temoignage->nom         = $request->nom;
                $temoignage->profession  = $request->profession;
                $temoignage->slug   = Str::slug("$request->token". Hash::make($request->token),"-");
                $temoignage->message     = $request->message;
                if (request()->file('photo')) {
                    $img = request()->file('photo');
                        $messi = md5($img->getClientOriginalExtension().time().$request->nom).".".$img->getClientOriginalExtension();
                        $source = $img;
                        $target = 'images/Temoignage/'.$messi;
                        InterventionImage::make($source)->fit(102,103)->save($target);
                         $temoignage->photo  =  $messi;
                }else{
                    $temoignage->photo   =  'default.jpg';
                }
               
                $temoignage->save();

                if($temoignage->save()){
                    return redirect()->back()->with('successTEmAjou','temoignageaire sauvegarder avec succès');
                }else{
                    return redirect('/Temoignage_list')->with('error',"l'un des champs n'est pas correctement inscrit");
                }

       }catch(Exception $err){
         report($err);
            return redirect('/Temoignage_list')->with('erreur','un probleme est survenue ');
        }

      }

        public function listAllTemoignage(){
            $Temoignage = Temoignage::all();
            return view('AdminPages.Site.Temoignage.list', compact('Temoignage'));
        }

      public function editTemoignage($slug){
        try{
        $Temoignage = Temoignage::where('slug',$slug)->first();
            if(isset($Temoignage) ){
                return view('AdminPages.Site.Temoignage.edit', compact('Temoignage')) ;
            }else{
                 return redirect('/Temoignage_list')->with('NotExist', 'pas de tem') ;
                }
        }catch(Exception $err){
            report($err);
               return redirect('/Temoignage_list')->with('erreur','un probleme est survenue ');
           }
    }

    public function editTemoignages(Request $request,$slug)
    {
        try{
        $Temoignage = Temoignage::where('slug',$slug)->first();
            if(isset($Temoignage) ){ 
                $Temoignage->nom         = $request->nom;
                $Temoignage->profession  = $request->profession;
                $Temoignage->slug   = Str::slug("$request->token". Hash::make($request->token),"-");
                $Temoignage->message     = $request->message;
      
                if (request()->file('photo')) {
                    $img = request()->file('photo');
                        $messi = md5($img->getClientOriginalExtension().time().$request->nom).".".$img->getClientOriginalExtension();
                        $source = $img;
                        $target = 'images/Temoignage/'.$messi;
                         InterventionImage::make($source)->fit(102,103)->save($target);
                         $Temoignage->photo   =  $messi;
                }
                $Temoignage->update();

                if($Temoignage->update()){
                     return redirect('/Temoignage_list')->with('ModifSuccess', ' de tem'); 
                    }else{
                        return redirect('/Temoignage_list')->with('NotModifSuccess', ' le tem ne peux pas etres modif');
                    }

            }
        }catch(Exception $err){
            report($err);
               return redirect('/Temoignage_list')->with('erreur','un probleme est survenue ');
           }
    }
      //
      public function deleteTemoignage($slug){
        try{
        $Temoignage = Temoignage::where('slug',$slug)->first();
            if(isset($Temoignage)) { 
                return view('AdminPages.Site.Temoignage.delete', compact('Temoignage')); 
            }else
            {
                return redirect('/Temoignage_list')->with('NotExist', 'pas de tem') ;
            }
        }catch(Exception $err){
            report($err);
               return redirect('/Temoignage_list')->with('erreur','un probleme est survenue ');
           }
      }

      public function destroyTemoignage($slug){
        try{
            $Temoignage = Temoignage::where('slug',$slug)->first();
            if(isset($Temoignage)) { 
            $Temoignage->delete();
            return redirect('/Temoignage_list')->with('succ', 'delete avce succes ');
            }else{
                return redirect('/Temoignage_list')->with('NotExist', 'pas de tem') ;
            }
        }catch(Exception $err){
            report($err);
               return redirect('/Temoignage_list')->with('erreur','un probleme est survenue ');
           }
      }
}
