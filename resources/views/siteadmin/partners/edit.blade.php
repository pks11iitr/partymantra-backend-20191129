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
                   <form action="{{route('admin.partners.update',['id'=>$partners->id])}}" method="post" enctype="multipart/form-data">
				@csrf

                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row">
                          <div class="col-md-6">
                              <div class="form-group">
                                  <label>Partner Type</label>
                                  <select name="type"  class="form-control select2"
                                     style="width: 100%;">
                                      <option value="restaurant" {{$partners->type=='restaurant'?'selected':''}}>Restaurant</option>
                                      <option value="organizers" {{$partners->type=='organizers'?'selected':''}}>Event Organizer</option>
                                 </select>
                              </div>
                          </div>
                            <!-- /.col -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Partner Title</label>
                                    <input type="text" class="form-control" name="name"
                                    value="{{$partners->name}}" id="exampleInputEmail1" placeholder="Enter email">
                                </div>
                                <!-- /.form-group -->
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->

                        <!-- /.row -->
                        <div class="row">
                            <!-- /.col -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Header Image</label>
                                    <input type="file" class="form-control" name="header_image" id="exampleInputEmail1" placeholder="Enter email"><br>
                                      <image src="{{$partners->header_image}}" height="100" width="200">
                                </div>
                                <!-- /.form-group -->
                            </div>
                            <!-- /.col -->
                            <!-- /.col -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Small Icon Image</label>
                                    <input type="file" class="form-control" id="exampleInputEmail1" placeholder="Enter email" name="small_image">
                                    <br>
                                    <image src="{{$partners->small_image}}" height="100" width="200">
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
                                    <textarea name="description" class="form-control">
                                    {{$partners->description}}</textarea>
                                </div>
                                <!-- /.form-group -->
                            </div>

                        </div>

                        <div class="row">
                            <!-- /.col -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Short Address</label>
                                    <input type="text" class="form-control" name="short_address"  value="{{$partners->short_address}}"
                                    id="exampleInputEmail1" placeholder="Enter email" name="short_address">
                                </div>
                                <!-- /.form-group -->
                            </div>
                            <!-- /.col -->
                            <!-- /.col -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Per Person Text</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1"
                                    value="{{$partners->per_person_text}}" placeholder="Enter email" name="per_person_text">
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
                                      <input type="text" class="form-control" id="exampleInputEmail1"
                                      value="{{$partners->address}}" placeholder="Enter address" name="address">


                                </div>
                                <!-- /.form-group -->
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Is Active</label>
                                    <select name="isactive" class="form-control select2"
                                      style="width: 100%;">
                                      <option   value="1" {{$partners->isactive==1?'selected':''}}>Yes</option>
                                        <option   value="0" {{$partners->isactive==0?'selected':''}}>No</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Contact No</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1"
                                    value="{{$partners->contact_no}}" placeholder="Enter email" name="contact_no">
                                </div>
                                <!-- /.form-group -->
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Is Allow Party</label>
                                    <select name="allow_party" class="form-control select2"
                                            style="width: 100%;">
                                        <option   value="1" {{$partners->allow_party==1?'selected':''}}>Yes</option>
                                        <option   value="0" {{$partners->allow_party==0?'selected':''}}>No</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Restaurant Booking Timings</label>
                                    <textarea type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter email" name="timings">{{$partners->timings}}</textarea>
                                </div>
                                <!-- /.form-group -->
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Party Booking Timings</label>
                                    <textarea type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter email" name="party_timings">{{$partners->party_timings}}</textarea>
                                </div>
                                <!-- /.form-group -->
                            </div>
                        </div>
                        <div class="row">
                            <!-- /.col -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Open Time</label>
                                    <input type="text" class="form-control" name="open" id="exampleInputEmail1" placeholder="Enter email" name="short_address" value="{{$partners->open}}">
                                </div>
                                <!-- /.form-group -->
                            </div>
                            <!-- /.col -->
                            <!-- /.col -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Close Time</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1"
                                           placeholder="Enter email" name="close" value="{{$partners->close}}">
                                </div>
                                <!-- /.form-group -->
                            </div>
                            <!-- /.col -->
                        </div>

                         <div class="row">

                                <div class="form-group"  style="algin:center;">
                                    <button type="submit" class="btn btn-block btn-primary btn-sm">Update</button>

                            </div>
                        </div>

                        <!-- /.row -->
                    </div>
                    <!-- /.card-body -->

                <!-- /.card -->
                </form>

                </div><!-- /.container-fluid -->
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <!-- SELECT2 EXAMPLE -->
                <div class="card card-default">
                    <div class="card-header">
                        <h3 class="card-title">
                            Change Partner Password
                        </h3>
                    </div>
                    <form action="{{route('admin.partner.changepass',['id'=>$partners->id])}}" method="post" enctype="multipart/form-data">
                    @csrf

                    <!-- /.card-header -->
                        <div class="card-body">
                            <!-- /.row -->

                            <!-- /.row -->
                            <!-- /.row -->


                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Enter New Password</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1"
                                               value="" placeholder="Enter email" name="password">
                                    </div>
                                    <!-- /.form-group -->
                                </div>
                            </div>
                            <div class="row">

                                <div class="form-group"  style="algin:center;">
                                    <button type="submit" class="btn btn-block btn-primary btn-sm">Update</button>

                                </div>
                            </div>

                            <!-- /.row -->
                        </div>
                        <!-- /.card-body -->


                        <!-- /.card -->
                    </form>

                </div><!-- /.container-fluid -->
            </div>
        </section>
        <section class="content">
            <div class="container-fluid">
                <!-- SELECT2 EXAMPLE -->
                <div class="card card-default">
                    <div class="card-header">
                        <h3 class="card-title">Add Menus with partners</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-remove"></i></button>
                        </div>
                    </div>

                    @foreach($partners->menus as $menu)
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input class="form-control" type="text" readonly value="{{$menu->name}}">
                                    </div>
                                </div>
                                <!-- /.col -->
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <input class="form-control" type="text" readonly value="{{$menu->pivot->price}}">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <input class="form-control" type="text" readonly value="{{$menu->pivot->cut_price}}">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <a href="{{route('admin.partner.delmenu', ['pid'=>$partners->id, 'mid'=>$menu->id])}}"><button class="btn btn-block btn-primary btn-sm">Delete</button></a>
                                    </div>
                                </div>
                                <!-- /.col -->
                            </div>
                        </div>
                    @endforeach

                    <form action="{{route('admin.partner.addmenu',['id'=>$partners->id])}}" method="post" enctype="multipart/form-data">
                    @csrf

                    <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Select Menu</label>
                                        <select name="menuid"  class="form-control select2"
                                                style="width: 100%;">
                                            @foreach($menus as $menu)
                                                <option value="{{$menu->id}}">{{$menu->name}}</option>
                                             @endforeach

                                        </select>
                                    </div>
                                </div>
                                <!-- /.col -->
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Price</label>
                                        <input type="text" class="form-control" name="price"
                                               value="" id="exampleInputEmail1" placeholder="Enter email">
                                    </div>
                                    <!-- /.form-group -->
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Cut Price</label>
                                        <input type="text" class="form-control" name="cut_price"
                                               value="" id="exampleInputEmail1" placeholder="Enter email">
                                    </div>
                                    <!-- /.form-group -->
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"></label>
                                        <button type="submit" class="btn btn-block btn-primary btn-sm">Submit</button>
                                    </div>
                                    <!-- /.form-group -->
                                </div>
                                <!-- /.col -->
                            </div>
                        </div>
                        <!-- /.card-body -->

                        <!-- /.card -->
                    </form>

                </div><!-- /.container-fluid -->
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <!-- SELECT2 EXAMPLE -->
                <div class="card card-default">
                    <div class="card-header">
                        <h3 class="card-title">Add Facilities</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-remove"></i></button>
                        </div>
                    </div>

                    @foreach($partners->facilities as $facility)
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input class="form-control" type="text" readonly value="{{$facility->name}}">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <a href="{{route('admin.partner.delfacility', ['pid'=>$partners->id, 'fid'=>$facility->id])}}"><button class="btn btn-block btn-primary btn-sm">Delete</button></a>
                                    </div>
                                </div>
                                <!-- /.col -->
                            </div>
                        </div>
                    @endforeach

                    <form action="{{route('admin.partner.addfacility',['id'=>$partners->id])}}" method="post" enctype="multipart/form-data">
                    @csrf

                    <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Select Menu</label>
                                        <select name="facilities[]"  class="form-control select2"
                                                style="width: 100%;" multiple>
                                            @foreach($facilities as $facility)
                                                <option value="{{$facility->id}}">{{$facility->name}}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                </div>
                                <!-- /.col -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"></label>
                                        <button type="submit" class="btn btn-block btn-primary btn-sm">Submit</button>
                                    </div>
                                    <!-- /.form-group -->
                                </div>
                                <!-- /.col -->
                            </div>
                        </div>
                        <!-- /.card-body -->

                        <!-- /.card -->
                    </form>

                </div><!-- /.container-fluid -->
            </div>
        </section>
        <!-- /.content -->

        <section class="content">
            <div class="container-fluid">
                <!-- SELECT2 EXAMPLE -->
                <div class="card card-default">
                    <div class="card-header">
                        <h3 class="card-title">Add Gallery Images</h3>
                    </div>
                    <!-- /.card-header -->
                    <form action="{{route('admin.partner.gallery',['id'=>$partners->id])}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <!-- /.row -->

                            <!-- /.row -->
                            <div class="row">
                                <!-- /.col -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Header Image</label>
                                        <input type="file" class="form-control" name="gallery[]" id="exampleInputEmail1" placeholder="Enter image" multiple>
                                        <br>
                                    </div>
                                    <!-- /.form-group -->
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Show Image in</label>
                                        <select name="type" class="form-control select2"
                                                style="width: 100%;">
                                            <option   value="restaurant">Restaurant</option>
                                            <option   value="party">Party</option>
                                            <option   value="both">Both</option>
                                        </select>
                                    </div>
                                </div>
                                <!-- /.col -->
                                <!-- /.col -->
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">.</label>
                                        <button type="submit" class="btn btn-block btn-primary btn-sm">Add</button>
                                    </div>
                                    <!-- /.form-group -->
                                </div>
                                <!-- /.col -->
                            </div>
                            <div class="row">
                                <!-- /.col -->
{{--                                <div class="col-md-6">--}}
                                @foreach($partners->gallery as $g)
                                    @if(in_array($g->other_type, ['both','party', 'restaurant']))
                                    <div class="form-group">
                                        <img src="{{$g->doc_path}}" height="100" width="200"> &nbsp; &nbsp; <a href="{{route('admin.partner.galleryrm', ['id'=>$g->id])}}">X</a>
                                        &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;          &nbsp; &nbsp; &nbsp; &nbsp;            </div>
                                    @endif
                                    @endforeach
{{--                                </div>--}}

                            <!-- /.form-group -->
                                <!-- /.form-group -->
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->
                    </form>
                </div>



            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <!-- SELECT2 EXAMPLE -->
                <div class="card card-default">
                    <div class="card-header">
                        <h3 class="card-title">Add Party or Event images for Restaurant Detail Screen</h3>
                    </div>
                    <!-- /.card-header -->
                    <form action="{{route('admin.partner.partyevent',['id'=>$partners->id])}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <!-- /.row -->

                            <!-- /.row -->
                            <div class="row">
                                <!-- /.col -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Header Image</label>
                                        <input type="file" class="form-control" name="gallery[]" id="exampleInputEmail1" placeholder="Enter image" multiple>
                                        <br>
                                    </div>
                                    <!-- /.form-group -->
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Show Image in</label>
                                        <select name="type" class="form-control select2"
                                                style="width: 100%;">
                                            <option   value="partyonrestaurant">Party</option>
                                            @foreach($partners->events as $e)
                                                <option   value="{{$e->id}}">{{$e->title}}</option>
                                                @endforeach

                                        </select>
                                    </div>
                                </div>
                                <!-- /.col -->
                                <!-- /.col -->
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">.</label>
                                        <button type="submit" class="btn btn-block btn-primary btn-sm">Add</button>
                                    </div>
                                    <!-- /.form-group -->
                                </div>
                                <!-- /.col -->
                            </div>
                            <div class="row">
                                <!-- /.col -->
                                {{--                                <div class="col-md-6">--}}
                                @foreach($partners->eventparty as $g)
                                    <div class="form-group">
                                        <img src="{{$g->doc_path}}" height="100" width="200"> &nbsp;{{$g->other_type}} &nbsp; &nbsp; <a href="{{route('admin.partner.galleryrm', ['id'=>$g->id])}}">X</a>
                                        &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;          &nbsp; &nbsp; &nbsp; &nbsp;            </div>
                            @endforeach
                            {{--                                </div>--}}

                            <!-- /.form-group -->
                                <!-- /.form-group -->
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->
                    </form>
                </div>



            </div>
        </section>
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
