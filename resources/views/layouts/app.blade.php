<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="keywords" content="Digital marketing agency, Digital marketing company, Digital marketing services">
		<meta name="description" content="Jano creative multipurpose is a beautiful website template designed for SEO & Digital Agency websites.">
      	<meta property="og:site_name" content="Jano">
      	<meta property="og:url" content="https://heloshape.com/">
      	<meta property="og:type" content="website">
      	<meta property="og:title" content="iwa delivery">
		
		<!-- For IE -->
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<!-- For Resposive Device -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<!-- For Window Tab Color -->
		<!-- Chrome, Firefox OS and Opera -->
		<meta name="theme-color" content="#1d2b40">
		<!-- Windows Phone -->
		<meta name="msapplication-navbutton-color" content="#1d2b40">
		<!-- iOS Safari -->
		<meta name="apple-mobile-web-app-status-bar-style" content="#1d2b40">
		<title>iwa</title>
		<!-- Favicon -->
		<link rel="icon" type="image/png" sizes="56x56" href="frontStyle/images/logo/logo.png">
		<!-- Main style sheet -->
		<link rel="stylesheet" type="text/css" href="{{ asset('frontStyle/css/style.css') }}" media="all">
		<!-- responsive style sheet -->
		<link rel="stylesheet" type="text/css" href="{{ asset('frontStyle/css/responsive.css') }}" media="all">

		<!-- Fix Internet Explorer ______________________________________-->
		<!--[if lt IE 9]>
			<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
			<script src="vendor/html5shiv.js"></script>
			<script src="vendor/respond.js"></script>
		<![endif]-->	
	</head>

	<body>
		<div class="main-page-wrapper">
			<!-- ===================================================
				Loading Transition
			==================================================== -->
			<div id="preloader">
				<div id="ctn-preloader" class="ctn-preloader">
					<div class="animation-preloader">
						<div class="icon"><img src="../frontStyle/images/logo/logo.png" alt="" class="m-auto d-block" width="40"></div>
						<div class="txt-loading mt-3">
							<span data-text-preloader="I" class="letters-loading">
								I
							</span>
							<span data-text-preloader="W" class="letters-loading">
								W
							</span>
							<span data-text-preloader="A" class="letters-loading">
								A
							</span>
						</div>
					</div>	
				</div>
			</div>

@include('partials.navbar')

@yield('content')

@include('partials.footer')







		<!-- Optional JavaScript _____________________________  -->

    	<!-- jQuery first, then Bootstrap JS -->
    	<!-- jQuery -->
		<script src="{{ asset('frontStyle/vendor/jquery.min.js ') }}"></script>
		<!-- Bootstrap JS -->
		<script src="{{ asset('frontStyle/vendor/bootstrap/js/bootstrap.bundle.min.js ') }}"></script>
		<!-- WOW js -->
		<script src="{{ asset('frontStyle/vendor/wow/wow.min.js ') }}"></script>
		<!-- Slick Slider -->
		<script src="{{ asset('frontStyle/vendor/slick/slick.min.js ') }}"></script>
		<!-- Fancybox -->
		<script src="{{ asset('frontStyle/vendor/fancybox/dist/jquery.fancybox.min.js ') }}"></script>
		<!-- Lazy -->
    	<script src="{{ asset('frontStyle/vendor/jquery.lazy.min.js ') }}"></script>
    	<!-- js Counter -->
		<script src="{{ asset('frontStyle/vendor/jquery.counterup.min.js ') }}"></script>
		<script src="{{ asset('frontStyle/vendor/jquery.waypoints.min.js ') }}"></script>

		<!-- Theme js -->
		<script src="{{ asset('frontStyle/js/theme.js') }}"></script>
		</div> <!-- /.main-page-wrapper -->
	</body>
</html>