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

      <div class="col-lg-12 entries">
        <div class="container">
          @if(isset($data['activities']))
          <div class="box-body">
            <div class="table-responsive">
                <table id="example1" class="table">
                    <thead>
                        <tr>
                            <th>Nuotrauka</th>
                            <th>@sortablelink('name','Pavadinimas')</th>
                            <th>@sortablelink('hours','Valandos')</th>
                            <th>@sortablelink('create_at','Baigta')</th>
                            <th>Veiksmai</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        @foreach ($data['activities'] as $act)

                        <td><img style="width="100": height="80";"  src="{{asset($act->activity_photo)}}"></td>
                        <td>{{$act->name}}</td>
                        <td>{{$act->hours}}</td>
                        <td>{{$act->created_at}}</td>
                        <td>
                            None
                        </td>
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

@endsection