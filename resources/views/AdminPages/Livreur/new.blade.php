@extends('dash/layout/app')

@section('content')






 <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->

            <div class="content-page">
                <div class="content">
                @if ( session('EnrgSuccess'))
                    <div class="alert alert-success">
                    Le livreur a ete sauvegarder avec succes
                    </div>
                    @endif

                @if ( session('pb'))
                    <div class="alert alert-warning">
                    Un probleme est survenue veuillez reprendre l'enregistrement
                    </div>
                    @endif

                @if ( session('champsNotField'))
                    <div class="alert alert-danger">
                    Tous les champs ne sont pas correctement Remplis
                    </div>
                    @endif

                @if ( session('ExistLivreur'))
                    <div class="alert alert-info">
                    Le livreur Existe deja !
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
                                    <h4 class="page-title">Ajouter un nouveau Livreur <a href="#" class="float-end"><button type="button" class="btn btn-outline-info rounded-pill ms-5"><i class="uil-circuit"></i> Liste des Livreurs</button> </a></h4>
                                    
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                       


                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="header-title">Livreurs</h4>
                            
<!-- section pour les livreurs -->
                                        
<section class="my-lg-14 my-4">
      <!-- container -->
    <div class="container">
      <div class="row justify-content-center">
          <!-- col -->
          <div class="col-md-12 mb-8">
            <div class="wrapper">
              <div class="row ">

              <div class="col-md-6 " >
                        <div class="alert alert-warning text-dark">
                                Voulez-vous Ajoutez un Livreur ?
                                </div>
                     <div class="row " style="width: 100%; margin-left: 0.4em; height: 83%;">
                            <img src="../dashStyle/assets/images/iwaEnrliv.gif" class="w-100 h-100" alt="">
                        </div>
            </div> 


            <div class="col-md-6  rounded-3" style="background-color: #FAF9F9; box-shadow: 1px 1px 20px 1px; margin: auto;">
             
                             <div class="tab-content">
                                        <div class="tab-pane show active" id="input-types-preview">
                                            <div class="row">
                                                 <div class="col-lg-11 mt-4 ms-1">
                                                    <form action="{{ route('createNewLivreurs') }}" method="POST" enctype="multipart/form-data">
                                                      @csrf 
                                                      @method('POST')
                                                        <div class="mb-3">
                                                                <label for="example-palaceholder" class="form-label">Nom</label>
                                                                <input name="nom_livreurs" type="text" id="example-palaceholder" class="form-control" placeholder="Entrer le Nom">
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="example-palaceholder" class="form-label">Prenoms</label>
                                                                <input name="prenom_livreurs" type="text" id="example-palaceholder" class="form-control" placeholder="Entrer le prenom">
                                                            </div>
        

                                                            <div class="mb-3">
                                                                <label for="example-palaceholder" class="form-label">Contact</label>
                                                                <input name="contact" type="text" id="example-palaceholder" class="form-control" value="+225">
                                                            </div>


                                                            <div class="mb-3">
                                                            <label for="example-fileinput" class="form-label">Joindre une photo de profile (FACULTATIF)</label>
                                                            <input name="photo" type="file" id="example-fileinput" class="form-control">
                                                        </div>
                
                                                        <input type="hidden" name="token" value="{{ csrf_token() }}" />

                                                        </div>
                                                        <div class="me-3">
                                                          <button type="submit" class="btn btn-primary " style="margin: 1rem 1rem;">valider</button>
                                                          </div>
                                                      </div>
        
                
                                                        </form>
                                                </div> <!-- end col -->


        
                                                 
                                            </div>
                                                <!-- end row-->                      
                                    </div> <!-- end preview-->
                                        
                            
                             </div> <!-- end tab-content-->
            
        
         
        

        </div>
            
        </div>
        </div>
        </div>
      </div>
    </div>
</section>















                        
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
                                <script>document.write(new Date().getFullYear())</script> PRUMAD (IWA)
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



