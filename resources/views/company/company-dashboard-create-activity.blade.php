@extends('company.company-dashboard-main')
@section('content')

<div id="content" class="p-4 p-md-5">

  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">

      <button type="button" id="sidebarCollapse" class="btn btn-primary">
        <i class="fa fa-bars"></i>
        <span class="sr-only">Toggle Menu</span>
      </button>

    </div>
  </nav>
  

<div class="container-full">
    <!-- Content Header (Page header) -->
    <!-- Main content -->
    <section class="content">
        <!-- Basic Forms -->
        <div class="box">
            <div class="box-header with-border">
                <h4 class="box-title">Pridėti Savanorystės veiklą </h4>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="row">
                    <div class="col">

                        <form method="post" action="{{route('activity.submit')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-12">

                                    <div class="row">
                                        <!-- start 1st row  -->
                                        <div class="col-md-4">

                                            <div class="form-group">
                                                <h5>Savanorystės kategorija <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <select name="category_id" class="form-control" required="">
                                                        <option value="" selected="" disabled="">Pasirinkti kategoriją</option>
                                                        @foreach ($data['categories'] as $cat)
                                                            <option value="{{ $cat->id }}">
                                                                {{ $cat->category_name_en }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('category_id')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                        </div> <!-- end col md 4 -->

                                    </div> <!-- end 1st row  -->

                                    <div class="row">
                                        <!-- start 2nd row  -->

                                        <div class="col-md-4">

                                            <div class="form-group">
                                                <h5>Savanorystės apavadinimas<span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="activity_name" class="form-control"
                                                        required="">
                                                    @error('activity_name')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                        </div> <!-- end col md 4 -->

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>Nuotrauka <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="file" name="activity_photo" class="form-control"
                                                        onChange="mainThamUrl(this)" required="">
                                                    @error('activity_photo')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                    <img src="" id="mainThmb">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-4">

                                            <div class="form-group">
                                                <h5>Savanorių limitas <span class="text-danger"></span></h5>
                                                <div class="controls">
                                                    <input type="number" pattern="\d*" step="1" oninvalid="this.setCustomValidity('Įveskite sveikąjį skaičių')" name="people_limit" class="form-control">
                                                    @error('product_qty')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                        </div> <!-- end col md 4 -->

                                    </div> <!-- end 2nd row  -->

                                    <div class="row">
                                        <div class="col-md-3">
                                            <h5>Pradžios data <span class="text-danger">*</span></h5>
                                            <input class="form-group" type="datetime-local" required="" name="start_date">
                                        </div>
                                        <div class="col-md-3">
                                            <h5>Pabaigos data<span class="text-danger">*</span></h5>
                                            <input class="form-group" type="datetime-local" required="" name="end_date">
                                        </div>
                                        <div class="col-md-3">
                                            <h5>Miestas <span class="text-danger">*</span></h5>
                                            <select name="city" class="form-control" required="">
                                                <option value="" selected="" disabled="">Pasirinktite miestą</option>
                                                <option value="Vilnius" selected="" ="">Vilnius</option>
                                                <option value="Kaunas" selected="" ="">Kaunas</option>
                                                <option value="Klaipėda" selected="" ="">Klaipėda</option>
                                                <option value="Palanga" selected="" ="">Palanga</option>
                                                <option value="Panevėžys" selected="" ="">Panevėžys</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <h5>Valandų skaičius<span class="text-danger">*</span></h5>
                                            <input class="form-group" pattern="\d*" step="1" oninvalid="this.setCustomValidity('Įveskite sveikąjį skaičių')" type="number" name="hours">
                                        </div>
                                    </div>

                                    

                                    <div class="row">
                                        <!-- start 7th row  -->
                                        <div class="col-md-12">

                                            <div class="form-group">
                                                <h5>Trumpas Aprašymnas <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <textarea name="short_desc" id="textarea" class="form-control"
                                                        required placeholder="Trumpas savanorystės aprašymas, kuris yra matomas paieškoje"></textarea>
                                                </div>
                                            </div>

                                        </div> <!-- end col md 6 -->

                                    </div> <!-- end 7th row  -->

                                    <div class="row">
                                        <!-- start 8th row  -->
                                        <div class="col-md-12">

                                            <div class="form-group">
                                                <h5>Ilgas aprašymas <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <textarea id="editor1" class="form-control" placeholder="Ilgas aprašymas, kuris pateikiamas savanorystės individualiame puslapyje" name="long_desc" rows="10" cols="80"required=""></textarea>
                                                </div>
                                            </div>

                                        </div> <!-- end col md 6 -->

                                    </div> <!-- end 8th row  -->

                                    <hr>

                                    <div class="row">

                                        <div class="col-md-12">
                                            <div class="form-group">

                                                <div class="controls">
                                                    <div id="app">
                                                        <documents>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <button type="button" name="add" id="dynamic-ar" class="btn btn-outline-primary">Pridėti papildomų klausimų</button>
                                        <table class="table table-bordered" id="dynamicAddRemove">
                                            <tr>
                                                <th>Klausimas</th>
                                                <th>Pašalinti</th>
                                            </tr>
                                            <tr>
                                                
                                            </tr>
                                        </table>
                                    </div>

                                    <div class="text-xs-right">
                                        <input type="submit" class="btn btn-rounded btn-primary mb-5"
                                            value="Pridėti savanorystę">
                                    </div>
                        </form>

                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->

    </section>
    <!-- /.content -->
</div>
</div>

@endsection