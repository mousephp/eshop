<section class="shop checkout section">
    <div class="container">
        <form class="form" method="POST" action="{{route('checkout.place.order')}}">
            @csrf
            @method('post')
            
            <div class="row">
                <div class="col-lg-8 col-12">
                    <div class="checkout-form">
                        <h2>Make Your Checkout Here</h2>
                        <p>Please register in order to checkout more quickly</p>
                        <!-- Form -->
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="form-group">
                                    <label>Name<span>*</span></label>
                                    <input type="text" name="full_name" placeholder="" value="{{old('full_name')}}" value="{{old('first_name')}}" class="form-control @error('full_name') is-invalid @enderror">
                                    @error('full_name')
                                    <span class='text-danger'>{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="form-group">
                                    <label>Email Address<span>*</span></label>
                                    <input type="email" name="email" placeholder="" value="{{old('email')}}" class="form-control @error('name') is-invalid @enderror">
                                    @error('email')
                                    <span class='text-danger'>{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="form-group">
                                    <label>Phone Number <span>*</span></label>
                                    <input type="number" name="phone" placeholder="" value="{{old('phone')}}" class="form-control @error('phone') is-invalid @enderror">
                                    @error('phone')
                                    <span class='text-danger'>{{$message}}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="form-group">
                                    <label>Address<span>*</span></label>
                                    <textarea rows="2" id="address" class="form-control @error('address') is-invalid @enderror" name="address" placeholder="Địa chỉ" value="{{old('address')}}"></textarea>
                                    @error('address')
                                    <span class='text-danger'>{{$message}}</span>
                                    @enderror
                                </div>
                            </div>

                            {{-- select address --}}
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Chọn tỉnh, thành phố</label>
                                    <select name="province" id="province" class="form-control input-sm m-bot15 choose province">
                                        <option value="" disabled>--Chọn tỉnh thành phố--</option>
                                        @foreach ($provinces as $province)
                                        <option value="{{$province->id}}">
                                            {{$province->name}}
                                        </option>
                                        @endforeach
                                    </select>
                                    @error('address')
                                    <span class='text-danger'>{{$message}}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Chọn quận huyện</label>
                                    <select name="district" id="district" class="form-control">
                                        {{-- <option value="0" disabled>--Chọn quận huyện--</option> --}}
                                    </select>
                                    @error('address')
                                    <span class='text-danger'>{{$message}}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Chọn xã phường</label>
                                    <select name="ward" id="ward" class="form-control">
                                        {{-- <option value="0" disabled>--Chọn xã phường--</option> --}}
                                    </select>
                                    @error('address')
                                    <span class='text-danger'>{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            {{-- end select address --}}

                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Số nhà, tên đường</label>
                                    <textarea rows="2" id="shipping_address" class="form-control @error('shipping_address') is-invalid @enderror" name="shipping_address" placeholder="Số nhà, tên đường"></textarea>
                                </div>
                                @error('address')
                                <span class='text-danger'>{{$message}}</span>
                                @enderror
                            </div>

                        </div>
                        <!--/ End Form -->
                    </div>
                </div>

                <!-- Order Widget -Payment Method Widget / Button Widget -->
                @include('frontend.checkout.order_widget')
                <!--/ End Order Widget / Payment Method Widget / Button Widget -->

            </div>
        </form>
    </div>
</section>



<script src="{{asset('frontend/js/jquery.min.js')}}"></script>

<script>
    $(document).ready(function() {
        $('#province').on('change', function() {
            var idProvince = this.value;
            $("#district").html('');
            $.ajax({
                url: "{{url('fetch-district')}}"
                , type: "POST"
                , data: {
                    province_id: idProvince
                    , _token: '{{csrf_token()}}'
                }
                , dataType: 'json'
                , success: function(result) {
                    // console.log(result);
                    $('#district').html('<option disabled value="">Select district</option>');
                    $.each(result.districts, function(key, value) {
                        $("#district").append('<option value="' + value.id + '">' + value.name + '</option>');
                    });
                    $('#ward').html('<option value="">Select ward</option>');
                }
            });
        });
        $('#district').on('change', function() {
            var idDistrict = this.value;
            $("#ward").html('');
            $.ajax({
                url: "{{url('fetch-ward')}}"
                , type: "POST"
                , data: {
                    district_id: idDistrict
                    , _token: '{{csrf_token()}}'
                }
                , dataType: 'json'
                , success: function(res) {
                    console.log(res);
                    $('#ward').html('<option disabled value="">Select ward</option>');
                    $.each(res.wards, function(key, value) {
                        $("#ward").append('<option value="' + value.id + '">' + value.name + '</option>');
                    });
                }
            });
        });
    });
    //https://www.positronx.io/laravel-dependent-country-state-city-dropdown-with-ajax/

</script>
