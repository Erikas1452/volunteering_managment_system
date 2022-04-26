@extends('volunteer.volunteer-main')
@section('content')
<main id="main">
    <!-- ======= Cta Section ======= -->
    <section id="cta" class="cta">
      <div class="container" data-aos="fade-in">
        
      </div>
    </section><!-- End Cta Section -->
  
    <div class="container-fluid global_container index_container">
            <div class="box">
                <div class="row">
                    <div class="col-md-12">
                        <h1>{{$data['activity'][0]->name}}<h1>
                        <h3>{{$data['activity'][0]->short_desc}}<h3>
                    </div>
                </div>

                <br>

                <div class="row">

                    <div class="col-md-4">
                        <img width="380px" height="auto" src="{{asset($data['activity'][0]->activity_photo)}}">
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
    </div>
    

  </main><!-- End #main -->

@endsection