@extends('dash/layout/app')

@section('content')


 <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->

            <div class="content-page">
                <div class="content">

                
                    @if ( session('NotExist'))
                    <div class="alert alert-dansger">
                    L'utilisateur selectionner n'existe pas , si le probleme persiste veuillez rafraichir votre page
                    </div>

                    @endif
                    @if ( session('ModifySccuessequipe'))
                    <div class="alert alert-warning">
                    les informations de l'utilisateur ont ete modifier avec succes
                    </div>

                    @endif
                    @if ( session('SupprimerAvecSuccess'))
                    <div class="alert alert-success">
                    L'utilisateur selectionner a ete supprimer avec success
                    </div>

                    @endif

                    <!-- Start Content-->
                    <div class="container-fluid">
                        
                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                   
                                    <h4 class="page-title">Listes des membres  <a href="/new_equipe" class="float-end"><button type="button" class="btn btn-outline-info rounded-pill ms-5"><i class="uil-circuit"></i> Ajoutez un membre</button> </a></h4>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                        <div class="app-search dropdown mt-2 mb-2">
                                                <form action="{{ route('findSearchTeam') }}">
                                                    <div class="input-group">
                                                        <input type="search" name= "search" value="{{  request()->search ?? '' }}"  class="form-control dropdown-toggle"  placeholder="Recherche..." id="top-search">
                                                        <span class="mdi mdi-magnify search-icon"></span>
                                                        
                                                
                                                        <button class="input-group-text btn btn-primary" type="submit">Search</button>
                                                    </div>
                                                </form>
                                              
                                            </div>

                        
                       

                        <div class="row">
                        @foreach($equipe as $equipes)
    <div class="col-xl-4 col-lg-12">
        <div class="card">
            <div class="card-body">
                <span class="float-start m-2 me-4">
                    <img src="/images/Equipe/{{$equipes->photo}}" style="height: 100px;" alt="avatar-2" class="rounded-circle img-thumbnail">
                </span>
                <div class="">
                    <h4 class="mt-1 mb-1">{{$equipes->nom}}</h4>
                    <p class="font-13"> {{$equipes->prenom}}</p>
            
                    <ul class="mb-0 list-inline">
                        <li class="list-inline-item me-3">
                            <h5 class="mb-1">{{$equipes->contact}}</h5>
                            <p class="mb-0 font-13">{{$equipes->fonction}}</p>
                        </li>
                        <li class="list-inline-item">
                            <p class="mb-0 font-13">{{$equipes->email}}</p>
                        </li>
                      
                        <div class="dropdown float-end">
                                          <a href="#" class="dropdown-toggle text-black arrow-none" data-bs-toggle="dropdown" aria-expanded="false">
                                              <i class="mdi mdi-dots-vertical font-18"></i>
                                          </a>
                                          <div class="dropdown-menu dropdown-menu-end">
                                              <!-- item-->
                                              <a href="/equipe_edit/{{$equipes->slug}}" class="dropdown-item"><i class="mdi mdi-pencil me-1"></i>Edit</a>
                                              <!-- item-->
                                            
                                              <a href="/equipe_delete/{{$equipes->slug}}" class="dropdown-item"><i class="mdi mdi-delete me-1"></i>Delete</a>

                                          </div>
                                      </div>
                       
                    </ul>
                </div>
                <!-- end div-->
            </div>
            <!-- end card-body-->
        </div>
    </div> <!-- end col -->
    @endforeach
</div>
<!-- end row-->
                        
                    </div> <!-- container -->

                </div> <!-- content -->

                                        
                <!-- Footer Start -->
                <footer class="footer">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6">
                                <script>document.write(new Date().getFullYear())</script> © Prumad
                            </div>
                            <div class="col-md-6">
                                <div class="text-md-end footer-links d-none d-md-block">
                                    <a href="javascript: void(0);">About</a>
                                    <a href="javascript: void(0);">Contact Us</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </footer>
                <!-- end Footer -->

            </div>

            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->

@endsection