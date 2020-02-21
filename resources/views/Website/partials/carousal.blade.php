@if(isset($banners))
<section class="carousel slider">
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner slider-inner">
            @foreach($banners as $banner)
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
