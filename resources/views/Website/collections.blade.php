@extends('Website.layout')

@section('contents')
    <!-- Breadcrumb Starts-->
    <!-- Breadcrumb Starts-->
    <!-- Mobile Search Ends-->
    <!-- page container Starts-->
    <section class="section">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center py-2 mb-3">
                    <h5 class="heading">FIND VENUE SPACE THAT WORKS FOR YOU</h5>
                    <p>Find the best party venues in Delhi, Gurgaon, and Noida that suits your budget, purpose, and venue requirements. Our venues are A-listed and ensure you a great time whenever you visit.</p>
                </div>

                @foreach($collections as $collection)
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 mb-3 service-box">
                    @if($type=='event')
                    <a href="{{route('website.collection.event', ['id'=>$collection->id])}}">
                    @elseif($type=='restaurant')
                            <a href="{{route('website.collection.restaurant', ['id'=>$collection->id])}}">
                    @else
                                    <a href="{{route('website.collection.party', ['id'=>$collection->id])}}">
                     @endif
                        <div class="card collections">
                            <div class="img imgbox">
                                <img class="img-fluid" src="{{$collection->cover_image}}">
                            </div>
                            <div class="card-block collection-content">
                                <h4 class="card-title text-white">{{$collection->name}}</h4>
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
