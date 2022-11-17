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
                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                        <li><a href="/new_equipe"><button type="button" class="btn btn-outline-info rounded-pill ms-5"><i class="uil-circuit"></i> Ajoutez un membre</button> </a></li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">Listes des membres</h4>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                        
                       

                        <div class="row">
                            @foreach($equipe as $equipes)
                            <div class="col-sm-6 col-lg-3">
                                <div class="card">
                                    <img src="/images/Equipe/{{$equipes->photo}}" class="card-img-top" alt="...">
                                    <div class="card-body">
                                        <h5 class="card-title">{{$equipes->nom}},( {{$equipes->fonction}})

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
                                        </h5>
                                        <button class="btn btn-primary ms-1" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#collapseExample"
                                                aria-expanded="false" aria-controls="collapseExample">
                                               Informations suppl...
                                            </button>
                                        </p>
                                        <div class="collapse show" id="collapseExample">
                                            <div class="card card-body mb-0">
                                            
                                               <p> nom:       {{$equipes->nom}} </p>
                                                  <p> prenom:    {{$equipes->prenom}} </p>
                                                    <p> contact:   {{$equipes->contact}} </p>
                                                     <p> fonction:  {{$equipes->fonction}} </p>
                                                <p> email:      {{$equipes->email}}</p>
                                            </div>
                                        </div>
                                    </div> <!-- end card-body -->
                                </div> <!-- end card -->
                            </div> <!-- end col-->
                            @endforeach
                        </div>
                        <!-- end row -->
                        
                    </div> <!-- container -->

                    <div class="app-search dropdown mb-5">
                                                <form action="{{ route('findSearchTeam') }}">
                                                    <div class="input-group">
                                                        <input type="search" name= "search" value="{{  request()->search ?? '' }}"  class="form-control dropdown-toggle"  placeholder="Recherche..." id="top-search">
                                                        <span class="mdi mdi-magnify search-icon"></span>
                                                        
                                                        <button class="input-group-text btn btn-primary" type="submit">Search</button>
                                                    </div>
                                                </form>

                                              
                                            </div>

                </div> <!-- content -->

                                         
                <!-- Footer Start -->
                <footer class="footer">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6">
                                <script>document.write(new Date().getFullYear())</script> © Hyper - Coderthemes.com
                            </div>
                            <div class="col-md-6">
                                <div class="text-md-end footer-links d-none d-md-block">
                                    <a href="javascript: void(0);">About</a>
                                    <a href="javascript: void(0);">Support</a>
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