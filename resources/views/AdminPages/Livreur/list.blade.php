@extends('dash/layout/app')

@section('content')

 <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->

            <div class="content-page">
                <div class="content">
                @if ( session('ModifySuccess'))
                    <div class="alert alert-success">
                    Le livreur selectionner a ete modifer avec succes
                    </div>
                    @endif
                @if ( session('DeleteSuccess'))
                    <div class="alert alert-success">
                    Le livreur a ete supprimer
                    </div>

                    @endif
                @if ( session('SupprimerAvecSuccess'))
                    <div class="alert alert-success">
                    Le partenaire selectionner a ete supprimer avec success
                    </div>

                    @endif
                 @if ( session('NotExist'))
                    <div class="alert alert-danger">
                    Le Livreur selectionner n'existe pas
                    </div>

                    @endif

                    @if ( session('NotModifySuccess'))
                    <div class="alert alert-warning">
                    les informations du livreur n'ont pas pu etre  modifer 
                    </div>
                    @endif

                    @if ( session('Nodetails'))
                    <div class="alert alert-warning">
                    Aucun details trouver. Esaayez encore  !
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
                                    <h4 class="page-title"> Nos Livreurs
                                    <a href="/newLivreur" class="float-end"><button type="button" class="btn btn-outline-info rounded-pill ms-5"><i class="uil-plus-circle"></i> Ajoutez une Annonce</button> </a>
                                </h4>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->



                      <div class="col-lg-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                            <h4 class="card-title">Liste de tous les livreurs
                    
                                         <div class="app-search dropdown float-end">
                                                <form action="">
                                                    <div class="input-group">
                                                        <input type="search" name= "search" value="{{  request()->search ?? '' }}"  class="form-control dropdown-toggle"  placeholder="Recherche..." id="top-search">
                                                        <span class="mdi mdi-magnify search-icon"></span>
                                                        
                                                        <button class="input-group-text btn btn-primary" type="submit">recherche</button>
                                                    </div>
                                                </form>

                                              
                                            </div>
                
                </h4>
                  <p class="card-description mt-3">
                    Vous avez la possibilité de  <code>modifier</code> ou de <code>suprimer  </code> un Livreur
                  </p>
                
                    <!-- Fitrage -->
                  <div class="mb-1 col-6">
                
                <!-- title -->
                <form action="">
                  <div class="d-flex  mt-lg-0 ">
                        <!-- select option -->
                        <select class="form-select" aria-label="Default select example" name="FindAnnonce">
                          <option selected>Filtrer selon: </option>
                          <option value="Prix Le plus bas">Prix Le plus bas</option>
                          <option value="Prix Le plus eleve"> Prix Le plus eleve</option>
                          <option value="date recente"> date recente</option>
                        </select>

                        <button type="submit" class="btn btn-dark ms-3">Filtrer </button>
                      
                      </div>

                      </form>
              </div>





                  <div class="table-responsive">
                  <table class="table">
                    <thead class="thead-dark">
                        <tr class="bg-warning">
                        <th scope="col">Noms</th>
                        <th scope="col">prenoms</th>
                        <th scope="col">contact</th>
                        <th scope="col">date de creation</th>
                        <th scope="col">photo</th>
                        <th scope="col">modifier</th>
                        <th scope="col">suprimer</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($livreur as $livreurs)
                        <tr>
                               <td class="fw-bold" >
                                    {{$livreurs->nom_livreurs}}
                              </td>
                               
                        <td class="fw-bold"> {{$livreurs->prenom_livreurs}}</td>
                        <td>{{$livreurs->contact}}</td>
                        <td>{{ date('j M, Y', strtotime($livreurs->created_at)) }}</td>
                        <td></td>
                        <td>
                            <a href="/changeLivreur/{{$livreurs->id}}"><button type="button" class="btn btn-info"><i class="mdi mdi-keyboard"></i> </button> </a> 
                            </td>
                        <td class="table-user">
                            <a href="/deleteLiv/{{$livreurs->id}}"> <img src="../dashStyle/assets/images/rondDelete.gif" alt="table-user" class="me-2 rounded-circle" /> </a> 
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