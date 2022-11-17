@extends('dash.layout.app')

@section('content')


<!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->

            <div class="content-page">
                <div class="content">


                   <!-- Start Content-->
                   <div class="container-fluid">

                    <form action="{{ url('/destroyLiv/'.$livreur->id) }}" method="POST">
                        @csrf 
                        @method('DELETE')

                        <div class="alert alert-danger" role="alert">
                    vous allez suprimer {{$livreur->nom_livreurs}} ?
                    </div>

                    <div class="shadow-lg p-3 mb-5 bg-body rounded">Voulez vous vraiment suprimer {{$livreur->nom_livreurs}} 
                    <button type="submit"  class="btn btn-danger float-end mt-3" >oui suprimer</button>
                    <a href="{{ url('/Annonce_list/') }}" class="float-end me-2 mb-4 mt-3"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">non fermer </button>  </a> 
                    
                    
                    <div class="col-md-6 mt-5" style="margin: auto;" >
                    
                     <div class="row " style="width: 100%; margin-left: 0.4em; height: 85%;">
                            <img src="../dashStyle/assets/images/deletUs.gif" class="w-100 h-100" alt="">
                        </div>
            </div>
                    </div>
                    </form>




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