<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Contact;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ContactController extends Controller
{
    public function addContact(Request $request){
        try{
              $contacts                = new Contact ;
          $contacts->nom       = $request->nom;
          $contacts->email   = $request->email;
          $contacts->sujet   = $request->sujet;
          $contacts->Comment   = $request->Comment;
          $contacts->slug   =  Str::slug("$request->token".Hash::make($request->nom.$request->sujet),"-");
  
          $contacts->save();
          if( $contacts->save()){
            return  redirect('/contactez-nous')->with('success','Messsage  envoyer avec succès');
          }else{
            return  redirect('/contactez-nous')->with('error','Messsage  non send avec succès');
          }
      }catch(Exception $e){
          report($e);

          return  redirect('/contactez-nous')->with('error','Messsage  non send avec succès');
      }
    
}


public function listContact(){
    $contact = Contact::all();

    return view('AdminPages.Site.Contact.list', compact('contact'));
  }


  public function Contactdelete($slug){
    try{
        $contacts = Contact::where('slug',$slug)->first();
        if(isset($contacts)){
        return view('AdminPages.Site.Contact.delete', compact('contacts'));
        }else{
            return redirect('/contact_list')->with('Notsupprimer', "le contact n'existe pas");
        }

      }catch(Exception $e){
        report($e);
        return redirect('/contact_list')->with('error', "le contact n'existe pas");
      }
  }

  public function Contactdestroy($slug){
    try{
        $contacts = Contact::where('slug',$slug)->first();
        if(isset($contacts)){
            $contacts->delete();
            return redirect('/contact_list')->with('supprimer', 'contct delete');
        }else{
          return redirect('/contact_list')->with('Notsupprimer', "le contact n'existe pas");
        }
     }catch(Exception $e){
       report($e);
       return redirect('/contact_list')->with('error', "le contact n'existe pas");
     }
   
  }

}
