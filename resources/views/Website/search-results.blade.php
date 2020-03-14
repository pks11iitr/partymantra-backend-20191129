@extends('Website.layout')

@section('contents')

    <!-- Evetns Section Starts -->
    @if(!empty($events->toArray()))
            <section class="section" id="">
                <div class="container">
                    <div class="section-heading">

                        <h2>Search Results For Club Events<span class="pull-right"></span></h2>
                    </div><br>
                    <div class="row">
                        @foreach($events as $item)


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
                        @endforeach
                    </div>
                </div>
            </section>
    @endif
    @if(!empty($restaurants->toArray()))
        <section class="section" id="">
            <div class="container">
                <div class="section-heading">
                    <h2>Search Results For Dinings<span class="pull-right"></span></h2>
                </div><br>
                <div class="row">
                    @foreach($restaurants as $item)
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
                    @endforeach
                </div>
            </div>
        </section>
    @endif
    @if(!empty($parties->toArray()))
        <section class="section">
            <div class="container">
                <div class="section-heading">

                    <h2>Search Results For Parties<span class="pull-right"></span></h2>
                </div><br>
                <div class="row">
                    @foreach($parties as $item)
                        <div class="col-4 mt-4 service-box">
            <a href="{{route('website.party.details',['id'=>$item->id])}}">
                <div class="card">
                    <div class="cardimg">
                        <img class="card-img-top" src="{{$item->small_image}}">
                        <span class="card-star">4 <i class="fa fa-star" aria-hidden="true"></i></span>
                    </div>
                    <div class="card-block text-center">
                        <h4 class="card-title">{{$item->name}}</h4>
                        <div class="meta">
                            <a href="#">{{$item->short_address}}</a>
                        </div>

                    </div>
                </div>
            </a>
        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

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
