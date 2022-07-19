<div class="col-lg-8 col-12">
    <div class="row">
        @foreach($posts as $post)
        {{-- {{$post}} --}}
        <div class="col-lg-6 col-md-6 col-12">
            <!-- Start Single Blog  -->
            <div class="shop-single-blog">
                <img src="{{asset($post->photo)}}" alt="{{$post->photo}}">
                <div class="content">
                    <p class="date"><i class="fa fa-calendar" aria-hidden="true"></i> 
                        @if(isset($post->created_at))
                            {{$post->created_at->format('d M, Y. D')}}
                        @endif
                        <span class="float-right">
                            <i class="fa fa-user" aria-hidden="true"></i>                 
                            @if($post->admin->name)
                                {{$post->admin->name}}
                            @else
                                Anonymous
                            @endif
                        </span>
                    </p>
                    <a href="{{route('blog.detail',$post->slug)}}" class="title">{{$post->title}}</a>
                    <p>{!! html_entity_decode($post->summary) !!}</p>
                    <a href="{{route('blog.detail',$post->slug)}}" class="more-btn">Continue Reading</a>
                </div>
            </div>
            <!-- End Single Blog  -->
        </div>
        @endforeach

        @if($route == 'blog')
        <div class="col-12">
            <!-- Pagination -->
            {{$posts->appends($_GET)->links()}}
            <!--/ End Pagination -->
        </div>
        @endif
    </div>
</div>
