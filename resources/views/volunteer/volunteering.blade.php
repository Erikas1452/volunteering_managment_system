@extends('volunteer.volunteer-main')
@section('content')
<main id="main">
  <!-- ======= Cta Section ======= -->
  <section id="cta" class="cta">
    <div class="container" data-aos="fade-in">

    </div>
  </section><!-- End Cta Section -->

</main><!-- End #main -->

<section id="blog" class="blog">
  <div class="container" data-aos="fade-up">

    <div class="row">

      <div class="col-lg-8 entries">

        <div class="container">
          @if(isset($data))
          <h2>Sample Search Results</h2>
          <table class="table table-striped">
              <thead>
                  <tr>
                      <th>Savanorystės pavadinimas</th>
                      <th>Aprašymas</th>
                  </tr>
              </thead>
              <tbody>
                  @foreach($data['activities'] as $a)
                  <tr>
                      <td>{{$a->name}}</td>
                      <td>{{$a->short_desc}}</td>
                  </tr>
                  @endforeach
              </tbody>
          </table>
        </div>
          @else
            <h2>Sample Search Results</h2>
            <h1>NIEKO NERASTA</h1>
          </div>
          @endif

      </div><!-- End blog entries list -->

      <div class="col-lg-4">

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
              <li><a href="#">Medicina <span>(25)</span></a></li>
              <li><a href="#">Kelionės <span>(12)</span></a></li>
              <li><a href="#">Prieglauda <span>(5)</span></a></li>
              <li><a href="#">Menas <span>(22)</span></a></li>
            </ul>
          </div><!-- End sidebar categories-->

        </div><!-- End sidebar -->

      </div><!-- End blog sidebar -->

    </div>

  </div>
</section><!-- End Blog Section -->

@endsection