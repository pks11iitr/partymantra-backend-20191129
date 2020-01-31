@extends('layouts.admin')

@section('contents')
    @include('partials.admin-sidebar')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Add Event Packages</h1>
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
                                        <form action="{{route('admin.package.store')}}" method="post" enctype="multipart/form-data">
						@csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Select Event</label>
                                    <select name="event_id" class="form-control select2" style="width: 100%;" onchange="getdata($(this).val())" id="events">
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
                                    <input type="text" class="form-control" name="package_name" id="exampleInputEmail1" placeholder="Enter name">
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
                                    <input type="text" class="form-control" name="price" id="exampleInputEmail1" placeholder="Enter price" >
                                </div>
                                <!-- /.form-group -->
                            </div>
                            <!-- /.col -->
                            <!-- /.col -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Text under Name</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter text under name" name="text_under_name">
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
                                    <input type="text" class="form-control" name="custom_package_detail" id="exampleInputEmail1" placeholder="Enter package details">
                                </div>
                                <!-- /.form-group -->
                            </div>
                            <!-- /.col -->
                            <!-- /.col -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Add Menus</label>
                                    <select name="menus[]" class="form-control select2" style="width: 100%;" multiple id="lca">


                                    </select>
                                </div>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Isactive</label>
                                <select name="isactive" class="form-control select2" style="width: 100%;">
                                    <option  selected="selected" value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Partner active</label>
                                <select name="partneractive" class="form-control select2" style="width: 100%;">
                                    <option  selected="selected" value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                            </div>
                        </div>


                        <!-- /.col -->
                    </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Isactive</label>
                                    <select name="isactive" class="form-control select2" style="width: 100%;">
                                        <option  selected="selected" value="1">Yes</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Partner active</label>
                                    <select name="partneractive" class="form-control select2" style="width: 100%;">
                                        <option  selected="selected" value="1">Yes</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>
                            </div>


                            <!-- /.col -->
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Package available in party</label>
                                    <select name="forparty" class="form-control select2" style="width: 100%;">
                                        <option  selected="selected" value="1">Yes</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Package available in dining</label>
                                    <select name="fordining" class="form-control select2" style="width: 100%;">
                                        <option  selected="selected" value="1">Yes</option>
                                        <option value="0">No</option>
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
    <script type="text/javascript">
        function getdata(id)
        {

            $.ajax({
                method: 'get', // Type of response and matches what we said in the route
                url: '{{route('partner.packagemenu.ajax', ['id'=>''])}}/'+id, // This is the url we gave in the route
                data: {}, // a JSON object to send back
                datatype:'json',
                success: function(response){ // What to do if we succeed
                    $("#lca").empty();
                    if(response){

                        $.each(response,function(i, data){
                            console.log(data)

                                $("#lca").append('<option value="'+data.id+'">'+data.name+'</option>');
                      });

                    }else{
                        $("#lca").empty();

                    }


                },
                error: function(jqXHR, textStatus, errorThrown) { // What to do if we fail
                    console.log(JSON.stringify(jqXHR));
                    console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
                }
            });
        }


    </script>
    <script>
        $(document).ready(function(){
            getdata($("#events").val())
        })
    </script>
@endsection
