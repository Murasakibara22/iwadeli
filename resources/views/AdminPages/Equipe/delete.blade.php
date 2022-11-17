@extends('dash.layout.app')

@section('content')


<!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->

            <div class="content-page">
                <div class="content">


                   <!-- Start Content-->
                   <div class="container-fluid">

<form action="{{ url('/equipDelete/'.$equipe->slug) }}" method="POST">
    @csrf 
    @method('DELETE')

    <div class="alert alert-danger" role="alert">
  vous allez suprimer {{$equipe->nom}} ?
</div>

<div class="shadow-lg p-3 mb-5 bg-body rounded"> <h4 class="mb-3 fs-3">Voulez vous vraiment suprimer {{$equipe->nom}} </h4>
<button type="submit"  class="btn btn-danger mt-2">oui suprimer</button>
<a href="{{ url('/equipe_list/') }}"><button type="button" class="btn btn-secondary mt-2" data-bs-dismiss="modal">non fermer </button>  </a> 

<div class="col-md-6 mt-5" style="margin: auto;" >
                    
                    <div class="row " style="width: 100%; margin-left: 0.4em; height: 85%;">
                           <img src="../dashStyle/assets/images/deleteMembers.gif" class="w-100 h-100" alt="">
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
                <script>document.write(new Date().getFullYear())</script> © Hyper - Coderthemes.com
            </div>
            <div class="col-md-6">
                <div class="text-md-end footer-links d-none d-md-block">
                    <a href="javascript: void(0);">About</a>
                    <a href="javascript: void(0);">Support</a>
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