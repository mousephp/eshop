<div class="product-area most-popular related-product section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title">
                    <h2>Related Products</h2>
                </div>
            </div>
        </div>
        <div class="row">
            {{-- {{$product_detail->rel_prods}} --}}
            <div class="col-12">
                <div class="owl-carousel popular-slider">
                    @foreach($product_detail->rel_prods as $data)
                    @if($data->id !== $product_detail->id)
                    <!-- Start Single Product -->
                    <div class="single-product">
                        <div class="product-img">
                            <a href="{{route('product-detail', $data->slug)}}">
                                @php
                                $photo = explode(',', $data->feature_image_path);
                                @endphp
                                <img class="default-img" src="{{asset($photo[0])}}" alt="{{$photo[0]}}">
                                {{-- <img class="hover-img" src="{{asset($photo[0])}}" alt="{{$photo[0]}}"> --}}
                                <span class="price-dec">{{$data->discount}} % Off</span>
                                {{-- <span class="out-of-stock">Hot</span> --}}
                            </a>
                            <div class="button-head">
                                <div class="product-action">
                                    <a data-toggle="modal" data-target="#modelExample" title="Quick View" href="#"><i class=" ti-eye"></i><span>Quick Shop</span></a>
                                    <a title="Wishlist" href="#"><i class=" ti-heart "></i><span>Add to Wishlist</span></a>
                                    <a title="Compare" href="#"><i class="ti-bar-chart-alt"></i><span>Add to Compare</span></a>
                                </div>
                                <div class="product-action-2">
                                    <a title="Add to cart" href="#">Add to cart</a>
                                </div>
                            </div>
                        </div>
                        <div class="product-content">
                            <h3><a href="{{route('product-detail',$data->slug)}}">{{$data->title}}</a></h3>
                            <div class="product-price">
                                @php
                                $after_discount = ($data->price - (($data->discount * $data->price)/100));
                                @endphp
                                <span class="old">${{number_format($data->price,2)}}</span>
                                <span>${{number_format($after_discount,2)}}</span>
                            </div>

                        </div>
                    </div>
                    <!-- End Single Product -->

                    @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>