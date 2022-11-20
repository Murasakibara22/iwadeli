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
                                    <h4 class="page-title"> <a href="/listAllLivreur" class="float-start me-5"><button type="button" class="btn btn-outline-success rounded-pill "><i class="uil-circuit"></i> Retour</button> </a>Ajouter un nouveau Livreur </h4>
                                    
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
                        <div class="alert alert-success text-dark">
                                Toutes les livraisons effectuer de <span class="fw-bold">{{$livreur->nom_livreurs}} , {{$livreur->prenom_livreurs}}</span>
                                </div>
                     <div class="row " style="width: 100%; margin-left: 0.4em; height: 87%;">
                            <img src="../dashStyle/assets/images/deliverySuccess.gif" class="w-100 h-100" alt="">
                        </div>
            </div> 


            <div class="col-md-6  rounded-3" style="background-color: #FAF9F9; box-shadow: 1px 1px 20px 1px; margin: auto;">
             
                             <div class="tab-content">
                                        <div class="tab-pane show active" id="input-types-preview">
                                            <div class="row">
                                                 <div class="col-lg-11 mt-4 ms-1">

                                                 <!-- Place form -->

                                                 <div class="row">
                                                 <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header d-flex justify-content-between align-items-center">
                                        <h4 class="header-title">Livraison effectuer</h4>
                                        
                                    </div>

                                    <div class="card-body pt-0">
                                        <div id="dash-campaigns-chart" data-labels="Djon,vivi,moro" class="apex-charts" data-colors="#ffbc00,#727cf5,#F73131"></div>

                                        <div class="row text-center mt-3">
                                            <div class="col-sm-4">
                                                <i class="mdi mdi-send widget-icon rounded-circle bg-warning-lighten text-warning"></i>
                                                <h3 class="fw-normal mt-3">
                                                    <span>{{$n}}</span>
                                                </h3>
                                                <p class="text-muted mb-0 mb-2"><i class="mdi mdi-checkbox-blank-circle text-warning"></i>Today</p>
                                            </div>
                                            <div class="col-sm-4">
                                                <i class="mdi mdi-flag-variant widget-icon rounded-circle bg-primary-lighten text-primary"></i>
                                                <h3 class="fw-normal mt-3">
                                                    <span>{{$countMeHier}}</span>
                                                </h3>
                                                <p class="text-muted mb-0 mb-2"><i class="mdi mdi-checkbox-blank-circle text-primary"></i>Hier</p>
                                            </div>
                                            <div class="col-sm-4">
                                                <i class="mdi mdi-email-open widget-icon rounded-circle bg-success-lighten text-success"></i>
                                                <h3 class="fw-normal mt-3">
                                                    <span>{{$allcom}}</span>
                                                </h3>
                                                <p class="text-muted mb-0 mb-2"><i class="mdi mdi-checkbox-blank-circle text-danger"></i> Total</p>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end card body-->
                                </div>
                                <!-- end card -->
                            </div>
                            <!-- end col-->
                                                 </div>



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



