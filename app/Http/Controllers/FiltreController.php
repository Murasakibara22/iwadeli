<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Livreur;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class FiltreController extends Controller
{
    ////////////////////////////////////////////////////////////
    /**RECHERCHE ET FILTRE DANS TOUTES LES COMMANDES TERMINER */
    ////////////////////////////////////////////////////////////

        //filtre sur toutes les commandes Terminer 
        function filtreAllCT(Request $request)
    {
        $today = date('j M, Y', strtotime(Carbon::today()) );
        $yesterday = date('j M, Y', strtotime(Carbon::yesterday()) );
        $typeOfFiltreParent = $request->FiltrerSelon;
        if($request->FiltrerSelon == "Aujourd'hui"){
            $commande = Order::WhereDate('updated_at',Carbon::today())->where('terminate',1)->where('status',1)->OrderBy('created_at','DESC')->get();
      
            if (count ($commande) > 0 && isset($commande)){
            return view('AdminPages.Filtre.CT.list',compact('today','yesterday','typeOfFiltreParent'))->with('commande',$commande);
        }else{
            return redirect('/listAllComTerminer')->with( 'Nodetails','No Details found. Esaayez encore  !' );	
            }	
        }
        if($request->FiltrerSelon == "hier"){

            $commande = Order::WhereDate('updated_at',Carbon::yesterday())->where('terminate',1)->where('status',1)->OrderBy('created_at','DESC')->get();

            if (count ($commande) > 0 && isset($commande)){
                return view('AdminPages.Filtre.CT.list',compact('today','yesterday','typeOfFiltreParent'))->with('commande',$commande);
            }else{
                return redirect( '/listAllComTerminer')->with( 'Nodetails','No Details found. Esaayez encore  !' );	
                }
        }
        if($request->FiltrerSelon == "7 derniers jours"){
            $commande = Order::WhereDate('updated_at',Carbon::week())->where('terminate',1)->where('status',1)->OrderBy('created_at','DESC')->get();

            if (count ($commande) > 0 && isset($commande)){
                return view('AdminPages.Filtre.CT.list',compact('today','yesterday','typeOfFiltreParent'))->with('commande',$commande);
            }else{
                return redirect( '/listAllComTerminer')->with( 'Nodetails','No Details found. Esaayez encore  !' );	
                }
        }
        if($request->FiltrerSelon == "il y a un Mois"){
            $commande = Order::WhereDate('updated_at',Carbon::Month())->where('terminate',1)->where('status',1)->OrderBy('created_at','DESC')->get();

            if (count ($commande) > 0 && isset($commande)){
                return view('AdminPages.Filtre.CT.list',compact('today','yesterday','typeOfFiltreParent'))->with('commande',$commande);
            }else{
                return redirect( '/listAllComTerminer')->with( 'Nodetails','No Details found. Esaayez encore  !' );	
                }
        }
    }



    //recherche dans la page commande terminer
    function findSearInOrderT(Request $request){
        $today = date('j M, Y', strtotime(Carbon::today()) );
        $yesterday = date('j M, Y', strtotime(Carbon::yesterday()) );
        $searchs = $request->search;		
        $commande = Order::where( 'lieudedepart', 'LIKE', '%' . $searchs . '%' )->WhereDate('updated_at',Carbon::today())->where('terminate',1)->where('status',1)->OrderBy('created_at','DESC')->get();
        if (count ($commande) > 0 && isset($commande)){
        return view ( 'AdminPages.Filtre.CT.listInCT',compact('today','yesterday','searchs'))->with('commande',$commande);
        }else{
        return redirect()->back()->with( 'Nodetails','No Details found. Try to search again !' );	
        }	
    }


    //range dans le resultat de CT
    function RangeInAllCT(Request $request)
    {
        $today = date('j M, Y', strtotime(Carbon::today()) );
        $yesterday = date('j M, Y', strtotime(Carbon::yesterday()) );
        $firsstFiltreChoisie = $request->firsstFiltreChoisie;
/**TODAY */
        if($request->firsstFiltreChoisie == "Aujourd'hui"){
                    if($request->FiltrerSelon == "Lieu de Depart"){
                        $commande = Order::WhereDate('updated_at',Carbon::today())->where('terminate',1)->where('status',1)->OrderBy('lieudedepart','ASC')->get();
                
                        if (count ($commande) > 0 && isset($commande)){
                        return view('AdminPages.Filtre.CT.Range',compact('today','yesterday','firsstFiltreChoisie'))->with('commande',$commande);
                    }else{
                        return redirect('/listAllComTerminer')->with( 'Nodetails','No Details found. Esaayez encore  !' );	
                        }	
                    }
                    if($request->FiltrerSelon == "Lieu de D'arriver"){

                        $commande = Order::WhereDate('updated_at',Carbon::today())->where('terminate',1)->where('status',1)->OrderBy('lieudelivraison','ASC')->get();

                        if (count ($commande) > 0 && isset($commande)){
                            return view('AdminPages.Filtre.CT.Range',compact('today','yesterday','firsstFiltreChoisie'))->with('commande',$commande);
                        }else{
                            return redirect( '/listAllComTerminer')->with( 'Nodetails','No Details found. Esaayez encore  !' );	
                            }
                    }
                    if($request->FiltrerSelon == "prix"){
                        $commande = Order::WhereDate('updated_at',Carbon::today())->where('terminate',1)->where('status',1)->OrderBy('montant','ASC')->get();

                        if (count ($commande) > 0 && isset($commande)){
                            return view('AdminPages.Filtre.CT.Range',compact('today','yesterday','firsstFiltreChoisie'))->with('commande',$commande);
                        }else{
                            return redirect( '/listAllComTerminer')->with( 'Nodetails','No Details found. Esaayez encore  !' );	
                            }
                    }
        }


/**HIER */

        if($request->firsstFiltreChoisie == "hier"){
            if($request->FiltrerSelon == "Lieu de Depart"){
                $commande = Order::WhereDate('updated_at',Carbon::yesterday())->where('terminate',1)->where('status',1)->OrderBy('lieudedepart','ASC')->get();
        
                if (count ($commande) > 0 && isset($commande)){
                return view('AdminPages.Filtre.CT.Range',compact('today','yesterday','firsstFiltreChoisie'))->with('commande',$commande);
            }else{
                return redirect()->back()->with( 'Nodetails','No Details found. Esaayez encore  !' );	
                }	
            }
            if($request->FiltrerSelon == "Lieu de D'arriver"){

                $commande = Order::WhereDate('updated_at',Carbon::yesterday())->where('terminate',1)->where('status',1)->OrderBy('lieudelivraison','ASC')->get();

                if (count ($commande) > 0 && isset($commande)){
                    return view('AdminPages.Filtre.CT.Range',compact('today','yesterday','firsstFiltreChoisie'))->with('commande',$commande);
                }else{
                    return redirect( )->back()->with( 'Nodetails','No Details found. Esaayez encore  !' );	
                    }
            }
            if($request->FiltrerSelon == "prix"){
                $commande = Order::WhereDate('updated_at',Carbon::yesterday())->where('terminate',1)->where('status',1)->OrderBy('montant','ASC')->get();

                if (count ($commande) > 0 && isset($commande)){
                    return view('AdminPages.Filtre.CT.Range',compact('today','yesterday','firsstFiltreChoisie'))->with('commande',$commande);
                }else{
                    return redirect( )->back()->with( 'Nodetails','No Details found. Esaayez encore  !' );	
                    }
            }
        }
       
    }


    // //Range dans la recherche du filtre de toutes les commandes Terminer
    // function RangeInSearchAllCT(Request $request){
    //     $searched = $request->search;
    //     $today = date('j M, Y', strtotime(Carbon::today()) );
    //     $yesterday = date('j M, Y', strtotime(Carbon::yesterday()) );


    //     if($request->FiltrerSelon == "Lieu de Depart"){
    //         $commande = Order::where( 'lieudedepart', 'LIKE', '%' . $searched . '%' )->orWhere( 'lieudelivraison', 'LIKE', '%' . $searched . '%' )->where('terminate',1)->where('status',1)->OrderBy('lieudedepart','ASC')->get();
      
    //         if (count ($commande) > 0 && isset($commande)){
    //         return view('AdminPages.Filtre.CT.RangeInSearch',compact('today','yesterday','searched'))->with('commande',$commande);
    //     }else{
    //         return redirect('/listAllComTerminer')->with( 'Nodetails','No Details found. Esaayez encore  !' );	
    //         }	
    //     }
    //     if($request->FiltrerSelon == "Lieu de D'arriver"){

    //         $commande = Order::where( 'lieudedepart', 'LIKE', '%' . $searched . '%' )->orWhere( 'lieudelivraison', 'LIKE', '%' . $searched . '%' )->where('terminate',1)->where('status',1)->OrderBy('lieudelivraison','ASC')->get();

    //         if (count ($commande) > 0 && isset($commande)){
    //             return view('AdminPages.Filtre.CT.RangeInSearch',compact('today','yesterday','searched'))->with('commande',$commande);
    //         }else{
    //             return redirect( '/listAllComTerminer')->with( 'Nodetails','No Details found. Esaayez encore  !' );	
    //             }
    //     }
    //     if($request->FiltrerSelon == "prix"){
    //         $commande = Order::where( 'lieudedepart', 'LIKE', '%' . $searched . '%' )->orWhere( 'lieudelivraison', 'LIKE', '%' . $searched . '%' )->where('terminate',1)->where('status',1)->OrderBy('montant','ASC')->get();

    //         if (count ($commande) > 0 && isset($commande)){
    //             return view('AdminPages.Filtre.CT.RangeInSearch',compact('today','yesterday','searched'))->with('commande',$commande);
    //         }else{
    //             return redirect( '/listAllComTerminer')->with( 'Nodetails','No Details found. Esaayez encore  !' );	
    //             }
    //     }
       
    // }


     ////////////////////////////////////////////////////////////
    /** END RECHERCHE ET FILTRE DANS TOUTES LES COMMANDES TERMINER */
    ////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


     ////////////////////////////////////////////////////////////
    /**RECHERCHE ET FILTRE DANS TOUTES LES COMMANDES EN COUR */
    ////////////////////////////////////////////////////////////



      //filtre sur toutes les commandes En cour  
      function filtreAllCEC(Request $request)
      {
          $today = date('j M, Y', strtotime(Carbon::today()) );
          $yesterday = date('j M, Y', strtotime(Carbon::yesterday()) );
          $typeOfFiltreParent = $request->FiltrerSelon;
          if($request->FiltrerSelon == "Aujourd'hui"){
              $commande = Order::WhereDate('updated_at',Carbon::today())->where('terminate',0)->where('status',1)->OrderBy('created_at','DESC')->get();
        
              if (count ($commande) > 0 && isset($commande)){
              return view('AdminPages.Filtre.CEC.list',compact('today','yesterday','typeOfFiltreParent'))->with('commande',$commande);
          }else{
              return redirect()->back()->with( 'Nodetails','No Details found. Esaayez encore  !' );	
              }	
          }
          if($request->FiltrerSelon == "hier"){
  
              $commande = Order::WhereDate('updated_at',Carbon::yesterday())->where('terminate',0)->where('status',1)->OrderBy('created_at','DESC')->get();
  
              if (count ($commande) > 0 && isset($commande)){
                  return view('AdminPages.Filtre.CEC.list',compact('today','yesterday','typeOfFiltreParent'))->with('commande',$commande);
              }else{
                  return redirect()->back()->with( 'Nodetails','No Details found. Esaayez encore  !' );	
                  }
          }
          if($request->FiltrerSelon == "7 derniers jours"){
              $commande = Order::WhereDate('updated_at',Carbon::week())->where('terminate',0)->where('status',1)->OrderBy('created_at','DESC')->get();
  
              if (count ($commande) > 0 && isset($commande)){
                  return view('AdminPages.Filtre.CEC.list',compact('today','yesterday','typeOfFiltreParent'))->with('commande',$commande);
              }else{
                  return redirect()->back()->with( 'Nodetails','No Details found. Esaayez encore  !' );	
                  }
          }
          if($request->FiltrerSelon == "il y a un Mois"){
              $commande = Order::WhereDate('updated_at',Carbon::Month())->where('terminate',0)->where('status',1)->OrderBy('created_at','DESC')->get();
  
              if (count ($commande) > 0 && isset($commande)){
                  return view('AdminPages.Filtre.CEC.list',compact('today','yesterday','typeOfFiltreParent'))->with('commande',$commande);
              }else{
                  return redirect()->back()->with( 'Nodetails','No Details found. Esaayez encore  !' );	
                  }
          }
      }
  
  
  
      //recherche dans la page commande terminer
      function findSearInOrderEC(Request $request){
          $today = date('j M, Y', strtotime(Carbon::today()) );
          $yesterday = date('j M, Y', strtotime(Carbon::yesterday()) );
          $searchs = $request->search;		
          $commande = Order::where( 'lieudedepart', 'LIKE', '%' . $searchs . '%' )->WhereDate('updated_at',Carbon::today())->where('terminate',0)->where('status',1)->OrderBy('created_at','DESC')->get();
          if (count ($commande) > 0 && isset($commande)){
          return view ( 'AdminPages.Filtre.CEC.listInCEC',compact('today','yesterday','searchs'))->with('commande',$commande);
          }else{
          return redirect()->back()->with( 'Nodetails','No Details found. Try to search again !' );	
          }	
      }
  
  
      //range dans le resultat de CT
      function RangeInAllCEC(Request $request)
      {
          $today = date('j M, Y', strtotime(Carbon::today()) );
          $yesterday = date('j M, Y', strtotime(Carbon::yesterday()) );
          $firsstFiltreChoisie = $request->firsstFiltreChoisie;
  /**TODAY */
          if($request->firsstFiltreChoisie == "Aujourd'hui"){
                      if($request->FiltrerSelon == "Lieu de Depart"){
                          $commande = Order::WhereDate('updated_at',Carbon::today())->where('terminate',0)->where('status',1)->OrderBy('lieudedepart','ASC')->get();
                  
                          if (count ($commande) > 0 && isset($commande)){
                          return view('AdminPages.Filtre.CEC.Range',compact('today','yesterday','firsstFiltreChoisie'))->with('commande',$commande);
                      }else{
                          return redirect()->back()->with( 'Nodetails','No Details found. Esaayez encore  !' );	
                          }	
                      }
                      if($request->FiltrerSelon == "Lieu de D'arriver"){
  
                          $commande = Order::WhereDate('updated_at',Carbon::today())->where('terminate',0)->where('status',1)->OrderBy('lieudelivraison','ASC')->get();
  
                          if (count ($commande) > 0 && isset($commande)){
                              return view('AdminPages.Filtre.CEC.Range',compact('today','yesterday','firsstFiltreChoisie'))->with('commande',$commande);
                          }else{
                              return redirect( '/listAllComTerminer')->with( 'Nodetails','No Details found. Esaayez encore  !' );	
                              }
                      }
                      if($request->FiltrerSelon == "prix"){
                          $commande = Order::WhereDate('updated_at',Carbon::today())->where('terminate',0)->where('status',1)->OrderBy('montant','ASC')->get();
  
                          if (count ($commande) > 0 && isset($commande)){
                              return view('AdminPages.Filtre.CEC.Range',compact('today','yesterday','firsstFiltreChoisie'))->with('commande',$commande);
                          }else{
                              return redirect( '/listAllComTerminer')->with( 'Nodetails','No Details found. Esaayez encore  !' );	
                              }
                      }
          }
  
  
  /**HIER */
  
          if($request->firsstFiltreChoisie == "hier"){
              if($request->FiltrerSelon == "Lieu de Depart"){
                  $commande = Order::WhereDate('updated_at',Carbon::yesterday())->where('terminate',0)->where('status',1)->OrderBy('lieudedepart','ASC')->get();
          
                  if (count ($commande) > 0 && isset($commande)){
                  return view('AdminPages.Filtre.CEC.Range',compact('today','yesterday','firsstFiltreChoisie'))->with('commande',$commande);
              }else{
                  return redirect()->back()->with( 'Nodetails','No Details found. Esaayez encore  !' );	
                  }	
              }
              if($request->FiltrerSelon == "Lieu de D'arriver"){
  
                  $commande = Order::WhereDate('updated_at',Carbon::yesterday())->where('terminate',0)->where('status',1)->OrderBy('lieudelivraison','ASC')->get();
  
                  if (count ($commande) > 0 && isset($commande)){
                      return view('AdminPages.Filtre.CEC.Range',compact('today','yesterday','firsstFiltreChoisie'))->with('commande',$commande);
                  }else{
                      return redirect( )->back()->with( 'Nodetails','No Details found. Esaayez encore  !' );	
                      }
              }
              if($request->FiltrerSelon == "prix"){
                  $commande = Order::WhereDate('updated_at',Carbon::yesterday())->where('terminate',0)->where('status',1)->OrderBy('montant','ASC')->get();
  
                  if (count ($commande) > 0 && isset($commande)){
                      return view('AdminPages.Filtre.CEC.Range',compact('today','yesterday','firsstFiltreChoisie'))->with('commande',$commande);
                  }else{
                      return redirect( )->back()->with( 'Nodetails','No Details found. Esaayez encore  !' );	
                      }
              }
          }
         
      }




     ////////////////////////////////////////////////////////////
    /** END RECHERCHE ET FILTRE DANS TOUTES LES COMMANDES EN COUR */
    ////////////////////////////////////////////////////////////





    
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


     ////////////////////////////////////////////////////////////
    /**RECHERCHE ET FILTRE DANS TOUTES LES COMMANDES EN ATTENTE */
    ////////////////////////////////////////////////////////////




      //filtre sur toutes les commandes En Attente  
      function filtreAllCEA(Request $request)
      {
          $today = date('j M, Y', strtotime(Carbon::today()) );
          $yesterday = date('j M, Y', strtotime(Carbon::yesterday()) );
          $typeOfFiltreParent = $request->FiltrerSelon;
          if($request->FiltrerSelon == "Aujourd'hui"){
              $commande = Order::WhereDate('updated_at',Carbon::today())->where('terminate',0)->where('status',0)->where('id_livreurs',NULL)->OrderBy('created_at','DESC')->get();
        
              if (count ($commande) > 0 && isset($commande)){
                $livreur = Livreur::OrderBy('nom_livreurs','ASC');
              return view('AdminPages.Filtre.CEA.list',compact('today','livreur','yesterday','typeOfFiltreParent'))->with('commande',$commande);
          }else{
              return redirect()->back()->with( 'Nodetails','No Details found. Esaayez encore  !' );	
              }	
          }
          if($request->FiltrerSelon == "hier"){
  
              $commande = Order::WhereDate('updated_at',Carbon::yesterday())->where('terminate',0)->where('status',0)->where('id_livreurs',NULL)->OrderBy('created_at','DESC')->get();
  
              if (count ($commande) > 0 && isset($commande)){
                $livreur = Livreur::OrderBy('nom_livreurs','ASC');
                  return view('AdminPages.Filtre.CEA.list',compact('today','livreur','yesterday','typeOfFiltreParent'))->with('commande',$commande);
              }else{
                  return redirect()->back()->with( 'Nodetails','No Details found. Esaayez encore  !' );	
                  }
          }
          if($request->FiltrerSelon == "7 derniers jours"){
              $commande = Order::WhereDate('updated_at',Carbon::week())->where('terminate',0)->where('status',0)->where('id_livreurs',NULL)->OrderBy('created_at','DESC')->get();
  
              if (count ($commande) > 0 && isset($commande)){
                $livreur = Livreur::OrderBy('nom_livreurs','ASC');
                  return view('AdminPages.Filtre.CEA.list',compact('today','livreur','yesterday','typeOfFiltreParent'))->with('commande',$commande);
              }else{
                  return redirect()->back()->with( 'Nodetails','No Details found. Esaayez encore  !' );	
                  }
          }
          if($request->FiltrerSelon == "il y a un Mois"){
              $commande = Order::WhereDate('updated_at',Carbon::Month())->where('terminate',0)->where('status',0)->where('id_livreurs',NULL)->OrderBy('created_at','DESC')->get();
  
              if (count ($commande) > 0 && isset($commande)){
                $livreur = Livreur::OrderBy('nom_livreurs','ASC');
                  return view('AdminPages.Filtre.CEA.list',compact('today','livreur','yesterday','typeOfFiltreParent'))->with('commande',$commande);
              }else{
                  return redirect()->back()->with( 'Nodetails','No Details found. Esaayez encore  !' );	
                  }
          }
      }
  
  
  
      //recherche dans la page commande En Attente
      function findSearInOrderEA(Request $request){
          $today = date('j M, Y', strtotime(Carbon::today()) );
          $yesterday = date('j M, Y', strtotime(Carbon::yesterday()) );
          $searchs = $request->search;		
          $commande = Order::where( 'lieudedepart', 'LIKE', '%' . $searchs . '%' )->WhereDate('updated_at',Carbon::today())->where('terminate',0)->where('status',0)->where('id_livreurs',NULL)->OrderBy('created_at','DESC')->get();
          if (count ($commande) > 0 && isset($commande)){
            $livreur = Livreur::OrderBy('nom_livreurs','ASC');
          return view ( 'AdminPages.Filtre.CEA.listInCEA',compact('today','livreur','yesterday','searchs'))->with('commande',$commande);
          }else{
          return redirect()->back()->with( 'Nodetails','No Details found. Try to search again !' );	
          }	
      }
  
  
      //range dans le resultat de commande en attente
      function RangeInAllCEA(Request $request)
      {
          $today = date('j M, Y', strtotime(Carbon::today()) );
          $yesterday = date('j M, Y', strtotime(Carbon::yesterday()) );
          $firsstFiltreChoisie = $request->firsstFiltreChoisie;
          $livreur = Livreur::OrderBy('nom_livreurs','ASC');
  /**TODAY */
          if($request->firsstFiltreChoisie == "Aujourd'hui"){
                      if($request->FiltrerSelon == "Lieu de Depart"){
                          $commande = Order::WhereDate('updated_at',Carbon::today())->where('terminate',0)->where('status',0)->where('id_livreurs',NULL)->OrderBy('lieudedepart','ASC')->get();
                  
                          if (count ($commande) > 0 && isset($commande)){
                          return view('AdminPages.Filtre.CEA.Range',compact('today','livreur','yesterday','firsstFiltreChoisie'))->with('commande',$commande);
                      }else{
                          return redirect()->back()->with( 'Nodetails','No Details found. Esaayez encore  !' );	
                          }	
                      }
                      if($request->FiltrerSelon == "Lieu de D'arriver"){
  
                          $commande = Order::WhereDate('updated_at',Carbon::today())->where('terminate',0)->where('status',0)->where('id_livreurs',NULL)->OrderBy('lieudelivraison','ASC')->get();
  
                          if (count ($commande) > 0 && isset($commande)){
                              return view('AdminPages.Filtre.CEA.Range',compact('today','livreur','yesterday','firsstFiltreChoisie'))->with('commande',$commande);
                          }else{
                              return redirect( '/listAllComTerminer')->with( 'Nodetails','No Details found. Esaayez encore  !' );	
                              }
                      }
                      if($request->FiltrerSelon == "prix"){
                          $commande = Order::WhereDate('updated_at',Carbon::today())->where('terminate',0)->where('status',0)->where('id_livreurs',NULL)->OrderBy('montant','ASC')->get();
  
                          if (count ($commande) > 0 && isset($commande)){
                              return view('AdminPages.Filtre.CEA.Range',compact('today','livreur','yesterday','firsstFiltreChoisie'))->with('commande',$commande);
                          }else{
                              return redirect( '/listAllComTerminer')->with( 'Nodetails','No Details found. Esaayez encore  !' );	
                              }
                      }
          }
  
  
  /**HIER */
  
          if($request->firsstFiltreChoisie == "hier"){
              if($request->FiltrerSelon == "Lieu de Depart"){
                  $commande = Order::WhereDate('updated_at',Carbon::yesterday())->where('terminate',0)->where('status',0)->where('id_livreurs',NULL)->OrderBy('lieudedepart','ASC')->get();
          
                  if (count ($commande) > 0 && isset($commande)){
                  return view('AdminPages.Filtre.CEA.Range',compact('today','livreur','yesterday','firsstFiltreChoisie'))->with('commande',$commande);
              }else{
                  return redirect()->back()->with( 'Nodetails','No Details found. Esaayez encore  !' );	
                  }	
              }
              if($request->FiltrerSelon == "Lieu de D'arriver"){
  
                  $commande = Order::WhereDate('updated_at',Carbon::yesterday())->where('terminate',0)->where('status',0)->where('id_livreurs',NULL)->OrderBy('lieudelivraison','ASC')->get();
  
                  if (count ($commande) > 0 && isset($commande)){
                      return view('AdminPages.Filtre.CEA.Range',compact('today','livreur','yesterday','firsstFiltreChoisie'))->with('commande',$commande);
                  }else{
                      return redirect( )->back()->with( 'Nodetails','No Details found. Esaayez encore  !' );	
                      }
              }
              if($request->FiltrerSelon == "prix"){
                  $commande = Order::WhereDate('updated_at',Carbon::yesterday())->where('terminate',0)->where('status',0)->where('id_livreurs',NULL)->OrderBy('montant','ASC')->get();
  
                  if (count ($commande) > 0 && isset($commande)){
                      return view('AdminPages.Filtre.CEA.Range',compact('today','livreur','yesterday','firsstFiltreChoisie'))->with('commande',$commande);
                  }else{
                      return redirect( )->back()->with( 'Nodetails','No Details found. Esaayez encore  !' );	
                      }
              }
          }
         
      }


     ////////////////////////////////////////////////////////////
    /** END RECHERCHE ET FILTRE DANS TOUTES LES COMMANDES EN ATTENTE */
    ////////////////////////////////////////////////////////////

}
