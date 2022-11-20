@extends('dash.layout.app')

@section('content')
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
                            
                                    <h4 class="page-title">Commandes Details</h4>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">

                                        <!-- Invoice Logo-->
                                        <div class="clearfix">
                                            <div class="float-start mb-3">
                                                <img src="../logo/Jiam_s3-removebg-preview.png" alt="dark logo" height="85">
                                            </div>
                                            <div class="float-end">
                                                <h4 class="m-0 d-print-none">Commande</h4>
                                            </div>
                                        </div>

                                        <!-- Invoice Detail-->
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="float-end mt-3">
                                                @foreach($commande->user()->get()  as $utili)
                                                    <p><b>{{$utili->nom}}, {{$utili->prenom}}</b></p>
                                                    @endforeach
                                                    <p class="text-muted font-13">Please find below a cost-breakdown for the recent work completed. Please make payment at your earliest convenience, and do not hesitate to contact me with any questions.</p>
                                                </div>
            
                                            </div><!-- end col -->
                                            <div class="col-sm-4 offset-sm-2">
                                                <div class="mt-3 float-sm-end">
                                                    <p class="font-13"><strong>date : </strong> &nbsp;&nbsp;&nbsp; {{ date('j M, Y', strtotime($commande->created_at)) }}</p>
                                                    
                                                    <p class="font-13"><strong> Status: </strong>
                                                    @if($commande->terminate  == 0  && $commande->status  == 0)
                                                     <span class="badge bg-danger float-end">En Attente</span>
                                                     @elseif($commande->terminate  == 0  && $commande->status  == 1)
                                                     <span class="badge bg-warning float-end">En Cour</span>
                                                     @elseif($commande->terminate  == 1  && $commande->status  == 1)
                                                     <span class="badge bg-success float-end">LIvrer</span>
                                                     @else
                                                     <span class="badge bg-secondary float-end">Aucun</span>
                                                     @endif
                                                    </p>

                                                    <p class="font-13"><strong>Commande ID: </strong> <span class="float-end">#{{$commande->id}}</span></p>
                                                </div>
                                            </div><!-- end col -->
                                        </div>
                                        <!-- end row -->
            
                                        <div class="row mt-4">
                                            <div class="col-sm-4">
                                                <h6> Address de depart</h6>
                                                <address>
                                                    {{$commande->lieudedepart}}
                                                </address>
                                            </div> <!-- end col-->
            
                                            <div class="col-sm-4">
                                                <h6>Destinations</h6>
                                                <address>
                                                {{$commande->lieudelivraison}}
                                                </address>
                                            </div> <!-- end col-->
            
                                            <div class="col-sm-4">
                                                <div class="text-sm-end">
                                                    <img src="assets/images/barcode.png" alt="barcode-image" class="img-fluid me-2" />
                                                </div>
                                            </div> <!-- end col-->
                                        </div>    
                                        <!-- end row -->        
    
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="table-responsive">
                                                    <table class="table mt-4">
                                                        <thead>
                                                        <tr><th>#</th>
                                                            <th>Item</th>
                                                        </tr></thead>
                                                        <tbody>
                                                        <tr>
                                                            <td>1</td>
                                                            <td>
                                                            <b>Contact Source</b>
                                                            @foreach($commande->user()->get()  as $utili)
                                                             <br/>
                                                                {{$utili->contact}}
                                                             @endforeach
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>2</td>
                                                            <td>
                                                                <b>Livreur Associer</b> 
                                                                @foreach($commande->livreur()->get() as $livr)
                                                                <br/>
                                                               {{$livr->nom_livreurs}}, {{$livr->prenom_livreurs}}
                                                                @endforeach
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>3</td>
                                                            <td>
                                                                <b>Contact dudestinataire</b> <br/>
                                                                {{$commande->contactdudestinataire}}
                                                            </td>
                                                        </tr>
    
                                                        </tbody>
                                                    </table>
                                                </div> <!-- end table-responsive-->
                                            </div> <!-- end col -->
                                        </div>
                                        <!-- end row -->

                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="clearfix pt-3">
                                                    <h6 class="text-muted">Details:</h6>
                                                    <small>
                                                        {{$commande->details}}
                                                    </small>
                                                </div>
                                            </div> <!-- end col -->
                                            <div class="col-sm-6">
                                                <div class="float-end mt-3 mt-sm-0">
                                                    <p><b>Montant:</b> <span class="float-end">{{$commande->montant}}  FCFA</span></p>
                                                    <p><b>TVA (12.5):</b> <span class="float-end">515.00 FCFA</span></p>
                                                    <h3>{{$commande->montant}} FCFA</h3>
                                                </div>
                                                <div class="clearfix"></div>
                                            </div> <!-- end col -->
                                        </div>
                                        <!-- end row-->

                                        
                                        <div class="d-print-none mt-4">
                                            <div class="text-end">
                                            @if($commande->terminate  == 0  && $commande->status  == 0)
                                            <div class="row">
                                            <form action=" {{ route('valideCommWithLivreurs') }}"  method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    
                                                    <div class="text-truncate" style=" height:40px; width:100px; overflow:hidden;">
                                                        <select class="form-select mb-3" name="id_livreurs">
                                                        <option selected>aucun</option>
                                                            @foreach($livreur as $livreurs)
                                                            <option name="id_livreurs" value="{{$livreurs->id}}">{{$livreurs->nom_livreurs}}</option>
                                                            @endforeach
                                                        </select>
                                                        </div>
                                                    

                                                    <input type="hidden" value="{{$commande->id}}"  name="id_com">

                                                            
                                                            <button type="submit" class="btn btn-success"><i class="mdi mdi"> valider</i> </button> 
                                                            
                                                </form>
                                                </div>
                                                @elseif($commande->terminate  == 0  && $commande->status  == 1)

                                                <form action=" {{ route('TerminateCommWithLivreurs') }}"  method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        

                                                        <input type="hidden" value="{{$commande->id}}"  name="id_com">

                                                                <td>
                                                                <button type="submit" class="btn btn-success"><i class="mdi mdi"> Terminer</i> </button> 
                                                                </td>
                                                    </form>
                                                @elseif($commande->terminate  == 1  && $commande->status  == 1)
                                                <button type="submit" class="btn btn-success" disabled><i class="mdi mdi"> Terminer</i> </button>
                                                @else
                                                <button type="submit" class="btn btn-secondary" disabled><i class="mdi mdi"> Terminer</i> </button>
                                                @endif
                                            </div>
                                        </div>   
                                        <!-- end buttons -->

                                    </div> <!-- end card-body-->
                                </div> <!-- end card -->
                            </div> <!-- end col-->
                        </div>
                        <!-- end row -->
                        
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