
 <!-- ======= Header ======= -->
  <header id="header" class="fixed-top d-flex align-items-center">
    <div class="container d-flex align-items-center justify-content-between">

      <div class="logo">
        <h1 class="text-light"><a href="{{route('home')}}">Volunteer+</a></h1>
        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <a href="index.html"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->
      </div>

      
      @php 
        $route = Route::current()->getName();
      @endphp

          @if (Auth::guard('web')->check())
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
          <nav id="navbar" class="navbar">
            <ul>
              <li><a class="getstarted" href="{{route('admin.logout')}}">Atsijungti</a></li>
            </ul>
            <i class="bi bi-list mobile-nav-toggle"></i>
          </nav><!-- .navbar -->
          @else
          <nav id="navbar" class="navbar">
            <ul>
              <li><a class="active" href="index.html">Home</a></li>
              <li><a href="services.html">Services</a></li>
              <li><a href="pricing.html">Pricing</a></li>
              <li><a href="portfolio.html">Portfolio</a></li>
              <li><a href="blog.html">Blog</a></li>
              <li><a href="contact.html">Contact</a></li>
              <li><a class="getstarted" href="{{route('register')}}">Registracija</a></li>
            </ul>
            <i class="bi bi-list mobile-nav-toggle"></i>
          </nav><!-- .navbar -->
          @endif
          

    </div>
  </header><!-- End Header -->