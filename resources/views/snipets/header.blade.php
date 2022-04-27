
 <!-- ======= Header ======= -->
  <header id="header" class="fixed-top d-flex align-items-center">
    <div class="container d-flex align-items-center justify-content-between">

      @php 
        $route = Route::current()->getName();
      @endphp

          @if (Auth::guard('web')->check())

          <div class="logo">
            <h1 class="text-light"><a href="{{route('home')}}">Volunteer+</a></h1>
            <!-- Uncomment below if you prefer to use an image logo -->
            <!-- <a href="index.html"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->
          </div>

          <nav id="navbar" class="navbar">
            <ul>
              <li class="{{($route == 'volunteering' || $route == 'search')? 'active' : '' }}"><a href="{{route('volunteering')}}">Savanorystės</a></li>
              <li class=""><a href="">Services</a></li>
              <li class=""><a href="">Pricing</a></li>
              <li class=""><a href="">Portfolio</a></li>
              <li class=""><a href="">Blog</a></li>
              <li class="dropdown"><a class="getstarted" href="{{route('volunteer.profile', ['id' => Auth::user()->id])}}">{{Auth::user()->full_name}}</a>
                <ul>
                  <li><a href="{{route('volunteer.profile', ['id' => Auth::user()->id])}}">Redaguoti</a></li>
                  <li><a href="{{route('volunteer.logout')}}">Atsijungti</a></li></form>
                </ul>
              </li>
            </ul>
            <i class="bi bi-list mobile-nav-toggle"></i>
          </nav><!-- .navbar -->
          @elseif (Auth::guard('admin')->check())

          <div class="logo">
            <h1 class="text-light"><a href="{{route('admin.dashboard')}}">Volunteer+</a></h1>
            <!-- Uncomment below if you prefer to use an image logo -->
            <!-- <a href="index.html"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->
          </div>

          <nav id="navbar" class="navbar">
            <ul>
              <li><a class="getstarted" href="{{route('admin.logout')}}">Atsijungti</a></li>
            </ul>
            <i class="bi bi-list mobile-nav-toggle"></i>
          </nav><!-- .navbar -->
          @elseif (Auth::guard('organization')->check())
          <div class="logo">
            <h1 class="text-light"><a href="{{route('company.dashboard')}}">Volunteer+</a></h1>
            <!-- Uncomment below if you prefer to use an image logo -->
            <!-- <a href="index.html"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->
          </div>

          <nav id="navbar" class="navbar">
            <ul>
              <li><a class="getstarted" href="{{route('organization.logout')}}">Atsijungti</a></li>
            </ul>
            <i class="bi bi-list mobile-nav-toggle"></i>
          </nav><!-- .navbar -->
          @else
          <div class="logo">
            <h1 class="text-light"><a href="{{route('home')}}">Volunteer+</a></h1>
            <!-- Uncomment below if you prefer to use an image logo -->
            <!-- <a href="index.html"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->
          </div>

          <nav id="navbar" class="navbar">
            <ul>
              <li><a class="active" href="index.html">Pagrindinis</a></li>
              <li><a href="">Paslaugos</a></li>
              <li><a href="">Kontaktai</a></li>
              <li><a href="{{route('company.main')}}">Organizacijoms</a></li>
              <li><a class="getstarted" href="{{route('register')}}">Registracija</a></li>
            </ul>
            <i class="bi bi-list mobile-nav-toggle"></i>
          </nav><!-- .navbar -->
          @endif
          

    </div>
  </header><!-- End Header -->