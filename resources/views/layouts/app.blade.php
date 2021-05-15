<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>

  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>{{ env('APP_NAME') }}</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="{{ url('/') }}/assets/img/favicon.png" rel="icon">
  <link href="{{ url('/') }}/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,600,600i,700,700i,900" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.15.2/css/all.css" crossorigin="anonymous"/>


  <!-- Vendor CSS Files -->
  <link href="{{ url('/') }}/assets/vendor/animate.css/animate.min.css" rel="stylesheet">
  <link href="{{ url('/') }}/assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="{{ url('/') }}/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="{{ url('/') }}/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="{{ url('/') }}/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="{{ url('/') }}/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="{{ url('/') }}/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="{{ url('/') }}/assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: Mamba - v4.1.0
  * Template URL: https://bootstrapmade.com/mamba-one-page-bootstrap-template-free/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
        
  <!-- jquery -->
  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  
  <!-- main css -->      
  <link rel="stylesheet" href="{{ url('/') }}/assets/css/main.css">
</head>
<body>
    <div id="app">
    	<div> 
    		@include('navbar') 
    	</div>
    	<div>
        	<main class="pageBody py-4">
            	@yield('content')
        	</main>
        </div>
        <div>
			@include('footer')
		</div>	
    </div>
   <!-- MAMBA dizajn Vendor JS Files -->
   <script src="{{ url('/') }}/assets/vendor/aos/aos.js"></script>
   <script src="{{ url('/') }}/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
   <script src="{{ url('/') }}/assets/vendor/glightbox/js/glightbox.min.js"></script>
   <script src="{{ url('/') }}/assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
   <script src="{{ url('/') }}/assets/vendor/php-email-form/validate.js"></script>
   <script src="{{ url('/') }}/assets/vendor/purecounter/purecounter.js"></script>
   <script src="{{ url('/') }}/assets/vendor/swiper/swiper-bundle.min.js"></script>

   <!-- Template Main JS File -->
   <script src="{{ url('/') }}/assets/js/main.js"></script>
    
</body>
</html>
