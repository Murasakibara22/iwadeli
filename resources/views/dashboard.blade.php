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
                                    <h4 class="page-title">CRM</h4>
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
                                                <h5 class="text-muted fw-normal mt-0 text-truncate" title="Campaign Sent">Abonnés </h5>
                                                <h3 class="my-2 py-1">9,184</h3>
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
                                                <h5 class="text-muted fw-normal mt-0 text-truncate" title="New Leads">Annonces</h5>
                                                <h3 class="my-2 py-1"></h3>
                                                <p class="mb-0 text-muted">
                                                    <span class="text-danger me-2"><i class="mdi mdi-arrow-down-bold"></i> 5.38%</span>
                                                </p>
                                            </div>
                                            <div class="col-6">
                                                <div class="text-end">
                                                    <div id="new-leads-chart" data-colors="#0acf97"></div>
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
                                                <h5 class="text-muted fw-normal mt-0 text-truncate" title="Deals">Sous Categories</h5>
                                                <h3 class="my-2 py-1"></h3>
                                                <p class="mb-0 text-muted">
                                                    <span class="text-success me-2"><i class="mdi mdi-arrow-up-bold"></i> 4.87%</span>
                                                </p>
                                            </div>
                                            <div class="col-6">
                                                <div class="text-end">
                                                    <div id="deals-chart" data-colors="#727cf5"></div>
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
                                                <h5 class="text-muted fw-normal mt-0 text-truncate" title="Booked Revenue">Pays</h5>
                                                <h3 class="my-2 py-1"></h3>
                                                <p class="mb-0 text-muted">
                                                    <span class="text-success me-2"><i class="mdi mdi-arrow-up-bold"></i> 11.7%</span>
                                                </p>
                                            </div>
                                            <div class="col-6">
                                                <div class="text-end">
                                                    <div id="booked-revenue-chart" data-colors="#0acf97"></div>
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
    
                            <div class="col-lg-7">
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

                                        <div dir="ltr">
                                            <div id="dash-revenue-chart" class="apex-charts" data-colors="#0acf97,#fa5c7c"></div>
                                        </div>

                                    </div>
                                    <!-- end card body-->
                                </div>
                                <!-- end card -->
                            </div>
                            <!-- end col-->
                        </div>
                        <!-- end row-->


                        <div class="row">
                            <div class="col-xl-4 col-lg-12">
                                <div class="card">
                                    <div class="card-header d-flex justify-content-between align-items-center">
                                        <h4 class="header-title">Meilleurs publicateurs</h4>
                                      
                                    </div>

                                    <div class="card-body pt-0">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-sm table-nowrap table-centered mb-0">
                                                <thead>
                                                    <tr>
                                                        <th>User</th>
                                                       
                                                        <th>N'b de publication</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            <h5 class="font-15 mb-1 fw-normal">Jeremy Young</h5>
                                                            <span class="text-muted font-13">Senior Sales Executive</span>
                                                        </td>
                                                       
                                                        <td>49</td>
                                                        <td class="table-action">
                                                            <a href="javascript: void(0);" class="action-icon"> <i class="mdi mdi-eye"></i></a>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <h5 class="font-15 mb-1 fw-normal">Thomas Krueger</h5>
                                                            <span class="text-muted font-13">Senior Sales Executive</span>
                                                        </td>
                                                        
                                                        <td>83</td>
                                                        <td class="table-action">
                                                            <a href="javascript: void(0);" class="action-icon"> <i class="mdi mdi-eye"></i></a>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <h5 class="font-15 mb-1 fw-normal">Pete Burdine</h5>
                                                            <span class="text-muted font-13">Senior Sales Executive</span>
                                                        </td>
                                                    
                                                        <td>62</td>
                                                        <td class="table-action">
                                                            <a href="javascript: void(0);" class="action-icon"> <i class="mdi mdi-eye"></i></a>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <h5 class="font-15 mb-1 fw-normal">Mary Nelson</h5>
                                                            <span class="text-muted font-13">Senior Sales Executive</span>
                                                        </td>
                                                       
                                                        <td>258</td>
                                                        <td class="table-action">
                                                            <a href="javascript: void(0);" class="action-icon"> <i class="mdi mdi-eye"></i></a>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <h5 class="font-15 mb-1 fw-normal">Kevin Grove</h5>
                                                            <span class="text-muted font-13">Senior Sales Executive</span>
                                                        </td>
                                                       
                                                        <td>73</td>
                                                        <td class="table-action">
                                                            <a href="javascript: void(0);" class="action-icon"> <i class="mdi mdi-eye"></i></a>
                                                        </td>
                                                    </tr>
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
                                        <h4 class="header-title">Annonces du jour</h4>
                                        <div class="dropdown">
                                            <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="mdi mdi-dots-vertical"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <!-- item-->
                                                <a href="/annonce_list" class="dropdown-item">Voir plus</a>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card-body pt-2">
                                    
           

                                        <div class="d-flex align-items-start">
                                            <img class="me-3 rounded-circle" src="../images/User/  " width="40" alt="Troc moi images user">
                                            <div class="w-100 overflow-hidden">
                                             
                                                <span class="badge badge-warning-lighten float-end"> </span>
                                
                                                <h5 class="mt-0 mb-1"> </h5>
                                                <span class="font-13"> </span>
                                            </div>
                                           
                                        </div>

                            
                                                                            
                                    </div>
                                    <a href="/annonce_list" type="button" class="btn btn-soft-primary btn-sm mt-3">
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
                                                <h3 class="m-0 fw-normal cta-box-title">Administrer votre site plus facilement <b>Campaign</b> for better outreach </h3>
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