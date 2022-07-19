<div class="product-area section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title">
                    <h2>Trending Item</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="product-info">
                    <div class="nav-main">
                        <!-- Tab Nav -->
                        <ul class="nav nav-tabs filter-tope-group" id="myTab" role="tablist">
                            <button class="btn" style="background:black" data-filter="*">
                                All Products
                            </button>
                            @foreach($category_lists as $key => $cate)
                                @if($key < 7)                               
                                <button class="btn" style="background:none;color:black;" data-filter=".{{$cate->id}}">
                                    {{$cate->name}}
                                </button>
                                @endif
                            @endforeach
                        </ul>
                        <!--/ End Tab Nav -->
                    </div>
                    <div class="tab-content isotope-grid" id="myTabContent">
                        <!-- Start Single Tab -->
                        @if($product_lists)
                        @foreach($product_lists as $key=>$product)
                        <div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item {{$product->cat_id}}">
                            <div class="single-product">
                                <div class="product-img">
                                    <a href="{{route('product-detail',$product->slug)}}">
                                        @php
                                            $photo=explode(',', $product->feature_image_path);
                                        @endphp
                                        <img class="default-img" src="{{asset($photo[0])}}" alt="{{asset($photo[0])}}">
                                        <img class="hover-img" src="{{asset($photo[0])}}" alt="{{asset($photo[0])}}">
                                        @if($product->stock <= 0) 
                                            <span class="out-of-stock">Sale out</span>
                                        @elseif($product->condition == 'new')
                                            <span class="new">New</span 
                                        @elseif($product->condition == 'hot')
                                            <span class="hot">Hot</span>
                                        @else
                                            <span class="price-dec">{{$product->discount}}% Off</span>
                                        @endif
                                    </a>
                                    <div class="button-head">
                                        <div class="product-action">
                                            <a data-toggle="modal" data-target="#{{$product->id}}" title="Quick View" href="#"><i class=" ti-eye"></i><span>Quick Shop</span></a>
                                            <a title="Wishlist" href="{{route('add-to-wishlist',$product->slug)}}"><i class=" ti-heart "></i><span>Add to Wishlist</span></a>
                                        </div>
                                        <div class="product-action-2">
                                            <a title="Add to cart" href="{{asset('cart/form/create/'.$product->id)}}">Add to cart</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="product-content">
                                    <h3><a href="{{route('product-detail',$product->slug)}}">{{$product->title}}</a></h3>
                                    <div class="product-price">
                                        @php
                                        $after_discount = ($product->price - ($product->price * $product->discount)/100);
                                        @endphp
                                        <span>${{number_format($after_discount,2)}}</span>
                                        <del style="padding-left:4%;">${{number_format($product->price,2)}}</del>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        @endif
                        <!--/ End Single Tab -->
                        <!--/ End Single Tab -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
