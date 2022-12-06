@extends('dash/layout/app')

@section('content')

   <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->

            <div class="content-page">
                <div class="content">


                @if ( session('ModifSuccess'))
  <div class="alert alert-success mt-2">
    Temoignage modifier  avec succes 
  </div>
@endif

@if ( session('succ'))
  <div class="alert alert-success mt-2">
    Temoignage supprimer  avec succes 
  </div>
@endif

@if ( session('NotExist'))
  <div class="alert alert-danger mt-2">
    Temoignage n'existe pas 
  </div>
@endif
@if ( session('error'))
  <div class="alert alert-danger mt-2">
  l'un des champs n'est pas correctement inscrit
  </div>
@endif

@if ( session('NotModifSuccess'))
  <div class="alert alert-danger">
  le Temoignage ne peux pas etres modifier
  </div>
@endif

@if ( session('erreur'))
  <div class="alert alert-danger mt-2">
    Un probleme est survenue 
  </div>
@endif

@if ( session('success'))
  <div class="alert alert-success mt-2">
    Temoignage supprimer  avec succes 
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

                                        </ol>
                                    </div>
                                    <h4 class="page-title">Tous les Temoignage <a href="/addTemoignage" class="float-end"><button type="button" class="btn btn-info rounded-pill ms-5"><i class="uil-clipboard-alt"></i> Ajouter</button> </a></h4>
                                    
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                        <div class="row">
                            
                                <div class="tab-content">
                                    <div class="tab-pane show active" id="ribbons-preview">
                                        <div class="row">
                                        @foreach($Temoignage as $Temoignages)
                                            <div class="col-xxl-4 col-md-6">
                                                <div class="card ribbon-box">
                                                    <div class="card-body">
                                                        <div class="ribbon ribbon-primary float-start"><i class="mdi mdi-access-point me-1"></i> {{$Temoignages->nom}}</div>
                                                        <h5 class="text-primary float-end mt-0">{{$Temoignages->profession}}</h5>
                                                        <div class="ribbon-content">
                                                            <p class="mb-0">{{$Temoignages->message}}</p>
                                                        </div>
                                                        <div class="dropdown float-end">
                                                            <a href="#" class="dropdown-toggle text-black arrow-none" data-bs-toggle="dropdown" aria-expanded="false">
                                                                <i class="mdi mdi-dots-vertical font-18"></i>
                                                            </a>
                                                            <div class="dropdown-menu dropdown-menu-end">
                                                                <!-- item-->
                                                                <a href="/temoignage_edit/{{$Temoignages->slug}}" class="dropdown-item"><i class="mdi mdi-pencil me-1"></i>Edit</a>
                                                                <!-- item-->
                                                                
                                                                <a href="/temoignagedelet/{{$Temoignages->slug}}" class="dropdown-item"><i class="mdi mdi-delete me-1"></i>Delete</a>

                                                            </div>
                                                        </div>
                                                    </div> <!-- end card-body -->
                                                  
                                                </div> <!-- end card-->
                                            </div> <!-- end col -->
                                        @endforeach
                                        </div>
                                        <!-- end row -->

                                    </div> <!-- end preview-->

                                </div> <!-- end tab-content-->
                            </div>
                        </div>
                        <!-- end row-->

                    </div> <!-- container -->

                </div> <!-- content -->

                <!-- Footer Start -->
                <footer class="footer">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6">
                                <script>document.write(new Date().getFullYear())</script>© PRUMAD (IWA)
                            </div>
                            <div class="col-md-6">
                                <div class="text-md-end footer-links d-none d-md-block">
                                    <a href="/about">About</a>
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