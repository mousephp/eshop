@if(count($banners)>0)
<section id="Gslider" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
        @foreach($banners as $key => $banner)
        <li data-target="#Gslider" data-slide-to="{{$key}}" class="{{(($key ==0)? 'active' : '')}}"></li>
        @endforeach

    </ol>
    <div class="carousel-inner" role="listbox">
        @foreach($banners as $key => $banner)
        <div class="carousel-item {{(($key == 0) ? 'active' : '')}}">
            <img class="first-slide" src="{{asset($banner->photo)}}" alt="First slide">
            <div class="carousel-caption d-none d-md-block text-left">
                <h1 class="wow fadeInDown">{{$banner->title}}</h1>
                <p>{!! html_entity_decode($banner->description) !!}</p>
                <a class="btn btn-lg ws-btn wow fadeInUpBig" href="{{route('product-grids')}}" role="button">Shop Now<i class="far fa-arrow-alt-circle-right"></i></i></a>
            </div>
        </div>
        @endforeach
    </div>
    <a class="carousel-control-prev" href="#Gslider" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#Gslider" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</section>
@endif

<!--/ End Slider Area -->

<!-- Start Small Banner  -->
<section class="small-banner section">
    <div class="container-fluid">
        <div class="row">
            @foreach($category_lists as $key => $cat)
            @if($key < 3)
            <!-- Single Banner  -->
            <div class="col-lg-4 col-md-6 col-12">
                <div class="single-banner">
                    @if($cat->photo)
                    <img src="{{asset($cat->photo)}}" alt="{{asset($cat->photo)}}">
                    @else
                    <img src="https://via.placeholder.com/600x370" alt="#">
                    @endif
                    <div class="content">
                        <h3>{{$cat->name}}</h3>
                        <a href="{{route('product-cat',$cat->slug)}}">Discover Now</a>
                    </div>
                </div>
            </div>
            @endif
            <!-- /End Single Banner  -->
            @endforeach
        </div>
    </div>
</section>
<!-- End Small Banner -->