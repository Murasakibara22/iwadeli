@extends('dash/layout/app')

@section('content')

 <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->

            <div class="content-page">
                <div class="content">
                @if ( session('Valide'))
                    <div class="alert alert-success">
                    La commande a ete valider
                    </div>
                    @endif
                @if ( session('NotValide'))
                    <div class="alert alert-warning">
                    La commande n'a pas pu etre valider , verifier si le livreur n'a pas deja une commande en cours
                    </div>

                    @endif
                @if ( session('successDele'))
                    <div class="alert alert-success">
                    Utilisateur Supprimer
                    </div>

                    @endif
                @if ( session('succesEdit'))
                    <div class="alert alert-success">
                    L'utilisateur a ete modifier
                    </div>

                    @endif
                 @if ( session('NotExist'))
                    <div class="alert alert-danger">
                    L'utilisateur spécifier n'existe pas
                    </div>

                    @endif

                    @if ( session('NotModifySuccess'))
                    <div class="alert alert-warning">
                    les informations du livreur n'ont pas pu etre  modifer 
                    </div>
                    @endif

                    @if ( session('erreur'))
                    <div class="alert alert-warning">
                    l'un des champs n'est pas correctement remplis
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
                                    <h4 class="page-title"> Listes des Utilisateurs
                                    <a href="/newUser" class="float-end"><button type="button" class="btn btn-outline-info rounded-pill ms-5"><i class="uil-plus-circle"></i> Ajoutez un Utilisateurs</button> </a>
                                </h4>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->



                      <div class="col-lg-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                            <h4 class="card-title">Liste de tous les utilisateurs</h4>

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
                
                
              </div>





         <div class="table-responsive col-12">
                  <table class="table">
                    <thead class="thead-dark">
                        <tr class="bg-white">
                        <th scope="col">photos</th>
                        <th scope="col">Noms</th>
                        <th scope="col">Prenoms</th>
                        <th scope="col">contact</th>
                        <th scope="col">Email </th>
                        <th scope="col">Inscrit le</th>
                        <th scope="col">modifer</th> 
                        <th scope="col">Supprimer</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($user as $users)
                        <tr>
                               <td class="table-user" >
                               <img src="../images/User/{{$users->photo}}" alt="table-user" class="me-2 rounded-circle" />
                              </td>
                               
                        <td class="fw-bold">{{$users->nom}}</td>
                        <td>{{$users->prenom}}</td>
                        <td>{{$users->contact}}</td>
                        <td>{{$users->email}}</td>
               
                        <td>{{date('j M, Y', strtotime($users->created_at))}}</td>
                        <td class="table-user">
                        <a href="/changeNewUser/{{$users->id}}"> <img src="../dashStyle/assets/images/roudedEdit.gif" alt="table-user" class="me-2 rounded-circle " /></a> 
                        </td>
                         <td  class="table-user">
                            <a href="/deleteUs/{{$users->id}}">  <img src="../dashStyle/assets/images/rondDelete.gif" alt="table-user" class="me-2 rounded-circle" /></a> 
                        </td>
                        </tr>
                    </tbody>
                    @endforeach
                    </table>


                </div>
                </div>
              </div>
            </div>



                     </div>
                </div>
            </div>



@endsection