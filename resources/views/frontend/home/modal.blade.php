@if($product_lists)
@foreach($product_lists as $key => $product)
<div class="modal fade" id="{{$product->id}}" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span class="ti-close" aria-hidden="true"></span></button>
            </div>
            <div class="modal-body">
                <div class="row no-gutters">
                    <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                        <!-- Product Slider -->
                        <div class="product-gallery">
                            <div class="quickview-slider-active">
                            {{-- @foreach($product->productImages as $data) 
                                @if($data->prod_id == $product->id)                              
                                    <div class="single-slider">
                                        <img src="{{asset($data->image_path)}}" >
                                </div>                                 
                                @endif
                             @endforeach  --}}

                            <div class="single-slider">
                                <img src="{{asset($product->feature_image_path)}}" >
                            </div>                                          
                        </div>
                        <!-- End Product slider -->
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                    <div class="quickview-content">
                        <h2>{{$product->title}}</h2>
                        <div class="quickview-ratting-review">
                            <div class="quickview-ratting-wrap">
                                <div class="quickview-ratting">
                                    @php
                                    $rate=DB::table('product_reviews')->where('prod_id',$product->id)->avg('rate');
                                    $rate_count=DB::table('product_reviews')->where('prod_id',$product->id)->count();
                                    @endphp
                                    @for($i=1; $i<=5; $i++) 
                                        @if($rate>=$i)
                                        <i class="yellow fa fa-star"></i>
                                        @else
                                        <i class="fa fa-star"></i>
                                        @endif
                                    @endfor
                                </div>
                                <a href="#"> ({{$rate_count}} customer review)</a>
                            </div>
                            <div class="quickview-stock">
                                @if($product->stock >0)
                                <span><i class="fa fa-check-circle-o"></i> {{$product->stock}} in stock</span>
                                @else
                                <span><i class="fa fa-times-circle-o text-danger"></i> {{$product->stock}} out stock</span>
                                @endif
                            </div>
                        </div>
                        @php
                        $after_discount=($product->price-($product->price*$product->discount)/100);
                        @endphp
                        <h3><small><del class="text-muted">${{number_format($product->price,2)}}</del></small> ${{number_format($after_discount,2)}} </h3>
                        <div class="quickview-peragraph">
                            <p>{!! html_entity_decode($product->summary) !!}</p>
                        </div>

                        <form action="{{route('cart.store',$product->id)}}" method="POST" class="mt-4">
                            @csrf
                            @method('post')
                            @if($product->size)
                            <div class="size">
                                <div class="row">
                                    <div class="col-lg-6 col-12">
                                        <h5 class="title">Size</h5>
                                        <select name="size" class="form-control">
                                            @php
                                            $sizes=explode(',',$product->size);
                                            @endphp
                                            @foreach($sizes as $size)
                                            <option value="{{$size}}">{{$size}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            @endif

                            <div class="quantity">
                                <!-- Input Order -->
                                <div class="input-group">
                                    <div class="button minus">
                                        <button type="button" class="btn btn-primary btn-number" disabled="disabled" data-type="minus" data-field="quant[1]">
                                            <i class="ti-minus"></i>
                                        </button>
                                    </div>
                                    <input type="hidden" name="slug" value="{{$product->slug}}">
                                    <input type="text" name="quant[1]" class="input-number" data-min="1" data-max="1000" value="1">
                                    <div class="button plus">
                                        <button type="button" class="btn btn-primary btn-number" data-type="plus" data-field="quant[1]">
                                            <i class="ti-plus"></i>
                                        </button>
                                    </div>
                                </div>
                                <!--/ End Input Order -->
                            </div>
                            <div class="add-to-cart">
                                <button type="submit" class="btn">Add to cart</button>
                                {{-- <a href="{{asset('cart/create/'.$product->id)}}" class="btn min"><i class="ti-heart"></i>Add to cart</a> --}}
                            </div>
                        </form>
                        <div class="default-social">
                            <!-- ShareThis BEGIN -->
                            <div class="sharethis-inline-share-buttons"></div><!-- ShareThis END -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endforeach
@endif
