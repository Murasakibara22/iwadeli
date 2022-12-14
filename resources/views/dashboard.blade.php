@extends('dash/layout/app')

@section('content')


@if ( session('success'))
  <div class="alert alert-success">
   sauvegarder avec succès
  </div>

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
                                          
                                        </ol>
                                    </div>
                                    <h4 class="page-title" style="font-family:poppins;">IWA DELIVERY</h4>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                                 <div class="row">
                                    <div class="col-md-6 col-xl-3">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="row align-items-center">
                                                    <div class="col-6">
                                                        <h5 class="text-muted fw-normal mt-0 text-truncate" title="Campaign Sent">Orders</h5>
                                                        <h3 class="my-2 py-1">{{$countAllOrder}}</h3>
                                                        <p class="mb-0 text-muted">
                                                            <span class="text-success me-2"><i class="mdi mdi-arrow-up-bold"></i> 3.27%</span>
                                                        </p>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="text-end">
                                                            <div id="campaign-sent-chart" data-colors="#727cf5"></div>
                                                        </div>
                                                    </div>
                                                </div> <!-- end row-->
                                            </div> <!-- end card-body -->
                                        </div> <!-- end card -->
                                    </div> <!-- end col -->

                                    <div class="col-md-6 col-xl-3">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="row align-items-center">
                                                    <div class="col-6">
                                                        <h5 class="text-muted fw-normal mt-0 text-truncate" title="New Leads">C.D.J</h5>
                                                        <h3 class="my-2 py-1">{{$comAll}}</h3>
                                                        <p class="mb-0 text-muted">
                                                            @if($commandeTCount <  $commandeHCount)
                                                            <span class="text-danger me-2"><i class="mdi mdi-arrow-down-bold"></i> Baisse</span>
                                                            @elseif($commandeTCount >  $commandeHCount)
                                                            <span class="text-success me-2"><i class="mdi mdi-arrow-up-bold"></i> good</span>
                                                            @else
                                                            <span class="text-secondary me-2"><i class="mdi mdi-arrow-down-bold"></i>meme</span>
                                                            @endif
                                                        </p>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="text-end">
                                                        @if($commandeTCount <  $commandeHCount)
                                                            <div id="new-leads-chart" data-colors="#F73131"></div>
                                                            @elseif($commandeTCount >  $commandeHCount)
                                                            <div id="new-leads-chart" data-colors="#0acf97"></div>
                                                            @else
                                                            <div id="new-leads-chart" data-colors="#C1C1C1"></div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div> <!-- end row-->
                                            </div> <!-- end card-body -->
                                        </div> <!-- end card -->
                                    </div> <!-- end col -->

                                    <div class="col-md-6 col-xl-3">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="row align-items-center">
                                                    <div class="col-6">
                                                        <h5 class="text-muted fw-normal mt-0 text-truncate" title="Deals">Com.Valider</h5>
                                                        <h3 class="my-2 py-1">{{$comAllValidate}}</h3>
                                                        <p class="mb-0 text-muted">
                                                            @if($result_Pourcentage_valider_todays <  $result_Pourcentage_valider_yesterday)
                                                            <span class="text-danger me-2"><i class="mdi mdi-arrow-down-bold"></i>{{sprintf("%.1f", $result_Pourcentage_valider_todays)}}%</span>
                                                            @elseif($result_Pourcentage_valider_todays >  $result_Pourcentage_valider_yesterday)
                                                            <span class="text-success me-2"><i class="mdi mdi-arrow-up-bold"></i>{{sprintf("%.1f", $result_Pourcentage_valider_todays)}}%</span>
                                                            @else
                                                            <span class="text-secondary me-2"><i class="mdi mdi-arrow-up-bold"></i>{{sprintf("%.1f", $result_Pourcentage_valider_todays)}}%</span>
                                                            @endif
                                                        </p>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="text-end">
                                                        @if($result_Pourcentage_valider_todays <  $result_Pourcentage_valider_yesterday)
                                                            <div id="deals-chart" data-colors="#F73131">Baisse</div>
                                                            @elseif($result_Pourcentage_valider_todays >  $result_Pourcentage_valider_yesterday)
                                                            <div id="deals-chart" data-colors="#0acf97">Hausse</div>
                                                            @else
                                                            <div id="deals-chart" data-colors="#727cf5">Stable</div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div> <!-- end row-->
                                            </div> <!-- end card-body -->
                                        </div> <!-- end card -->
                                    </div> <!-- end col -->

                                    <div class="col-md-6 col-xl-3">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="row align-items-center">
                                                    <div class="col-6">
                                                        <h5 class="text-muted fw-normal mt-0 text-truncate" title="Booked Revenue">C.Terminer</h5>
                                                        <h3 class="my-2 py-1">{{$comAllTerminer}}</h3>
                                                        <p class="mb-0 text-muted">
                                                            @if($result_Pourcentage_terminer_todays <  $result_Pourcentage_terminer_hier)
                                                            <span class="text-danger me-2"><i class="mdi mdi-arrow-down-bold"></i>{{sprintf("%.1f", $result_Pourcentage_terminer_todays)}}%</span>
                                                            @elseif($result_Pourcentage_terminer_todays >  $result_Pourcentage_terminer_hier)
                                                            <span class="text-success me-2"><i class="mdi mdi-arrow-up-bold"></i>{{sprintf("%.1f", $result_Pourcentage_terminer_todays)}}%</span>
                                                            @else
                                                            <span class="text-secondary me-2"><i class="mdi mdi-arrow-up-bold"></i>{{sprintf("%.1f", $result_Pourcentage_terminer_todays)}}%</span>
                                                            @endif
                                                        </p>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="text-end">
                                                        @if($result_Pourcentage_terminer_todays <  $result_Pourcentage_terminer_hier)
                                                            <div id="booked-revenue-chart" data-colors="#F73131">Chute</div>
                                                            @elseif($result_Pourcentage_terminer_todays >  $result_Pourcentage_terminer_hier)
                                                            <div id="booked-revenue-chart" data-colors="#0acf97">Hausse</div>
                                                            @else
                                                            <div id="booked-revenue-chart" data-colors="#727cf5">stable</div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div> <!-- end row-->
                                            </div> <!-- end card-body -->
                                        </div> <!-- end card -->
                                    </div> <!-- end col -->
                                </div>
                                <!-- end row -->

                        <div class="row">
                           
                            <!-- end col-->
    
                            <div class="row">
                            <div class="col-lg-6">
                                <div class="card">
                                    <div class="card-header d-flex justify-content-between align-items-center">
                                        <h4 class="header-title">STATS Commande du jours</h4>
                                        
                                    </div>

                                    <div class="card-body pt-0">
                                        <div id="dash-campaigns-chart" data-labels="Djon,vivi,moro" class="apex-charts" data-colors="#ffbc00,#727cf5,#F73131"></div>

                                        <div class="row text-center mt-3">
                                            <div class="col-sm-4">
                                                <i class="mdi mdi-send widget-icon rounded-circle bg-warning-lighten text-warning"></i>
                                                <h3 class="fw-normal mt-3">
                                                    <span>{{$commandeEnCourCount}}</span>
                                                </h3>
                                                <p class="text-muted mb-0 mb-2"><i class="mdi mdi-checkbox-blank-circle text-warning"></i>commandes en cours</p>
                                            </div>
                                            <div class="col-sm-4">
                                                <i class="mdi mdi-flag-variant widget-icon rounded-circle bg-success-lighten text-success"></i>
                                                <h3 class="fw-normal mt-3">
                                                    <span>{{$commandeTTCount}}</span>
                                                </h3>
                                                <p class="text-muted mb-0 mb-2"><i class="mdi mdi-checkbox-blank-circle text-primary"></i> Commandes finish</p>
                                            </div>
                                            <div class="col-sm-4">
                                                <i class="mdi mdi-email-open widget-icon rounded-circle bg-danger-lighten text-danger"></i>
                                                <h3 class="fw-normal mt-3">
                                                    <span>{{$commandeEACount}}</span>
                                                </h3>
                                                <p class="text-muted mb-0 mb-2"><i class="mdi mdi-checkbox-blank-circle text-danger"></i> commande En attente</p>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end card body-->
                                </div>
                                <!-- end card -->
                            </div>
                            <!-- end col-->
    
                            <div class="col-lg-6">
                                <div class="card">
                                    <div class="card-header d-flex justify-content-between align-items-center">
                                        <h4 class="header-title">Revenue</h4>
                                        <div>
                                            <button type="button" class="btn btn-soft-secondary btn-sm">
                                                ALL
                                            </button>
                                            <button type="button" class="btn btn-soft-primary btn-sm">
                                                1M
                                            </button>
                                            <button type="button" class="btn btn-soft-secondary btn-sm">
                                                6M
                                            </button>
                                            <button type="button" class="btn btn-soft-secondary btn-sm">
                                                1Y
                                            </button>
                                        </div>
                                    </div>

                                    <div class="card-body pt-0">
                                        <div class="chart-content-bg">
                                            <div class="row text-center">
                                                <div class="col-sm-6">
                                                    <p class="text-muted mb-0 mt-3">Current Month</p>
                                                    <h2 class="fw-normal mb-3">
                                                        <span>$42,025</span>
                                                    </h2>
                                                </div>
                                                <div class="col-sm-6">
                                                    <p class="text-muted mb-0 mt-3">Previous Month</p>
                                                    <h2 class="fw-normal mb-3">
                                                        <span>$74,651</span>
                                                    </h2>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- <div dir="ltr">
                                            <div id="dash-revenue-chart" class="apex-charts" data-colors="#0acf97,#fa5c7c"></div>
                                        </div> -->

                                    </div>
                                    <!-- end card body-->
                                </div>
                                <!-- end card -->
                            </div>
                            <!-- end col-->
                        </div>
                        <!-- end row-->
                        </div>
                        <!-- end row-->


                        <div class="row">
                            <div class="col-xl-4 col-lg-12">
                                <div class="card">
                                    <div class="card-header d-flex justify-content-between align-items-center">
                                        <h4 class="header-title">Inscrits Aujourd'hui</h4>
                                      
                                    </div>

                                    <div class="card-body pt-0">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-sm table-nowrap table-centered mb-0">
                                                <thead>
                                                    <tr>
                                                        <th>Nom et prenoms </th>
                                                       
                                                        <th>Contact</th>
                                                     
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($user as $users)
                                                    @if( date('j M, Y', strtotime($users->created_at))  ==  $today)
                                                    <tr>
                                                        <td>
                                                            <h5 class="font-15 mb-1 fw-normal">{{$users->nom}}</h5>
                                                            <span class="text-muted font-13">{{$users->prenom}}</span>
                                                        </td>
                                                       
                                                        <td>{{$users->contact}}</td>
                                                       
                                                    </tr>
                                                   @endif
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div> <!-- end table-responsive-->

                                    </div> <!-- end card-body-->
                                </div> <!-- end card-->
                            </div>
                            <!-- end col-->

                            <div class="col-xl-4 col-lg-6">
                                <div class="card">
                                    <div class="card-header d-flex justify-content-between align-items-center">
                                        <h4 class="header-title">Commandes du jour</h4>
                                        <div class="dropdown">
                                            <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="mdi mdi-dots-vertical"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <!-- item-->
                                                <a href="/AllOrders" class="dropdown-item">Voir plus</a>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card-body pt-2">
                                    
           
                                        @foreach($com as $comm)
                                        @if( date('j M, Y', strtotime($comm->created_at))  ==  $today)
                                        @foreach($comm->user()->get()  as $utili)
                                        <div class="d-flex align-items-start mt-2">
                                            <img class="me-3 rounded-circle" src="../images/User/{{$utili->photo}} " width="40" alt=" user">
                                            <div class="w-100 overflow-hidden">
                                             
                                            @if($comm->terminate  == 0  && $comm->status  == 0)
                                                <span class="badge badge-danger-lighten float-end">En Attente </span>
                                                @elseif($comm->terminate  == 0  && $comm->status  == 1)
                                                <span class="badge badge-warning-lighten float-end">En Cour </span>
                                                @elseif($comm->terminate  == 1  && $comm->status  == 1)
                                                <span class="badge badge-success-lighten float-end">Terminer</span>
                                                @else
                                                <span class="badge badge-info-danger float-end">En Attente </span>
                                                @endif


                                               
                                                <h5 class="mt-0 ">{{$utili->nom}} , {{$utili->contact}}</h5>
                                               
                                                <span class="font-13"> {{$comm->nature}}</span>
                                            </div>
                                           
                                        </div>
                                        @endforeach
                                        @endif
                                        @endforeach

                            
                                                                            
                                    </div>
                                    <a href="/AllOrders" type="button" class="btn btn-soft-primary btn-sm mt-3">
                                                Voir tous
                                            </a>
                                    <!-- end card-body -->
                                </div>
                                <!-- end card-->
                            </div>
                            <!-- end col -->  
                            
                            <div class="col-xl-4 col-lg-6">
                                <div class="card cta-box bg-primary text-white">
                                    <div class="card-body">
                                        <div class="d-flex align-items-start align-items-center">
                                            <div class="w-100 overflow-hidden">
                                                <h2 class="mt-0"><i class="mdi mdi-bullhorn-outline"></i>&nbsp;</h2>
                                                <h3 class="m-0 fw-normal cta-box-title">Administrer votre site plus facilement  </h3>
                                            </div>
                                            <img class="ms-3" src="dashStyle/assets/images/svg/email-campaign.svg" width="120" alt="Troc moi images user">
                                        </div>
                                    </div>
                                    <!-- end card-body -->
                                </div>
                                <!-- end card-->

                                <!-- Todo-->
                                

                            </div>
                            <!-- end col -->  
                        </div>
                        <!-- end row-->
                        
                    </div> <!-- container -->

                </div> <!-- content -->

                <!-- Footer Start -->
                <footer class="footer">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6">
                                <script>document.write(new Date().getFullYear())</script> @ICDIGITAL
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