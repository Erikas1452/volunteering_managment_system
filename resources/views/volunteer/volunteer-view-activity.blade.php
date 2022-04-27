@extends('volunteer.volunteer-main')
@section('content')
<main id="main">
    <!-- ======= Cta Section ======= -->
    <section id="cta" class="cta">
      <div class="container" data-aos="fade-in">
        
      </div>
    </section><!-- End Cta Section -->
  
    <section id="about" class="about">
        <div class="container">
  
          <div class="">
            <div class="col-lg-11">
              <div class="row justify-content-end">
  
                <div class="col-lg-12 col-md-12 col-12 d-md-flex align-items-md-stretch">
                  <div class="count-box py-5">
                    <h1 style="font-weight: 700;
                    color: #3c4133;">
                    Savanorystė: {{$data['activity'][0]->name}}</h1>
                  </div>
                </div>

  
              </div>
            </div>
          </div>
  
          <div class="row">
  
            <div class="col-lg-6 video-box align-self-baseline position-relative">
              <img src="{{asset($data['activity'][0]->activity_photo)}}" class="img-fluid" alt="">
            </div>
  
            <div class="col-lg-6 pt-3 pt-lg-0 content">
              <h3>Sukurta organizacijos:</h3>
              <p class="fst-italic">{{$data['organization'][0]->name}}</p>
              <p class="fst-italic">{{$data['organization'][0]->email}}</p>
              <p class="fst-italic">Savanorių limitas: {{$data['activity'][0]->people_limit}}</p>
              <p class="fst-italic">laisvų vietų: {{$data['activity'][0]->people_limit - $data['activity'][0]->people_registered}}</p>
              <h3>Savanorystės Aprašymas:</h3>
              <p class="fst-italic">{{$data['activity'][0]->long_desc}}</p>

              <div class="row">
                <div class="col-md-6">
                    <h3>Pradžia</h3>
                    <h4>{{$data['activity'][0]->start_date}}<h4>
                </div>
                <div class="col-md-6">
                    <h3>Pabaiga</h3>
                    <h4>{{$data['activity'][0]->end_date}}<h4>
                </div>

            </div>

            </div>
  
          </div>
  
        </div>
      </section><!-- End About Section -->
  
      

      <!-- ======= Work Process Section ======= -->
      <section id="work-process" class="work-process">
        <div class="container">
  
          <div class="section-title" data-aos="fade-up">
            <a href="{{route('volunteer.activity.register', $data['activity'][0]->id)}}"><h2 style="color: #94c045">Registruotis</h2></a>
          </div>
  
        </div>
      </section><!-- End Work Process Section -->
  

    {{-- <div class="container-fluid global_container index_container">
            <div class="box">
                <div class="row">
                    <div class="col-md-12">
                        <h1>{{$data['activity'][0]->name}}<h1>
                        <h3>{{$data['activity'][0]->short_desc}}<h3>
                    </div>
                </div>

                <br>

                <div class="row">

                    <div class="col-md-2">
                        <img width="200px" height="auto" src="{{asset($data['activity'][0]->activity_photo)}}">
                    </div>

                    <div class="col-md-8">
                        <h3>Sukurta organizacijos:</h3>
                        <h5>{{$data['organization'][0]->name}}</h5>
                        <h5>{{$data['organization'][0]->email}}</h5>
                        <h5>Savanorių limitas: {{$data['activity'][0]->people_limit}}</h5>
                        <h5>laisvų vietų: {{$data['activity'][0]->people_limit - $data['activity'][0]->people_registered}}</h5>
                    </div>

                </div>

                <div class="row">
                    <div class="col-md-12">
                        <h2>Savanorystės Aprašymas:</h2>
                        <p>{{$data['activity'][0]->long_desc}}</p>
                    </div>
                </div>

                <br>

                <div class="row">
                    <div class="col-md-6">
                        <h3>Pradžia</h3>
                        <h4>{{$data['activity'][0]->start_date}}<h4>
                    </div>
                    <div class="col-md-6">
                        <h3>Pabaiga</h3>
                        <h4>{{$data['activity'][0]->end_date}}<h4>
                    </div>

                </div>
                <br>
                <a class="btn btn-primary" href="{{}}">Registruotis</a>
                <br>
            </div>
    </div> --}}
    

  </main><!-- End #main -->

@endsection