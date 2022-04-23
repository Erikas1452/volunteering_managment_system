@extends('company.company-main')
@section('content')

<main id="main">

    {{-- Profile --}}
  
    <div class="container">
      <div class="main-body">
      

            <!-- /Breadcrumb -->
    
            <div class="row gutters-sm">
              <div class="col-md-4 mb-3">

              </div>
              <div class="col-md-12">
                <div class="card mb-3">
                    <form method="POST" action="{{route('company.request.create')}}" enctype="multipart/form-data">
                        @csrf
                         <div class="card-body">
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Organizacijos pavadinimas</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <div class="form-group"> <input type="text" placeholder="Pavadinimas" name="name" class="form-control" value="" required="required"> </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">El. paštas</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <div class="form-group"> <input type="email" name="email" class="form-control" placeholder="El. Paštas" required="required"> </div>
                                    @error('email')
                                        <span class="text-danger">Toks el.paštas jau egzistuoja</span>
                                    @enderror
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Telefono nr.</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <div class="form-group"> <input type="text" placeholder="Numeris" name="phone" class="form-control" value=""> </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Adresas</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <div class="form-group"> <input type="text" placeholder="Adresas" name="address" class="form-control" value=""> </div>
                                </div>
                            </div>
                            <hr>
                            <div class="col-sm-3">
                                <h6 class="mb-0">Organizacijos validumą patvirtinantis dokumentas priimami formatai (.pdf)*</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <div class="form-group"> <input type="file" name="upload_file" class="form-control"> </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-12">
                                    <button class="editbutton">Teikti užklausą</button>
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

@endsection