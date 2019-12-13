
@extends('layouts.admin')

@section('contents')
    @include('partials.admin-sidebar')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>View Event Packages</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">View Event Packages</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">

            <!-- /.card-header -->

            <!-- /.card-body -->
          </div>
          <!-- /.card -->

          <div class="card">
            <div class="card-header">
              <h3 class="card-title">View Event Packages Table</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Organizer</th>
                  <th>Event Name</th>
                  <th>Package Name</th>
                  <th>Price</th>
                  <th>Isactive</th>
                 <th>Action</th>
                </tr>
                </thead>
                <tbody>

               @foreach($event_packages as $packages)
                <tr>
                  <td>{{$packages->partner->name??''}}</td>
                  <td>{{$packages->event->title??''}}</td>
                  <td>{{$packages->package_name}}</td>
                  <td>{{$packages->price}}</td>

                  <td>{{$packages->statustext()}}</td>
                    <td>
					<a href="{{route('admin.package.edit', ['id'=>$packages->id])}}"><span class="badge bg-success">Edit</span></a>
                    </td>

                </tr>
                @endforeach

                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>

  <script>
  $(function () {
    $("#example1").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
    });
  });
</script>

@endsection
@section('scripts')
    <script>
        //Initialize Select2 Elements
        $('.select2').select2()

        //Initialize Select2 Elements
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })
    </script>
@endsection
