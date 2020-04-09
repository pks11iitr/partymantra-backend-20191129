@extends('Website.layout')
@section('contents')
    <style>
    /* Set the size of the div element that contains the map */
    #map {
    height: 400px;  /* The height is 400 pixels */
    width: 100%;  /* The width is the width of the web page */
    }
    </style>
    <!-- Breadcrumb Starts-->
    @if ($errors->any())
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert">×</button>
            {{$errors->first()}}
        </div>
    @endif
    <section class="section pagecrumb" style="background-image:url({{$restaurant->header_image}}); background-repeat: no-repeat;background-size: cover;">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center py-4">
                    <h2 class="pagebrumb heading text-light">{{$restaurant->name}}</h2>
                    <p class="text-light">{{$restaurant->short_address}}</p>
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
                            <h2 class="heading">{{$restaurant->name}}</h2>
                            <p class="px-2">{{$restaurant->short_address}}</p>
                            <div class="rate  px-2">
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star-half-o" aria-hidden="true"></i>
                            </div>
                            <p class="text-justify px-2">{{$restaurant->description}}</p>
                        </div>
                        <div class="col-12 event">
                            <h2 class="heading"><i class="fa fa-info-circle" aria-hidden="true"></i> About <span class="float-right"><a href="tel:+91-{{$restaurant->contact_no}}" class="heading"><i class="fa fa-phone" aria-hidden="true"></i> Call</a></span></h2>
                            <div class="row py-2">

                                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                    <p><strong><i class="fa fa-clock-o" aria-hidden="true"></i> Time</strong><br> {{$restaurant->open}}-{{$restaurant->close}}</p>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                    <p><strong><i class="fa fa-rupee" aria-hidden="true"></i> Everage Cost</strong><br> {{$restaurant->per_person_text}}</p>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                    <p><strong><i class="fa fa-mobile" aria-hidden="true"></i> Contact Number</strong><br> +91-{{$restaurant->contact_no}}</p>
                                </div>
                            </div>
                            <h6><i class="fa fa-heart" aria-hidden="true"></i> Facilities</h6>
                            <div class="row px-2">
                                @foreach($restaurant->facilities as $facility)
                                    <div class="col-6">
                                        <p class="text-justify"><span class="heading h6" style="margin-right:5px;"><i class="fa fa-check-square-o" aria-hidden="true"></i></span>{{$facility->name}}</p>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="col-12 event">
                            <h2 class="heading"><i class="fa fa-map-marker" aria-hidden="true"></i> Address </h2>
                            <p class="">{{$restaurant->address}}</p>
                            <div class="map py-2">
                                <div id="map"></div>
                            </div>
                        </div>

                        @if(!empty($restaurant->gallery->toArray()))
                            <div class="col-12 event">
                                <h2 class="heading"><i class="fa fa-image" aria-hidden="true"></i> Gallery</h2>
                                <div class="customer-logos row">
                                    @foreach($restaurant->gallery as $image)
                                        <div class="slide col-4 mt-4 service-box">
                                            <div class="">
                                                <div class="card">
                                                    <div class="cardimg">
                                                        <a class="thumbnail" href="#" data-image-id="" data-toggle="modal" data-image="{{$image->doc_path}}" data-target="#image-gallery">
                                                            <img class="card-img-top img-fluid" src="{{$image->doc_path}}" style="height:120px;" alt="Short alt text">
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
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
                        @endif
                        <div class="col-12 event">
                            <ul class="nav nav-pills nav-justified protab" id="pills-tab" role="tablist">
                                <li class="nav-item pro-item">
                                    <a class="nav-link pro-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Party Packages</a>
                                </li>
                            </ul>
                            <div class="tab-content px-2 bg-white" id="pills-tabContent">
                                <div class="tab-pane fade show active" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                                    <div class="row">
                                        <div class="col-12">
                                            @if($restaurant->packages->toArray())
                                            @foreach($restaurant->packages as $package)
                                            <div class="row reviews">
                                                <div class="col-4 py-2">
                                                    <p class="h3"><strong>{{$package->package_name}}</strong><p><p>{{$package->text_under_name}}</p>
                                                    
                                                </div>
                                                <div class="col-4 py-2">
                                                    <p>Rs.{{$package->price}}</p>
                                                </div>
                                                <div class="col-4 py-2">
                                                    <div class="input-group">
                                                         <span class="input-group-btn">
                                                             <button type="button" class="quantity-minus-item btn btn-quant btn-number"  data-type="minus" data-field="" itemtype="package" itemid='{{$package->id}}' itemprice="{{$package->price}}" itemname="{{$package->package_name}}">
                                                             <i class="fa fa-minus" aria-hidden="true"></i>
                                                             </button>
                                                         </span>
                                                         <input type="text" id="package-{{$package->id}}" name="quantity" class="form-control input-number quantity" value="{{isset($cartdata['itemid'])?(array_search($package->id,$cartdata['itemid'])!==false?(isset($cartdata['pass'])?($cartdata['pass'][array_search($package->id,$cartdata['itemid'])]??0):0):0):0}}" min="1" max="100">
                                                        <span class="input-group-btn">
                                                             <button type="button" class="quantity-plus-item btn btn-quant btn-number" data-type="plus" data-field="" itemtype="package" itemid='{{$package->id}}' itemprice="{{$package->price}}" itemname="{{$package->package_name}}">
                                                             <i class="fa fa-plus" aria-hidden="true"></i>
                                                             </button>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="col-12 px-2">
                                                <p class="px-2"><a href="#" data-toggle="collapse" data-target="#elig-box-{{$package->id}}" class="" aria-expanded="true">show more</a></p>
                                                </div>
                                                <div class="col-12 eligibal p-2 collapse px-4" id="elig-box-{{$package->id}}">
                                                        <div class="arrow-up"></div>
                                                        <p class="h5">{{$package->custom_package_detail}}</p>
                                                        <div class="row">
                                                            @foreach($package->activemenus as $m)
                                                            <div class="col-6">
                                                                <p class="text-justify"><span class="heading"><i class="fa fa-circle" aria-hidden="true"></i></span>{{$m->name}}</p>
                                                            </div>
                                                            @endforeach
                                                        </div>
                                                </div>
                                        </div>
                                                <!--<table class="table table-hover">
                                                    <tbody>
                                                    @foreach($restaurant->packages as $package)
                                                        <tr>
                                                            <td scope="col">
                                                                {{--                                                          <img src="img/events/e1.jpg" style="width:60px; height:60px;" class="img-responsive rounded">--}}
                                                            </td>
                                                            <td scope="col" class="py-4"><strong>{{$package->package_name}}</strong><br>
                                                                <small>Rs.{{$package->price}}</small>
                                                            </td>
                                                            <td scope="col">
                                                                <div class="input-group">
                                             <span class="input-group-btn">
                                             <button type="button" class="quantity-minus-item btn btn-quant btn-number"  data-type="minus" data-field="" itemtype="package" itemid='{{$package->id}}' itemprice="{{$package->price}}" itemname="{{$package->package_name}}">
                                             <i class="fa fa-minus" aria-hidden="true"></i>
                                             </button>
                                             </span>
                                                                    <input type="text" id="package-{{$package->id}}" name="quantity" class="form-control input-number quantity" value="{{isset($cartdata['itemid'])?(array_search($package->id,$cartdata['itemid'])!==false?(isset($cartdata['pass'])?($cartdata['pass'][array_search($package->id,$cartdata['itemid'])]??0):0):0):0}}" min="1" max="100">
                                                                    <span class="input-group-btn">
                                             <button type="button" class="quantity-plus-item btn btn-quant btn-number" data-type="plus" data-field="" itemtype="package" itemid='{{$package->id}}' itemprice="{{$package->price}}" itemname="{{$package->package_name}}">
                                             <i class="fa fa-plus" aria-hidden="true"></i>
                                             </button>
                                             </span>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>-->
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-5 col-lg-5 col-sm-12 col-xs-12 px-2">
                    <form action="{{route('website.book')}}" method="post" onsubmit="return checkPartyBook()">
                    <!----- Sidebar Starts---->
                        <div class="alert alert-danger" id="page-errors" style="display:none">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <p id="error-msg"></p>
                        </div>
                    <input type="hidden" value="party" name="type">
                    <input type="hidden" name="entity_id" value="{{$restaurant->id??''}}">

                    <div clss="row">
                        <div class="col-12 event">
                                <h2 class="heading">Booking Details </h2>
                                <table class="table table-hover">
                                    <tbody id="selected_elements">

                                    @if($restaurant->packages->toArray())
                                        @foreach($restaurant->packages as $package)
                                            @if(isset($cartdata['itemid']) && array_search($package->id, array_values($cartdata['itemid']))!==false)
                                                <tr itemid="{{$package->id}}" itemtype="package" class="selected-items">
                                                    <td scope="col" class="py-4"><strong>{{$package->package_name}}</strong><br>
                                                        <small>Rs.{{$package->price}}</small>
                                                    </td>
                                                    <td scope="col" class="py-4">
                                                        {{isset($cartdata['itemid'])?(array_search($package->id,$cartdata['itemid'])!==false?(isset($cartdata['pass'])?($cartdata['pass'][array_search($package->id,$cartdata['itemid'])]??0):0):0):0}}
                                                    </td>
                                                    <td scope="col"class="py-4">
                                                        Rs.{{(isset($cartdata['itemid'])?(array_search($package->id,$cartdata['itemid'])!==false?(isset($cartdata['pass'])?($cartdata['pass'][array_search($package->id,$cartdata['itemid'])]??0):0):0):0)*$package->price}}
                                                        <span class="pull-right ml-3"><i class="fa fa-times" aria-hidden="true"></i></span>
                                                    </td>
                                                    <input type="hidden" name="itemid[]" value="{{$package->id}}">
                                                    <input type="hidden" name="pass[]" value="{{isset($cartdata['itemid'])?(array_search($package->id,$cartdata['itemid'])!==false?(isset($cartdata['pass'])?($cartdata['pass'][array_search($package->id,$cartdata['itemid'])]??0):0):0):0}}">
                                                </tr>
                                            @endif
                                        @endforeach
                                    @endif

                                    </tbody>
                                    <tfoot>
                                    {{--                                <th colspan="3" class="text-right"> Total</th>--}}
                                    {{--                                <th> Rs.1500</th>--}}
                                    </tfoot>

                                </table>
                            </div>
                            <div class="col-12 event">
                                <div class="">


                                    <h2 class="text-center py-2 mb-4">Book Your Party Now</h2>
                                <div class="form-group row">
                                    <div class="col-12">
                                        <div id="calendar-container">
                                          <h1 id="calendar-title">
                                            <div class="btn clndr left"><</div>
                                            <span>April, 2019</span>
                                            <div class="btn clndr right">></div>
                                          </h1>
                                          <table id="calendar-table">
                                            <tr>
                                              <th>Sun</th>
                                              <th>Mon</th>
                                              <th>Tue</th>
                                              <th>Wed</th>
                                              <th>Thu</th>
                                              <th>Fri</th>
                                              <th>Sat</th>
                                            </tr>
                                            <tr>
                                              <td></td>
                                              <td>1</td>
                                              <td>2</td>
                                              <td>3</td>
                                              <td>4</td>
                                              <td>5</td>
                                              <td>6</td>
                                            </tr>
                                            <tr>
                                              <td>7</td>
                                              <td>8</td>
                                              <td>9</td>
                                              <td>10</td>
                                              <td>11</td>
                                              <td>12</td>
                                              <td>13</td>
                                            </tr>
                                            <tr>
                                              <td>14</td>
                                              <td>15</td>
                                              <td>16</td>
                                              <td>17</td>
                                              <td>18</td>
                                              <td>19</td>
                                              <td>20</td>
                                            </tr>
                                            <tr>
                                              <td>21</td>
                                              <td>22</td>
                                              <td>23</td>
                                              <td>24</td>
                                              <td>25</td>
                                              <td>26</td>
                                              <td>27</td>
                                            </tr>
                                            <tr>
                                              <td>28</td>
                                              <td>29</td>
                                              <td>30</td>
                                              <td></td>
                                              <td></td>
                                              <td></td>
                                              <td></td>
                                            </tr>

                                          </table>
                                          <p id="date-text"></p>
                                            <input type="hidden" name="date" value="" id="selected-date">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputname1">Choose Slot</label>
                                    <div class="form-group row mb-2">
                                        @foreach(explode(',',$restaurant->party_timings) as $t)
                                    <div class="col-6 text-center form-check form-check-inline d-flex justify-content-center">
                                      <input class="form-check-input" type="radio" name="time" id="inlineRadio1" value="{{$t}}">
                                      <label class="form-check-label slot-lable" for="inlineRadio1">{{$t}}</label>
                                    </div>
                                            @endforeach
                                    </div>
                                </div>
                                    <div class="row py-2">
                                        <div class="col-8">
                                            <p>Men </p>
                                        </div>
                                        <div class="col-4">
                                            <div class="input-group">
                                 <span class="input-group-btn">
                                 <button type="button" class="quantity-ratio-minus btn btn-quant btn-number"  data-type="minus" data-field="" ratioid="men">
                                 <i class="fa fa-minus" aria-hidden="true"></i>
                                 </button>
                                 </span>
                                                <input type="text" name="men" class="form-control input-number quantity" value="{{$cartdata['men']??0}}" min="1" max="100" id="quantity-men">
                                                <span class="input-group-btn">
                                 <button type="button" class="quantity-ratio-plus btn btn-quant btn-number" data-type="plus" data-field="" ratioid="men">
                                 <i class="fa fa-plus" aria-hidden="true"></i>
                                 </button>
                                 </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row py-2">
                                        <div class="col-8">
                                            <p>Women </p>
                                        </div>
                                        <div class="col-4">
                                            <div class="input-group">
                                 <span class="input-group-btn">
                                 <button type="button" class="quantity-ratio-minus btn btn-quant btn-number"  data-type="minus" data-field="" ratioid="women">
                                 <i class="fa fa-minus" aria-hidden="true"></i>
                                 </button>
                                 </span>
                                                <input type="text" class="form-control input-number quantity" value="{{$cartdata['women']??0}}" min="1" max="100" id="quantity-women" name="women">
                                                <span class="input-group-btn">
                                 <button type="button" class="quantity-ratio-plus btn btn-quant btn-number" data-type="plus" data-field="" ratioid="women">
                                 <i class="fa fa-plus" aria-hidden="true"></i>
                                 </button>
                                 </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row py-2">
                                        <div class="col-8">
                                            <p>Couple </p>
                                        </div>
                                        <div class="col-4">
                                            <div class="input-group">
                                 <span class="input-group-btn">
                                 <button type="button" class="quantity-ratio-minus btn btn-quant btn-number"  data-type="minus" data-field="" ratioid="couple">
                                 <i class="fa fa-minus" aria-hidden="true"></i>
                                 </button>
                                 </span>
                                                <input type="text" name="couple" class="form-control input-number quantity" value="{{$cartdata['couple']??0}}" min="1" max="100" id="quantity-couple">
                                                <span class="input-group-btn">
                                 <button type="button" class="quantity-ratio-plus btn btn-quant btn-number" data-type="plus" data-field="" ratioid="couple">
                                 <i class="fa fa-plus" aria-hidden="true"></i>
                                 </button>
                                 </span>
                                            </div>
                                        </div>
                                    </div>
                                    </br>
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
                                    {{--                                    <div class="form-group form-check">--}}
                                    {{--                                        <input type="checkbox" class="form-check-input" id="exampleCheck1">--}}
                                    {{--                                        <label class="form-check-label" for="exampleCheck1">Accept <a href="">Terms & Cond.</a></label>--}}
                                    {{--                                    </div>--}}
                                    <input type="hidden" name="date" value="2020-12-11">
                                    <input type="hidden" name="time" value="11:00AM">
                                    <button type="submit" class="btn btn-form btn-block">Book Now</button>

                                </div>
                            </div>
                        </div>
                        </form>
                    </div>
                    <!----- Sidebar Ends---->

            </div>
            <!----- Review Section Starts---->
            @if(!empty($restaurant->reviews->toArray()))
            <div class="row py-5 event-section event">
                <h2 class="heading"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Customer Reviews</h2>
                @foreach($restaurant->reviews as $review)
                    <div class="reviews col-12">
                        <div class="review-item">
                            <div class="row">
                                <div class="col-4 text-center">
                                    <img class="rounded-circle review-image" src="{{$review->user->image}}">
                                </div>
                                <div class="col-8">
                                    <h6 class="heading">{{$review->user->name}}</h6>
                                   <!-- <div class="ratebox text-center" data-id="0" data-rating="5"></div>-->
                                   <div class="rate  px-2">
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star-half-o" aria-hidden="true"></i>
                                    </div>
                                    <p class="review-text">{{$review->description}}</p>
                                    <p>{{date('D, M d, Y', strtotime($review->created_at))}}</p>
                                </div>
                            </div>
                        </div>

                    </div>
                @endforeach
            </div>
            @endif
            <!----- Review Section Ends---->
        </div>
    </section>
    <!-- page container Ends-->
          <style>
  .form-check-inline .form-check-input{
  display:none;
  }
   .form-check-inline{
  margin-right:0;
  }

  .slot-lable {
    cursor: pointer;
    background: #e2e2e2;
    padding: 6px 15px;
}
    .slot-lable:hover{
        cursor: pointer;
        background: #ec7160;
        color:#fff;
    }
  </style>
@endsection
@section('scripts')
    <script>
        //clearGrid()
        renderCalendar();
        function checkPartyBook(){

            if($("#selected-date").val()==''){
                $("#error-msg").html('Please select date')
                $("#page-errors").show()
                $("#page-errors").get(0).scrollIntoView()
                return false
            }

            if(!$("input[name='time']:checked").val()){
                $("#error-msg").html('Please select time slot')
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
            var uluru = {lat: {{$restaurant->lat}}, lng: {{$restaurant->lang}}  };
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
