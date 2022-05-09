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

  <h2 class="mb-4">Organizacijų sąrašas</h2>
  
  <table class="table table-striped">
    <thead>
        <tr>
            <th>Pavadinimas</th>
            <th>El. paštas</th>
            <th>Statusas</th>
            <th>pašalinti iš sistemos</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data['organizations'] as $organization)
        <tr>
            <td>{{$organization->name}}</td>
            <td>{{$organization->email}}</td>
            <td style="text-align: center;"><a class="badge badge-success">Aktyvus</a></td>
            <td style="text-align-last: center;"><a href="{{ route('organization.delete', $organization->id) }}"
              class="btn btn-danger" title="Pašalinti" id="delete">
              <i class="fa fa-trash"></i></a></td>
        </tr>
        @endforeach
    </tbody>
</table>
{{ $data['organizations']->links('vendor.pagination.bootstrap-4') }}

</div>
@endsection