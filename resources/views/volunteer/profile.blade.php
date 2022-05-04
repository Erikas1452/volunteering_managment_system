@extends('volunteer.volunteer-main')
@section('content')

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
                  @if (Auth::guard('web')->check() && Auth::user()->id === $user->id)
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

        <div class="container my-5 py-5">
          <div class="row d-flex justify-content-center">
            <div class="col-md-12 col-lg-12">
              <div class="card text-dark">
                <div class="card-body p-4">
                  <h4 style="text-align: center" class="mb-0">Atsiliepimai</h4>
                  <div class="d-flex flex-start">
                    <div>
                      <h6 class="fw-bold mb-1">įmonė</h6>
                      <div class="d-flex align-items-center mb-3">
                        <p style="color: black" class="mb-0">
                          Komentaras apie savanorį:
                        </p>
                      </div>
                      <p style="color: black" class="mb-0">
                        Lorem Ipsum is simply dummy text of the printing and typesetting
                        industry. Lorem Ipsum has been the industry's standard dummy text ever
                        since the 1500s, when an unknown printer took a galley of type and
                        scrambled it.
                      </p>
                    </div>
                  </div>

                  <hr>

                  <div class="d-flex flex-start">
                    <div>
                      <h6 class="fw-bold mb-1">įmonė</h6>
                      <div class="d-flex align-items-center mb-3">
                        <p style="color: black" class="mb-0">
                          Komentaras apie savanorį:
                        </p>
                      </div>
                      <p style="color: black" class="mb-0">
                        Lorem Ipsum is simply dummy text of the printing and typesetting
                        industry. Lorem Ipsum has been the industry's standard dummy text ever
                        since the 1500s, when an unknown printer took a galley of type and
                        scrambled it.
                      </p>
                    </div>
                  </div>

                  <hr>
                  
                </div>

                <hr>

                </div>
                
                </div>
                </div>
      

              </div>
            </div>
          </div>
        </div>

    </div>
  </section><!-- End Cta Section -->

</main><!-- End #main -->
@endsection