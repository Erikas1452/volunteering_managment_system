@extends('volunteer.volunteer-main')
@section('content')
<main id="main">
  <!-- ======= Cta Section ======= -->
  <section id="cta" class="cta">
    <div class="container" data-aos="fade-in">

    </div>
  </section><!-- End Cta Section -->

</main><!-- End #main -->

<div id="app">
  <section id="" class="">
  <div class="container">

    <div class="row">

      <div class="col-lg-12 entries">
        <div class="container">
          @if(isset($data['activities']))
          <div class="box-body">
            <div class="table-responsive">
                <table id="example1" class="table">
                    <thead>
                        <tr>
                            <th>Nuotrauka</th>
                            <th>Pavadinimas</th>
                            <th>Aprašymas</th>
                            <th>Statusas</th>
                            <th>Veiksmai</th>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data['activities'] as $act)

                            @php
                            $form = DB::table('registration_forms')
                            ->where('activity_id', $act->id)
                            ->where('volunteer_id', Auth::guard('web')->user()->id)
                            ->first();
                            @endphp

                            <tr>
                                <td><img width="100" height="80" src="{{asset($act->activity_photo)}}"/></td>

                                <td>{{$act->name}}</td>
                                <td style="">{{$act->short_desc}}</td>
                                @php
                                    if(!isset($act->people_limit)) $people = "Neribota";
                                    else {
                                      $people = $act->people_limit - $act->people_registered;
                                    }
                                @endphp

                                @if($form->accepted == 1)
                                <td> <span class="badge bg-success">Patvirtinta</span></td>
                                <td>
                                  <div style="display: -webkit-inline-box;">
                                    <email-popup user="{{Auth::guard('web')->user()->id}}" activity="{{$act->id}}" organization="{{$act->organization_id}}"> </email-popup>
                                    <a href="{{route('volunteer.activity.view',$act->id)}}" style="color: white; background-color: #0582dc" class="btn"
                                    title="Peržiūrėti skelbimą"> <i class="fa fa-search"></i></a>
                                  </div>
                                </td>
                                @else
                                <td> <span class="badge bg-secondary text-dark">Laukiama atsakymo</span></td>
                                <td>
                                    <a href="{{route('volunteer.activity.view',$act->id)}}" style="color: white; background-color: #0582dc" class="btn"
                                    title="Peržiūrėti skelbimą"> <i class="fa fa-search"></i></a>
                                    <a href="{{route('volunteer.form.delete', $form->id)}}" style="color: white; background-color: #dc0505" class="btn"
                                    title="Atšaukti"> <i class="fa fa-times"></i></a>
                                </td>
                                @endif
                            </tr>

                        @endforeach
                    </tbody>
                </table>
                {{ $data['activities']->links('vendor.pagination.bootstrap-4') }}
            </div>
        </div>
          @else
          <table id="example1" class="table">
            <thead>
                <tr>
                    <th>Nuotrauka</th>
                    <th>Pavadinimas</th>
                    <th>Aprašymas</th>
                    <th>Statusas</th>
                    <th>Veiksmai</th>
                    </th>
                </tr>
            </thead>
          </table>
            <h2 style="padding-bottom: 20%">Šiuo metu nesate užsiregistravę į jokią savanorystę</h2>
          @endif
        </div>

      </div><!-- End blog entries list -->

    </div>

  </div>
</section><!-- End Blog Section -->
</div>


@endsection