@extends('dash/layout/app')

@section('content')


       <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->

            <div class="content-page">
                <div class="content">
                @if ( session('successDele'))
                    <!-- Basic Toast -->
                    <div class="toast fade show  ms-15 bg-success align-center" role="alert" aria-live="assertive" aria-atomic="true">
                        <div class="toast-header">
                            <img src="./assets/images/logo/freshcart-logo.svg" alt="brand-logo" height="12" class="me-1" />
                            <strong class="me-auto">succes</strong>
                            <small>Maintenant</small>
                            <button type="button" class="ms-2 mb-1 btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                        </div>
                        <div class="toast-body">
                            Utilisateur Supprimer avec suces .
                        </div>
                    </div> <!--end toast-->

                    @endif

                @if ( session('succesEdit'))
                    <!-- Basic Toast -->
                    <div class="toast fade show  ms-7 bg-success align-center" role="alert" aria-live="assertive" aria-atomic="true">
                        <div class="toast-header">
                            <img src="./assets/images/logo/freshcart-logo.svg" alt="brand-logo" height="12" class="me-1" />
                            <strong class="me-auto">succes</strong>
                            <small>Maintenant</small>
                            <button type="button" class="ms-2 mb-1 btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                        </div>
                        <div class="toast-body">
                            Utilisateur Modifier avec suces
                        </div>
                    </div> <!--end toast-->

                    @endif


                @if ( session('Nodetails'))
                    <!-- Basic Toast -->
                    <div class="alert alert-danger mt-2" role="alert">
                        Utilisateur Non trouver
                      </div><!--end toast-->

                    @endif

                    <!-- Start Content-->
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"> <a href="/addUser" class="float-end"><button type="button" class="btn btn-outline-info rounded-pill ms-5"><i class="uil-circuit"></i> Ajoutez des Utilisateurs</button> </a></li>

                                        </ol>
                                    </div>
                                    <h4 class="page-title">Utilisateurs </h4>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->


                        
                        <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Liste des utilisateurs 
                  <div class="app-search dropdown mt-2  float-end">
                                                <form action="{{ route('findSearch') }}">
                                                    <div class="input-group">
                                                        <input type="search" name= "search" value="{{  request()->search ?? '' }}"  class="form-control dropdown-toggle"  placeholder="Recherche..." id="top-search">
                                                        <span class="mdi mdi-magnify search-icon"></span>
                                             
                                                        <button class="input-group-text btn btn-primary" type="submit">Search</button>
                                                    </div>
                                                </form>

                                              
                                            </div>
                  </h4>
                  <p class="card-description">
                    Vous avez la possibilité de  <code>modifier</code> ou de <code>suprimer  </code> un utilisateur
                  </p>
                  <div class="table-responsive">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th>
                            Photo 
                          </th>
                          <th>
                           Nom
                          </th>
                          <th>
                            prenom
                          </th>
                          <th>
                            role
                          </th>
                       
                          <th>
                            email
                          </th>
                          <th>
                            Mobile
                          </th>
                          <th>
                            Modifier
                          </th>
                          <th>
                            Suprimer
                          </th>
        
                        </tr>
                      </thead>
                      @foreach($user as $u)
                      <tbody>
                        <tr>
                          <td class="py-2">
                            <img src="../images/User/{{$u->photo}}" alt="image" width="100%" height="40%" class="rounded-5"    data-bs-toggle="modal" data-bs-target="#exampleModal"/>
                          
                          </td>
                          <td>
                            {{$u->nom}}
                          </td>
                         
                          <td>
                          {{$u->prenom}}
                          </td>
                           <td>
                          {{$u->role}}
                          </td>
                          <td>
                          {{$u->email}}
                          </td>
                          <td>
                          {{$u->contact}}
                          </td> 
                       <td>
                               <a href="/Utilisateurs-edit/{{$u->slug}}">  <button type="button" class="btn btn-outline-primary">Modifier</button> </a> 
                          </td>
                          <td>
                               <a href="/Userdelete/{{$u->slug }}">  <button type="button" class="btn btn-outline-danger">Suprimer</button> </a> 
                          </td>
                        </tr>
                      </tbody>
                      @endforeach
                    </table>
                  </div>
                </div>
              </div>
</div>
                            </div><!-- end col-->
                      

                 

                </div> 

            </div>

            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->

@endsection