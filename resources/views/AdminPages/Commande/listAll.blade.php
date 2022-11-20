@extends('dash/layout/app')

@section('content')

 <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->

            <div class="content-page">
                <div class="content">
                @if ( session('Valide'))
                    <div class="alert alert-success mt-1">
                    La commande a ete valider
                    </div>
                    @endif
                @if ( session('NotValide'))
                    <div class="alert alert-warning mt-1">
                    La commande n'a pas pu etre valider , verifier si le livreur n'a pas deja une commande en cours
                    </div>

                    @endif
                @if ( session('successDelete'))
                    <div class="alert alert-success mt-1">
                    La commande a ete supprimer avec succes
                    </div>

                    @endif
                 @if ( session('NotFound'))
                    <div class="alert alert-danger mt-1">
                    La commande selectionner n'a pas ete trouver
                    </div>

                    @endif

                    @if ( session('NotAssociate'))
                    <div class="alert alert-danger  mt-1">
                    veuillez associer un livreur avant de valider la commande ! 
                    </div>
                    @endif

                    @if ( session('Nodetails'))
                    <div class="alert alert-warning mt-1">
                    Aucun details trouver. Esaayez En recherchant selon le lieu de depart ou le lieu cible !
                    </div>

                    @endif

                    <!--  -->
                  

                    <!-- Start Content-->
                    <div class="container-fluid">

                     <!-- start page title -->
                     <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            
                                        </ol>
                                    </div>
                                    <h4 class="page-title"> Nos Commande Non valider
                                    <a href="/listAllComValide" class="float-end"><button type="button" class="btn btn-success rounded-pill ms-5"><i class="uil-plus-circle"></i> Commande Valider</button> </a>
                                </h4>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->



                      <div class="col-lg-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                            <h4 class="card-title">Liste de toutes les commandes</h4>

                            <div class="app-search dropdown float-end mt-3 mb-2">
                                                <form action="">
                                                    <div class="input-group">
                                                        <input type="search" name= "search" value="{{  request()->search ?? '' }}"  class="form-control dropdown-toggle"  placeholder="Recherche..." id="top-search">
                                                        <span class="mdi mdi-magnify search-icon"></span>
                                                        
                                                        <button class="input-group-text btn btn-primary" type="submit">recherche</button>
                                                    </div>
                                                </form>

                                              
                                            </div>
                  <p class="card-description mt-3 mb-3">
                    Vous avez la possibilité de  <code>modifier</code> ou de <code>suprimer  </code> un Livreur
                  </p>
                
                    <!-- Fitrage -->
                  <div class="mb-1 col-12">
                
                  <form action="">
                  <div class="d-flex  mt-lg-0 ">
                        <!-- select option -->
                        <select class="form-select" aria-label="Default select example" name="FiltrerSelon">
                        <option selected>Filtrer les commandes selon: </option>
                          <option value="Aujourd'hui">Aujourd'hui</option>
                          <option value="hier"> hier</option>
                          <option value="7 derniers jours"> 7 derniers jours</option>
                          <option value="il y a un Mois"> il y a un Mois</option>
                        </select>

                        <button type="submit" class="btn btn-dark ms-3">Filtrer </button>
                      
                      </div>

                      </form>
              </div>





         <div class="table-responsive">
                  <table class="table">
                    <thead class="thead-dark">
                        <tr class="bg-warning">
                        <th scope="col">depart</th>
                        <th scope="col">arrive</th>
                        <th scope="col">C.D.D</th>
                        <th scope="col">date </th>
                        <th scope="col">prix</th>
                        <th scope="col">N.U.C</th> 
                        <th scope="col">Contact</th> 
                        <th scope="col">Engins</th>
                        <th scope="col">Qui effectue ?</th>
                        <th scope="col">Validiter</th>
                        <th scope="col">Terminer</th>
                        <th scope="col">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($commande as $commandes)
                        <tr>
                               <td class="fw-bold" >
                               <div class="text-truncate" style=" height:20px; width:80px; overflow:hidden;">
                                    {{$commandes->lieudedepart}}
                                </div>
                              </td>
                               
                        <td class="fw-bold">
                        <div class="text-truncate" style=" height:20px; width:90px; overflow:hidden;">
                             {{$commandes->lieudelivraison}}
                             </div>
                            </td>
                        <td>{{$commandes->contactdudestinataire}}</td>
                        <td>
                        <div class="text-truncate" style=" height:20px; width:90px; overflow:hidden;">
                            {{ date('j M, Y', strtotime($commandes->created_at)) }}
                            </div>
                        </td>
                        <td>
                          <div class="text-truncate" style=" height:40px; width:80px; overflow:hidden;">
                            {{ $commandes->montant }} FCFA
                            </div>
                        </td>
                        @foreach($commandes->user()->get()  as $utili)
                        <td>{{$utili->nom}}</td>
                        <td>{{$utili->contact}}</td>
                        @endforeach


                        <td>
                            {{$commandes->nature}}
                        </td>
                        <!-- Formulaire pour valider la commande -->
                        @if($commandes->terminate  == 0  && $commandes->status  == 0)
                    <form action=" {{ route('valideCommWithLivreurs') }}"  method="POST">
                        @csrf
                        @method('PUT')
                          <td>
                          <div class="text-truncate" style=" height:40px; width:100px; overflow:hidden;">
                            <select class="form-select mb-3" name="id_livreurs">
                            <option selected>aucun</option>
                                @foreach($livreur as $livreurs)
                                <option name="id_livreurs" value="{{$livreurs->id}}">{{$livreurs->nom_livreurs}}</option>
                                @endforeach
                            </select>
                            </div>
                          </td>

                          <input type="hidden" value="{{$commandes->id}}"  name="id_com">

                                <td>
                                <button type="submit" class="btn btn-success"><i class="mdi mdi"> valider</i> </button> 
                                </td>
                    </form>

                    @elseif($commandes->terminate  == 0  && $commandes->status  == 1)

                                <td>
                                <span class="badge badge-warning-lighten ">En Cour </span></td> 
                                </td>
                                 <td>
                                <button type="submit" class="btn btn-success" disabled><i class="mdi mdi"> valider</i> </button> 
                                </td>
                      @elseif($commandes->terminate  == 1  && $commandes->status  == 1)

                                <td>
                                <span class="badge badge-success-lighten ">Terminer </span></td> 
                                </td>
                                 <td>
                                <button type="submit" class="btn btn-success" disabled><i class="mdi mdi"> valider</i> </button> 
                                </td>
                     @else
                                 <td>
                                <span class="badge badge-secondary-lighten ">Terminer </span></td> 
                                </td>
                                 <td>
                                <button type="submit" class="btn btn-secondary" disabled><i class="mdi mdi"> valider</i> </button> 
                                </td>
                     @endif
                     <!-- Terminer une commande -->



                               

                     @if($commandes->terminate  == 0  && $commandes->status  == 1)
                     <form action=" {{ route('TerminateCommWithLivreurs') }}"  method="POST">
                            @csrf
                            @method('PUT')
                            

                              <input type="hidden" value="{{$commandes->id}}"  name="id_com">

                                    <td>
                                    <button type="submit" class="btn btn-success"><i class="mdi mdi"> Terminer</i> </button> 
                                    </td>
                        </form>
                        @else
                                     <td>
                                    <button type="submit" class="btn btn-success" disabled><i class="mdi mdi"> Terminer</i> </button> 
                                    </td>
                        @endif
                         <td class="table-user">
                            <a href="/deleteCommande/{{$commandes->id}}"> <img src="../dashStyle/assets/images/rondDelete.gif" alt="table-user" class="me-2 rounded-circle" /> </a> 
                        </td>
                        </tr>
                        @endforeach
                    </tbody>
                    </table>


        </div>
                </div>
              </div>
            </div>



                     </div>
                </div>
            </div>



@endsection