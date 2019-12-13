@extends('layouts.admin')

@section('contents')
    @include('partials.partner-sidebar')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Edit Event Packages</h1>
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
                                        <form action="{{route('partner.package.update',['id'=>$package->id])}}" method="post" enctype="multipart/form-data">
						@csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Select Event</label>
                                    <select name="event_id" class="form-control select2"
                                    value="<?=$package->event_id?>" style="width: 100%;">
                                      @foreach($events as $event)
                                      <option  selected="selected" value="{{$event->id}}">{{$event->title}}</option>
                                      @endforeach
                                    </select>
                                </div>
                            </div>
                            <!-- /.col -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Package Name</label>
                                    <input type="text" class="form-control" name="package_name" id="exampleInputEmail1"
                                    value="<?=$package->package_name?>" placeholder="Enter name">
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
                                    <label for="exampleInputEmail1">Price</label>
                                    <input type="text" class="form-control" name="price" id="exampleInputEmail1"
                                    value="<?=$package->price?>" placeholder="Enter price" >
                                </div>
                                <!-- /.form-group -->
                            </div>
                            <!-- /.col -->
                            <!-- /.col -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Text under Name</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1"
                                    value="<?=$package->text_under_name?>" placeholder="Enter text under name"
                                    name="text_under_name">
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
                                    <label for="exampleInputEmail1">Customer Package Details</label>
                                    <input type="text" class="form-control" name="custom_package_detail" id="exampleInputEmail1"
                                    value="<?=$package->custom_package_detail?>" placeholder="Enter package details">
                                </div>
                                <!-- /.form-group -->
                            </div>
                            <!-- /.col -->
                            <!-- /.col -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Isactive</label>
                                    <select name="isactive" class="form-control select2" style="width: 100%;">
                                      <option   value="1" {{$package->isactive==1?'selected':''}}>Yes</option>
                                        <option   value="0" {{$package->isactive==0?'selected':''}}>No</option>
                                    </select>
                                </div>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Select Menu</label>
                                    <select name="menus[]" class="form-control select2" style="width: 100%;" multiple>
                                        @foreach($menus as $m)
                                            <option value="{{$m->id}}" >{{$m->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <!-- /.col -->
                        </div>


                        <div class="row">

                                <div class="form-group"  style="algin:center;">
                                    <button type="submit" class="btn btn-block btn-primary btn-sm">Add</button>

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
