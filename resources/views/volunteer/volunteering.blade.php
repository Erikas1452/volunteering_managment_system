@extends('volunteer.volunteer-main')
@section('content')
<main id="main">
  <!-- ======= Cta Section ======= -->
  <section id="cta" class="cta">
    <div class="container" data-aos="fade-in">

    </div>
  </section><!-- End Cta Section -->

</main><!-- End #main -->

<section id="" class="">
  <div class="container">

    <div class="row">

      <div class="col-lg-10 entries">
        <div class="container">
          @if(isset($data['activities']))
          <div class="box-body">
            <div class="table-responsive">
                <table id="example1" class="table">
                    <thead>
                        <tr>
                            <th>Nuotrauka</th>
                            <th>@sortablelink('name', 'Pavadinimas')</th>
                            <th>Aprašymas</th>
                            <th>Laisvų vietų</th>
                            <th>Veiksmai</th>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data['activities'] as $act)
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
                                <td>Laisvų vietų: {{$people}}</td>
                                <td>

                                  @php
                                     $form = DB::table('registration_forms')
                                    ->where('activity_id', $act->id)
                                    ->where('volunteer_id', Auth::guard('web')->user()->id)
                                    ->get();
                                  @endphp

                                  @if(!$form->isEmpty())
                                  <a href="{{route('volunteer.activity.view',$act->id)}}" style="color: white; background-color: #0582dc" class="btn"
                                  title="Peržiūrėti skelbimą"> <i class="fa fa-search"></i></a>
                                  @else
                                    <a href="{{route('volunteer.activity.register', $act->id)}}" style="color: white; background-color: #86b03c" class="btn"
                                        title="Registruotis į veiklą"> <i class="fa fa-address-book"></i></a>
                                    <a href="{{route('volunteer.activity.view',$act->id)}}" style="color: white; background-color: #0582dc" class="btn"
                                    title="Peržiūrėti skelbimą"> <i class="fa fa-search"></i></a>
                                  @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $data['activities']->appends(\Request::except('page'))->links('vendor.pagination.bootstrap-4') }}
            </div>
        </div>
          @else
            <h1>Atsiprašome</h1>
            <h2>Tačiau paieškos metu nieko neradome</h2>
          @endif
        </div>

      </div><!-- End blog entries list -->

      <div class="col-lg-2">

        <div class="sidebar">

          <h3 class="sidebar-title">Paieška</h3>
          <div class="sidebar-item search-form">
            <form action="{{route('search')}}" method="POST" role="search">
              @csrf
              @php
                  if(isset($data['search_word']))$value = $data['search_word'];
                  else $value = '';
              @endphp
              <input type="text" value="{{$value}}" name="search_word">
              <button type="submit"><i class="bi bi-search"></i></button>
            </form>
          </div><!-- End sidebar search formn-->

          <h3 class="sidebar-title">Kategorijos</h3>
          <div class="sidebar-item categories">
            <ul>
              @if(isset($data['categories']))
                @foreach($data['categories'] as $cat)
                <li><a href="{{route('filter',$cat->id)}}">{{$cat->category_name_en}} <span></span></a></li>
                @endforeach
              @endif
            </ul>
          </div><!-- End sidebar categories-->

        </div><!-- End sidebar -->

      </div><!-- End blog sidebar -->

    </div>

  </div>
</section><!-- End Blog Section -->

@endsection