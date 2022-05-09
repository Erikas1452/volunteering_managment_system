@extends('admin.admin-main')
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

  <h2 class="mb-4">Savanorių profilių sąrašas</h2>
  

  
  <div id="app">

    <table class="table table-striped">
      <thead>
          <tr>
              <th>Vardas</th>
              <th>El. paštas</th>
              <th>Statusas</th>
              <th>Nusiskundimai</th>
              <th>Informacija</th>
              <th>Paskyros stabdymas</th>
          </tr>
      </thead>
      <tbody>
        @php

        foreach ($data['users'] as $user) {
          if($user->suspended != null){
            if(\Carbon\Carbon::createFromFormat('Y-m-d', $user->suspended)->gte(\Carbon\Carbon::now())){
              $suspended = true;
            }
            else{
              $suspended = false;
            }
          }
          else{
            $suspended = false;
          }
          $user->suspended = $suspended;
        }

        $suspended = true;
        @endphp
          @foreach($data['users'] as $user)
          <tr>
              <td>{{$user->full_name}}</td>
              <td>{{$user->email}}</td>
              @if($user->suspended)
                  <td style="text-align: center;"><a class="badge badge-warning">Sustbadytas</a></td>
              @else
                  <td style="text-align: center;"><a class="badge badge-success">Aktyvus</a></td>
              @endif
              @php
              $complaints = DB::table('complaints')->where('user_id', $user->id)->get();
              $count = count($complaints);
              @endphp
              <td style="text-align-last: center;"><complaint-admin :complaints="{{$complaints}}" id="{{$user->id}}" count="{{$count}}"> </complaint-admin></td>
              <td style="text-align: -webkit-center;"><a href="{{ route('volunteer.profile', $user->id)}}" class="btn btn-info"
                title="Savanorio profilis"><i style="text-align: -webkit-center;" class="fa fa-user"></i> </a></td>
              <td>
                <example-component user="{{$user->id}}"></example-component>
            </td>
          </tr>
          @endforeach
      </tbody>
    </table>
  
{{ $data['users']->links('vendor.pagination.bootstrap-4') }}
  </div>
</div>

@endsection