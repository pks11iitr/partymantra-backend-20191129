@extends('layouts.admin')

@section('contents')
    @include('partials.admin-sidebar')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Edit Partner</h1>
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
                   <form action="{{route('admin.partners.store')}}" method="post" enctype="multipart/form-data">
				@csrf
 
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Partner Type</label>
                                    <select name="type"  class="form-control select2" 
                                     value="<?php echo $partners->type?>"  style="width: 100%;">
                                        <option value="restaurant" selected="selected">Restaurant</option>
                                        <option value="organizers">Event Organizer</option>
                                   </select>
                                </div>
                            </div>
                            <!-- /.col -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Partner Title</label>
                                    <input type="text" class="form-control" name="name" id="exampleInputEmail1" 
                                    placeholder="Enter email" value="<?php echo $partners->name?>">
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
                                    <label for="exampleInputEmail1">Mobile</label>
                                    <input type="text" class="form-control" name="contact_no" id="exampleInputEmail1"
                                     value="<?php echo $partners->contact_no?>" placeholder="Enter email" name="contact_no">
                                </div>
                                <!-- /.form-group -->
                            </div>
                            <!-- /.col -->
                            <!-- /.col -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Password</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter password" 
                                    value="<?php echo $partners->password?>" name="password">
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
                                    <input type="file" class="form-control" name="header_image" id="exampleInputEmail1" placeholder="Enter email">
                                </div>
                                <!-- /.form-group -->
                            </div>
                            <!-- /.col -->
                            <!-- /.col -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Small Icon Image</label>
                                    <input type="file" class="form-control" id="exampleInputEmail1" placeholder="Enter email" name="small_image">
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
                                    <textarea name="description" class="form-control" 
                                    value="<?php echo $partners->description?>"></textarea>
                                </div>
                                <!-- /.form-group -->
                            </div>

                        </div>

                        <div class="row">
                            <!-- /.col -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Short Address</label>
                                    <input type="text" class="form-control" name="short_address" id="exampleInputEmail1" 
                                    value="<?php echo $partners->short_address?>" placeholder="Enter email" name="short_address">
                                </div>
                                <!-- /.form-group -->
                            </div>
                            <!-- /.col -->
                            <!-- /.col -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Per Person Text</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter email" 
                                    value="<?php echo $partners->per_person_text?>" name="per_person_text">
                                </div>
                                <!-- /.form-group -->
                            </div>
                            <!-- /.col -->
                        </div>

                        <div class="row">
                            <!-- /.col -->
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Address</label>
                                    <input type="text" class="form-control" name="address" id="exampleInputEmail1" placeholder="Enter email" name="address">
                                    <input type="hidden" class="form-control" id="exampleInputEmail1" placeholder="Enter email" name="lat">
                                    <input type="hidden" class="form-control" id="exampleInputEmail1" placeholder="Enter email" name="lang">
                                </div>
                                <!-- /.form-group -->
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Is Active</label>
                                    <select name="isactive" class="form-control select2" 
                                    value="<?php echo $partners->isactive?>" style="width: 100%;">
                                        <option  selected="selected" value="1">Yes</option>
                                        <option value="organizer" value="0">No</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                         <div class="row">
                            
                                <div class="form-group"  style="algin:center;">
                                    <button type="submit" class="btn btn-block btn-primary btn-sm">Add</button>
                            
                            </div>
                        </div>

                        <!-- /.row -->
                    </div>
                    <!-- /.card-body -->

                </div>
                <!-- /.card -->
</form>

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
