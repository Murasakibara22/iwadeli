@extends('dash/layout/app')

@section('content')

 <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->

            <div class="content-page">
                <div class="content">
               
@if ( session('error'))
  <div class="alert alert-danger">
  une erreur c'est produite et l'exception a ete lever
  </div>

@endif


@if ( session('supprimer'))
  <div class="alert alert-success">
   contact supprimer  avec succes 
  </div>

@endif

@if ( session('Notsupprimer'))
  <div class="alert alert-danger">
  le contact n'existe pas
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
                                    <h4 class="page-title">  Messages
                                    <a href="" class="float-end"><button type="button" class="btn btn-outline-info rounded-pill ms-5"><i class="uil-plus-circle"></i> Ajoutez un Livreur</button> </a>
                                </h4>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->



                      <div class="col-lg-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                            <h4 class="card-title">Tous les Messages
                    
                                         <!-- <div class="app-search dropdown float-end">
                                                <form action="{{ route('findSearchLivreurs') }}">
                                                    <div class="input-group">
                                                        <input type="search" name= "search" value="{{  request()->search ?? '' }}"  class="form-control dropdown-toggle"  placeholder="Recherche..." id="top-search">
                                                        <span class="mdi mdi-magnify search-icon"></span>
                                                        
                                                        <button class="input-group-text btn btn-primary" type="submit">recherche</button>
                                                    </div>
                                                </form> -->

                                              
                                            </div>
                
                </h4>
                  <p class="card-description mt-3 ms-3">
                    Tous les messages Laisser sur le site web IWA
                  </p>
                






                  <div class="table-responsive">
                  <table class="table">
                    <thead class="thead-dark">
                        <tr class="bg-warning">
                        <th scope="col">Noms et prenoms</th>
                        <th scope="col">Sujet</th>
                        <th scope="col">messages</th>
                        <th scope="col">date de creation</th>
                        <th scope="col">suprimer</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($contact as $con)
                        <tr>
                               <td class="fw-bold" >
                                    {{$con->nom}}
                              </td>
                        <td>{{$con->sujet}}</td>
                        <td>{{$con->Comment}}</td>

                        <td>{{ date('j M Y ,  H:m a', strtotime($con->created_at)) }}</td>
                        
                        <td class="table-user">
                            <a href="/contactdelete/{{$con->slug}}"> <img src="../dashStyle/assets/images/rondDelete.gif" alt="table-user" class="me-2 rounded-circle" /> </a> 
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