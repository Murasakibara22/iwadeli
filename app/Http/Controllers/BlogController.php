<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Blog;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Image;
use Image as InterventionImage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;

class BlogController extends Controller
{
    
    public function newBlog(){
        return view('AdminPages.Site.Blog.new');
    }


    public function addBlog(Request $request)
    {
       
                $blog                = new Blog ;
                $blog->titre       = $request->titre;
                $blog->description   = $request->description;
                $blog->slug   = Str::slug("$request->token". Hash::make($request->titre),"-");
                $blog->date   = $request->date;
                //renomer les photos et les stocker dans un dossier et enrg le nom en BD
                if (request()->file('banner')) {
                        $img = request()->file('banner');
                            $photo = md5($img->getClientOriginalExtension().time().$request->updated_at).".".$img->getClientOriginalExtension();
                            $source = $img;
                            $target = 'images/blogs/'.$photo;
                            InterventionImage::make($source)->fit(550,300)->save($target);
                            $blog->banner   =  $photo;
                }else {
                    $blog->banner = 'default.jpg';
                }

                $blog->save();

                

                
                if($blog->save()){
                    return redirect()->back()->with('success','Nou sauvegarder avec succès');
                }else{
                    return redirect()->back()->with('erreur','Nou sauvegarder avec succès');
                }

                
         }
        


    //liste blog
    public function listAllBlog(){

        $blog = Blog::all();

        
        $bloge = Blog::all();

        return view('AdminPages.Site.Blog.list', compact('blog', 'bloge'));  
      }

      //view modifier blog
      public function editBlog($slug)
      {
                try{
                        $blo  = Blog::where('slug',$slug)->first();
                        if(isset($blo)){
                            return view('AdminPages.Site.Blog.edit',compact('blo'));
                        }else{
                            return redirect('/Blog_list')->with('erreur', "Le Blog specifier est introuvable");
                        }
                }catch(Exception $e){
                    report($e);
                    return redirect('/Blog_list')->with('error', 'un probleme est survenur veuillez reessayer plus tard');
                }

      }


      public function editBlogs(Request $request, $slug)
      {
                try{
                        $bloblo               =  Blog::where('slug',$slug)->first();
                        if(isset($bloblo)){
                        $lui = Auth::user()->id;
                        $bloblo->titre        = $request->titre;
                        $bloblo->description   = $request->description;
                        $bloblo->slug   = Str::slug("$request->token". Hash::make($request->titre),"-");
                        $bloblo->date   = $request->date;

                        if (request()->file('banner')) {

                                $doc_path = "images/blogs/.$bloblo->banner";
                                if (File::exists($doc_path)) {
                                    File::delete($doc_path);
                                }

                            $img = request()->file('banner');
                                $photo = md5($img->getClientOriginalExtension().time().$request->updated_at).".".$img->getClientOriginalExtension();
                                $source = $img;
                                $target = 'images/blogs/'.$photo;
                                InterventionImage::make($source)->fit(550,300)->save($target);
                                $bloblo->banner   =  $photo;
                        }else {
                            $bloblo->banner = 'default.jpg';
                        }
                        $bloblo->user_id = $lui;
                        $bloblo->update();

                        if($bloblo->update()){
                            return redirect('/Blog_list')->with('succes', 'Utilisateurs modifier');
                        }else{
                            return redirect('/Blog_list')->with('er', "Le Blog specifier est introuvable");
                        }
                                    
                        }else{
                            return redirect('/Blog_list')->with('erreur', "Le Blog specifier est introuvable");
                        }


            }catch(Exception $er){
                report($er);
                return redirect('/Blog_list')->with('error', 'un probleme est survenur veuillez reessayer plus tard');
            }
        }
                
           


           //vue delete un Blog
           public function deleteBlog($slug)
           {
                     try{
                             $blo  = Blog::where('slug',$slug)->first();
                             if(isset($blo)){
                                 return view('AdminPages.Site.Blog.delete',compact('blo'));
                             }else{
                                 return redirect('/Blog_list')->with('erreur', "Le Blog specifier est introuvable");
                             }
                     }catch(Exception $e){
                         report($e);
                         return redirect('/Blog_list')->with('error', 'un probleme est survenur veuillez reessayer plus tard');
                     }
     
           }

           //destroy Blog
           public function destroyBlog($slug)
           {
                     try{
                             $blog  = Blog::where('slug',$slug)->first();

                             if(isset($blog)){
                                    $doc_path = "images/blogs.$blog->banner";
                                    if (File::exists($doc_path)) {
                                        File::delete($doc_path);
                                    }

                                $blog->delete();
                                 return redirect('/Blog_list')->with('suprime',' Blog delete avec succes');
                             }else{
                                 return redirect('/Blog_list')->with('erreur', "Le Blog specifier est introuvable");
                             }
                     }catch(Exception $e){
                         report($e);
                         return redirect('/Blog_list')->with('error', 'un probleme est survenur veuillez reessayer plus tard');
                     }
     
           }
}
