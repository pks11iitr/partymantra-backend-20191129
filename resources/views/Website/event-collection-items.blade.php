@extends('Website.layout')
@section('contents')
    <!-- Breadcrumb Starts-->
    <section class="section pagecrumb" style="background-image:url({{$collection->cover_image}});">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center py-4">
                    <h2 class="pagebrumb heading text-light">{{$collection->name}}</h2>
                    <p class="text-light">{{$collection->about}}</p>
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
                @foreach($events as $event)
                <div class="col-4 mt-4 service-box">
                    <a href="{{route('website.event.details', ['id'=>$event->id])}}">
                        <div class="card">
                            <div class="cardimg">
                                <img class="card-img-top" src="{{$event->small_image}}">
                                <span class="card-star">4 <i class="fa fa-star" aria-hidden="true"></i></span>
                            </div>
                            <div class="card-block text-center">
                                <h4 class="card-title">{{$event->title}}</h4>
                                <div class="meta">
                                    <a href="#">{{$event->venue_name}}</a>
                                </div>

                            </div>
                        </div>
                    </a>
                </div>
                    @endforeach
            </div>
{{--            <div class="row py-2">--}}
{{--                <div class="col-12 text-center">--}}
{{--                    <nav aria-label="Page navigation example">--}}
{{--                        <ul class="pagination justify-content-end">--}}
{{--                            <li class="page-item disabled">--}}
{{--                                <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>--}}
{{--                            </li>--}}
{{--                            <li class="page-item"><a class="page-link" href="#">1</a></li>--}}
{{--                            <li class="page-item"><a class="page-link" href="#">2</a></li>--}}
{{--                            <li class="page-item"><a class="page-link" href="#">3</a></li>--}}
{{--                            <li class="page-item">--}}
{{--                                <a class="page-link" href="#">Next</a>--}}
{{--                            </li>--}}
{{--                        </ul>--}}
{{--                    </nav>--}}
{{--                </div>--}}
{{--            </div>--}}
        </div>
    </section>
    <!-- page container Ends-->
@endsection
