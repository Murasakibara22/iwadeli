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

                    @if ( session('notFoundOrder'))
                    <div class="alert alert-warning mt-1">
                    Commade Non trouver
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
                            <h4 class="card-title">Liste de toutes les commandes

                            <div class="app-search dropdown float-end mt-3 mb-2">
                                                <form action="">
                                                    <div class="input-group">
                                                        <input type="search" name= "search" value="{{  request()->search ?? '' }}"  class="form-control dropdown-toggle"  placeholder="Recherche..." id="top-search">
                                                        <span class="mdi mdi-magnify search-icon"></span>
                                                        
                                                        <button class="input-group-text btn btn-primary" type="submit">recherche</button>
                                                    </div>
                                                </form>

                                              
                                            </div>
                            </h4>

                           
                  <p class="card-description mt-3 mb-3">
                  Vous avez la possibilité de  <code>suprimer  </code> une Commande ou de voir les details
                  </p>
                
                    <!-- Fitrage -->
                     <!--filter-->
       <div class="container-xl  rounded-3 py-3 " style="box-shadow: 1px 1px 12px 1px;">
        <div class="col-12">
            <div class="d-lg-flex justify-content-between align-items-center">
              <div class="mb-3 mb-lg-0">
                  <p class="mb-0"> <span class="text-dark">Trouvez des Commandes Particuliaires </span> </p>
              </div>
              <!-- icon -->
           
                  <form action="{{ route('FilterAllCommandes') }}">
                      <div class="d-flex mt-2 mt-lg-0">
                        <div class="me-2 flex-grow-2" >
                            <select class="form-select" aria-label="Default select example"  name="TrouveSelonEngins" >
                              <option selected value="" selected>Engins:</option>
                              <option value="moto">moto</option>
                              <option value="vehicules"> Voitures</option>
                              <option value="velo">velo</option>
                            </select>
                        </div>
                        <div>
                            <!-- select option -->
                            <select class="form-select" aria-label="Default select example" name="TrouveSelon">
                              <option selected value="">Trier Par: </option>
                              <option value="prix Le plus bas">prix Le plus bas</option>
                              <option value="prix Le plus haut"> prix Le plus haut</option>
                              <option value="Date Recentes">Date Recentes</option>
                              <option value="Date DESC"> Date DESC </option>
                            </select>
                        </div>

                        <div>
                        <button type="submit" class="btn btn-outline-dark ms-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                class="feather feather-filter me-2">
                                <polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"></polygon>
                            </svg>
                           
                            </button> 
                        </div>
                      </div>
                  </form>

              </div>
            </div>
        </div>
     <!-- Filtrage  end-->


         <div class="table-responsive mt-3">
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
                        <th scope="col">Details</th>
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
                                <span class="badge badge-warning-lighten ">En Cour </span>
                                </td>
                                 <td>
                                <button type="submit" class="btn btn-success" disabled><i class="mdi mdi"> valider</i> </button> 
                                </td>
                      @elseif($commandes->terminate  == 1  && $commandes->status  == 1)

                                <td>
                                <span class="badge badge-success-lighten ">Terminer </span>
                                </td>
                                 <td>
                                <button type="submit" class="btn btn-success" disabled><i class="mdi mdi"> valider</i> </button> 
                                </td>
                     @else
                                 <td>
                                <span class="badge badge-danger-lighten ">anuler </span>
                                </td>
                                 <td>
                                <button type="submit" class="btn btn-dangeer" disabled><i class="mdi mdi"> valider</i> </button> 
                                </td>
                     @endif
                     <!-- Terminer une commande -->



                               

                     @if($commandes->refus == 0 && $commandes->terminate == 0)
                     <form action=" {{ route('RefuserCommande',$commandes->id) }}"  method="POST">
                            @csrf
                            @method('PUT')

                                    <td>
                                    <button type="submit" class="btn btn-danger"><i class="mdi mdi"> Annuler</i> </button> 
                                    </td>
                        </form>
                        @else
                                     <td>
                                    <button type="submit" class="btn btn-danger" disabled><i class="mdi mdi"> Annuler</i> </button> 
                                    </td>
                        @endif

                        <td>
                            <a href="/DetailOneOrder/{{$commandes->id}}"><i class="mdi mdi-eye"></i></a>
                        </td>

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