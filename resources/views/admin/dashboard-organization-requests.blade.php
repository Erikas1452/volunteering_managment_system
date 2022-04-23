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

  <h2 class="mb-4">Organizacijų užklausos registracijai į sistemą</h2>
  
  <table class="table table-striped">
    <thead>
        <tr>
            <th>Pavadinimas</th>
            <th>El. paštas</th>
            <th>Adresas</th>
            <th>Telefono Nr.</th>
            <th style="text-align: -webkit-center;">Dokumentas</th>
            <th style="text-align: -webkit-center;">Veiksmai</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data['requests'] as $re)
        <tr>
            <td>{{$re->name}}</td>
            <td>{{$re->email}}</td>
            <td>{{$re->address}}</td>
            <td>{{$re->phone}}</td>
            <td style="text-align: -webkit-center;"><a href="{{ route('organization.request.file', $re->file_upload_path) }}" class="btn btn-info"
                title="Atsisiūsti"><i class="fa fa-download"></i> </a></td>
            <td style="text-align: -webkit-center;">
                <a href="{{ route('organization.request.confirm', $re->email) }}" class="btn btn-success"
                    title="Patvirtinti"><i class="fa fa-check"></i> </a>
                <a href="{{ route('organization.request.deny', $re->email) }}" class="btn btn-danger"
                    title="Atmesti"><i class="fa fa-times"></i> </a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
{{ $data['requests']->links('vendor.pagination.bootstrap-4') }}

</div>
@endsection