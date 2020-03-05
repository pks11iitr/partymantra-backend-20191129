@extends('Website.layout')
@section('contents')
    <!-- Breadcrumb Starts-->
    @if ($errors->any())
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <?php var_dump($errors) ?>
        </div>
    @endif
    <section class="section pagecrumb" style="background-image:url({{$restaurant->header_image}});">
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
                            <h2 class="heading"><i class="fa fa-info-circle" aria-hidden="true"></i> About <span class="float-right"><a href="" class="heading"><i class="fa fa-phone" aria-hidden="true"></i> Call</a></span></h2>
                            <div class="row py-2 text-center">
                                <div class="col-3">
                                    <p><strong><i class="fa fa-map-marker" aria-hidden="true"></i> Address</strong><br>{{$restaurant->address}}</p>
                                </div>
                                <div class="col-3">
                                    <p><strong><i class="fa fa-clock-o" aria-hidden="true"></i> Time</strong><br>{{$restaurant->open}}-{{$restaurant->close}}</p>
                                </div>
                                <div class="col-3">
                                    <p><strong><i class="fa fa-rupee" aria-hidden="true"></i> Everage Cost</strong><br>{{$restaurant->per_person_text}}</p>
                                </div>
                                <div class="col-3">
                                    <p><strong><i class="fa fa-mobile" aria-hidden="true"></i> Contact Number</strong><br>+91-{{$restaurant->contact_no}}</p>
                                </div>
                            </div>
                            <h6><i class="fa fa-heart" aria-hidden="true"></i> Facilities</h6>
                            <div class="row px-2">
                                @foreach($restaurant->facilities as $facility)
                                    <div class="col-4">
                                        <p class="text-justify"><span class="heading h6" style="margin-right:5px;"><i class="fa fa-check-square-o" aria-hidden="true"></i></span>{{$facility->name}}</p>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        {{--
                        <div class="col-12 event">
                           --}}
                        {{--
                        <h2 class="heading"><i class="fa fa-calendar-check-o" aria-hidden="true"></i> Event Description </h2>
                        --}}
                        {{--
                        <p class="text-justify">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                        --}}
                        {{--
                     </div>
                     --}}
                        @if(!empty($restaurant->eventparty->toArray()))
                            <div class="col-12 pb-5 event carousel slider">
                                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                                    <ol class="carousel-indicators">
                                        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                                        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                                        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                                    </ol>
                                    <div class="carousel-inner slider-inner">
                                        @foreach($restaurant->eventparty as $image)
                                            <div class="carousel-item slider-item active">
                                                @if($image->other_type=='partyonrestaurant')
                                                    <a href="{{route('website.party.details',['id'=>$image->other_id])}}"><img src="{{$image->doc_path}}" class="img-fluid d-block w-100" alt="..."></a>
                                                @else
                                                    <a href="{{route('website.event.details',['id'=>$image->other_id])}}"><img src="{{$image->doc_path}}" class="img-fluid d-block w-100" alt="..."></a>
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
                                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </div>
                            </div>
                        @endif
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
                                                            <img class="card-img-top img-fluid" src="{{$image->doc_path}}" style="height:200px;" alt="Short alt text">
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
                                    <a class="nav-link pro-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Menu</a>
                                </li>
                                <li class="nav-item pro-item">
                                    <a class="nav-link pro-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Combos</a>
                                </li>
                            </ul>
                            <div class="tab-content px-2 bg-white" id="pills-tabContent">
                                <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                                    <div class="row">
                                        <div class="col-12">
                                            @if($restaurant->menus->toArray())
                                                <table class="table table-hover">
                                                    <tbody>
                                                    @foreach($restaurant->menus as $menu)
                                                        <tr>
                                                            <td scope="col"><img src="{{$menu->image}}" style="width:60px; height:60px;" class="img-responsive rounded"></td>
                                                            <td scope="col" class="py-4"><strong>{{$menu->name}}</strong><br>
                                                                <small>Rs.500</small>
                                                            </td>
                                                            <td scope="col">
                                                                <div class="input-group">
                                             <span class="input-group-btn">
                                             <button type="button" class="quantity-minus-item btn btn-quant btn-number"  data-type="minus" data-field="" itemtype="menu" itemid='{{$menu->id}}' itemprice="250" itemname="{{$menu->name}}">
                                             <i class="fa fa-minus" aria-hidden="true"></i>
                                             </button>
                                             </span>
                                                                    <input type="text" id="menu-{{$menu->id}}" name="quantity" class="form-control input-number quantity" value="{{isset($cartdata['menuid'])?(array_search($menu->id,$cartdata['menuid'])!==false?(isset($cartdata['quantity'])?($cartdata['quantity'][array_search($menu->id,$cartdata['menuid'])]??0):0):0):0}}" min="1" max="100">
                                                                    <span class="input-group-btn">
                                             <button type="button" class="quantity-plus-item btn btn-quant btn-number" data-type="plus" data-field="" itemtype="menu" itemid='{{$menu->id}}' itemprice="250" itemname="{{$menu->name}}">
                                             <i class="fa fa-plus" aria-hidden="true"></i>
                                             </button>
                                             </span>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade show active" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                                    <div class="row">
                                        <div class="col-12">
                                            @if($restaurant->packages->toArray())
                                                <table class="table table-hover">
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
                                                </table>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <form action="{{route('website.book')}}" method="post">
                <!----- Sidebar Starts---->
                    <input type="hidden" value="restaurant" name="type">
                    <input type="hidden" name="entity_id" value="{{$restaurant->id??''}}">
                <div class="col-md-5 col-lg-5 col-sm-12 col-xs-12 px-2">
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

                                @if($restaurant->menus->toArray())
                                    @foreach($restaurant->menus as $menu)
                                        @if(isset($cartdata['menuid']) && array_search($menu->id, array_values($cartdata['menuid']))!==false)

                                            <tr itemid="{{$menu->id}}" itemtype="menu" class="selected-items">
                                                <td scope="col" class="py-4"><strong>{{$menu->name}}</strong><br>
                                                    <small>Rs.{{$menu->price}}</small>
                                                </td>
                                                <td scope="col" class="py-4">
                                                    {{isset($cartdata['menuid'])?(array_search($menu->id,$cartdata['menuid'])!==false?(isset($cartdata['quantity'])?($cartdata['quantity'][array_search($menu->id,$cartdata['menuid'])]??0):0):0):0}}
                                                </td>
                                                <td scope="col"class="py-4">
                                                    Rs.{{(isset($cartdata['menuid'])?(array_search($menu->id,$cartdata['menuid'])!==false?(isset($cartdata['quantity'])?($cartdata['quantity'][array_search($menu->id,$cartdata['menuid'])]??0):0):0):0)*$package->price}}
                                                    <span class="pull-right ml-3"><i class="fa fa-times" aria-hidden="true"></i></span>
                                                </td>
                                                <input type="hidden" name="menuid[]" value="{{$menu->id}}">
                                                <input type="hidden" name="quantity[]" value="{{isset($cartdata['menuid'])?(array_search($menu->id,$cartdata['menuid'])!==false?(isset($cartdata['quantity'])?($cartdata['quantity'][array_search($menu->id,$cartdata['menuid'])]??0):0):0):0}}">
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


                                    <h2 class="text-center py-2 mb-4">Book Your Table Now</h2>
                                    <div class="row py-2">
                                        <div class="col-6">
                                            <p>Men </p>
                                        </div>
                                        <div class="col-6">
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
                                    <div class="row">
                                        <div class="col-6">
                                            <p>Women </p>
                                        </div>
                                        <div class="col-6">
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
                                    <div class="row">
                                        <div class="col-6">
                                            <p>Couple </p>
                                        </div>
                                        <div class="col-6">
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
                                        <input type="text" class="form-control" id="exampleInputname1" aria-describedby="nameHelp" name="name" value="{{$cartdata['name']??''}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Your Email</label>
                                        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email" value="{{$cartdata['email']??''}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Your Mobile</label>
                                        <input type="text" class="form-control" id="exampleInputmobile" name="mobile" value="{{$cartdata['mobile']??''}}">
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
                </div>
                <!----- Sidebar Ends---->
                </form>
            </div>
            <!----- Review Section Starts---->
            <div class="row py-5 event-section event">
                <h2 class="heading"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Customer Reviews</h2>
                {{--
                <div class="col-12 py-4 reviews">
                   --}}
                {{--
                <form>
                   --}}
                {{--
                <div class="form-group row">
                   --}}
                {{--						<label for="inputEmail3" class="col-sm-3 col-form-label">Your Review</label>--}}
                {{--
                <div class="col-sm-9">--}}
                {{--						  <textarea name="comment" class="form-control"></textarea>--}}
                {{--
             </div>
             --}}
                {{--
             </div>
             --}}
                {{--
                <div class="form-group row">
                   --}}
                {{--
                <div class="col-sm-9 offset-sm-3">--}}
                {{--						  <button type="submit" class="btn btn-form btn-block">Submit</button>--}}
                {{--
             </div>
             --}}
                {{--
             </div>
             --}}
                {{--
             </form>
             --}}
                {{--
             </div>
             --}}
                @foreach($restaurant->reviews as $review)
                    <div class="reviews">
                        <div class="row blockquote review-item">
                            <div class="col-3 text-center">
                                <img class="rounded-circle reviewer" src="{{$review->user->image}}">
                            </div>
                            <div class="col-9">
                                <h6 class="heading">{{$review->user->name}}</h6>
                                <div class="ratebox text-center" data-id="0" data-rating="5"></div>
                                <p class="review-text">{{$review->description}}</p>
                                <p>{{date('D, M d, Y', strtotime($review->created_at))}}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <!----- Review Section Ends---->
        </div>
    </section>
    <!-- page container Ends-->
@endsection
