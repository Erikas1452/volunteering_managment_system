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
  
            <form method="post" action="{{route('activity.register.volunteer')}}" enctype="multipart/form-data">
              @csrf
              <div class="row">
                <div class="col-12">

                    <div class="row">
                        <!-- start 1st row  -->
                        <div class="col-md-4">

                            <input type="number" name="activity_id" hidden value="{{$data['activity'][0]->id}}">
                            <input type="number" name="volunteer_id" hidden value="{{Auth::guard('web')->user()->id}}">

                        </div> <!-- end col md 4 -->

                    </div> <!-- end 1st row  -->

                    <div class="row">
                        <!-- start 2nd row  -->

                        <div class="col-md-4">

                            <div class="form-group">
                                <h5>Savanorio Vardas Pavardė<span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="text" value="{{Auth::guard('web')->user()->full_name}}" name="full_name" class="form-control"
                                        required="">
                                    @error('full_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                        </div> <!-- end col md 4 -->

                        <div class="col-md-4">

                            <div class="form-group">
                                <h5>El. paštas<span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="text" value="{{Auth::guard('web')->user()->email}}" name="email" class="form-control"
                                        required="">
                                    @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                        </div> <!-- end col md 4 -->

                        <div class="col-md-4">

                            <div class="form-group">
                                <h5>Telefono nr.<span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="text" value="{{Auth::guard('web')->user()->phone}}" name="phone" class="form-control"
                                        required="">
                                    @error('phone')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                        </div> <!-- end col md 4 -->

                    <div class="row"> 
                        <div class="col-md-4">
                            <div class="form-group">
                                <h5>Miestas<span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="text" value="" name="city" class="form-control"
                                        required="">
                                    @error('city')
                                        <span class="city">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>


                    </div> <!-- end 2nd row  -->

                    <div class="row">
                        <!-- start 7th row  -->
                        <div class="col-md-12">

                            <div class="form-group">
                                <h5>Komentarai<span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <textarea name="comments" id="textarea" class="form-control"
                                        placeholder="Komentarai/Pageidavimai"></textarea>
                                </div>
                            </div>

                        </div> <!-- end col md 6 -->

                    </div> <!-- end 7th row  -->

                    <hr>

                    <div class="row">

                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="row controls">
                                    @if ($data['activity'][0]->papers_required === 1)
                                    <div class="col-md-5">
                                        <h6 class="mb-0">Pasirašykite šį dokumentą ir įkelkite jį (priimami formatai - .pdf)*</h6>
                                        <a href="https://acrobat.adobe.com/link/acrobat/fillsign">Rekomenduojamas įrankis</a>
                                    </div>
                                    <div class="col-md-1">
                                    <td style="text-align: -webkit-center;"><a style="color: white" href="{{ route('organization.request.file', $data['activity'][0]->file_upload_path) }}" class="btn btn-info"
                                            title="Atsisiūsti"><i class="fa fa-download"></i> </a></td>
                                    </div>
                                    @else
                                        
                                    @endif
                                </div>
                                <div style="padding-top: 1rem; padding-bottom: 1rem" class="col-md-6 text-secondary">
                                    <div class="form-group"><span><input type="file" name="upload_file" required class="form-control">*</span> </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <h3>Klausimai:</h3>
                        <div class="col-md-12">
                            @php
                            $i = 0;
                            @endphp
                        @foreach ($data['questions'] as $q)
                        <fieldset>
                        <input type="checkbox" id="checkbox_1" name="answer[{{$i}}][answer]" value="{{$q->id}}">
                        <label for="checkbox_1">{{$q->question}}</label>
                        @php
                               $i++ 
                        @endphp
                        </fieldset>
                        @endforeach
                    </div>
                    </div>

                    <div style="padding-top:1rem" class="text-xs-right">
                        <input type="submit" class="btn btn-rounded btn-primary mb-5"
                            value="Registruotis">
                    </div>
        </form>

        </div>
      </section><!-- End About Section -->
  
      

      <!-- ======= Work Process Section ======= -->
      <section id="work-process" class="work-process">
        <div class="container">
  
          <div class="section-title" data-aos="fade-up">
            <a href="{{}}"><h2 style="color: #94c045">Registruotis</h2></a>
          </div>
  
        </div>
      </section><!-- End Work Process Section -->
    

  </main><!-- End #main -->

@endsection