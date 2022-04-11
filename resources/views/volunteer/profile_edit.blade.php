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
@endsection