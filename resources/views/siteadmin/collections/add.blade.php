@extends('layouts.admin')

@section('contents')
    @include('partials.admin-sidebar')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Add Collection</h1>
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
                     <form action="{{route('admin.collection.store')}}" method="post" enctype="multipart/form-data">
						@csrf
                    <div class="card-body">
                        <div class="row">
                           
                            <!-- /.col -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Name</label>
                                    <input type="text" class="form-control" name="name" id="exampleInputEmail1" placeholder="Enter name">
                                </div>
                                <!-- /.form-group -->
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                        
                         <div class="col-md-6">
                                <div class="form-group">
                                    <label>Cover Image</label>
                             <input type="file" class="form-control" name="cover_image" id="exampleInputEmail1" placeholder="Enter image">

                                </div>
                            </div>
                         <div class="row">
                            
                                <div class="form-group"  style="algin:center;">
                                    <button type="submit" class="btn btn-block btn-primary btn-sm">Add</button>
                            
                            </div>
                        </div>
                            <!-- /.col -->
                            <!-- /.col -->
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
