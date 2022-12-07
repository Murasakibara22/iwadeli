@extends('dash/layout/app')

@section('content')

 <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->

            <div class="content-page">
                <div class="content">
           
@if ( session('succes'))
  <div class="alert alert-success">
    Blog modifier  avec succes 
  </div>

@endif

@if ( session('success'))
  <div class="alert alert-success">
    Blog suprimer  avec succes 
  </div>

@endif

@if ( session('erreur'))
  <div class="alert alert-danger">
  Le Blog specifier est introuvable 
  </div>

@endif

@if ( session('errr'))
  <div class="alert alert-danger">
  Le Blog specifier n'est pas modifier 
  </div>

@endif


@if ( session('suprimer'))
  <div class="alert alert-success">
  Blogs Supprimer
  </div>

@endif

@if ( session('er'))
  <div class="alert alert-success">
 Une erreur c'est produite lors du chargement de l'image
  </div>

@endif

                    <!--  -->
                  

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
                                    <h4 class="page-title"> Nos Blogs
                                    <a href="/addBlog" class="float-end"><button type="button" class="btn btn-outline-info rounded-pill ms-5"><i class="uil-plus-circle"></i> Ajouter des Blogs</button> </a>
                                </h4>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->



                      <div class="col-lg-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                            <h4 class="card-title">Liste des Blogs
                    
                                            <!-- Fitrage -->
                                                        <div class="mb-1 col-6 float-end">
                                                        
                                                        <!-- title -->
                                                        <form action="">
                                                        <div class="d-flex  mt-lg-0 ">
                                                                <!-- select option -->
                                                                <select class="form-select" aria-label="Default select example" name="FindAnnonce">
                                                                <option selected>Filtrer selon: </option>
                                                                <option value="Aujourd'hui">Aujourd'hui</option>
                                                                <option value="Hier"> hier</option>
                                                                <option value="date recente"> date recente</option>
                                                                </select>

                                                                <button type="submit" class="btn btn-dark ms-3">Filtrer </button>
                                                            
                                                            </div>

                                                            </form>
                                                    </div>
                
                </h4>
                  <p class="card-description mt-3">
                    Vous avez la possibilité de  <code>modifier</code> ou de <code>suprimer  </code> un Blog
                  </p>
                
                





                  <div class="table-responsive">
                  <table class="table">
                    <thead class="thead-dark">
                        <tr class="bg-warning">
                        <th scope="col">Baniere</th>
                        <th scope="col">titres</th>
                        <th scope="col">Date</th>
                        <th scope="col">date de creation</th>
                        <th scope="col">details</th>
                        <th scope="col">modifier</th>
                        <th scope="col">suprimer</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($blog as $blo)
                        <tr>
                        <td class="fw-bold">
                            <img src="../images/blogs/{{$blo->banner}}" alt="image" width="40 height="10" />
                          
                          </td>
                               <td class="fw-bold" >
                                    {{$blo->titre}}
                              </td>
                               
                        <td>{{$blo->date}}</td>
                        <td>{{ date('j M, Y', strtotime($blo->created_at)) }}</td>
                        
                        <td>
                           <a href="/detailsLiv/{{$blo->slug}}"><button type="button" class="btn btn-warning"><i class="mdi mdi-eye"></i> </button> </a> 
                        </td>
                        <td>
                            <a href="/Blog_edit/{{$blo->slug}}"><button type="button" class="btn btn-info"><i class="mdi mdi-keyboard"></i> </button> </a> 
                            </td>
                        <td class="table-user">
                            <a href="/Blogdelete/{{$blo->slug}}"> <img src="../dashStyle/assets/images/rondDelete.gif" alt="table-user" class="me-2 rounded-circle" /> </a> 
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