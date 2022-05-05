@extends('company.company-dashboard-main')
@section('content')

<div id="app">
    <div id="content" class="p-4 p-md-5">

        <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
    
            <button type="button" id="sidebarCollapse" class="btn btn-primary">
            <i class="fa fa-bars"></i>
            <span class="sr-only">Toggle Menu</span>
            </button>
    
        </div>
        </nav>

        <div class="container py-5">

            <a class="btn btn-primary nav-link border-0 text-uppercase font-weight-bold" data-toggle="" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                užklausos į savanorystę
            </a>
            </p>
            <div class="" id="collapseExample">
            <div class="card card-body">
                <h2 class="mb-4">Savanorių užklausos</h2>

                @if(!$data['requests']->isEmpty())
                <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Vardas-Pavardė</th>
                        <th>El. paštas</th>
                        <th>Miestas</th>
                        <th>Telefono Nr.</th>
                        @if($data['activity'][0]->papers_required)
                        <th style="text-align: -webkit-center;">Dokumentas</th>
                        @endif
                        <th style="text-align: -webkit-center;">Veiksmai</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data['requests'] as $re)
                    <tr>
                        <td>{{$re->full_name}}</td>
                        <td>{{$re->email}}</td>
                        <td>{{$re->city}}</td>
                        <td>{{$re->phone}}</td>
                        @if($data['activity'][0]->papers_required)
                        <td style="text-align: -webkit-center;"><a href="{{ route('organization.request.file', $re->upload_file) }}" class="btn btn-info"
                            title="Atsisiūsti"><i class="fa fa-download"></i> </a></td>
                        @endif
                        <td style="text-align: -webkit-center;">
                            <a href="{{ route('volunteer.profile', $re->volunteer_id)}}" class="btn btn-info"
                                title="Savanorio profilis"><i class="fa fa-user"></i> </a>
                                <div style="display: inline-flex;">
                                    <div id="app">
                                        <answers id="{{$re->id}}">
                                    </div>
                                </div>
                            <a href="{{ route('volunteer.request.confirm', [$re->email, $data['activity'][0]->name, $re->id]) }}" class="btn btn-success"
                                title="Patvirtinti"><i class="fa fa-check"></i> </a>
                            <a href="{{ route('volunteer.request.deny', [$re->email, $data['activity'][0]->name, $re->id]) }}" class="btn btn-danger"
                                title="Atmesti"><i class="fa fa-times"></i> </a>

                            
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Vardas-Pavardė</th>
                        <th>El. paštas</th>
                        <th>Miestas</th>
                        <th>Telefono Nr.</th>
                        @if($data['activity'][0]->papers_required)
                        <th style="text-align: -webkit-center;">Dokumentas</th>
                        @endif
                        <th style="text-align: -webkit-center;">Veiksmai</th>
                    </tr>
                </thead>
            </table>
            <h4>Šiuo metu užsiregistravusių savanorių nėra</h4>
            @endif


            {{-- {{ $data['requests']->links('vendor.pagination.bootstrap-4') }} --}}
            </div>
            </div>
        
            <div class="p-5 bg-white rounded shadow mb-5">
            <!-- Rounded tabs -->
            <ul id="myTab" role="tablist" class="nav nav-tabs nav-pills flex-column flex-sm-row text-center bg-light border-0 rounded-nav">
                <li class="nav-item flex-sm-fill">
                <a id="activity-tab" data-toggle="tab" href="#activity" role="tab" aria-controls="home" aria-selected="true" class="nav-link border-0 text-uppercase font-weight-bold active">Savanorystės veiklos informacija</a>
                </li>
                <li class="nav-item flex-sm-fill">
                    <a id="tab4-tab" data-toggle="tab" href="#tab4" role="tab" aria-controls="tab4" aria-selected="false" class="nav-link border-0 text-uppercase font-weight-bold">Savanoriai</a>
                </li>
            </ul>
            <div id="myTabContent" class="tab-content">

                {{-- TAB1 --}}
                <div id="activity" role="tabpanel" aria-labelledby="activity-tab" class="tab-pane fade px-4 py-5 show active">
                    <section class="content">
                        <!-- Basic Forms -->
                        <div class="box">
                            <div class="box-header with-border">
                                <h4 class="box-title">Savanorystės veikla </h4>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <div class="row">
                                    <div class="col">
                
                                            <div class="row">
                                                <div class="col-12">
                
                                                    <div class="row">
                                                        <!-- start 1st row  -->
                                                        <div class="col-md-4">
                
                                                            <div class="form-group">
                                                                <h5>Savanorystės kategorija: <span class="text-danger"></span></h5>
                                                                <div class="controls">
                                                                    <h2> {{$data['activity'][0]->category->category_name_en}} <h2>
                                                                </div>
                                                            </div>
                
                                                        </div> <!-- end col md 4 -->
                
                                                    </div> <!-- end 1st row  -->
                
                                                    <div class="row">
                                                        <!-- start 2nd row  -->
                
                                                        <div class="col-md-4">
                
                                                            <div class="form-group">
                                                                <h5>Savanorystės apavadinimas<span class="text-danger"></span></h5>
                                                                <div class="controls">
                                                                    <h2>{{$data['activity'][0]->name}}</h2>

                                                                </div>
                                                            </div>
                
                                                        </div> <!-- end col md 4 -->
                
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <h5>Nuotrauka <span class="text-danger"></span></h5>
                                                                <div class="controls">
                                                                    <img width="140px" height="100px" src="{{asset($data['activity'][0]->activity_photo)}}" id="mainThmb">
                                                                </div>
                                                            </div>
                                                        </div>
                
                                                        <div class="col-md-4">
                
                                                            <div class="form-group">
                                                                <h5>Savanorių limitas: <span class="text-danger"></span></h5>
                                                                <div class="controls">
                                                                    <h2>{{$data['activity'][0]->people_limit}}</h2>
                                                                </div>
                                                            </div>
                
                                                        </div> <!-- end col md 4 -->
                
                                                    </div> <!-- end 2nd row  -->
                
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <h5>Pradžios data <span class="text-danger"></span></h5>
                                                            <h2>{{$data['activity'][0]->start_date}}</h2>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <h5>Pabaigos data<span class="text-danger"></span></h5>
                                                            <h2>{{$data['activity'][0]->end_date}}</h2>
                                                        </div>
                                                    </div>
                
                                                    <div class="row">
                                                        <!-- start 7th row  -->
                                                        <div class="col-md-12">
                
                                                            <div class="form-group">
                                                                <h5>Trumpas Aprašymnas <span class="text-danger"></span></h5>
                                                                <div class="controls">
                                                                <h3>{{$data['activity'][0]->short_desc}}</h3>
                                                                </div>
                                                            </div>
                
                                                        </div> <!-- end col md 6 -->
                
                                                    </div> <!-- end 7th row  -->
                
                                                    <div class="row">
                                                        <!-- start 8th row  -->
                                                        <div class="col-md-12">
                
                                                            <div class="form-group">
                                                                <h5>Ilgas aprašymas <span class="text-danger"></span></h5>
                                                                <div class="controls">
                                                                    <p>{{$data['activity'][0]->long_desc}}</p>
                                                                </div>
                                                            </div>
                
                                                        </div> <!-- end col md 6 -->
                
                                                    </div> <!-- end 8th row  -->
                
                                                    <hr>
                
                                                    <div class="row">
                
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                
                                                                <div class="controls">
                                                                    @if($data['activity'][0]->papers_required)
                                                                    <p>Reikalingas dokumentas: Taip</p>
                                                                    <td style="text-align: -webkit-center;"><a style="color: white" href="{{ route('organization.request.file', $data['activity'][0]->file_upload_path) }}" class="btn btn-info"
                                                                        title="Atsisiūsti"><i class="fa fa-download"></i> </a></td>
                                                                    @else
                                                                    Reikalingas dokumentas: Ne
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                
                                                    <div class="row">
                                                        <table class="table table-bordered" id="dynamicAddRemove">
                                                            <tr>
                                                                <th>Papildomi Klausimai</th>
                                                            </tr>
                                                            @if(!$data['questions']->isEmpty())
                                                            @foreach ($data['questions'] as $q)
                                                            <tr>
                                                                <td>
                                                                    {{$q->question}}
                                                                </td>
                                                            </tr>
                                                            @endforeach
                                                            @else
                                                            <tr>
                                                                <td>
                                                                    Anketoje nėra papildomų klausimų
                                                                </td>
                                                            </tr>
                                                            @endif
                                                        </table>
                                                    </div>
                
                                    </div>
                                    <!-- /.col -->
                                </div>
                                <!-- /.row -->
                            </div>
                            <!-- /.box-body -->
                        </div>
                        <!-- /.box -->
                
                    </section>
                </div>


                {{-- TAB2 --}}
                <div id="tab4" role="tabpanel" aria-labelledby="tab4-tab" class="tab-pane fade px-4 py-5">
                    @if(!$data['volunteers']->isEmpty())
                    <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Vardas-Pavardė</th>
                            <th>El. paštas</th>
                            <th>Miestas</th>
                            <th>Telefono Nr.</th>
                            @if($data['activity'][0]->papers_required)
                            <th style="text-align: -webkit-center;">Dokumentas</th>
                            @endif
                            <th style="text-align: -webkit-center;">Veiksmai</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data['volunteers'] as $v)
                        <tr>
                            <td>{{$v->full_name}}</td>
                            <td>{{$v->email}}</td>
                            <td>{{$v->city}}</td>
                            <td>{{$v->phone}}</td>
                            @if($data['activity'][0]->papers_required)
                            <td style="text-align: -webkit-center;"><a style="color: white" href="{{ route('organization.request.file', $v->upload_file) }}" class="btn btn-info"
                                title="Atsisiūsti"><i class="fa fa-download"></i> </a></td>
                            @endif
                            <td style="text-align: -webkit-center;">
                                <a  style="color: white" href="{{ route('volunteer.profile', $v->volunteer_id)}}" class="btn btn-info"
                                    title="Savanorio profilis"><i class="fa fa-user"></i> </a>
                                    <div style="display: inline-flex;">
                                        <div id="app">
                                         <answers id="{{$v->id}}">
                                        </div>
                                        <div style="padding-margin: 1rem" id="app">
                                            <comment id="{{$v->volunteer_id}}" organization="{{$data['activity'][0]->organization_id}}">
                                        </div>
                                        <div style="padding-margin: 1rem" id="app">
                                            <complaint id="{{$v->volunteer_id}}" organization="{{$data['activity'][0]->organization_id}}">
                                        </div>
                                        <div style="padding-margin: 1rem" id="app">
                                            <badge id="{{$v->volunteer_id}}" organization="{{$data['activity'][0]->organization_id}}">
                                        </div>
                                    </div>
                                <a style="color: white" href="{{ route('volunteer.remove', [$v->email, $data['activity'][0]->name, $v->id]) }}" class="btn btn-danger"
                                    title="Pašalinti iš savanorystės"><i class="fa fa-times"></i> </a>
                                    
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Vardas-Pavardė</th>
                            <th>El. paštas</th>
                            <th>Miestas</th>
                            <th>Telefono Nr.</th>
                            @if($data['activity'][0]->papers_required)
                            <th style="text-align: -webkit-center;">Dokumentas</th>
                            @endif
                            <th style="text-align: -webkit-center;">Veiksmai</th>
                        </tr>
                    </thead>
                </table>
                <h4>Šiuo metu  savanorių neturite</h4>
                @endif
                </div>

            </div>
            <!-- End of tabs -->
            <a class="btn btn-primary nav-link border-0 text-uppercase font-weight-bold" data-toggle="" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                El. pranešimo siuntimas
            </a>
            </p>
            <div class="" id="collapseExample">
            <div class="card card-body">
                <h2 class="mb-4">El. pranešimo siuntimas</h2>

                <form method="post" action="{{route('participants.send.mail', $data['activity'][0]->id)}}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <!-- start 8th row  -->
                        <div class="col-md-12">
                            <div class="form-group">
                                <h5>Šioje skiltyje įvesta žinutė pasieks visus priimtus savanorius automatiškai į Savanorių el. paštų adresus <span class="text-danger"></span></h5>
                                <div class="controls">
                                    <textarea id="editor1" class="form-control" placeholder="Žinutė" name="message" rows="10" cols="80"required=""></textarea>
                                </div>
                            </div>
                        </div> <!-- end col md 6 -->
                    </div> <!-- end 8th row  -->
                    <div class="row">
                        <!-- start 8th row  -->
                        <div style="text-align-last: center;" class="col-md-12">
                            <button type="submit" class="btn btn-primary">Siūsti pranešimą</button>
                        </div> <!-- end col md 6 -->
                    </div> <!-- end 8th row  -->
                </form>

            {{-- {{ $data['requests']->links('vendor.pagination.bootstrap-4') }} --}}
            </div>
            </div>
            </div>
            
        
        </div>       

    </div>
</div>
@endsection