<section class="shop-blog section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title">
                    <h2>From Our Blog</h2>
                </div>
            </div>
        </div>
        <div class="row">
            @if($posts)
            @foreach($posts as $post)
            <div class="col-lg-4 col-md-6 col-12">
                <!-- Start Single Blog  -->
                <div class="shop-single-blog">
                    <img src="{{asset($post->photo)}}" alt="{{asset($post->photo)}}">
                    <div class="content">
                        <p class="date">{{$post->created_at ? $post->created_at->format('d M , Y. D') : ''}}</p>
                        <a href="{{route('blog.detail',$post->slug)}}" class="title">{{$post->title}}</a>
                        <a href="{{route('blog.detail',$post->slug)}}" class="more-btn">Continue Reading</a>
                    </div>
                </div>
                <!-- End Single Blog  -->
            </div>
            @endforeach
            @endif
        </div>
    </div>
</section>