@extends('layouts.admin')

@section('contents')
    @include('partials.admin-sidebar')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Add Events</h1>
                    </div>

                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- SELECT2 EXAMPLE -->
                <div class="card card-default">
                    <div class="card-header">
                        <h3 class="card-title">Fill Below Details</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-remove"></i></button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                               <form action="{{route('admin.event.store')}}" method="post" enctype="multipart/form-data">
						@csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Isactive</label>
                                   <select name="isactive" class="form-control select2" style="width: 100%;">
                                        <option  selected="selected" value="1">Yes</option>
                                        <option value="organizer" value="0">No</option>
                                    </select>
                                </div>
                            </div>
                            <!-- /.col -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1"> Title</label>
                                    <input type="text" class="form-control" name="title" id="exampleInputEmail1" placeholder="Enter title">
                                </div>
                                <!-- /.form-group -->
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                        <div class="row">
                            <!-- /.col -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Start Date</label>
                                    <input type="date" class="form-control" name="startdate" id="exampleInputEmail1" placeholder="Enter startdate" >
                                </div>
                                <!-- /.form-group -->
                            </div>
                            <!-- /.col -->
                            <!-- /.col -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">End Date</label>
                                    <input type="date" class="form-control" id="exampleInputEmail1" placeholder="Enter enddate" name="enddate">
                                </div>
                                <!-- /.form-group -->
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                        <div class="row">
                            <!-- /.col -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Header Image</label>
                                    <input type="file" class="form-control" name="header_image" id="exampleInputEmail1" placeholder="Enter image">
                                </div>
                                <!-- /.form-group -->
                            </div>
                            <!-- /.col -->
                            <!-- /.col -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Small Icon Image</label>
                                    <input type="file" class="form-control" id="exampleInputEmail1" placeholder="Enter small image" name="small_image">
                                </div>
                                <!-- /.form-group -->
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->

                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea name="description" class="form-control"></textarea>
                                </div>
                                <!-- /.form-group -->
                            </div>

                        </div>

                        <div class="row">
                            <!-- /.col -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Venue Name</label>
                                    <input type="text" class="form-control" name="venue_name" id="exampleInputEmail1" placeholder="Enter venue" >
                                </div>
                                <!-- /.form-group -->
                            </div>
                            <!-- /.col -->
                            <!-- /.col -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Venue Address</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter venue address" name="venue_adderss">
                                </div>
                                <!-- /.form-group -->
                            </div>
                            <!-- /.col -->
                        </div>
                        
                        <div class="row">
                            <!-- /.col -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Custom Package Details</label>
                                    <input type="text" class="form-control" name="custom_package_details" id="exampleInputEmail1" placeholder="Enter custom package details" >
                                </div>
                                <!-- /.form-group -->
                            </div>
                            <!-- /.col -->
                            <!-- /.col -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Markas Full</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter markasfull" name="markasfull">
                                </div>
                                <!-- /.form-group -->
                            </div>
                            <!-- /.col -->
                        </div>


                        <div class="row">
                            <!-- /.col -->
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">TNC</label>
                                    <input type="text" class="form-control" name="tnc" id="exampleInputEmail1" placeholder="Enter tnc" name="address">
                                 
                                </div>
                                <!-- /.form-group -->
                            </div>
                        </div>
                        
                        
                        
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-block btn-primary btn-sm">Add</button>
                                </div>
                            </div>
                        </div>

                        <!-- /.row -->
                    </div>
                    <!-- /.card-body -->
					</form>
                </div>
                <!-- /.card -->


            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
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
