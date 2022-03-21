<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
      
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
        
        <!-- Template Main CSS File -->
        <link href="{{asset('assets/css/style.css')}}" rel="stylesheet">
        <link href="{{asset('assets/css/profile.css')}}" rel="stylesheet">
      
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

    {{-- Profile --}}

    <div class="container">
      <div class="main-body">
      
            <!-- Breadcrumb -->
            <nav aria-label="breadcrumb" class="main-breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item"><a href="javascript:void(0)">User</a></li>
                <li class="breadcrumb-item active" aria-current="page">User Profile</li>
              </ol>
            </nav>
            <!-- /Breadcrumb -->
    
            <div class="row gutters-sm">
              <div class="col-md-4 mb-3">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex flex-column align-items-center text-center">
                      <img src="{{asset($user->profile_img)}}" alt="Admin" class="rounded-circle" width="150">
                      <div class="mt-3">
                        <h4>{{$user->full_name}}</h4>
                        <p class="text-secondary mb-1">
                          {{$user->description}}
                        </p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-8">
                <div class="card mb-3">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-sm-3">
                        <h6 class="mb-0">Vardas Pavardė</h6>
                      </div>
                      <div class="col-sm-9 text-secondary">
                        {{$user->full_name}}
                      </div>
                    </div>
                    <hr>
                    <div class="row">
                      <div class="col-sm-3">
                        <h6 class="mb-0">El. paštas</h6>
                      </div>
                      <div class="col-sm-9 text-secondary">
                        {{$user->email}}
                      </div>
                    </div>
                    <hr>
                    <div class="row">
                      <div class="col-sm-3">
                        <h6 class="mb-0">Telefono nr.</h6>
                      </div>
                      <div class="col-sm-9 text-secondary">
                        {{$user->phone}}
                      </div>
                    </div>
                    <hr>
                    <div class="row">
                      <div class="col-sm-3">
                        <h6 class="mb-0">Adresas</h6>
                      </div>
                      <div class="col-sm-9 text-secondary">
                        {{$user->address}}
                      </div>
                    </div>
                    <hr>
                    @if (Auth::user()->id === $user->id)
                    <div class="row">
                      <div class="col-sm-12">
                        <a class="editbutton"href="{{route('profile.edit')}}">Redaguoti</a>
                      </div>
                    </div>
                    @endif
                  </div>
                </div>
              </div>
            </div>
  
          </div>
      </div>

    {{-- Profile finish --}}

   @include('snipets.stats')

       <!-- ======= Services Section ======= -->
       <section id="services" class="services ">
        <div class="container">
  
          <div class="row">
            <div class="col-md-6">
              <div class="icon-box" data-aos="fade-up">
                <div class="icon"><i class="bi bi-briefcase" style="color: #ff689b;"></i></div>
                <h4 class="title"><a href="">Lorem Ipsum</a></h4>
                <p class="description">Voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident</p>
              </div>
            </div>
            <div class="col-md-6">
              <div class="icon-box" data-aos="fade-up">
                <div class="icon"><i class="bi bi-book" style="color: #e9bf06;"></i></div>
                <h4 class="title"><a href="">Dolor Sitema</a></h4>
                <p class="description">Minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat tarad limino ata</p>
              </div>
            </div>
          </div>
  
        </div>
      </section><!-- End Services Section -->
  

    <!-- ======= Cta Section ======= -->
    <section id="cta" class="cta">
      <div class="container" data-aos="fade-in">

        <div class="text-center">
          <h3>Call To Action</h3>
          <p> Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
          <a class="cta-btn" href="#">Call To Action</a>
        </div>

      </div>
    </section><!-- End Cta Section -->

  </main><!-- End #main -->

  @include('snipets.footer')

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

  <!-- Template Main JS File -->
  <script src="{{asset('assets/js/main.js')}}"></script>

</body>

</html>