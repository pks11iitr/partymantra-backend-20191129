@extends('layouts.admin')

@section('contents')
    @include('partials.admin-sidebar')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Edit Banners</h1>
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
                                        <form action="{{route('admin.banner.update',['id'=>$banner->id])}}" method="post" enctype="multipart/form-data">
						@csrf
                    <div class="card-body">


                	<div class="row">
                            <!-- /.col -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label >Select Type</label>
                                    <select name="entity_type" class="form-control select2"
                                    style="width: 100%;"  onchange="getdata(this.value)" >

                                        <option  value="event" {{$banner->entity_type=='event'?'selected': ''}}>Event</option>
                                        <option  value="restaurant" {{$banner->entity_type=='restaurant'?'selected': ''}}>Restaurant</option>
                                        <option  value="party" {{$banner->entity_type=='party'?'selected': ''}}>Party</option>

                                    </select>
                                </div>
                                <!-- /.form-group -->
                            </div>
                            <!-- /.col -->
                            <!-- /.col -->
                            <div class="col-md-6">
                                <div class="form-group">
                                     <label>Entities</label>
										 <select class="form-control select2" name="entity_id"
                  value="<?=$banner->entity_id?>" id="lca">
											 Select Entity  </select>

                                </div>
                                <!-- /.form-group -->
                            </div>
                            <!-- /.col -->
                        </div>
					<div class="row">
                            <!-- /.col -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Image</label>
                                    <input type="file" class="form-control" name="image" id="exampleInputEmail1" placeholder="Enter image"><br>
                                      <image src="{{$banner->image}}" height="100" width="200">
                                </div>
                                <!-- /.form-group -->
                            </div>
                            <!-- /.col -->
                            <!-- /.col -->
                            <div class="col-md-6">
                                <div class="form-group">
                                     <label>Isactive</label>
                                     <select name="isactive" class="form-control select2" style="width: 100%;">
                                        <option  selected="selected" value="1" {{$banner->isactive==1?'selected':''}}>Yes</option>
                                        <option value="0" {{$banner->isactive==0?'selected':''}}>No</option>
                                    </select>
                                </div>
                                <!-- /.form-group -->
                            </div>
                    </div>
                        <div class="row">
                            <!-- /.col -->

                            <!-- /.col -->
                            <!-- /.col -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Priority(Set priority between 1-10 to show it in top slider)</label>
                                    <input type="text" class="form-control" name="priority" id="exampleInputEmail1" placeholder="Enter a number" value="{{$banner->priority}}">
                                </div>
                                <!-- /.form-group -->
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
                   url: '{{route('banner.ajax')}}', // This is the url we gave in the route
                   data: {'type':id}, // a JSON object to send back
                   datatype:'json',
                   success: function(response){ // What to do if we succeed
                       $("#lca").empty();
                       if(response){

                           $.each(response,function(i, data){
                               console.log(data)
                               if(id=='event')
                                   $("#lca").append('<option value="'+data.id+'">'+data.title+'</option>');

                               else if(id=='party'){
                                   $("#lca").append('<option value="'+data.id+'">'+data.title+'</option>');
                               }else if(id=='restaurant'){
                                   $("#lca").append('<option value="'+data.id+'">'+data.name+'</option>');
                               }
                               $("#lca").val('{{$banner->entity_id}}').trigger('change');
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
            getdata('event')
            //$('#lca').select2("val", '{{$banner->entity_id}}');

        })
    </script>

@endsection
