<div class="product-area most-popular section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title">
                    <h2>Hot Item</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="owl-carousel popular-slider">
                    @foreach($hot_items as $key => $product)
                    <!-- Start Single Product -->
                    <div class="single-product">
                        <div class="product-img">
                            <a href="{{route('product-detail',$product->slug)}}">
                                @php
                                $photo = explode(',', $product->feature_image_path);
                                @endphp
                                <img class="default-img" src="{{asset($photo[0])}}" alt="{{asset($photo[0])}}">
                                <img class="hover-img" src="{{asset($photo[0])}}" alt="{{asset($photo[0])}}">
                                {{-- <span class="out-of-stock">Hot</span> --}}
                            </a>
                            <div class="button-head">
                                <div class="product-action">
                                    <a data-toggle="modal" data-target="#{{$product->id}}" title="Quick View" href="#"><i class=" ti-eye"></i><span>Quick Shop</span></a>
                                    <a title="Wishlist" href="{{route('add-to-wishlist',$product->slug)}}"><i class=" ti-heart "></i><span>Add to Wishlist</span></a>
                                </div>
                                <div class="product-action-2">
                                    <a href="{{asset('cart/form/create/'.$product->id)}}">Add to cart</a>
                                </div>
                            </div>
                        </div>
                        <div class="product-content">
                            <h3><a href="{{route('product-detail',$product->slug)}}">{{$product->title}}</a></h3>
                            <div class="product-price">
                                <span class="old">${{number_format($product->price,2)}}</span>
                                @php
                                $after_discount=($product->price-($product->price*$product->discount)/100)
                                @endphp
                                <span>${{number_format($after_discount,2)}}</span>
                            </div>
                        </div>
                    </div>
                    <!-- End Single Product -->
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>