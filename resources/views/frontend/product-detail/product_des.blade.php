<div class="product-des">
    <!-- Description -->
    <div class="short">
        <h4>{{$product_detail->title}}</h4>
        <div class="rating-main">
            <ul class="rating">
                @php
                $rate = ceil($product_detail->getReview->avg('rate'))
                @endphp
                @for($i=1; $i<=5; $i++) 
                    @if($rate>=$i)
                    <li><i class="fa fa-star"></i></li>
                    @else
                    <li><i class="fa fa-star-o"></i></li>
                    @endif
                @endfor
            </ul>
            <a href="#" class="total-review">({{$product_detail['getReview']->count()}}) Review</a>
        </div>
        @php
        $after_discount = ($product_detail->price - (($product_detail->price*$product_detail->discount)/100));
        @endphp
        <p class="price"><span class="discount">${{number_format($after_discount,2)}}</span><s>${{number_format($product_detail->price,2)}}</s> </p>
        <p class="description">{!!($product_detail->summary)!!}</p>
    </div>
    <!--/ End Description -->

    <!-- Color -->
    <div class="color">
        <h4>Available Options <span>Color</span></h4>
        <ul>
            <li><a href="#" class="one"><i class="ti-check"></i></a></li>
            <li><a href="#" class="two"><i class="ti-check"></i></a></li>
            <li><a href="#" class="three"><i class="ti-check"></i></a></li>
            {{-- @foreach($product_detail->colors()->get() as $color)
            <li><a href="#" class="four"><i class="ti-check"></i>{{$coclor['name']}}</a></li>
            @endforeach --}}
        </ul>
    </div>
    <!--/ End Color -->


    <form action="{{route('cart.store',$product_detail->id)}}" method="POST">
        @csrf
        @method('POST')
        <!-- Size -->
        @if($product_detail->sizes)
        <div class="size mt-4">
            <h4>Size</h4>
            <ul>
                @php
                    $sizes = explode(',', $product_detail->sizes);
                @endphp
                <select name="size" class="form-control">
                    @foreach($product_detail->sizes()->get() as $size)
                        <option value="{{$size['name']}}">{{$size['name']}}</option>
                    @endforeach
                </select>
            </ul>
        </div>
        @endif
        <!--/ End Size -->

        <!-- Product Buy -->
        <div class="product-buy">
            <div class="quantity">
                <h6>Quantity :</h6>
                <!-- Input Order -->
                <div class="input-group">
                    <div class="button minus">
                        <button type="button" class="btn btn-primary btn-number" disabled="disabled" data-type="minus" data-field="quant[1]">
                            <i class="ti-minus"></i>
                        </button>
                    </div>
                    <input type="hidden" name="slug" value="{{$product_detail->slug}}">
                    <input type="text" name="quant[1]" class="input-number" data-min="1" data-max="1000" value="1" id="quantity">
                    <div class="button plus">
                        <button type="button" class="btn btn-primary btn-number" data-type="plus" data-field="quant[1]">
                            <i class="ti-plus"></i>
                        </button>
                    </div>
                </div>
                <!--/ End Input Order -->
            </div>
        </div>
        <div class="add-to-cart mt-4">
            <button type="submit" class="btn">Add to cart</button>
        </div>
    </form>

    <p class="cat">Category :
        <a href="{{route('product-cat',$product_detail->cat_info['slug'])}}">{{$product_detail->cat_info['name']}}</a>
    </p>

    <p class="cat">Tags :
        @foreach($product_detail->tags()->get() as $tag)
        <a>{{$tag['name']}}</a>
        @endforeach
    </p>

    @if($product_detail->sub_cat_info)
    @endif

    <p class="availability">Stock :
    @if($product_detail->quantity > 0)
        <span class="badge badge-success">{{$product_detail->quantity}}</span>
    @else 
        <span class="badge badge-danger">{{$product_detail->quantity}}</span>
    @endif</p>
</div>
<!--/ End Product Buy -->
</div>
