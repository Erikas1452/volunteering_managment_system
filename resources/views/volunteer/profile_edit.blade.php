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
                        <hr>
                        <form method="POST" action="{{route('volunteer.profile.photo.update')}}" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="old_image" value="{{ $user->profile_img }}">
                            <input type="file" name="image" class="form-control">
                            <br>
                            <button class="editbutton" style="margin-left:0px; float:none;">Atnaujinti nuotrauką</button>
                        </form>
                        
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-8">
                <div class="card mb-3">
                    <form method="POST" action="{{route('volunteer.profile.update')}}" enctype="multipart/form-data">
                        @csrf
                         <div class="card-body">
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Vardas Pavardė</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <div class="form-group"> <input type="text" name="full_name" class="form-control" value="{{$user->full_name}}" required="required"> </div>
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
                                    <div class="form-group"> <input type="text" name="phone" class="form-control" value="{{$user->phone}}"> </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Adresas</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <div class="form-group"> <input type="text" name="address" class="form-control" value="{{$user->address}}"> </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Aprašas</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <div class="form-group"> <input type="text" name="description" class="form-control" value="{{$user->description}}"> </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-12">
                                    <button class="editbutton">Išsaugoti pakeitimus</button>
                                </div>
                            </div>
                        </div>
                    </form>
                  
                </div>
              </div>
            </div>
  
          </div>
      </div>
    {{-- Profile finish --}}

    <!-- ======= Cta Section ======= -->
    <section id="cta" class="cta">
      <div class="container" data-aos="fade-in">

        <div class="text-center">
          <h3>Redaguokite savo savanorysčių istoriją</h3>
          <p> Čia galite redaguoti savo atliktų savanorysčių istoriją, kurią gali matyti įvairios organizacijos</p>
          <a class="cta-btn" href="#">Redaguoti</a>
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