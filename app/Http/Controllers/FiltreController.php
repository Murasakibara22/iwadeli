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
        $date = Carbon::now()->subDays(7);
        $dateMonth = Carbon::now()->subDays(30);
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
            $commande = Order::Where('updated_at','>=',$date)->where('terminate',1)->where('status',1)->OrderBy('created_at','DESC')->get();

            if (count ($commande) > 0 && isset($commande)){
                return view('AdminPages.Filtre.CT.list',compact('today','yesterday','typeOfFiltreParent'))->with('commande',$commande);
            }else{
                return redirect( '/listAllComTerminer')->with( 'Nodetails','No Details found. Esaayez encore  !' );	
                }
        }
        if($request->FiltrerSelon == "il y a un Mois"){
            $commande = Order::Where('updated_at','>=',$dateMonth)->where('terminate',1)->where('status',1)->OrderBy('created_at','DESC')->get();

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
        $commande = Order::where( 'lieudedepart', 'LIKE', '%' . $searchs . '%' )->where('terminate',1)->where('status',1)->OrderBy('created_at','DESC')->get();
        dd($commande);
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
        $dateMonth = Carbon::now()->subDays(30);
        $date = Carbon::now()->subDays(7);
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
              $commande = Order::Where('updated_at','>=',$date)->where('terminate',0)->where('status',1)->OrderBy('created_at','DESC')->get();
  
              if (count ($commande) > 0 && isset($commande)){
                  return view('AdminPages.Filtre.CEC.list',compact('today','yesterday','typeOfFiltreParent'))->with('commande',$commande);
              }else{
                  return redirect()->back()->with( 'Nodetails','No Details found. Esaayez encore  !' );	
                  }
          }
          if($request->FiltrerSelon == "il y a un Mois"){
              $commande = Order::Where('updated_at','>=',$dateMonth)->where('terminate',0)->where('status',1)->OrderBy('created_at','DESC')->get();
  
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
          $commande = Order::where( 'lieudedepart', 'LIKE', '%' . $searchs . '%' )->where('terminate',0)->where('status',1)->OrderBy('created_at','DESC')->get();
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
        $dateMonth = Carbon::now()->subDays(30);
        $date = Carbon::now()->subDays(7);
          $today = date('j M, Y', strtotime(Carbon::today()) );
          $yesterday = date('j M, Y', strtotime(Carbon::yesterday()) );
          $typeOfFiltreParent = $request->FiltrerSelon;
          if($request->FiltrerSelon == "Aujourd'hui"){
              $commande = Order::WhereDate('updated_at',Carbon::today())->where('terminate',0)->where('status',0)->where('id_livreurs',NULL)->OrderBy('created_at','DESC')->get();
        
              if (count ($commande) > 0 && isset($commande)){
                $livreur = Livreur::OrderBy('nom_livreurs','ASC')->get();
              return view('AdminPages.Filtre.CEA.list',compact('today','livreur','yesterday','typeOfFiltreParent'))->with('commande',$commande);
          }else{
              return redirect()->back()->with( 'Nodetails','No Details found. Esaayez encore  !' );	
              }	
          }
          if($request->FiltrerSelon == "hier"){
  
              $commande = Order::WhereDate('updated_at',Carbon::yesterday())->where('terminate',0)->where('status',0)->where('id_livreurs',NULL)->OrderBy('created_at','DESC')->get();
  
              if (count ($commande) > 0 && isset($commande)){
                $livreur = Livreur::OrderBy('nom_livreurs','ASC')->get();
                  return view('AdminPages.Filtre.CEA.list',compact('today','livreur','yesterday','typeOfFiltreParent'))->with('commande',$commande);
              }else{
                  return redirect()->back()->with( 'Nodetails','No Details found. Esaayez encore  !' );	
                  }
          }
          if($request->FiltrerSelon == "7 derniers jours"){
              $commande = Order::Where('updated_at','>=',$date)->where('terminate',0)->where('status',0)->where('id_livreurs',NULL)->OrderBy('created_at','DESC')->get();
  
              if (count ($commande) > 0 && isset($commande)){
                $livreur = Livreur::OrderBy('nom_livreurs','ASC')->get();
                  return view('AdminPages.Filtre.CEA.list',compact('today','livreur','yesterday','typeOfFiltreParent'))->with('commande',$commande);
              }else{
                  return redirect()->back()->with( 'Nodetails','No Details found. Esaayez encore  !' );	
                  }
          }
          if($request->FiltrerSelon == "il y a un Mois"){
              $commande = Order::Where('updated_at','>=',$dateMonth)->where('terminate',0)->where('status',0)->where('id_livreurs',NULL)->OrderBy('created_at','DESC')->get();
  
              if (count ($commande) > 0 && isset($commande)){
                $livreur = Livreur::OrderBy('nom_livreurs','ASC')->get();
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
            $livreur = Livreur::OrderBy('nom_livreurs','ASC')->get();
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
          $livreur = Livreur::OrderBy('nom_livreurs','ASC')->get();
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



        
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


     ////////////////////////////////////////////////////////////
    /**FILTRE SUR LA PAGE TOUTES LES COMMANDES*/
    ////////////////////////////////////////////////////////////



    public function FilterAllCommande(Request $request){
        $today = date('j M, Y', strtotime(Carbon::today()) );
          $yesterday = date('j M, Y', strtotime(Carbon::yesterday()) );
          $livreur = Livreur::OrderBy('nom_livreurs','ASC')->get();
          if(!is_null($request->TrouveSelonEngins)  && !is_null($request->TrouveSelon)){
            if($request->TrouveSelon == "prix Le plus bas"){
                $commande = Order::where('nature',$request->TrouveSelonEngins)->OrderBy('montant','ASC')->get();
              
                if (count ($commande) > 0 && isset($commande)){
                    return view('AdminPages.Filtre.AllOrderFiltre',compact('today','livreur','yesterday'))->with('commande',$commande);
                }else{
                    return redirect( )->back()->with( 'Nodetails','No Details found. Esaayez encore  !' );	
                    }
            }

            elseif($request->TrouveSelon == "prix Le plus haut"){
                $commande = Order::where('nature',$request->TrouveSelonEngins)->OrderBy('montant','DESC')->get();
              
                if (count ($commande) > 0 && isset($commande)){
                    return view('AdminPages.Filtre.AllOrderFiltre',compact('today','livreur','yesterday'))->with('commande',$commande);
                }else{
                    return redirect( )->back()->with( 'Nodetails','No Details found. Esaayez encore  !' );	
                    }
            }
            
            elseif($request->TrouveSelon == "Date Recentes"){
                $commande = Order::where('nature',$request->TrouveSelonEngins)->OrderBy('created_at','DESC')->get();
  
                if (count ($commande) > 0 && isset($commande)){
                    return view('AdminPages.Filtre.AllOrderFiltre',compact('today','livreur','yesterday'))->with('commande',$commande);
                }else{
                    return redirect( )->back()->with( 'Nodetails','No Details found. Esaayez encore  !' );	
                    }
            }

            elseif($request->TrouveSelon == "Date DESC"){
                $commande = Order::where('nature',$request->TrouveSelonEngins)->OrderBy('created_at','ASC')->get();
  
                if (count ($commande) > 0 && isset($commande)){
                    return view('AdminPages.Filtre.AllOrderFiltre',compact('today','livreur','yesterday'))->with('commande',$commande);
                }else{
                    return redirect( )->back()->with( 'Nodetails','No Details found. Esaayez encore  !' );	
                    }
            }

          }elseif(is_null($request->TrouveSelonEngins)  && !is_null($request->TrouveSelon)){  //Sinon si
            if($request->TrouveSelon == "prix Le plus bas"){
                $commande = Order::OrderBy('montant','ASC')->get();
  
                if (count ($commande) > 0 && isset($commande)){
                    return view('AdminPages.Filtre.AllOrderFiltre',compact('today','livreur','yesterday'))->with('commande',$commande);
                }else{
                    return redirect( )->back()->with( 'Nodetails','No Details found. Esaayez encore  !' );	
                    }
            }

            elseif($request->TrouveSelon == "prix Le plus haut"){
                $commande = Order::OrderBy('montant','DESC')->get();
  
                if (count ($commande) > 0 && isset($commande)){
                    return view('AdminPages.Filtre.AllOrderFiltre',compact('today','livreur','yesterday'))->with('commande',$commande);
                }else{
                    return redirect( )->back()->with( 'Nodetails','No Details found. Esaayez encore  !' );	
                    }
            }
            
            elseif($request->TrouveSelon == "Date Recentes"){
                $commande = Order::OrderBy('created_at','DESC')->get();
  
                if (count ($commande) > 0 && isset($commande)){
                    return view('AdminPages.Filtre.AllOrderFiltre',compact('today','livreur','yesterday'))->with('commande',$commande);
                }else{
                    return redirect( )->back()->with( 'Nodetails','No Details found. Esaayez encore  !' );	
                    }
            }

            elseif($request->TrouveSelon == "Date DESC"){
                $commande = Order::OrderBy('created_at','ASC')->get();
  
                if (count ($commande) > 0 && isset($commande)){
                    return view('AdminPages.Filtre.AllOrderFiltre',compact('today','livreur','yesterday'))->with('commande',$commande);
                }else{
                    return redirect( )->back()->with( 'Nodetails','No Details found. Esaayez encore  !' );	
                    }
            }
          }elseif(!is_null($request->TrouveSelonEngins)  && is_null($request->TrouveSelon)){  //Sinon si
            $commande = Order::where('nature',$request->TrouveSelonEngins)->get();
  
            if (count ($commande) > 0 && isset($commande)){
                return view('AdminPages.Filtre.AllOrderFiltre',compact('today','livreur','yesterday'))->with('commande',$commande);
            }else{
                return redirect( )->back()->with( 'Nodetails','No Details found. Esaayez encore  !' );	
                }
          }

    }


    ////////////////////////////////////////////////////////////
    /** END FILTRE SUR LA PAGE TOUTES LES COMMANDES*/
    ////////////////////////////////////////////////////////////
}
