<div class="col-lg-4 col-12">
    <div class="order-details">
        <!-- Order Widget -->
        <div class="single-widget">
            <h2>CART TOTALS</h2>
            <div class="content">
                <ul>
                    <li class="order_subtotal" data-price="">Cart Subtotal<span>$</span></li>
                    <li class="shipping">
                        Shipping Cost
                        <select name="shipping" class="nice-select">
                            <option value="">Select your address</option>
                            <option value="" class="shippingOption" data-price=""></option>
                        </select>

                        {{-- <span>Free</span> --}}
                    </li>
                    <li class="coupon_price" data-price="">You Save<span></span></li>
                    <li class="last" id="order_total_price">Total<span></span></li>
                </ul>
            </div>
        </div>
        <!--/ End Order Widget -->
        <!-- Order Widget -->
        <div class="single-widget">
            <h2>Payments</h2>
            <div class="content">
                <div class="checkbox">
                    {{-- <label class="checkbox-inline" for="1"><input name="updates" id="1" type="checkbox"> Check Payments</label> --}}
                    <form-group>
                        <input name="payment_method" type="radio" value="cod" checked> <label> Cash On Delivery</label><br>
                        <input name="payment_method" type="radio" value="paypal"> <label> PayPal</label>
                    </form-group>
                </div>
            </div>
        </div>
        <!--/ End Order Widget -->
        <!-- Payment Method Widget -->
        <div class="single-widget payement">
            <div class="content">
                <img src="{{('backend/img/payment-method.png')}}" alt="#">
            </div>
        </div>
        <!--/ End Payment Method Widget -->
        <!-- Button Widget -->
        <div class="single-widget get-button">
            <div class="content">
                <div class="button">
                    <button type="submit" class="btn">proceed to checkout</button>
                </div>
            </div>
        </div>
        <!--/ End Button Widget -->
    </div>
</div>
