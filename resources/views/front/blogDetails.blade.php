

	@extends('layouts.app')
    
    

    @section('content')



			<!-- 
			=============================================
				Feature Section Fifty One
			============================================== 
			-->
			<div class="fancy-feature-fiftyOne position-relative mt-250 lg-mt-200">
				<div class="container">
					<div class="row">
						<div class="col-xxl-8 col-lg-9 wow fadeInLeft">
							<p class="blog-pubish-date">Restez tranquille, on vous <a href="#" class="fw-500"> livre tous</a></p>
							<h2 class="blog-heading-one tx-dark">{{$blogu->titre}}</h2>
						</div>
					</div>
				</div> <!-- /.container -->
				<img src="frontStyle/images/lazy.svg" data-src="{{ url('../frontStyle/images/shape/shape_172.svg')}}" alt="" class="lazy-img shapes shape-two">
			</div> <!-- /.fancy-feature-fiftyOne -->



			<!--
			=====================================================
				Blog Details One
			=====================================================
			-->
			<div class="blog-details-one mt-120 lg-mt-60">
				<div class="container">
					<div class="border-bottom pb-130 lg-pb-60">
						<div class="row gx-xl-5">
							<div class="col-lg-8">
								<div class="blog-meta-wrapper pe-xxl-5">
									<article class="blog-details-content">
										<img src="frontStyle/images/lazy.svg" data-src="../images/blogs/{{$blogu->banner}}" alt="" class="lazy-img image-meta w-100">
                                        {!!$blogu->description!!}
										

										<div class="bottom-widget d-sm-flex align-items-center justify-content-between">
											<ul class="d-flex tags style-none pb-20">
												<li>Tag:</li>
												<li> date de creation</li>
											</ul>
											<ul class="d-flex share-icon align-items-center style-none pb-20">
												<li>Partage:</li>
												<li><a href="#"><i class="bi bi-google"></i></a></li>
												<li><a href="#"><i class="bi bi-twitter"></i></a></li>
												<li><a href="#"><i class="bi bi-instagram"></i></a></li>
											</ul>
										</div> <!-- /.bottom-widget -->
									</article> <!-- /.blog-details-content -->





									
									<div class="blog-comment-area">
										<h3 class="blog-inner-title tx-dark pb-15">Commentaires</h3>
										<div class="comment d-flex">
											<img src="frontStyle/images/media/dev2.jpg" alt="" class="user-avatar rounded-circle">
											<div class="comment-text">
												<div class="name fw-500 tx-dark">Richard Koffi</div>
												<div class="date">13 Juin, 2022, 19:30</div>
												<p>One touch of a red-hot stove is usually all we need to avoid that kind of lorem discomfort in future. The same true we experience </p>
												<a href="#" class="reply-btn fw-500 tran3s">Reply</a>
											</div> <!-- /.comment-text -->
										</div> <!-- /.comment -->
										<div class="comment d-flex">
											<img src="frontStyle/images/media/devpp.jpg" alt="" class="user-avatar rounded-circle">
											<div class="comment-text">
												<div class="name fw-500 tx-dark">Rashed ka.</div>
												<div class="date">14 Aout, 2022, 7:14</div>
												<p>One touch of a red-hot stove is usually all we need to avoid that kind of lorem discomfort in future. The same true we experience </p>
												<a href="#" class="reply-btn fw-500 tran3s">Reply</a>
											</div> <!-- /.comment-text -->
										</div> <!-- /.comment -->
									</div> <!-- /.blog-comment-area -->

									<div class="blog-comment-form">
										<h3 class="blog-inner-title tx-dark">Laisse un commentaire</h3>
										<p><a href="signin.html" class="text-decoration-underline"></a> </p>
										<form action="#" class="mt-30">
											<div class="input-wrapper mb-35">
												<label>Nom*</label>
												<input type="text" placeholder="Ex: Joackim Coulibaly">
											</div> <!-- /.input-wrapper -->
											<div class="input-wrapper mb-40">
												<label>Email*</label>
												<input type="email" placeholder="votreEmail@gmail.com">
											</div> <!-- /.input-wrapper -->
											<div class="input-wrapper mb-30">
												<textarea placeholder="Votre Commentaire"></textarea>
											</div> <!-- /.input-wrapper -->
											<button class="btn-twentyTwo fw-500 tran3s">OK</button>
										</form>
									</div> <!-- /.blog-comment-form -->
								</div> <!-- /.blog-meta-wrapper -->
							</div>

							<div class="col-lg-4 col-md-8">
								<div class="blog-sidebar md-mt-70">
									<div class="blog-sidebar-search mb-55 md-mb-40">
										<form action="#">
											<input type="text" placeholder="Recherche..">
											<button><i class="bi bi-search"></i></button>
										</form>
									</div> <!-- /.blog-sidebar-search -->
								

									<div class="sidebar-recent-news mb-60 md-mb-50">
										<h4 class="sidebar-title">News avec iwa</h4>
                                        @foreach($blog as $blogs)
										<div class="news-block d-flex align-items-center pt-20 pb-20 border-top">
											<div><img src="frontStyle/images/lazy.svg" data-src="../images/blogs/{{$blogs->banner}}" alt="" class="lazy-img"></div>
											<div class="post ps-4">
												<h4 class="mb-5"><a href="/blog_details/{{$blogs->slug}}" class="title tran3s">{{$blogs->titre}}</a></h4>
												<div class="date">{{$blogs->date}}</div>
											</div>
										</div>
                                        @endforeach
									</div> <!-- /.sidebar-recent-news -->

									<div class="sidebar-banner-add" style="background-image:url( {{ url('frontStyle/images/logo/bg-apropos.jpg') }} );">
										<div class="banner-content">
											<h4>Appelez <br>et soyez livrer Chap chap !</h4>
											<p>Pro---pro---professionnalisme</p>
											<a href="tel:+225 0707595959" class="btn-twentyOne fw-500 tran3s">Appeler</a>
										</div>
									</div> <!-- /.sidebar-banner-add -->
								</div> <!-- /.blog-sidebar -->
							</div>
						</div>
					</div>
				</div>
			</div> <!-- /.blog-details-one -->




		@endsection