<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta name="csrf-token" content="{{ csrf_token() }}">
      
        <title>Serenity Bootstrap Template - Index</title>
        <meta content="" name="description">
        <meta content="" name="keywords">
      
        <!-- Favicons -->
        <link href="assets/img/favicon.png" rel="icon">
        <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">
      
        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
      
        <!-- Vendor CSS Files -->
        <link href="{{asset('assets/vendor/aos/aos.css')}}" rel="stylesheet">
        <link href="{{asset('assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
        <link href="{{asset('assets/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
        <link href="{{asset('assets/vendor/boxicons/css/boxicons.min.css')}}" rel="stylesheet">
        <link href="{{asset('assets/vendor/glightbox/css/glightbox.min.css')}}" rel="stylesheet">
        <link href="{{asset('assets/vendor/swiper/swiper-bundle.min.css')}}" rel="stylesheet">
        <link href="{{asset('https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900')}}" rel="stylesheet">
        <link rel="stylesheet" href="{{asset('https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css')}}">
        <link rel="stylesheet" href="{{asset('assets/css/stylebar.css')}}">
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" >
        
        <!-- Template Main CSS File -->
        <link href="{{asset('assets/css/style.css')}}" rel="stylesheet">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      
        <link rel="stylesheet" type="text/css" 
           href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
        
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

        {{-- <link href="{{asset('css/app.css')}}" rel="stylesheet"> --}}
      
        <!-- =======================================================
        * Template Name: Serenity - v4.7.0
        * Template URL: https://bootstrapmade.com/serenity-bootstrap-corporate-template/
        * Author: BootstrapMade.com
        * License: https://bootstrapmade.com/license/
        ======================================================== -->
      </head>

<body>

  @include('snipets.header')

  <main id="main">

    @php 
        $route = Route::current()->getName();
    @endphp

    <div class="wrapper d-flex align-items-stretch">
			<nav id="sidebar" class="active">
				<h1><a class="logo">{{Str::ucfirst(Auth::guard('admin')->user()->name[0])}}</a></h1>
        <ul class="list-unstyled components mb-5">
          <li class="{{ ($route == 'admin.dashboard.volunteers')? 'active' : '' }}">
            <a href="{{route('admin.dashboard.volunteers')}}"><span class="fa fa-user"></span> Vartotojai</a>
          </li>
          <li class="{{ ($route == 'admin.dashboard.categories')? 'active' : '' }}">
            <a href="{{route('admin.dashboard.categories')}}"><span class="fa fa-list"></span> Kategorijos</a>
          </li>
          <li class="{{ ($route == 'admin.dashboard.organizations')? 'active' : '' }}">
            <a href="{{route('admin.dashboard.organizations')}}"><span class="fa fa-address-book"></span> Įmonių sąrašas</a>
          </li>
          <li class="{{ ($route == 'admin.organization.requests')? 'active' : '' }}">
            <a href="{{route('admin.organization.requests')}}"><span class="fa fa-address-book"></span> Įmonių užklausos</a>
          </li>
          <li class="{{ ($route == 'organizations')? 'active' : '' }}">
              <a href="{{route('organizations')}}"><span class="fa fa-pencil"></span> Įmonių registracija</a>
          </li>
        </ul>

        <div class="footer">
        	
        </div>
    	</nav>
        <!-- Page Content  -->
        @yield('content')
        
	</div>

  </main><!-- End #main -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="{{asset('assets/vendor/purecounter/purecounter.js')}}"></script>
  <script src="{{asset('assets/vendor/aos/aos.js')}}"></script>
  <script src="{{asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{asset('assets/vendor/glightbox/js/glightbox.min.js')}}"></script>
  <script src="{{asset('assets/vendor/isotope-layout/isotope.pkgd.min.js')}}"></script>
  <script src="{{asset('assets/vendor/swiper/swiper-bundle.min.js')}}"></script>
  <script src="{{asset('assets/vendor/waypoints/noframework.waypoints.js')}}"></script>
  <script src="{{asset('assets/vendor/php-email-form/validate.js')}}"></script>
  <script src="{{asset('assets/js/jquery.min.js')}}"></script>
  <script src="{{asset('assets/js/popper.js')}}"></script>
  <script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
  <script src="{{asset('assets/js/mainbar.js')}}"></script>

  <!-- Template Main JS File -->
  <script src="{{asset('assets/js/main.js')}}"></script>

  <script src="{{ asset('js/app.js') }}" defer></script>

    <script>
      @if(Session::has('message'))
      var type = "{{ Session::get('alert-type','info') }}"
      switch(type){
         case 'info':
         toastr.info(" {{ Session::get('message') }} ");
         break;
     
         case 'success':
         toastr.success(" {{ Session::get('message') }} ");
         break;
     
         case 'warning':
         toastr.warning(" {{ Session::get('message') }} ");
         break;
     
         case 'error':
         toastr.error(" {{ Session::get('message') }} ");
         break; 
      }
      @endif 
     </script>

</body>

</html>