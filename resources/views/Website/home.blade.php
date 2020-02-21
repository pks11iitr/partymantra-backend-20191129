@extends('Website.layout')

@section('contents')
<!---- Collection slider Container---->
@if(isset($collections))
<section class="section events">
    <div class="container">
        <div class="section-heading">
            <h2>Popular Collections<span class="pull-right"><a href="" class="btn btn-danger btn-small">View More</a></span>
{{--                <p>Popular Collection</p>--}}
        </div>
        <div class="row blog">
            <div class="col-md-12">
                <div id="blogCarousel" class="carousel slide" data-ride="carousel">

                    <!-- Carousel items -->
                    <div class="carousel-inner">

                        <div class="carousel-item active">
                            <div class="row">
                                <div class="col-4 mt-4 service-box">
                                    <div class="card">
                                        <div class="cardimg">
                                            <img class="card-img-top" src="img/events/e1.jpg">
                                            <span class="card-star">4 <i class="fa fa-star" aria-hidden="true"></i></span>
                                        </div>
                                        <div class="card-block text-center">
                                            <h4 class="card-title">Tawshif Ahsan Khan</h4>
                                            <div class="meta">
                                                <a href="#">Gurgaon</a>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-4 mt-4 service-box">
                                    <div class="card">
                                        <div class="cardimg">
                                            <img class="card-img-top" src="img/events/e4.jpg">
                                            <span class="card-star">3.4 <i class="fa fa-star" aria-hidden="true"></i></span>
                                        </div>
                                        <div class="card-block text-center">
                                            <h4 class="card-title">Tawshif Ahsan Khan</h4>
                                            <div class="meta">
                                                <a href="#">Gurgaon</a>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-4 mt-4 service-box">
                                    <div class="card">
                                        <div class="cardimg">
                                            <img class="card-img-top" src="img/events/e3.jpg">
                                            <span class="card-star">4.2 <i class="fa fa-star" aria-hidden="true"></i></span>
                                        </div>
                                        <div class="card-block text-center">
                                            <h4 class="card-title">Tawshif Ahsan Khan</h4>
                                            <div class="meta">
                                                <a href="#">Gurgaon</a>
                                            </div>

                                        </div>

                                    </div>
                                </div>
                            </div>
                            <!--.row-->
                            <!--.row-->
                        </div>
                        <!--.item-->

                        <div class="carousel-item">
                            <div class="row">
                                <div class="col-4 mt-4 service-box">
                                    <div class="card">
                                        <div class="cardimg">
                                            <img class="card-img-top" src="img/events/e1.jpg">
                                            <span class="card-star">4 <i class="fa fa-star" aria-hidden="true"></i></span>
                                        </div>
                                        <div class="card-block text-center">
                                            <h4 class="card-title">Tawshif Ahsan Khan</h4>
                                            <div class="meta">
                                                <a href="#">Gurgaon</a>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-4 mt-4 service-box">
                                    <div class="card">
                                        <div class="cardimg">
                                            <img class="card-img-top" src="img/events/e4.jpg">
                                            <span class="card-star">3.4 <i class="fa fa-star" aria-hidden="true"></i></span>
                                        </div>
                                        <div class="card-block text-center">
                                            <h4 class="card-title">Tawshif Ahsan Khan</h4>
                                            <div class="meta">
                                                <a href="#">Gurgaon</a>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-4 mt-4 service-box">
                                    <div class="card">
                                        <div class="cardimg">
                                            <img class="card-img-top" src="img/events/e3.jpg">
                                            <span class="card-star">4.2 <i class="fa fa-star" aria-hidden="true"></i></span>
                                        </div>
                                        <div class="card-block text-center">
                                            <h4 class="card-title">Tawshif Ahsan Khan</h4>
                                            <div class="meta">
                                                <a href="#">Gurgaon</a>
                                            </div>

                                        </div>

                                    </div>
                                </div>
                            </div>
                            <!--.row-->
                        </div>
                        <!--.item-->

                    </div>
                    <!--.carousel-inner-->
                    <div class="controls pull-right">
                        <a class="left fa fa-chevron-left btn btn-form" href="#blogCarousel"
                           data-slide="prev"></a>
                        <a class="right fa fa-chevron-right btn btn-form" href="#blogCarousel"
                           data-slide="next"></a>
                    </div>

                </div>
                <!--.Carousel-->

            </div>
        </div>
    </div>
</section>
@endif
<!-- Collection section Ends -->
<!-- Banner section Ends -->
{{--<section class="banner">--}}
{{--    <div class="container">--}}
{{--        <div class="row">--}}
{{--            <div class="col-12">--}}
{{--                <img src="img/banner1.jpg" class="img-responsive img-fluid">--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</section>--}}
<!-- banner section Ends -->

<!-- Evetns Section Starts -->
@if(isset($others))
    @foreach($others as $other)
        <section class="section parties" id="">
            <div class="container">
                <div class="section-heading">
                    <h2>{{$other->name}}<span class="pull-right"><a href="" class="btn btn-danger btn-small">View More</a></span></h2>
                        <p>{{$other->about}}</p>
                </div>
                <div class="row">
                    @foreach($other->$type as $item)
                        @if($type=='event')

                               <div class="col-4 mt-4 service-box">
                               <a href="{{route('website.event.details',['id'=>$item->id])}}">
                                <div class="card">
                                    <div class="cardimg">
                                        <img class="card-img-top" src="{{$item->small_image}}">
                                        <span class="card-star">4 <i class="fa fa-star" aria-hidden="true"></i></span>
                                    </div>
                                    <div class="card-block text-center">
                                        <h4 class="card-title">{{$item->title}}</h4>
                                        <div class="meta">
                                            {{$item->venue_name}}
                                        </div>

                                    </div>
                                </div>
                               </a>
                               </div>
                        @elseif($type=='restaurant')
                            <div class="col-4 mt-4 service-box">
                                <a href="{{route('website.restaurant.details',['id'=>$item->id])}}">
                                    <div class="card">
                                        <div class="cardimg">
                                            <img class="card-img-top" src="{{$item->small_image}}">
                                            <span class="card-star">4 <i class="fa fa-star" aria-hidden="true"></i></span>
                                        </div>
                                        <div class="card-block text-center">
                                            <h4 class="card-title">{{$item->name}}</h4>
                                            <div class="meta">
                                                {{$item->short_address}}
                                            </div>

                                        </div>
                                    </div>
                                </a>
                                </div>
                        @else
                            <div class="col-4 mt-4 service-box">
                                <a href="{{route('website.restaurant.details',['id'=>$item->id])}}">
                                <div class="card">
                                    <div class="cardimg">
                                        <img class="card-img-top" src="img/events/e1.jpg">
                                        <span class="card-star">4 <i class="fa fa-star" aria-hidden="true"></i></span>
                                    </div>
                                    <div class="card-block text-center">
                                        <h4 class="card-title">Tawshif Ahsan Khan</h4>
                                        <div class="meta">
                                            <a href="#">Gurgaon</a>
                                        </div>

                                    </div>
                                </div>
                                </a>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </section>

        <!-- Event Ends -->
        <!-- Banner section Ends -->
        @if(isset($other->banners))
            <section class="carousel slider banners">
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner slider-inner">
                        @foreach($other->banners as $banner)
                            <div class="carousel-item slider-item active">
                                @if($banner->entity_type=='event')
                                    <a href="{{route('website.event.details', ["id"=>$banner->entity_id])}}"><img src="{{$banner->image}}" class="img-fluid d-block w-100" alt="..."></a>
                                @elseif($banner->entity_type=='restaurant')
                                    <a href="{{route('website.restaurant.details', ["id"=>$banner->entity_id])}}"><img src="{{$banner->image}}" class="img-fluid d-block w-100" alt="..."></a>
                                @else
                                    <a href="{{route('website.party.details', ["id"=>$banner->entity_id])}}"><img src="{{$banner->image}}" class="img-fluid d-block w-100" alt="..."></a>
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

            </section>

        @endif
    @endforeach
@endif
{{--<!-- banner section Ends -->--}}
{{--<!-- Evetns Section Starts -->--}}
{{--<section class="section events" id="">--}}
{{--    <div class="container">--}}
{{--        <div class="section-heading">--}}
{{--            <h2>Beach parties<span class="pull-right"><a href="" class="btn btn-danger btn-small">View More</a></span>--}}
{{--                <p>Lorem IpsumLorem Ipsum ipsayi cuba</p>--}}
{{--        </div>--}}
{{--        <div class="row">--}}
{{--            <div class="col-4 mt-4 service-box">--}}
{{--                <div class="card">--}}
{{--                    <div class="cardimg">--}}
{{--                        <img class="card-img-top" src="img/events/e1.jpg">--}}
{{--                        <span class="card-star">4 <i class="fa fa-star" aria-hidden="true"></i></span>--}}
{{--                    </div>--}}
{{--                    <div class="card-block text-center">--}}
{{--                        <h4 class="card-title">Tawshif Ahsan Khan</h4>--}}
{{--                        <div class="meta">--}}
{{--                            <a href="#">Gurgaon</a>--}}
{{--                        </div>--}}

{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="col-4 mt-4 service-box">--}}
{{--                <div class="card">--}}
{{--                    <div class="cardimg">--}}
{{--                        <img class="card-img-top" src="img/events/e4.jpg">--}}
{{--                        <span class="card-star">3.4 <i class="fa fa-star" aria-hidden="true"></i></span>--}}
{{--                    </div>--}}
{{--                    <div class="card-block text-center">--}}
{{--                        <h4 class="card-title">Tawshif Ahsan Khan</h4>--}}
{{--                        <div class="meta">--}}
{{--                            <a href="#">Gurgaon</a>--}}
{{--                        </div>--}}

{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="col-4 mt-4 service-box">--}}
{{--                <div class="card">--}}
{{--                    <div class="cardimg">--}}
{{--                        <img class="card-img-top" src="img/events/e3.jpg">--}}
{{--                        <span class="card-star">4.2 <i class="fa fa-star" aria-hidden="true"></i></span>--}}
{{--                    </div>--}}
{{--                    <div class="card-block text-center">--}}
{{--                        <h4 class="card-title">Tawshif Ahsan Khan</h4>--}}
{{--                        <div class="meta">--}}
{{--                            <a href="#">Gurgaon</a>--}}
{{--                        </div>--}}

{{--                    </div>--}}

{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="col-4 mt-4 service-box">--}}
{{--                <div class="card">--}}
{{--                    <div class="cardimg">--}}
{{--                        <img class="card-img-top" src="img/events/e2.jpg">--}}
{{--                        <span class="card-star">4.7 <i class="fa fa-star" aria-hidden="true"></i></span>--}}
{{--                    </div>--}}
{{--                    <div class="card-block text-center">--}}
{{--                        <h4 class="card-title">Tawshif Ahsan Khan</h4>--}}
{{--                        <div class="meta">--}}
{{--                            <a href="#">Gurgaon</a>--}}
{{--                        </div>--}}

{{--                    </div>--}}

{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="col-4 mt-4 service-box">--}}
{{--                <div class="card">--}}
{{--                    <div class="cardimg">--}}
{{--                        <img class="card-img-top" src="img/events/e4.jpg">--}}
{{--                        <span class="card-star">4 <i class="fa fa-star" aria-hidden="true"></i></span>--}}
{{--                    </div>--}}
{{--                    <div class="card-block text-center">--}}
{{--                        <h4 class="card-title">Tawshif Ahsan Khan</h4>--}}
{{--                        <div class="meta">--}}
{{--                            <a href="#">Gurgaon</a>--}}
{{--                        </div>--}}

{{--                    </div>--}}

{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="col-4 mt-4 service-box">--}}
{{--                <div class="card">--}}
{{--                    <div class="cardimg">--}}
{{--                        <img class="card-img-top" src="img/events/e3.jpg">--}}
{{--                        <span class="card-star">4 <i class="fa fa-star" aria-hidden="true"></i></span>--}}
{{--                    </div>--}}
{{--                    <div class="card-block text-center">--}}
{{--                        <h4 class="card-title">Tawshif Ahsan Khan</h4>--}}
{{--                        <div class="meta">--}}
{{--                            <a href="#">Gurgaon</a>--}}
{{--                        </div>--}}

{{--                    </div>--}}

{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="col-4 mt-4 service-box">--}}
{{--                <div class="card">--}}
{{--                    <div class="cardimg">--}}
{{--                        <img class="card-img-top" src="img/events/e2.jpg">--}}
{{--                        <span class="card-star">4 <i class="fa fa-star" aria-hidden="true"></i></span>--}}
{{--                    </div>--}}
{{--                    <div class="card-block text-center">--}}
{{--                        <h4 class="card-title">Tawshif Ahsan Khan</h4>--}}
{{--                        <div class="meta">--}}
{{--                            <a href="#">Gurgaon</a>--}}
{{--                        </div>--}}

{{--                    </div>--}}

{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="col-4 mt-4 service-box">--}}
{{--                <div class="card">--}}
{{--                    <div class="cardimg">--}}
{{--                        <img class="card-img-top" src="img/events/e1.jpg">--}}
{{--                        <span class="card-star">3.4 <i class="fa fa-star" aria-hidden="true"></i></span>--}}
{{--                    </div>--}}
{{--                    <div class="card-block text-center">--}}
{{--                        <h4 class="card-title">Tawshif Ahsan Khan</h4>--}}
{{--                        <div class="meta">--}}
{{--                            <a href="#">Gurgaon</a>--}}
{{--                        </div>--}}

{{--                    </div>--}}

{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="col-4 mt-4 service-box">--}}
{{--                <div class="card">--}}
{{--                    <div class="cardimg">--}}
{{--                        <img class="card-img-top" src="img/events/e2.jpg">--}}
{{--                        <span class="card-star">4.5 <i class="fa fa-star" aria-hidden="true"></i></span>--}}
{{--                    </div>--}}
{{--                    <div class="card-block text-center">--}}
{{--                        <h4 class="card-title">Tawshif Ahsan Khan</h4>--}}
{{--                        <div class="meta">--}}
{{--                            <a href="#">Gurgaon</a>--}}
{{--                        </div>--}}

{{--                    </div>--}}

{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</section>--}}
{{--<!-- Event Ends -->--}}
{{--<!-- Banner section Ends -->--}}
{{--<section class="banner">--}}
{{--    <div class="container">--}}
{{--        <div class="row">--}}
{{--            <div class="col-12">--}}
{{--                <img src="img/banner1.jpg" class="img-responsive img-fluid">--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</section>--}}
{{--<!-- banner section Ends -->--}}
{{--<!-- Evetns Section Starts -->--}}
{{--<section class="section parties" id="">--}}
{{--    <div class="container">--}}
{{--        <div class="section-heading">--}}
{{--            <h2>Cruise Parties<span class="pull-right"><a href="" class="btn btn-danger btn-small">View More</a></span>--}}
{{--                <p>Lorem IpsumLorem Ipsum ipsayi cuba</p>--}}
{{--        </div>--}}
{{--        <div class="row">--}}
{{--            <div class="col-4 mt-4 service-box">--}}
{{--                <div class="card">--}}
{{--                    <div class="cardimg">--}}
{{--                        <img class="card-img-top" src="img/events/e1.jpg">--}}
{{--                        <span class="card-star">4 <i class="fa fa-star" aria-hidden="true"></i></span>--}}
{{--                    </div>--}}
{{--                    <div class="card-block text-center">--}}
{{--                        <h4 class="card-title">Tawshif Ahsan Khan</h4>--}}
{{--                        <div class="meta">--}}
{{--                            <a href="#">Gurgaon</a>--}}
{{--                        </div>--}}

{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="col-4 mt-4 service-box">--}}
{{--                <div class="card">--}}
{{--                    <div class="cardimg">--}}
{{--                        <img class="card-img-top" src="img/events/e4.jpg">--}}
{{--                        <span class="card-star">3.4 <i class="fa fa-star" aria-hidden="true"></i></span>--}}
{{--                    </div>--}}
{{--                    <div class="card-block text-center">--}}
{{--                        <h4 class="card-title">Tawshif Ahsan Khan</h4>--}}
{{--                        <div class="meta">--}}
{{--                            <a href="#">Gurgaon</a>--}}
{{--                        </div>--}}

{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="col-4 mt-4 service-box">--}}
{{--                <div class="card">--}}
{{--                    <div class="cardimg">--}}
{{--                        <img class="card-img-top" src="img/events/e3.jpg">--}}
{{--                        <span class="card-star">4.2 <i class="fa fa-star" aria-hidden="true"></i></span>--}}
{{--                    </div>--}}
{{--                    <div class="card-block text-center">--}}
{{--                        <h4 class="card-title">Tawshif Ahsan Khan</h4>--}}
{{--                        <div class="meta">--}}
{{--                            <a href="#">Gurgaon</a>--}}
{{--                        </div>--}}

{{--                    </div>--}}

{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="col-4 mt-4 service-box">--}}
{{--                <div class="card">--}}
{{--                    <div class="cardimg">--}}
{{--                        <img class="card-img-top" src="img/events/e2.jpg">--}}
{{--                        <span class="card-star">4.7 <i class="fa fa-star" aria-hidden="true"></i></span>--}}
{{--                    </div>--}}
{{--                    <div class="card-block text-center">--}}
{{--                        <h4 class="card-title">Tawshif Ahsan Khan</h4>--}}
{{--                        <div class="meta">--}}
{{--                            <a href="#">Gurgaon</a>--}}
{{--                        </div>--}}

{{--                    </div>--}}

{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="col-4 mt-4 service-box">--}}
{{--                <div class="card">--}}
{{--                    <div class="cardimg">--}}
{{--                        <img class="card-img-top" src="img/events/e4.jpg">--}}
{{--                        <span class="card-star">4 <i class="fa fa-star" aria-hidden="true"></i></span>--}}
{{--                    </div>--}}
{{--                    <div class="card-block text-center">--}}
{{--                        <h4 class="card-title">Tawshif Ahsan Khan</h4>--}}
{{--                        <div class="meta">--}}
{{--                            <a href="#">Gurgaon</a>--}}
{{--                        </div>--}}

{{--                    </div>--}}

{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="col-4 mt-4 service-box">--}}
{{--                <div class="card">--}}
{{--                    <div class="cardimg">--}}
{{--                        <img class="card-img-top" src="img/events/e3.jpg">--}}
{{--                        <span class="card-star">4 <i class="fa fa-star" aria-hidden="true"></i></span>--}}
{{--                    </div>--}}
{{--                    <div class="card-block text-center">--}}
{{--                        <h4 class="card-title">Tawshif Ahsan Khan</h4>--}}
{{--                        <div class="meta">--}}
{{--                            <a href="#">Gurgaon</a>--}}
{{--                        </div>--}}

{{--                    </div>--}}

{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="col-4 mt-4 service-box">--}}
{{--                <div class="card">--}}
{{--                    <div class="cardimg">--}}
{{--                        <img class="card-img-top" src="img/events/e2.jpg">--}}
{{--                        <span class="card-star">4 <i class="fa fa-star" aria-hidden="true"></i></span>--}}
{{--                    </div>--}}
{{--                    <div class="card-block text-center">--}}
{{--                        <h4 class="card-title">Tawshif Ahsan Khan</h4>--}}
{{--                        <div class="meta">--}}
{{--                            <a href="#">Gurgaon</a>--}}
{{--                        </div>--}}

{{--                    </div>--}}

{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="col-4 mt-4 service-box">--}}
{{--                <div class="card">--}}
{{--                    <div class="cardimg">--}}
{{--                        <img class="card-img-top" src="img/events/e1.jpg">--}}
{{--                        <span class="card-star">3.4 <i class="fa fa-star" aria-hidden="true"></i></span>--}}
{{--                    </div>--}}
{{--                    <div class="card-block text-center">--}}
{{--                        <h4 class="card-title">Tawshif Ahsan Khan</h4>--}}
{{--                        <div class="meta">--}}
{{--                            <a href="#">Gurgaon</a>--}}
{{--                        </div>--}}

{{--                    </div>--}}

{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="col-4 mt-4 service-box">--}}
{{--                <div class="card">--}}
{{--                    <div class="cardimg">--}}
{{--                        <img class="card-img-top" src="img/events/e2.jpg">--}}
{{--                        <span class="card-star">4.5 <i class="fa fa-star" aria-hidden="true"></i></span>--}}
{{--                    </div>--}}
{{--                    <div class="card-block text-center">--}}
{{--                        <h4 class="card-title">Tawshif Ahsan Khan</h4>--}}
{{--                        <div class="meta">--}}
{{--                            <a href="#">Gurgaon</a>--}}
{{--                        </div>--}}

{{--                    </div>--}}

{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</section>--}}
{{--<!-- Event Ends -->--}}
{{--<section class="section newsletter">--}}
{{--    <div class="container">--}}
{{--        <div class="row">--}}
{{--            <div class="title-column col-4">--}}
{{--                <h2>Newsletter Signup</h2>--}}
{{--                <div class="text">We send you latest news couple a month.</div>--}}
{{--            </div>--}}
{{--            <!--Form Column-->--}}
{{--            <div class="form-column col-8">--}}
{{--                <div class="row">--}}
{{--                    <form class="formnewsletter">--}}
{{--                        <div class="form-row align-items-center">--}}
{{--                            <div class="col-4 my-1">--}}
{{--                                <input type="text" class="forminput form-control" id="inlineFormInputName" placeholder="Your Name">--}}
{{--                            </div>--}}
{{--                            <div class="col-5 my-1">--}}
{{--                                <input type="email" class="forminput form-control" id="inlineFormInputName" placeholder="Your Email">--}}
{{--                            </div>--}}
{{--                            <div class="col-3 my-1">--}}
{{--                                <button type="submit" class="btn btn-light btn-block">Submit</button>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </form>--}}
{{--                </div>--}}
{{--            </div>--}}

{{--        </div>--}}
{{--    </div>--}}
{{--</section>--}}
{{--<!-- testimonial Ends -->--}}
{{--<!-- Events carousel -->--}}
{{--<section class="section events" id="">--}}
{{--    <div class="container">--}}
{{--        <div class="section-heading">--}}
{{--            <h2>Evergreen Events<span class="pull-right"><a href="" class="btn btn-danger btn-small">View More</a></span>--}}
{{--                <p>Lorem IpsumLorem Ipsum ipsayi cuba</p>--}}
{{--        </div>--}}
{{--        <div class="row">--}}
{{--            <div class="col-4 mt-4 service-box">--}}
{{--                <div class="card">--}}
{{--                    <div class="cardimg">--}}
{{--                        <img class="card-img-top" src="img/events/e1.jpg">--}}
{{--                        <span class="card-star">4 <i class="fa fa-star" aria-hidden="true"></i></span>--}}
{{--                    </div>--}}
{{--                    <div class="card-block text-center">--}}
{{--                        <h4 class="card-title">Tawshif Ahsan Khan</h4>--}}
{{--                        <div class="meta">--}}
{{--                            <a href="#">Gurgaon</a>--}}
{{--                        </div>--}}

{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="col-4 mt-4 service-box">--}}
{{--                <div class="card">--}}
{{--                    <div class="cardimg">--}}
{{--                        <img class="card-img-top" src="img/events/e4.jpg">--}}
{{--                        <span class="card-star">3.4 <i class="fa fa-star" aria-hidden="true"></i></span>--}}
{{--                    </div>--}}
{{--                    <div class="card-block text-center">--}}
{{--                        <h4 class="card-title">Tawshif Ahsan Khan</h4>--}}
{{--                        <div class="meta">--}}
{{--                            <a href="#">Gurgaon</a>--}}
{{--                        </div>--}}

{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="col-4 mt-4 service-box">--}}
{{--                <div class="card">--}}
{{--                    <div class="cardimg">--}}
{{--                        <img class="card-img-top" src="img/events/e3.jpg">--}}
{{--                        <span class="card-star">4.2 <i class="fa fa-star" aria-hidden="true"></i></span>--}}
{{--                    </div>--}}
{{--                    <div class="card-block text-center">--}}
{{--                        <h4 class="card-title">Tawshif Ahsan Khan</h4>--}}
{{--                        <div class="meta">--}}
{{--                            <a href="#">Gurgaon</a>--}}
{{--                        </div>--}}

{{--                    </div>--}}

{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="col-4 mt-4 service-box">--}}
{{--                <div class="card">--}}
{{--                    <div class="cardimg">--}}
{{--                        <img class="card-img-top" src="img/events/e2.jpg">--}}
{{--                        <span class="card-star">4.7 <i class="fa fa-star" aria-hidden="true"></i></span>--}}
{{--                    </div>--}}
{{--                    <div class="card-block text-center">--}}
{{--                        <h4 class="card-title">Tawshif Ahsan Khan</h4>--}}
{{--                        <div class="meta">--}}
{{--                            <a href="#">Gurgaon</a>--}}
{{--                        </div>--}}

{{--                    </div>--}}

{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="col-4 mt-4 service-box">--}}
{{--                <div class="card">--}}
{{--                    <div class="cardimg">--}}
{{--                        <img class="card-img-top" src="img/events/e4.jpg">--}}
{{--                        <span class="card-star">4 <i class="fa fa-star" aria-hidden="true"></i></span>--}}
{{--                    </div>--}}
{{--                    <div class="card-block text-center">--}}
{{--                        <h4 class="card-title">Tawshif Ahsan Khan</h4>--}}
{{--                        <div class="meta">--}}
{{--                            <a href="#">Gurgaon</a>--}}
{{--                        </div>--}}

{{--                    </div>--}}

{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="col-4 mt-4 service-box">--}}
{{--                <div class="card">--}}
{{--                    <div class="cardimg">--}}
{{--                        <img class="card-img-top" src="img/events/e3.jpg">--}}
{{--                        <span class="card-star">4 <i class="fa fa-star" aria-hidden="true"></i></span>--}}
{{--                    </div>--}}
{{--                    <div class="card-block text-center">--}}
{{--                        <h4 class="card-title">Tawshif Ahsan Khan</h4>--}}
{{--                        <div class="meta">--}}
{{--                            <a href="#">Gurgaon</a>--}}
{{--                        </div>--}}

{{--                    </div>--}}

{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="col-4 mt-4 service-box">--}}
{{--                <div class="card">--}}
{{--                    <div class="cardimg">--}}
{{--                        <img class="card-img-top" src="img/events/e2.jpg">--}}
{{--                        <span class="card-star">4 <i class="fa fa-star" aria-hidden="true"></i></span>--}}
{{--                    </div>--}}
{{--                    <div class="card-block text-center">--}}
{{--                        <h4 class="card-title">Tawshif Ahsan Khan</h4>--}}
{{--                        <div class="meta">--}}
{{--                            <a href="#">Gurgaon</a>--}}
{{--                        </div>--}}

{{--                    </div>--}}

{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="col-4 mt-4 service-box">--}}
{{--                <div class="card">--}}
{{--                    <div class="cardimg">--}}
{{--                        <img class="card-img-top" src="img/events/e1.jpg">--}}
{{--                        <span class="card-star">3.4 <i class="fa fa-star" aria-hidden="true"></i></span>--}}
{{--                    </div>--}}
{{--                    <div class="card-block text-center">--}}
{{--                        <h4 class="card-title">Tawshif Ahsan Khan</h4>--}}
{{--                        <div class="meta">--}}
{{--                            <a href="#">Gurgaon</a>--}}
{{--                        </div>--}}

{{--                    </div>--}}

{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="col-4 mt-4 service-box">--}}
{{--                <div class="card">--}}
{{--                    <div class="cardimg">--}}
{{--                        <img class="card-img-top" src="img/events/e2.jpg">--}}
{{--                        <span class="card-star">4.5 <i class="fa fa-star" aria-hidden="true"></i></span>--}}
{{--                    </div>--}}
{{--                    <div class="card-block text-center">--}}
{{--                        <h4 class="card-title">Tawshif Ahsan Khan</h4>--}}
{{--                        <div class="meta">--}}
{{--                            <a href="#">Gurgaon</a>--}}
{{--                        </div>--}}

{{--                    </div>--}}

{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</section>--}}
{{--<!-- Event Carousel Ends -->--}}
{{--<!-- Partner's Slider -->--}}
{{--<section class="section">--}}
{{--    <div class="container">--}}
{{--        <div class="row">--}}

{{--        </div>--}}
{{--    </div>--}}
{{--</section>--}}
{{--<!-- Partner's Slider -->--}}
{{--<!-- Footer -->--}}
@endsection
