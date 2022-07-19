<script>
    function updateCart(quant, rowId, productId) {
        //console.log(quantity)
        $.get('{{asset('cart/update')}}',{
                rowId: rowId
                ,quant: quant
                ,productId: productId
            },function(data, status) {
                console.log(data.qty)
                if(data == true){
                    toastr.success(data.success, 'Chúc mừng bạn đã cập nhập giở hàng thành công', {timeOut: 5000});
                    location.reload();
                }else{
                    toastr.error(data.error, 'Số lượng sản phẩm không đủ', {timeOut: 5000});
                }    
                //document.getElementById("total").value = "";          
            }
        );
    }

    function updateSize(quantity, size, rowId, productId) {
        $.get('{{asset('cart/update/size')}}',{
                quantity: quantity
                ,rowId: rowId
                ,size: size
                ,productId: productId
            },function(data, status) {
                if(data == true){
                    toastr.success(data.success, 'Cập nhập size thành công', {timeOut: 5000});
                    location.reload();
                }else{
                    toastr.error(data.error, 'Cập nhập size thất bại', {timeOut: 5000});
                }   
            }
        );
    }
</script>

<div class="shopping-cart section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <!-- Shopping Summery -->
                <table class="table shopping-summery">
                    <thead>
                        <tr class="main-hading">
                            <th>PRODUCT</th>
                            <th>IMAGE</th>
                            <th class="text-center">UNIT PRICE</th>
                            <th class="text-center">SIZE</th>
                            <th class="text-center">QUANTITY</th>
                            <th class="text-center">TOTAL</th>
                            <th class="text-center"><i class="ti-trash remove-icon"></i></th>
                        </tr>
                    </thead>
                    <tbody id="cart_item_list">
                        @if(Cart::content()->count())
                        <form action="{{route('cart.update.all')}}" method="POST">
                            @csrf
                            @method('put')

                            @foreach($items as $key => $value)
                            <tr>
                                <td>{!!$value->name!!} </td>
                                <td class="image" data-title="No">
                                    <img src="{{asset($value->options->img)}}" alt="">
                                </td>
                                <td class="price" data-title="Price"><span>{{number_format($value->price,0,',','.')}} đ</span></td>
                                <td class="size" data-title="size">
                                    {{$value->options->size}}
                                    <br>
                                    <select id="sizeProduct" name="size" class="form-control" oninput="this.value" value="{{$value->qty}}" onchange="updateSize('{{$value->qty}}',this.value,'{{$value->rowId}}','{{$value->id}}')">
                                        <option value="" disabled>--Select any size--</option>
                                        <option value="S">Small (S)</option>
                                        <option value="M">Medium (M)</option>
                                        <option value="L">Large (L)</option>
                                        <option value="XL">Extra Large (XL)</option>
                                    </select>
                                </td>
                                <td class="qty" data-title="Qty">
                                    {{--update item --}}
                                    <div class="input-group"> 
                                        <input type="number" name="quant" class="input-number" data-min="1" data-max="1000" id="quantity" oninput="this.value = Math.abs(this.value)" value="{{$value->qty}}" onchange="updateCart(this.value,'{{$value->rowId}}','{{$value->id}}')">
                                        <input type="text" name="rowId[]" class="input-number" id="rowId" value="{{$value->rowId}}" hidden>
                                    </div>
                                    
                                    {{--update multiple --}}
                                    {{-- <div class="input-group"> 
                                        <input type="number" name="quantity[]" class="input-number" data-min="1" data-max="1000" id="quantity" value="{{$value->qty}}">
                                        <input type="text" name="rowId[]" class="input-number" id="rowId" value="{{$value->rowId}}" hidden>
                                    </div> --}}

                                </td>
                                <td class="total-amount cart_single_price" data-title="Total"><span class="money" id="total">{{number_format($value->price * $value->qty,0,',','.')}} đ</span></td>

                                <td class="action" data-title="Remove"><a href="{{route('cart.delete',$value->rowId)}}"><i class="ti-trash remove-icon"></i></a></td>
                            </tr>
                            @endforeach

                            <td cospan="2">
                                <a href="{{route('cart.delete','all')}}" class="btn btn-info text-white"><i class="ti-trash remove-icon"></i>Remove Cart</a>
                            </td>
                            <td class="float-right" cospan="2">
                                <button class="btn float-right" type="submit">Update</button>
                            </td>
                        @else
                        <tr>
                            <td class="text-center">
                                There are no any carts available. <a href="{{route('product-grids')}}" style="color:blue;">Continue shopping</a>
                            </td>
                        </tr>
                        @endif

                        </form>
                    </tbody>
                </table>
                <!--/ End Shopping Summery -->
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <!-- Total Amount -->
                <div class="total-amount">
                    <div class="row">
                        <div class="col-lg-8 col-md-5 col-12">
                            <div class="left">
                                <div class="coupon">
                                    <form action="{{route('check.coupon')}}" method="get">
                                        @csrf
                                        <input type="text" name="coupon" placeholder="Enter Your Coupon" class="@error('coupon') is-invalid @enderror">
                                        <button type="submit" class="btn">Apply</button>
                                    </form>
                                    @error('coupon')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-7 col-12">
                            <div class="right">
                                <ul>
                                    <li class="order_subtotal" data-price="">Cart Subtotal<span></span></li>
                                    <li class="coupon_price" data-price="">You Save<span></span></li>
                                    <li class="last" id="order_total_price">You Pay<span></span></li>
                                </ul>
                                <div class="button5">
                                    <a href="{{route('checkout')}}" class="btn">Checkout</a>
                                    <a href="{{route('product-grids')}}" class="btn">Continue shopping</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/ End Total Amount -->
            </div>
        </div>
    </div>
</div>
