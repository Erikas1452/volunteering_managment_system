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
                      <th>Name</th>
                      <th>Email</th>
                  </tr>
              </thead>
              <tbody>
                  @foreach($data['users'] as $user)
                  <tr>
                      <td>{{$user->full_name}}</td>
                      <td>{{$user->email}}</td>
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
              <input type="text" name="search_word">
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