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
      @if(isset($data['activities']))
        <div class="row">
            <div class="col-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h2 class="box-title">Savanorysčių veiklų sąrašas <span class="badge badge-pill badge-danger">
                          {{ count($data['activities']) }} </span></h2>
                          <a href="{{route('company.dashboard.activities.create')}}" style="margin-bottom: 1rem" class="btn btn-rounded btn-primary">Pridėti naują savanorystės veiklą</a>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Nuotrauka</th>
                                        <th>@sortablelink('name', 'Pavadinimas')</th>
                                        <th>@sortablelink('categories','Kategorija')</th>
                                        <th>@sortablelink('people_limit','Žmonių limitas')</th>
                                        <th>Veiksmai</th>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data['activities'] as $act)
                                        <tr>
                                            <td><img width="100" height="80" src="{{asset($act->activity_photo)}}"/></td>
                                            <td>{{$act->name}}</td>
                                            <td>{{$act->category['category_name_en']}}</td>
                                            @php
                                                if(!isset($act->people_limit)) $people = "Limito Nėra";
                                                else $people = $act->people_limit;
                                            @endphp
                                            <td>{{$people}}</td>
                                            <td>
                                                <a href="{{route('remove.activity',$act->id)}}" class="btn btn-danger"
                                                    title="Pašalinti veiklą"> <i class="fa fa-trash"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $data['activities']->appends(\Request::except('page'))->links('vendor.pagination.bootstrap-4') }}
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
        @else

        <div class="row">
          <div class="col-12">
              <div class="box">
                  <div class="box-header with-border">
                      <h2 class="box-title">Savanorysčių veiklų sąrašas <span class="badge badge-pill badge-danger"> 0 </span></h2> 
                      <a href="{{route('company.dashboard.activities.create')}}" style="margin-bottom: 1rem" class="btn btn-rounded btn-primary">Pridėti naują savanorystės veiklą</a>
                  </div>
                  <!-- /.box-header -->
                  <div class="box-body">
                      <div class="table-responsive">
                          <table id="example1" class="table table-bordered">
                              <thead>
                                  <tr>
                                    <th>Nuotrauka</th>
                                    <th>Pavadinimas</th>
                                    <th>Kategorija</th>
                                    <th>Žmonių limitas</th>
                                    <th>Veiksmai</th>
                                    </th>
                                  </tr>
                              </thead>
                              <tbody>
                                  
                              </tbody>
                          </table>
                      </div>
                  </div>
                  <!-- /.box-body -->
              </div>
              <!-- /.box -->
          </div>
          <!--   ------------ Add Category Page -------- -->
          
            <!-- /.box -->
        </div>
          @endif
    </section>
    <!-- /.content -->
</div>
</div>

@endsection