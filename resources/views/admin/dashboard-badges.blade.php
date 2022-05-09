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
  

<div class="container-full">
    <!-- Content Header (Page header) -->
    <!-- Main content -->
    <section class="content">
        <div class="row">

            <div class="col-8">
                <div class="box">
                    <div class="box-header with-border">
                        <h2 class="box-title">Pagyrimo ženkliukų sąrašas <span class="badge badge-pill badge-danger">
                                {{ count($badges) }} </span></h2>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Nuotrauka</th>
                                        <th>Pavadinimas</th>
                                        <th>Veiksmai</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($badges) > 0);
                                    @foreach ($badges as $b)
                                        <tr>
                                            <td> <img src="{{asset($b->img_path)}}" alt=""> </td>
                                            <td>{{ $b->title }}</td>
                                            <td>
                                                {{-- route('category.edit', $cat->id) --}}
                                                <a href="" class="btn btn-primary"
                                                    title="Redaguoti pagyrimo ženkliuką"><i class="fa fa-pencil"></i> </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    @else
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
            <!--   ------------ Add Category Page -------- -->
            <div class="col-4">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Pridėti Ženkliuką </h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <form method="post" action="{{route('admin.create.badge')}}" enctype="multipart/form-data">
                                @csrf

                                <div class="form-group">
                                    <h5>Ženkliuko pavadinimas <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="title" class="form-control">
                                        @error('title')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group">
                                    <h5>Nuotrauka<span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="file" name="upload_file" class="form-control">
                                        @error('image')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="text-xs-right">
                                    <input type="submit" class="btn btn-rounded btn-primary mb-5" value="Pridėti">
                                </div>
                            </form>

                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>
</div>

@endsection