@extends('dash/layout/app')

@section('content')

 <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->

            <div class="content-page">
                <div class="content">
                @if ( session('Valide'))
                    <div class="alert alert-success mt-1">
                    La commande est Terminer
                    </div>
                    @endif

                    @if ( session('Nodetails'))
                    <div class="alert alert-info mt-1">
                    Aucun details trouver. Esaayez En recherchant selon le lieu de depart  !
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
                                    <h4 class="page-title"> Nos Commandes Effectuer
                                    <a href="/listAllCom" class="float-end"><button type="button" class="btn btn-warning rounded-pill ms-5"><i class="uil-plus-circle"></i> Commande En Attente</button> </a>
                                </h4>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->



                      <div class="col-lg-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                            <h4 class="card-title">Liste de toutes les commandes effectuees
                            <div class="app-search dropdown float-end mt-3">
                                                <form action="{{ route('findSearInOrderTs') }}">
                                                    <div class="input-group">
                                                        <input type="search" name= "search" value="{{  request()->search ?? '' }}"  class="form-control dropdown-toggle"  placeholder="Recherche..." id="top-search">
                                                        <span class="mdi mdi-magnify search-icon"></span>
                                                        
                                                        <button class="input-group-text btn btn-primary" type="submit">recherche</button>
                                                    </div>
                                                </form>

                                              
                                            </div>
                            </h4>

                          


                  <p class="card-description mt-3">
                    La Liste de toutes les commandes qui <code>viennent </code>  d'etre terminer 
                  </p>
                
                    <!-- Fitrage -->
                  <div class="mb-1 col-12">
                
                <!-- title -->
                <form action="{{ route ('filtreAllCTs') }}">
                  <div class="d-flex  mt-lg-0 ">
                        <!-- select option -->
                        <select class="form-select" aria-label="Default select example" name="FiltrerSelon">
                        <option selected>Filtrer les commandes selon: </option>
                          <option value="Aujourd'hui">Aujourd'hui</option>
                          <option value="hier"> hier</option>
                          <option value="7 derniers jours"> 7 derniers jours</option>
                          <option value="il y a un Mois"> il y a un Mois</option>
                        </select>

                        <button type="submit" class="btn btn-dark ms-3">Filtrer </button>
                      
                      </div>

                      </form>
              </div>





                  <div class="table-responsive">
                  <table class="table">
                    <thead class="thead-dark">
                        <tr class="bg-info">
                        <th scope="col">depart</th>
                        <th scope="col">arrive</th>
                        <th scope="col">CDD</th>
                        <th scope="col">date </th>
                        <th scope="col">prix</th>
                        <th scope="col">N.U.C</th>
                        <th scope="col">Contact</th>
                        <th scope="col">livrer par </th>
                        <th scope="col">Engins</th>
                        <th scope="col">Avamcement</th>
                        <th scope="col">suprimer</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($commande as $commandes)
                        <tr>
                               <td class="fw-bold" >
                               <div class="text-truncate" style=" height:20px; width:80px; overflow:hidden;">
                                    {{$commandes->lieudedepart}}
                                </div>
                              </td>
                               
                        <td class="fw-bold"> 
                        <div class="text-truncate" style=" height:20px; width:100px; overflow:hidden;">
                          {{$commandes->lieudelivraison}}
                          </div>
                        </td>
                        <td>{{$commandes->contactdudestinataire}}</td>
                        <td>
                        <div class="text-truncate" style="height:20px; width:100px; overflow:hidden;">
                          {{ date('j M, Y', strtotime($commandes->created_at)) }}
                          </div>
                        </td>
                        <td>{{ $commandes->montant }}</td>
                        @foreach($commandes->user()->get()  as $utili)
                        <td>{{$utili->nom}}</td>
                        <td>{{$utili->contact}}</td>
                        @endforeach

                        @foreach($commandes->livreur()->get() as $livr)
                        <td>
                        <div class="text-truncate" style=" height:20px; width:90px; overflow:hidden;">
                            {{$livr->nom_livreurs}}
                            </div>
                        </td>
                        @endforeach

                        <td>
                            {{$commandes->nature}}
                        </td>
                                    <td>
                                    Terminer
                                    </td>
                     
                         <td class="table-user">
                            <a href="/deleteCommande/{{$commandes->id}}">  <img src="../dashStyle/assets/images/rondDelete.gif" alt="table-user" class="me-2 rounded-circle " /> </a> 
                        </td>
                        </tr>
                        @endforeach
                    </tbody>
                    </table>

 
                  </div>
                </div>
              </div>
            </div>



                     </div>
                </div>
            </div>



@endsection