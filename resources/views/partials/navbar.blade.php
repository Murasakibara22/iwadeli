	<!-- 
			=============================================
				Theme Main Menu
			============================================== 
			-->
			<header class="theme-main-menu sticky-menu theme-menu-one">
				<div class="inner-content position-relative">
					<div class="d-flex align-items-center justify-content-between">
						<div class="logo order-lg-0"><a href="/dashboard" class="d-block"><img src="{{ url('frontStyle/images/logo/logo.png') }}" alt="" width="95"></a></div>


						<div class="right-widget d-flex align-items-center order-lg-3">
							<a href="/contactez-nous" class="contact-btn-one fs-16 fw-500 text-white tran3s d-none d-lg-block me-3">Contactez nous</a>

							@if (Auth::guest())
							<a href="/login" class="contact-btn-one fs-14 fw-500 text-white bg-warning tran3s d-none d-lg-block  me-1">Login</a>
							@else
							<a href="/deconnexion" class="contact-btn-one fs-14 fw-500 text-white bg-danger tran3s d-none d-lg-block  me-1">Logout</a>
							@endif


						</div> <!-- /.right-widget -->

						<nav class="navbar navbar-expand-lg order-lg-2">
							<button class="navbar-toggler d-block d-lg-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
						    	<span></span>
						 	</button>
						    <div class="collapse navbar-collapse" id="navbarNav">
						    	<ul class="navbar-nav">
						    		<li class="d-block d-lg-none"><div class="logo"><a href="/dashboard" class="d-block"><img src="{{ url('frontStyle/images/logo/logo.png') }}" alt="" width="95"></a></div></li>
							        <li class="nav-item active dropdown mega-dropdown">
							        	<a class="nav-link " href="/" role="button" aria-expanded="false">Accueil</a>
						            </li>
						            <li class="nav-item dropdown mega-dropdown-md">
							        	<a class="nav-link " href="/about" role="button"   aria-expanded="false">A propos</a>
						            </li>
									<li class="nav-item dropdown mega-dropdown-md">
							        	<a class="nav-link " href="/404-iwa" role="button"  aria-expanded="false">Tout sur l'App</a>
						            </li>
						    	</ul>


						    	<!-- Mobile Content -->
						    	<div class="mobile-content d-block d-lg-none">
						    		<div class="d-flex flex-column align-items-center justify-content-center mt-70">

									@if (Auth::guest())
									<a href="/login" class="contact-btn-one bg-warning fs-16 fw-500 text-white tran3s mb-4">Login</a>
                     		  		 @else
                          			  <a href="/deconnexion" class="contact-btn-one bg-danger fs-16 fw-500 text-white tran3s mb-4">Logout</a>
                     		   		@endif

						    			<a href="/contactez-nous" class="contact-btn-one fs-16 fw-500 text-white tran3s ">Contactez nous</a>
						    		</div>
									
						    	</div> <!-- /.mobile-content -->
						    </div>
						</nav>
					</div>
				</div> <!-- /.inner-content -->
			</header> <!-- /.theme-main-menu -->