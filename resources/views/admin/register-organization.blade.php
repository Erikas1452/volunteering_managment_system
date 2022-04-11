@extends('admin.admin-main')
@section('content')
<div id="content" class="p-4 p-md-5">

  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">

      <button type="button" id="sidebarCollapse" class="btn btn-primary">
        <i class="fa fa-bars"></i>
        <span class="sr-only">Toggle Menu</span>
      </button>
      <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <i class="fa fa-bars"></i>
      </button>

    </div>
  </nav>

  <h2 class="mb-4">Įmonės registracijos anketa</h2>
  <div class="padding container d-flex justify-content-center">
    <div class="col-md-10 col-md-offset-1">
        <form method="POST" class="signup-form" action="{{route('organization.registration')}}" enctype="multipart/form-data">
            @csrf
            <h2 class="text-center">Registracija</h2>
            <hr>
            <div class="form-group"> <input type="text" name="name" class="form-control" placeholder="Pavadinimas" required="required"> </div>
            @error('name')
                <span class="text-danger">{{ $message }}</span>
            @enderror
            <div class="form-group"> <input type="email" name="email" class="form-control" placeholder="El. Paštas" required="required"> </div>
            @error('email')
                <span class="text-danger">Toks el.paštas jau egzistuoja</span>
            @enderror
            
            <div class="form-group text-center"> <button type="submit" class="btn btn-blue btn-block">Registruoti</button> </div>
        </form>
    </div>
</div>
</div>
@endsection