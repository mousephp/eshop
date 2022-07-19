<section class="shop-home-list section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-12">
                <div class="row">
                    <div class="col-12">
                        <div class="shop-section-title">
                            <h1>Latest Items</h1>
                        </div>
                    </div>
                </div>
                <div class="row">
                    @foreach($product_lists as $key => $product)
                        @if($key < 6)                  
                        <div class="col-md-4">
                            <!-- Start Single List  -->
                            <div class="single-list">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <div class="list-image overlay">
                                            @php
                                            $photo = explode(',',$product->feature_image_path);
                                            @endphp
                                            <img src="{{asset($photo[0])}}" alt="{{asset($photo[0])}}">
                                            <a href="{{asset('cart/form/create/'.$product->id)}}" class="buy"><i class="fa fa-shopping-bag"></i></a>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-12 no-padding">
                                        <div class="content">
                                            <h4 class="title"><a href="#">{{$product->title}}</a></h4>
                                            <p class="price with-discount">${{number_format($product->discount,2)}}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Single List  -->
                        </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>