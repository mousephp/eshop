<div class="shopping-cart section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <!-- Shopping Summery -->
                <table class="table shopping-summery">
                    <thead>
                        <tr class="main-hading">
                            <th>PRODUCT</th>
                            <th>NAME</th>
                            <th class="text-center">TOTAL</th>
                            <th class="text-center">ADD TO CART</th>
                            <th class="text-center"><i class="ti-trash remove-icon"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(Auth::guard('client')->user())
                            @if(Helper::getAllProductFromWishlist())
                                @foreach(Helper::getAllProductFromWishlist() as $key => $wishlist)
                                    <tr>
                                        @php
                                        $photo = explode(',',$wishlist->product['feature_image_path']);
                                        @endphp
                                        
                                        <td class="image" data-title="No"><img src="{{asset($photo[0])}}" alt="{{asset($photo[0])}}"></td>
                                        <td class="product-des" data-title="Description">
                                            <p class="product-name"><a href="{{asset('product-detail/',$wishlist->product['slug'])}}">{{$wishlist->product['title']}}</a></p>
                                            <p class="product-des">{!!($wishlist->product['summary']) !!}</p>
                                        </td>
                                        <td class="total-amount" data-title="Total"><span>${{$wishlist['amount']}}</span></td>
                                        <td><a href="{{asset('cart/create/'.$wishlist->id)}}" class='btn text-white'>Add To Cart</a></td>
                                        <td class="action" data-title="Remove"><a href="{{route('wishlist-delete',$wishlist->id)}}"><i class="ti-trash remove-icon"></i></a></td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td class="text-center">
                                        There are no any wishlist available. <a href="{{route('product-grids')}}" style="color:blue;">Continue shopping</a>
                                    </td>
                                </tr>
                            @endif
                        @endif
                    </tbody>
                </table>
                <!--/ End Shopping Summery -->
            </div>
        </div>
    </div>
</div>
