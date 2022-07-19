<div class="comment-review">
    <div class="add-review">
        <h5>Add A Review</h5>
        <p>Your email address will not be published. Required fields are marked</p>
    </div>
    <h4>Your Rating <span class="text-danger">*</span></h4>
    <div class="review-inner">
        <!-- Form -->

        @if(Auth::guard('client')->user())
        <form class="form" method="post" action="{{route('review.store',$product_detail->slug)}}">
            @csrf
            <div class="row">
                <div class="col-lg-12 col-12">
                    <div class="rating_box">
                        <div class="star-rating">
                            <div class="star-rating__wrap">
                                <input class="star-rating__input" id="star-rating-5" type="radio" name="rate" value="5">
                                <label class="star-rating__ico fa fa-star-o" for="star-rating-5" title="5 out of 5 stars"></label>
                                <input class="star-rating__input" id="star-rating-4" type="radio" name="rate" value="4">
                                <label class="star-rating__ico fa fa-star-o" for="star-rating-4" title="4 out of 5 stars"></label>
                                <input class="star-rating__input" id="star-rating-3" type="radio" name="rate" value="3">
                                <label class="star-rating__ico fa fa-star-o" for="star-rating-3" title="3 out of 5 stars"></label>
                                <input class="star-rating__input" id="star-rating-2" type="radio" name="rate" value="2">
                                <label class="star-rating__ico fa fa-star-o" for="star-rating-2" title="2 out of 5 stars"></label>
                                <input class="star-rating__input" id="star-rating-1" type="radio" name="rate" value="1">
                                <label class="star-rating__ico fa fa-star-o" for="star-rating-1" title="1 out of 5 stars"></label>
                                @error('rate')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 col-12">
                    <div class="form-group">
                        <label>Write a review</label>
                        <textarea name="review" rows="6" placeholder=""></textarea>
                        @error('review')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-lg-12 col-12">
                    <div class="form-group button5">
                        <button type="submit" class="btn">Submit</button>
                    </div>
                </div>
            </div>
        </form>
        @else
        <p class="text-center p-5">
            You need to <a href="{{route('login.form')}}" style="color:rgb(54, 54, 204)">Login</a> OR <a style="color:blue" href="{{route('register.form')}}">Register</a>
        </p>
        <!--/ End Form -->
        @endif
    </div>
</div>

<div class="ratting-main">
    <div class="avg-ratting">
        <h4>{{ceil($product_detail->getReview->avg('rate'))}} <span>(Overall)</span></h4>
        <span>Based on {{$product_detail->getReview->count()}} Comments</span>
    </div>

    @foreach($product_detail['getReview'] as $data)
    <!-- Single Rating -->
    <div class="single-rating">
        <div class="rating-author">
            @if($data->user_info['photo'])
            <img src="{{$data->user_info['photo']}}" alt="{{$data->user_info['photo']}}">
            @else
            <img src="{{asset('backend/img/avatar.png')}}" alt="Profile.jpg">
            @endif
        </div>
        <div class="rating-des">
            <h6>{{$data->user_info['name']}}</h6>
            <div class="ratings">
                <ul class="rating">
                    @for($i=1; $i<=5; $i++) @if($data->rate>=$i)
                        <li><i class="fa fa-star"></i></li>
                        @else
                        <li><i class="fa fa-star-o"></i></li>
                        @endif
                    @endfor
                </ul>
                <div class="rate-count">(<span>{{$data->rate}}</span>)</div>
            </div>
            <p>{{$data->review}}</p>
        </div>
    </div>
    <!--/ End Single Rating -->
    @endforeach

</div>
