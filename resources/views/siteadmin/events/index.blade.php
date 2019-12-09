
@extends('layouts.admin')

@section('contents')
    @include('partials.admin-sidebar')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>View Events</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">View Events</li>
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
              <h3 class="card-title">View Events Table</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Title</th>
                  <th>Start Date</th>
                  <th>End Date</th>
                   <th>Header Image</th>
                    <th>Small  Image</th>
                     <th>Description</th>
                      <th>Venue Name</th>
                       <th>Venue Address</th>
                          <th>Package Name</th>
                          <th>Markas Full</th>
                             <th>Action</th>

                       
                  
                
                </tr>
                </thead>
                <tbody>
              
               @foreach($partners as $partner)	
                <tr>
                  <td>{{$partner->title}}</td>
                  <td>{{$partner->startdate}}</td>
                  <td>{{$partner->enddate}}</td>
                  <td>{{$partner->header_image}}</td>
                  <td>{{$partner->small_image}}</td>
                  <td>{{$partner->description}}</td>
                  <td>{{$partner->venue_name}}</td>
                  <td>{{$partner->venue_adderss}}</td>
                  <td>{{$partner->custom_package_details}}</td>
                  <td>{{$partner->markasfull}}</td>
                    <td>
					<a href="{{route('admin.menu.edit', ['id'=>$partner->id])}}"><span class="badge bg-success">Edit</span></a>
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
