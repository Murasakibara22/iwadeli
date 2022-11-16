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
                                    <h4 class="page-title"> Utilisateurs Inscrits
                                    <a href="/newUser" class="float-end"><button type="button" class="btn btn-success rounded-pill ms-5"><i class="uil-plus"></i> Ajoutez un Utilisateur</button> </a>
                                </h4>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->


                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Liste de tous les livreurs
                            </h4>

                            <div class="app-search dropdown float-end mt-3">
                                                <form action="">
                                                    <div class="input-group">
                                                        <input type="search" name= "search" value="{{  request()->search ?? '' }}"  class="form-control dropdown-toggle"  placeholder="Recherche..." id="top-search">
                                                        <span class="mdi mdi-magnify search-icon"></span>
                                                        
                                                        <button class="input-group-text btn btn-primary" type="submit">recherche</button>
                                                    </div>
                                                </form>
                                            </div>




                            <table class="table table-striped table-centered mb-0">
                                        <thead>
                                            <tr>
                                                <th>photo et noms</th>
                                                <th>Prenoms</th>
                                                <th>contact</th>
                                                <th>email</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($user as $users)
                                            <tr>
                                                <td class="table-user">
                                                    <img src="../images/User/{{$users->photo}}" alt="table-user" class="me-2 rounded-circle" />
                                                    {{$users->name}}
                                                </td>
                                                <td>{{$users->prenom}}</td>
                                                <td>{{$users->contact}}</td>
                                                <td>{{$users->email}}</td>
                                                <td class="table-action">
                                                    <a href="javascript: void(0);" class="action-icon"> <i class="mdi mdi-pencil"></i></a>
                                                    <a href="javascript: void(0);" class="action-icon"> <i class="mdi mdi-delete"></i></a>
                                                </td>
                                            </tr>
                                          @endforeach
                                        </tbody>
                                    </table>

                



                
                        </div>
                    </div>
                </di>






            </div>
         </div>
    </div>



@endsection