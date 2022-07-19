<section class="midium-banner">
    <div class="container">
        <div class="row">
            @if($featured)
            @foreach($featured as $data)
            <!-- Single Banner  -->
            <div class="col-lg-6 col-md-6 col-12">
                <div class="single-banner">
                    @php
                    $photo = explode(',',$data->feature_image_path);
                    @endphp
                    <img src="{{asset($photo[0])}}" alt="{{asset($photo[0])}}">
                    <div class="content">
                        <p>{{$data->cat_info['name']}}</p>
                        <h3>{{$data->title}} <br>Up to<span> {{$data->discount}}%</span></h3>
                        <a href="{{route('product-detail',$data->slug)}}">Shop Now</a>
                    </div>
                </div>
            </div>
            <!-- /End Single Banner  -->
            @endforeach
            @endif
        </div>
    </div>
</section>


