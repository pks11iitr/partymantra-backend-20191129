@extends('Website.layout')
@section('contents')
    <style>
        /* Set the size of the div element that contains the map */
        #map {
            height: 400px;  /* The height is 400 pixels */
            width: 100%;  /* The width is the width of the web page */
        }
    </style>
    @if ($errors->any())
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert">×</button>
            {{$errors->first()}}
        </div>
    @endif
    <!-- Breadcrumb Starts-->
    <section class="section pagecrumb" style="background-image:url({{$event->header_image}}); background-repeat: no-repeat;background-size: cover;">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center py-4">
                    <h2 class="pagebrumb heading text-light">{{$event->title}}</h2>
                    <p class="text-light">{{$event->partner->name}}</p>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Starts-->
    <!-- Mobile Search Ends-->
    <!-- page container Starts-->
    <section class="section bg-light">
        <div class="container">
            <div class="row">
                <div class="col-md-7 col-lg-7 col-sm-12 col-xs-12">
                    <div class="row px-2">
                        <div class="col-12 event">
                            <h2 class="heading">{{$event->title}}</h2>
                            <div class="rate">
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star-half-o" aria-hidden="true"></i>
                            </div>
                            <p class="">{{$event->partner->name}}</p>
                            <div class="date">
                                <h3><strong><i class="fa fa-calendar" aria-hidden="true"></i> Date & Time"</strong></h3>
                                <p style="margin-left:10px;">Starts at {{ date('D, d M Y H:iA', strtotime($event->start_date))}}<br>
                                    Ends at {{ date('D, d M Y H:iA', strtotime($event->end_date))}}
                                </p>
                            </div>
                        </div>
                        <div class="col-12 event">
                            <h2 class="heading"><i class="fa fa-map-marker" aria-hidden="true"></i> Address </h2>
                            <p class="">{{$event->venue_adderss}}</p>
                            <div class="map py-2">
                                <div id="map"></div>
                            </div>
                        </div>
                        <div class="col-12 event">
                            <h2 class="heading"><i class="fa fa-calendar-check-o" aria-hidden="true"></i> Event Description </h2>
                            <p class="text-justify">{{$event->description}}</p>
                        </div>
                        @if(!empty($event->facilities->toArray()))
                        <div class="col-12 event">
                            <h2 class="heading"><i class="fa fa-calendar-plus-o" aria-hidden="true"></i> More Info</h2>
                            <div class="row">
                            @foreach($event->facilities as $f)
                                <div class="col-6">
                                    <p class="text-justify"><span class="heading h6" style="margin-right:5px;"><i class="fa fa-check-square-o" aria-hidden="true"></i></span>{{$f->name}}</p>
                                </div>
                            @endforeach
                            </div>
                        </div>
                        @endif
                        @if(!empty($event->gallery->toArray()))
                            <div class="col-12 event">
                                <h2 class="heading"><i class="fa fa-image" aria-hidden="true"></i> Gallery</h2>
                                <div class="customer-logos row">
                                    @foreach($event->gallery as $g)
                                        <div class="slide col-4 mt-4 service-box">
                                            <div class="">
                                                <div class="card">
                                                    <div class="cardimg">
                                                        <a class="thumbnail" href="#" data-image-id="" data-toggle="modal" data-image="{{$g->doc_path}}" data-target="#image-gallery">
                                                            <img class="card-img-top img-fluid" src="{{$g->doc_path}}" style="height:120px;" alt="Short alt text">
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                    @endif
                    <!----- Start Modal gallery---->
                        <div class="modal fade" id="image-gallery" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                                        <img id="image-gallery-image" class="img-fluid" src="">
                                    </div>
                                    <div class="mdbtn">
                                        <a  type="button" class="float-left btn btn-default text-dark" id="show-previous-image">Previous</a>
                                        <a  type="button" id="show-next-image" class="float-right btn btn-default text-dark">Next</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!----- Modal gallery End---->
                        <div class="col-12 event">
                            <h2 class="heading"><i class="fa fa-tachometer" aria-hidden="true"></i> Terms & Cond.</h2>
                            <p class="text-justify">{{$event->tnc}}</p>
                        </div>
                    </div>
                </div>

                    <div class="col-md-5 col-lg-5 col-sm-12 col-xs-12 px-2">
                        <div class="alert alert-danger" id="page-errors" style="display:none">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <p id="error-msg"></p>
                        </div>
                        <form method="post" action="{{route('website.book')}}" class="event-form " >
                        <div clss="row">
                            <input type="hidden" name="type" value="event">
                            @if(!empty($event->covers->toArray()))
                                <div class="col-12 event" id="packagage-focus">
                                    <h2 class="heading">Cover charges</h2>
                                    <div class="row py-2 bg-light">
                                        <div class="col-4">
                                            <h6>Packages</h6>
                                        </div>
                                        <div class="col-4">
                                            <h6>Price</h6>
                                        </div>
                                        <div class="col-4">
                                        </div>
                                    </div>
                                     @foreach($event->covers as $c)
                                    <div class="row py-2">
                                        <div class="col-4">
                                            <p>{{$c->package_name}}</p>
                                        </div>
                                        <div class="col-4">
                                           <p>Rs.{{$c->price}}</p>
                                        </div>
                                        <div class="col-4">
                                            <div class="input-group">
                                                <span class="input-group-btn">
                                                    <button type="button" class="quantity-left-minus btn btn-quant btn-number"  data-type="minus" data-field="" packageid="{{$c->id}}" type1="cover">
                                                    <i class="fa fa-minus" aria-hidden="true"></i>
                                                    </button>
                                                </span>
                                                <input type="hidden" name="itemid[]" value="{{$c->id}}" id="pack-{{$c->id}}">
                                                <input type="text" id="packpass-{{$c->id}}" name="pass[]" class="form-control input-number quantity covers" value="{{isset($cartdata['itemid'])?(array_search($c->id,$cartdata['itemid'])!==false?(isset($cartdata['pass'])?($cartdata['pass'][array_search($c->id,$cartdata['itemid'])]??0):0):0):0}}" min="1" max="100" >
                                                <span class="input-group-btn">
                                                    <button type="button" class="quantity-right-plus btn btn-quant btn-number" data-type="plus" data-field="" packageid="{{$c->id}}" type1="cover">
                                                    <i class="fa fa-plus" aria-hidden="true"></i>
                                                    </button>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                     @endforeach
                                </div>
                            @endif
                            @if(!empty($event->packages))
                                <div class="col-12 event">
                                    <h2 class="heading">Event Packages</h2>
                                    <div class="row py-2 bg-light">
                                        <div class="col-4">
                                            <h6>Packages</h6>
                                        </div>
                                        <div class="col-4">
                                            <h6>Price</h6>
                                        </div>
                                        <div class="col-4">
                                        </div>
                                    </div>
                                    @foreach($event->packages as $c)
                                    <div class="row py-2">
                                        <div class="col-4">
                                            <p>{{$c->package_name}}<br>{{$c->text_under_name}}</p>
                                        </div>
                                        <div class="col-4">
                                           <p>Rs.{{$c->price}}</p>
                                        </div>
                                        <div class="col-4">
                                            <div class="input-group">
                                                <span class="input-group-btn">
                                                <button type="button" class="quantity-left-minus btn btn-quant btn-number"  data-type="minus" data-field="" packageid="{{$c->id}}" type1="package">
                                                <i class="fa fa-minus" aria-hidden="true"></i>
                                                </button>
                                                </span>
                                                                    <input type="hidden" name="itemid[]" value="{{$c->id}}"  id="pack-{{$c->id}}">
                                                                    <input type="text" id="packpass-{{$c->id}}" name="pass[]" class="form-control input-number quantity packages" value="{{isset($cartdata['itemid'])?(array_search($c->id,$cartdata['itemid'])!==false?(isset($cartdata['pass'])?($cartdata['pass'][array_search($c->id,$cartdata['itemid'])]??0):0):0):0}}" min="1" max="100">
                                                                    <span class="input-group-btn">
                                                <button type="button" class="quantity-right-plus btn btn-quant btn-number" data-type="plus" data-field="" packageid="{{$c->id}}" type1="package">
                                                <i class="fa fa-plus" aria-hidden="true"></i>
                                                </button>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-12 px-2">
                                                <p class="px-2"><a href="#" data-toggle="collapse" data-target="#elig-box-{{$c->id}}" class="" aria-expanded="true">show more</a></p>
                                                </div>
                                                <div class="col-12 eligibal p-2 collapse px-4" id="elig-box-{{$c->id}}">
                                                        <div class="arrow-up"></div>
                                                        <p class="h5">{{$c->custom_package_detail}}</p>
                                                        <div class="row">
                                                            @foreach($c->activemenus as $m)

                                                            <div class="col-6">
                                                                <p class="text-justify"><span class="heading"><i class="fa fa-circle" aria-hidden="true"></i></span>{{$m->name}}</p>
                                                            </div>
                                                            @endforeach
                                                        </div>
                                                </div>
                                    </div>
                                    @endforeach

                                </div>
                            @endif
                            <div class="col-12 event">
                                <div class="">
                                    <h2 class="text-center py-2 mb-4">Book Your Pass Now</h2>

                                    <div class="form-group">
                                        <label for="exampleInputname1">Your Name</label>
                                        <input type="text" class="form-control" id="booking-name" aria-describedby="nameHelp" name="name" value="{{$cartdata['name']??''}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Your Email</label>
                                        <input type="email" class="form-control" id="booking-email" aria-describedby="emailHelp" name="email" value="{{$cartdata['email']??''}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Your Mobile</label>
                                        <input type="text" class="form-control" id="booking-mobile" name="mobile" value="{{$cartdata['mobile']??''}}" maxlength="10">
                                    </div>
                                    <button type="submit" class="btn btn-form btn-block">Book Now</button>
                                </div>
                            </div>
                        </div>
                         </form>
                    </div>

            </div>
            @if(!empty($event->reviews->toArray()))
            <div class="row py-5 event-section event">
                <div class="col-12"><h2 class="heading"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>User Reviews</h2></div>


                    @foreach($event->reviews as $r)
                        <div class="reviews col-12">
                            <div class="row blockquote review-item">
                                <div class="col-4 text-center">
                                    <img class="rounded-circle review-image" src="{{$r->user->image}}">
                                </div>
                                <div class="col-8">
                                    <h6 class="heading">{{$r->user->name??'User'}}</h6>
                                   <!-- <div class="ratebox text-center" data-id="0" data-rating="5"></div>-->
                                    <div class="rate  px-2">
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star-half-o" aria-hidden="true"></i>
                                    </div>
                                    <p class="review-text">{{$r->description}}</p>
                                    <p>{{date('D,d M Y', strtotime($r->created_at))}}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach

            </div>

        </div>
        @endif
    </section>
    <!-- page container Ends-->
@endsection
@section('scripts')
    <script>
        $(document).ready(function(){
            $('.customer-logos').slick({
                slidesToShow: 3,
                slidesToScroll: 1,
                autoplay: true,
                autoplaySpeed: 500,
                arrows: false,
                dots: false,
                pauseOnHover: true,

            });
        });

        function checkEventBook(){
            canOrder=false
            $('.covers').each(function(){
                if($(this).val()>0){
                    canOrder=true
                    return false
                }

            })

            $('.packages').each(function(){
                if($(this).val()>0){
                    canOrder=true
                    return false
                }
            })

            if(canOrder==false){
                $("#error-msg").html('Please select atleast one package')
                $("#page-errors").show()
                $("#page-errors").get(0).scrollIntoView()
                return false
            }

            if($("#booking-email").val()==''){
                $("#error-msg").html('Please enter email')
                $("#page-errors").show()
                $("#page-errors").get(0).scrollIntoView()
                return false
            }

            if($("#booking-mobile").val()==''){
                $("#error-msg").html('Please enter mobile')
                $("#page-errors").show()
                $("#page-errors").get(0).scrollIntoView()

                return false
            }

            if($("#booking-name").val()==''){
                $("#error-msg").html('Please enter name')
                $("#page-errors").show()
                $("#page-errors").get(0).scrollIntoView()
                return false
            }
        }

    </script>

    <script>
        // Initialize and add the map
        function initMap() {
            // The location of Uluru
            var uluru = {lat: {{$event->lat}}, lng: {{$event->lang}}  };
            // The map, centered at Uluru
            var map = new google.maps.Map(
                document.getElementById('map'), {zoom: 17, center: uluru});
            // The marker, positioned at Uluru
            var marker = new google.maps.Marker({position: uluru, map: map});
        }
    </script>
    <!--Load the API from the specified URL
    * The async attribute allows the browser to render the page while the API loads
    * The key parameter will contain your own API key (which is not needed for this tutorial)
    * The callback parameter executes the initMap() function
    -->
    <script async defer
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBdnpGnI038nDRtvM7LbCrBClPnLeXvpfc&libraries=places&callback=initMap">
    </script>
@endsection
