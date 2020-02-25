@extends('Website.layout')
@section('contents')
    <!-- Breadcrumb Starts-->
    <section class="section pagecrumb" style="background-image:url({{$event->header_image}});">
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
                <div class="col-md-8 col-lg-8 col-sm-12 col-xs-12">
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
                                <h3>Find Us:</h3>
                                <div class="location">
                                    <div class="map-responsive">
                                        <iframe src="https://www.google.com/maps/embed/v1/place?key=AIzaSyA0s1a7phLN0iaD6-UE7m4qP-z21pH0eSc&q=Eiffel+Tower+Paris+France" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 event">
                            <h2 class="heading"><i class="fa fa-calendar-check-o" aria-hidden="true"></i> Event Description </h2>
                            <p class="text-justify">{{$event->description}}</p>
                        </div>

                        <div class="col-12 event">
                            <h2 class="heading"><i class="fa fa-calendar-plus-o" aria-hidden="true"></i> More Info</h2>
                            @foreach($event->facilities as $f)
                            <p class="text-justify"><span class="heading h6" style="margin-right:5px;"><i class="fa fa-check-square-o" aria-hidden="true"></i></span>{{$f->name}}</p>
                            @endforeach
                        </div>
                        @if(!empty($event->gallery))
                        <div class="col-12 event">
                            <h2 class="heading"><i class="fa fa-image" aria-hidden="true"></i> Gallery</h2>
                            <div class="customer-logos row">
                                @foreach($event->gallery as $g)
                                <div class="slide col-4 mt-4 service-box">
                                    <div class="">
                                        <div class="card">
                                            <div class="cardimg">
                                                <a class="thumbnail" href="#" data-image-id="" data-toggle="modal" data-image="img/events/e1.jpg" data-target="#image-gallery">
                                                    <img class="card-img-top img-fluid" src="{{$g->doc_path}}" style="height:200px;" alt="Short alt text">
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
                <div class="col-md-4 col-lg-4 col-sm-12 col-xs-12 px-2">
                    <div clss="row">
                        @if(!empty($event->covers))
                        <div class="col-12 event">
                            <h2 class="heading">Cover charges</h2>
                            <table class="table">
                                <thead>
                                <tr>

                                    <th scope="col">Packages</th>
                                    <th scope="col">Price</th>
                                    <th scope="col"></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($event->covers as $c)
                                <tr>

                                    <td>{{$c->}}</td>
                                    <td>Rs.1213</td>
                                    <td>
                                        <div class="input-group">
                                    <span class="input-group-btn">
                                        <button type="button" class="quantity-left-minus btn btn-quant btn-number"  data-type="minus" data-field="">
                                          <i class="fa fa-minus" aria-hidden="true"></i>
                                        </button>
                                    </span>
                                            <input type="text" id="quantity" name="quantity" class="form-control input-number" value="10" min="1" max="100">
                                            <span class="input-group-btn">
                                        <button type="button" class="quantity-right-plus btn btn-quant btn-number" data-type="plus" data-field="">
                                            <i class="fa fa-plus" aria-hidden="true"></i>
                                        </button>
                                    </span>
                                        </div>
                                    </td>
                                </tr>
                                @endfor
                                </tbody>
                            </table>

                        </div>
                        @endif
                        <div class="col-12 event">
                            <div class="">
                                <form class="event-form ">
                                    <h2 class="text-center py-2 mb-4">Book Your Slot Now..</h2>
                                    <div class="row py-2">
                                        <div class="col-6">
                                            <p>Men </p>

                                        </div>
                                        <div class="col-6">
                                            <div class="input-group">
											<span class="input-group-btn">
												<button type="button" class="quantity-left-minus btn btn-quant btn-number"  data-type="minus" data-field="">
												  <i class="fa fa-minus" aria-hidden="true"></i>
												</button>
											</span>
                                                <input type="text" id="quantity" name="quantity" class="form-control input-number" value="10" min="1" max="100">
                                                <span class="input-group-btn">
												<button type="button" class="quantity-right-plus btn btn-quant btn-number" data-type="plus" data-field="">
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
												<button type="button" class="quantity-left-minus btn btn-quant btn-number"  data-type="minus" data-field="">
												  <i class="fa fa-minus" aria-hidden="true"></i>
												</button>
											</span>
                                                <input type="text" id="quantity" name="quantity" class="form-control input-number" value="10" min="1" max="100">
                                                <span class="input-group-btn">
												<button type="button" class="quantity-right-plus btn btn-quant btn-number" data-type="plus" data-field="">
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
												<button type="button" class="quantity-left-minus btn btn-quant btn-number"  data-type="minus" data-field="">
												  <i class="fa fa-minus" aria-hidden="true"></i>
												</button>
											</span>
                                                <input type="text" id="quantity" name="quantity" class="form-control input-number" value="10" min="1" max="100">
                                                <span class="input-group-btn">
												<button type="button" class="quantity-right-plus btn btn-quant btn-number" data-type="plus" data-field="">
													<i class="fa fa-plus" aria-hidden="true"></i>
												</button>
											</span>
                                            </div>
                                        </div>
                                    </div>
                                    </br>
                                    <div class="form-group">
                                        <label for="exampleInputname1">Your Name</label>
                                        <input type="text" class="form-control" id="exampleInputname1" aria-describedby="nameHelp">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Your Email</label>
                                        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Your Mobile</label>
                                        <input type="text" class="form-control" id="exampleInputmobile">
                                    </div>
                                    <div class="form-group form-check">
                                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                        <label class="form-check-label" for="exampleCheck1">Accept <a href="">Terms & Cond.</a></label>
                                    </div>
                                    <button type="submit" class="btn btn-form btn-block">Book Now</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row py-5 event-section event">
                <h2 class="heading"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Leave Your Reviews</h2>
                <div class="col-12 py-4 reviews">
                    <form>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-3 col-form-label">Your Review</label>
                            <div class="col-sm-9">
                                <textarea name="comment" class="form-control"></textarea>
                            </div>
                        </div>


                        <div class="form-group row">
                            <div class="col-sm-9 offset-sm-3">
                                <button type="submit" class="btn btn-form btn-block">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="reviews">
                    <div class="row blockquote review-item">
                        <div class="col-3 text-center">
                            <img class="rounded-circle reviewer" src="http://standaloneinstaller.com/upload/avatar.png">
                        </div>
                        <div class="col-9">
                            <h6 class="heading">Joy Ray</h6>
                            <div class="ratebox text-center" data-id="0" data-rating="5"></div>
                            <p class="review-text">My awesome review. My awesome review. My awesome review. My awesome review. My awesome review. My awesome review. My awesome review. My awesome review. My awesome review. My awesome review. My awesome review. </p>
                            <p>Friday, Dec. 13, 2019</p>
                        </div>
                    </div>
                </div>
                <div class="reviews">
                    <div class="row blockquote review-item">
                        <div class="col-3 text-center">
                            <img class="rounded-circle reviewer" src="http://standaloneinstaller.com/upload/avatar.png">

                        </div>
                        <div class="col-9">
                            <h6 class="heading">Joe Ray</h4>
                                <div class="ratebox text-center" data-id="0" data-rating="5"></div>
                                <p class="review-text">My awesome review. My awesome review. My awesome review. My awesome review. My awesome review. My awesome review. My awesome review. My awesome review. My awesome review. My awesome review. My awesome review. </p>
                                <p>Friday, Dec. 13, 2019</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
    </script>
@endsection
