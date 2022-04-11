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
              <th>Nusiskundimų skaičius</th>
              <th>Informacija</th>
              <th>Paskyros stabdymas</th>
          </tr>
      </thead>
      <tbody>
          @foreach($data['users'] as $user)
          <tr>
              <td>{{$user->full_name}}</td>
              <td>{{$user->email}}</td>
              <td style="text-align: center;"><a class="badge badge-success">Aktyvus</a></td>
              <td>Reports</td>
              <td>Status</td>
              <td> 
                <button id="show-modal" @click="showModal = true">Stabdyti paskyrą</button>

                <example-component v-if="showModal" @close="showModal = false">

                </example-component>
            </td>
          </tr>
          @endforeach
      </tbody>
    </table>
  
{{ $data['users']->links('vendor.pagination.bootstrap-4') }}
  </div>
</div>

@endsection