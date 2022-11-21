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
                    <div class="alert alert-warning mt-1">
                    Aucun details trouver. Esaayez En recherchant selon le lieu de depart ou le lieu cible !
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
                                    <h4 class="page-title"> Nos Commandes En cour
                                    <a href="/listAllCom" class="float-end"><button type="button" class="btn btn-warning rounded-pill ms-5"><i class="uil-plus-circle"></i> Commande En Attente</button> </a>
                                </h4>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->



                      <div class="col-lg-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                            <h4 class="card-title">Recherches dans la listes des commandes En cour 
                            <div class="app-search dropdown float-end mt-3">
                                    <form action="{{ route('findSearInOrderECs') }}">
                                        <div class="input-group">
                                            <input type="search" name= "search" value="{{  request()->search ?? '' }}"  class="form-control dropdown-toggle"  placeholder="Recherche..." id="top-search">
                                            <span class="mdi mdi-magnify search-icon"></span>
                                            
                                            <button class="input-group-text btn btn-primary" type="submit">recherche</button>
                                        </div>
                                    </form>

                                    
                                </div>
                            </h4>

                  <p class="card-description mt-3">
                   toutes les commandes  <code>En cour</code>  
                  </p>
                
                    <!-- Fitrage -->
                  <div class="mb-1 col-12">
                
                <!-- title -->
                <form action="{{ route('RangeInAllCECs')}}">
                  <div class="d-flex  mt-lg-0 ">
                        <!-- select option -->
                        <select class="form-select" aria-label="Default select example" name="FiltrerSelon">
                          <option selected>Range Par: </option>
                          <option value="Lieu de Depart">Lieu de Depart</option>
                          <option value="Lieu de D'arriver"> Lieu de D'arriver</option>
                          <option value="prix"> prix</option>
                        </select>

                    <input type="hidden" value="{{$typeOfFiltreParent}}"  name="firsstFiltreChoisie">
                        <button type="submit" class="btn btn-dark ms-3">Filtrer </button>
                      
                      </div>

                      </form>
              </div>





                  <div class="table-responsive">
                  <table class="table">
                    <thead class="thead-white">
                        <tr class="bg-success text-dark">
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
                        <th scope="col">actions</th>
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
                        @if(date('j M, Y', strtotime($commandes->created_at)) == $today)
                        <td>
                        <div class="text-truncate" style=" height:20px; width:100px; overflow:hidden;">
                            Aujourd'hui
                            </div>
                        </td>
                        @elseif(date('j M, Y', strtotime($commandes->created_at)) == $yesterday)
                        <td>
                        <div class="text-truncate" style=" height:20px; width:100px; overflow:hidden;">
                            Hier
                            </div>
                        </td>
                        @else
                        <td>
                        <div class="text-truncate" style=" height:20px; width:100px; overflow:hidden;">
                            {{ date('j M, Y', strtotime($commandes->created_at)) }}
                            </div>
                        </td>
                        @endif
                        <td>{{ $commandes->montant }} </td>
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
                        @if($commandes->terminate  == 0  && $commandes->status  == 0)
                          <td>     <span class="badge badge-danger-lighten ">En Attente </span> </td> 
                              @elseif($commandes->terminate  == 0  && $commandes->status  == 1)
                          <td>    <span class="badge badge-warning-lighten ">En Cour </span></td> 
                                @elseif($commandes->terminate  == 1  && $commandes->status  == 1)
                            <td>   <span class="badge badge-success-lighten ">Terminer</span></td> 
                                @else
                            <td>  <span class="badge badge-info-danger ">En Attente </span></td> 
                                @endif
                     
                                <form action=" {{ route('TerminateCommWithLivreurs') }}"  method="POST">
                            @csrf
                            @method('PUT')
                            

                              <input type="hidden" value="{{$commandes->id}}"  name="id_com">

                                    <td>
                                    <button type="submit" class="btn btn-success"><i class="mdi mdi"> Terminer</i> </button> 
                                    </td>
                        </form>
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