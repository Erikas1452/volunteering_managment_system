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
  
    <div>
        @if(!$data['volunteers']->isEmpty())
        <table class="table table-striped">
        <thead>
            <tr>
                <th>@sortablelink('full_name','Vardas Pavardė')</th>
                <th>@sortablelink('email', 'El. paštas')</th>
                <th>@sortablelink('city', 'Miestas')</th>
                <th>Telefono Nr.</th>
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
                <td style="text-align: -webkit-center;">
                    <a  style="color: white" href="{{ route('volunteer.profile', $v->volunteer_id)}}" class="btn btn-info"
                        title="Savanorio profilis"><i class="fa fa-user"></i> </a>
                    {{-- <a  style="color: white" href="" class="btn btn-info"
                    title="Pakviesti į veiklą"><i class="fa fa-paper-plane"></i> </a>      --}}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $data['volunteers']->appends(\Request::except('page'))->links('vendor.pagination.bootstrap-4') }}
    @else
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Vardas-Pavardė</th>
                <th>El. paštas</th>
                <th>Miestas</th>
                <th>Telefono Nr.</th>
                <th style="text-align: -webkit-center;">Dokumentas</th>
                <th style="text-align: -webkit-center;">Veiksmai</th>
            </tr>
        </thead>
    </table>
    <h4>Šiuo metu  savanorių neturite</h4>
    @endif
    </div>

    
  </div>

@endsection