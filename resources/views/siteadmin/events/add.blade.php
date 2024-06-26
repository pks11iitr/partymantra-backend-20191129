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
                                    <label>Select Organizer</label>
                                    <select name="partner_id" class="form-control select2" style="width: 100%;">
                                        @foreach($organizers as $organizer)
                                        <option  value="{{$organizer->id}}"  {{old('id')==$organizer->id?'selected':''}}>{{$organizer->name}}</option>
                                        @endforeach

                                    </select>

                                </div>
                            </div>
                            <!-- /.col -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1"> Title</label>
                                    <input type="text" class="form-control" name="title" id="exampleInputEmail1" placeholder="Enter title" value="{{old('title')}}">
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
                                    <input type="text" class="form_datetime form-control" name="startdate" id="exampleInputEmail1" placeholder="Enter startdate" value="{{old('startdate')}}">
                                </div>
                                <!-- /.form-group -->
                            </div>
                            <!-- /.col -->
                            <!-- /.col -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">End Date</label>
                                    <input type="text" class="form_datetime form-control" id="exampleInputEmail1" placeholder="Enter enddate" name="enddate" value="{{old('enddate')}}">
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
                                    <textarea name="description" class="form-control">{{old('description')}}</textarea>
                                </div>
                                <!-- /.form-group -->
                            </div>

                        </div>

                        <div class="row">
                            <!-- /.col -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Venue Name</label>
                                    <input type="text" class="form-control" name="venue_name" id="exampleInputEmail1" placeholder="Enter venue" value="{{old('venue_name')}}">
                                </div>
                                <!-- /.form-group -->
                            </div>
                            <!-- /.col -->
                            <!-- /.col -->



                            <div class="col-md-6">
                                <div class="form-group" >
                                    <label for="exampleInputEmail1" id="locationField">Venue Address</label>
                                    <input type="text" class="form-control" id="autocomplete"
                                    placeholder="Search venue address....." name="venue_adderss" onFocus="geolocate()" value="{{old('venue_address')}}">
                                </div>
                                <!-- /.form-group -->
                            </div>
                            <!-- /.col -->
                        </div>
                        <div class="row">
                            <!-- /.col -->



                            <div class="col-md-6">
                                <div class="form-group" >
                                    <label for="exampleInputEmail1" id="locationField">Lat</label>
                                    <input class="form-control" type="input" name="lat" id="lat" value="{{old('lat')}}">

                                </div>
                                <!-- /.form-group -->
                            </div>
                            <!-- /.col -->
                            <!-- /.col -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Lang</label>
                                    <input class="form-control" type="input" name="lang" id="lang" value="{{old('lang')}}">

                                </div>
                                <!-- /.form-group -->
                            </div>
                            <!-- /.col -->

                        </div>
                        <div class="row">
                            <!-- /.col -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Is Active</label>
                                    <select name="isactive" class="form-control select2" style="width: 100%;">
                                        <option  selected="selected" value="1" {{old('isactive')==1?'selected':''}}>Yes</option>
                                        <option value="0" {{old('isactive')==0?'selected':''}}>No</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Partner Active</label>
                                    <select name="partneractive" class="form-control select2" style="width: 100%;">
                                        <option value="1" {{old('partneractive')==1?'selected':''}}>Yes</option>
                                        <option value="0" {{old('partneractive')==0?'selected':''}}>No</option>
                                    </select>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Mark as Full</label>
                                    <select name="markasfull" class="form-control select2" style="width: 100%;">
                                        <option value="0" {{old('markasfull')==1?'selected':''}}>No</option>
                                        <option   value="1" {{old('markasfull')==0?'selected':''}}>Yes</option>

                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Per Person Text</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1"
                                      placeholder="Enter email" name="per_person_text" value="{{old('per_person_text')}}">

                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <!-- /.col -->
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">TNC</label>
                                    <input type="text" class="form-control" name="tnc" id="exampleInputEmail1" placeholder="Enter tnc" value="{{old('tnc')}}">

                                </div>
                                <!-- /.form-group -->
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Custom Package Details</label>
                                    <textarea type="text" class="form-control" name="custom_package_details" id="exampleInputEmail1" placeholder="Enter custom package details" >{{old('custom_package_details')}}</textarea>
                                </div>
                                <!-- /.form-group -->
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Do You want to put on home page?</label>
                                    <select name="istop" class="form-control select2" style="width: 100%;">
                                        <option value="0" {{old('markasfull')==0?'selected':''}}>No</option>
                                        <option   value="1" {{old('markasfull')==1?'selected':''}}>Yes</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Home Position</label>
                                    <input type="text" class="form-control"  id="exampleInputEmail1" placeholder="Enter tnc" name="priority" value="{{old('markasfull')??100}}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <!-- /.col -->

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Select Collection</label>
                                    <select class="form-control select2" name="collection_id[]" multiple>

                                        @foreach($collections as $collection)
                                            <option value="{{$collection->id}}">{{$collection->name}}</option>
                                        @endforeach

                                    </select>

                                </div>
                                <!-- /.form-group -->
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Select Facilities</label>
                                    <select name="facilities[]" class="form-control select2" style="width: 100%;" multiple>
                                        @foreach($facilities as $c)
                                            <option value="{{$c->id}}">{{$c->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <!-- /.col -->

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Enable Cover Charges Men</label>
                                    <input type="checkbox" name="cover[]" value="men">
                                    <input name="charge[men]" value="0" placeholder="charge">
                                </div>
                                <!-- /.form-group -->
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Enable Cover Charges Women</label>
                                    <input type="checkbox" name="cover[]" value="women">
                                    <input name="charge[women]" value="0" placeholder="charge">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Enable Cover Charges Couple</label>
                                    <input type="checkbox" name="cover[]" value="couple">
                                    <input name="charge[couple]" value="0" placeholder="charge">
                                </div>
                            </div>
                        </div>
                            <div class="row">
                            <div class="col-md-12">
                                <div class="form-group" style="align:center">
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
        $(".form_datetime").datetimepicker({format: 'yyyy-mm-dd hh:ii'});
    </script>

    <script>
        // This sample uses the Autocomplete widget to help the user select a
        // place, then it retrieves the address components associated with that
        // place, and then it populates the form fields with those details.
        // This sample requires the Places library. Include the libraries=places
        // parameter when you first load the API. For example:
        // <script
        // src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

        var placeSearch, autocomplete;

        var componentForm = {
            venue_name: 'short_name'


        };

        function initAutocomplete() {
            // Create the autocomplete object, restricting the search predictions to
            // geographical location types.
            autocomplete = new google.maps.places.Autocomplete(
                document.getElementById('autocomplete'), {types: ['geocode']});

            // Avoid paying for data that you don't need by restricting the set of
            // place fields that are returned to just the address components.
            autocomplete.setFields(['address_component', 'formatted_address', 'geometry']);
            /*pankaj
            view data details at the link https://developers.google.com/maps/documentation/geocoding/intro
             */

            // When the user selects an address from the drop-down, populate the
            // address fields in the form.
            autocomplete.addListener('place_changed', fillInAddress);
        }

        function fillInAddress() {
            // Get the place details from the autocomplete object.
            var place = autocomplete.getPlace();

            // for (var component in componentForm) {
            //     document.getElementById(component).value = '';
            //     document.getElementById(component).disabled = false;
            // }

            // Get each component of the address from the place details,
            // and then fill-in the corresponding field on the form.
            for (var i = 0; i < place.address_components.length; i++) {
                console.log(place.getLatLng())
                var addressType = place.address_components[i].types[0];
                if (componentForm[addressType]) {
                    var val = place.address_components[i][componentForm[addressType]];
                    document.getElementById(addressType).value = val;
                }
            }
        }

        // Bias the autocomplete object to the user's geographical location,
        // as supplied by the browser's 'navigator.geolocation' object.
        function geolocate() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    var geolocation = {
                        lat: position.coords.latitude,
                        lng: position.coords.longitude
                    };
                    var circle = new google.maps.Circle(
                        {center: geolocation, radius: position.coords.accuracy});
                    autocomplete.setBounds(circle.getBounds());
                });
            }
        }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBdnpGnI038nDRtvM7LbCrBClPnLeXvpfc&libraries=places&callback=initAutocomplete"
            async defer></script>
@endsection
