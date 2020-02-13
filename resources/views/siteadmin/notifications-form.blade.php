@extends('layouts.admin')

@section('contents')
    @include('partials.admin-sidebar')




    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Add Banners</h1>
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
                    <form action="{{route('admin.notification.send')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">


                            <div class="row">
                                <!-- /.col -->
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label >Select Type</label>
                                        <select name="receipents" class="form-control select2"
                                                style="width: 100%;" >
                                            <option  value="customer">All Customer</option>
                                            <option  value="partner">All Partners</option>
                                            <option  value="all">All Site Users</option>
                                        </select>
                                    </div>
                                    <!-- /.form-group -->
                                </div>
                            </div>
{{--                            <div class="row">--}}
{{--                                <!-- /.col -->--}}
{{--                                <div class="col-md-12">--}}
{{--                                    <div class="form-group">--}}
{{--                                        <label for="exampleInputEmail1">Image</label>--}}
{{--                                        <input type="file" class="form-control" name="image" id="exampleInputEmail1" placeholder="Enter image"><br>--}}
{{--                                    </div>--}}
{{--                                    <!-- /.form-group -->--}}
{{--                                </div>--}}
{{--                                <!-- /.col -->--}}
{{--                                <!-- /.col -->--}}
{{--                            </div>--}}
                            <div class="row">
                                <!-- /.col -->

                                <!-- /.col -->
                                <!-- /.col -->
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Title</label>
                                        <input type="text" class="form-control" name="title" id="exampleInputEmail1" placeholder="Enter a number">
                                    </div>
                                    <!-- /.form-group -->
                                </div>
                            </div>
                            <div class="row">
                                <!-- /.col -->

                                <!-- /.col -->
                                <!-- /.col -->
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Description</label>
                                        <textarea class="form-control" name="description" id="exampleInputEmail1" placeholder="Enter a number"></textarea>
                                    </div>
                                    <!-- /.form-group -->
                                </div>
                            </div>
                            <div class="row">

                                <div class="form-group"  style="algin:center;">
                                    <button type="submit" class="btn btn-block btn-primary btn-sm">Send</button>

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
