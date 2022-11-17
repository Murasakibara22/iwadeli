@extends('dash/layout/app')

@section('content')




@if ( session('error'))
  <div class="alert alert-danger">
  Utilisateurs non sauvegarder (un champ n'est pas correctement remplis)  </div>

@endif


 <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->

            <div class="content-page">
                <div class="content">
                  
                    <!-- Start Content-->
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li><a href="/equipe_list"><button type="button" class="btn btn-outline-info rounded-pill ms-5"><i class="uil-circuit"></i> Listes de notre equipe</button> </a></li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title"> Notre Team </h4>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="header-title">Modifier un membre</h4>


                                        <div class="tab-content">
                                            <div class="tab-pane show active" id="input-types-preview">
                                                <div class="row">
                                                    <div class="col-lg-10">
                                                    <form action="{{ route('modifierEquipe',$equipe->slug ) }}" method="POST" enctype="multipart/form-data">
                                                      @csrf 
                                                      @method('PUT')
                                                        <div class="mb-3">
                                                                <label for="example-palaceholder" class="form-label">Nom</label>
                                                                <input name="nom" type="text" id="example-palaceholder" class="form-control" value="{{  old($equipe->nom) ?? $equipe->nom }}">
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="example-palaceholder" class="form-label">Prenoms</label>
                                                                <input name="prenom" type="text" id="example-palaceholder" class="form-control" value="{{  old($equipe->prenom) ?? $equipe->prenom }}">
                                                            </div>
        
                                                            <div class="mb-3">
                                                                <label for="example-email" class="form-label">Email</label>
                                                                <input name="email" type="email" id="example-email" class="form-control" value="{{  old($equipe->email) ?? $equipe->email }}">
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="example-palaceholder" class="form-label">Contact</label>
                                                                <input name="contact" type="text" id="example-palaceholder" class="form-control" value="{{  old($equipe->contact) ?? $equipe->contact }}">
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="example-palaceholder" class="form-label">fonctions</label>
                                                                <input name="fonction" type="text" id="example-palaceholder" class="form-control"  value="{{  old($equipe->fonction) ?? $equipe->fonction }}">
                                                            </div>

                                                            <div class="mb-3">
                                                            <label for="example-fileinput" class="form-label">Joindre une photo de profile (FACULTATIF)</label>
                                                            <input name="photo" type="file" id="example-fileinput" class="form-control" >
                                                        </div>
                
                                                        <input type="hidden" name="token" value="{{ csrf_token() }}" />

                                                        </div>
                                                          <button type="submit" class="btn btn-primary mb-2">Modifier</button>
                                                      </div>
        
                
                                                        </form>
                                                    </div> <!-- end col -->
        
                                                 
                                                </div>
                                                <!-- end row-->                      
                                            </div> <!-- end preview-->
                                        
                            
                                        </div> <!-- end tab-content-->
                                    </div> <!-- end card-body -->
                                </div> <!-- end card -->
                            </div><!-- end col -->
                        </div><!-- end row -->
                        
                    </div> <!-- container -->

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