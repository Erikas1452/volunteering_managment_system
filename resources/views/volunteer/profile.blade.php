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
                    <img src="{{asset($data['user']->profile_img)}}" alt="Admin" class="rounded-circle" width="150">
                    <div class="mt-3">
                      <h4>{{$data['user']->full_name}}</h4>
                      <p class="text-secondary mb-1">
                        {{$data['user']->description}}
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
                      {{$data['user']->full_name}}
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">El. paštas</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      {{$data['user']->email}}
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Telefono nr.</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      {{$data['user']->phone}}
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Adresas</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      {{$data['user']->address}}
                    </div>
                  </div>
                  <hr>
                  @if (Auth::guard('web')->check() && Auth::user()->id === $data['user']->id)
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

      <!-- ======= About Section ======= -->
      <section id="about" class="about">
        <div class="container">
  
          <div class="row justify-content-end">
            <div class="col-lg-11">
              <div class="row justify-content-end">
  
                <div class="col-lg-3 col-md-5 col-6 d-md-flex align-items-md-stretch">
                  <div class="count-box py-5">
                    <i class="bi bi-star"></i>
                    <span>{{number_format((float)$data['rating'], 2, '.', '');}}</span>
                    <p>Reitingas</p>
                  </div>
                </div>
  
                <div class="col-lg-3 col-md-5 col-6 d-md-flex align-items-md-stretch">
                  <div class="count-box py-5">
                    <i class="bi bi-journal-richtext"></i>
                    <span data-purecounter-start="0" data-purecounter-end="{{$data['activitiesCount']}}" class="purecounter">0</span>
                    <p>Savanorystės</p>
                  </div>
                </div>
  
                <div class="col-lg-3 col-md-5 col-6 d-md-flex align-items-md-stretch">
                  <div class="count-box pb-5 pt-0 pt-lg-5">
                    <i class="bi bi-clock"></i>
                    <span data-purecounter-start="0" data-purecounter-end="{{$data['hours']}}" class="purecounter">0</span>
                    <p>Savanoriautos valandos</p>
                  </div>
                </div>
  
                <div class="col-lg-3 col-md-5 col-6 d-md-flex align-items-md-stretch">
                  <div class="count-box pb-5 pt-0 pt-lg-5">
                    <i class="bi bi-award"></i>
                    <span data-purecounter-start="0" data-purecounter-end="{{count($data['badges'])}}" class="purecounter">0</span>
                    <p>Pagyrimai</p>
                  </div>
                </div>
  
              </div>
            </div>
          </div>
        </div>
      </section><!-- End About Section -->



     <!-- ======= Services Section ======= -->
     <section id="services" class="services ">
      <div style="margin-bottom: 1rem" class="container">
        <h1>Pagyrimo ženkliukai</h1>
        <div style="width: 95%; display: -webkit-inline-box;" class="overflow-auto">
        @if(!$data['badges']->isEmpty())
        @foreach ($data['badges'] as $badge)
        <div class="col-md-6">
          <img style="width: auto;"  src="{{asset($badge->img_path)}}">

              <div class="col-md-6">
                <div data-aos="fade-up">
                  <h4 class="title"><a href="">{{$badge->organization->name}}</a></h4>
                  <p class="description">{{$badge->comment}}</p>
                </div>
              </div>

        </div>
        @endforeach
        @else
        <div class="col-md-12">
          <div data-aos="fade-up">
            <h4 class="title"><a href="">Šiuo metu šis savanoris neturi pagyrimų</a></h4>
          </div>
        </div>
        @endif

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
                @if(!$data['comments']->isEmpty())
                @foreach ($data['comments'] as $com)
                <div class="d-flex flex-start">
                  <div>
                    <h6 class="fw-bold mb-1">{{$com->organization->name}}</h6>
                    <div class="d-flex align-items-center mb-3">
                      <p style="fonst-size:small; color: black" class="mb-0">
                        Organizatoriaus įvertinimas:
                        @for($i = 1; $i < 6; $i++)
                        <span class="fa fa-star" style="{{($com->rating >= $i)? 'color: orange;':''}}"></span>
                        @endfor
                      </p>
                    </div>
                    <div>
                      <p style="fonst-size:small; color: black" class="mb-0">
                        Komentaras apie savanorį:
                      </p>
                    </div>
                    <p style="color: black" class="mb-0">
                      {{$com->comment}}
                    </p>
                  </div>
                </div>
                <hr>
                @endforeach
                @else
                <hr>
                <div style="justify-content: center;" class="d-flex flex-start">
                  <div>
                    <p style="text-align:center;color: black" class="mb-0">
                      Atsiliepimų nėra
                    </p>
                  </div>
                </div>
                <hr>
                @endif
                
              </div>

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