<div class="col-lg-4 col-12">
    <div class="main-sidebar">
        <!-- Single Widget -->
        <div class="single-widget search">
            <form class="form" method="GET" action="{{route('blog.search')}}">
                <input type="text" placeholder="Search Here..." name="search">
                <button class="button" type="sumbit"><i class="fa fa-search"></i></button>
            </form>
        </div>
        <!--/ End Single Widget -->
        <!-- Single Widget -->
        <div class="single-widget category">
            <h3 class="title">Blog Categories</h3>
            <ul class="categor-list">
                <form action="{{route('blog.filter')}}" method="POST">
                    @csrf
                    @foreach(Helper::postCategoryList('posts') as $cate)
                    <li>
                        <a href="{{route('blog.category',$cate->slug)}}">{{$cate->name}} </a>
                    </li>
                    @endforeach
                </form>
            </ul>
        </div>
        <!--/ End Single Widget -->
        <!-- Single Widget -->
        <div class="single-widget recent-post">
            <h3 class="title">Recent post</h3>
            @foreach($recent_posts as $post)
            <!-- Single Post -->
            <div class="single-post">
                <div class="image">
                    <img src="{{asset($post->photo)}}" alt="{{$post->photo}}">
                </div>
                <div class="content">
                    <h5><a href="#">{{$post->title}}</a></h5>
                    <ul class="comment">
                        <li><i class="fa fa-calendar" aria-hidden="true"></i>
                            @if(isset($post->created_at))
                            {{$post->created_at->format('d M, Y. D')}}
                            @endif
                        </li>
                        <li>
                            <i class="fa fa-user" aria-hidden="true"></i>
                            @if($post->admin->name)
                            {{$post->admin->name}}
                            @else
                            Anonymous
                            @endif
                        </li>
                    </ul>
                </div>
            </div>
            <!-- End Single Post -->
            @endforeach
        </div>
        <!--/ End Single Widget -->
        <!-- Single Widget -->
        <!--/ End Single Widget -->
        <!-- Single Widget -->
        <div class="single-widget side-tags">
            <h3 class="title">Tags</h3>
            <ul class="tag">
                <form action="{{route('blog.filter')}}" method="POST">
                    @csrf
                    @foreach(Helper::postTagList('posts') as $tag)
                    <li>
                    
                        <a href="{{route('blog.tag',substr($tag->name,strpos($tag->name,'#')+1))}}">{{$tag->name}} </a>
                    </li>
                    @endforeach
                </form>
            </ul>
        </div>
        <!--/ End Single Widget -->
        <!-- Single Widget -->
        <div class="single-widget newsletter">
            <h3 class="title">Newslatter</h3>
            <div class="letter-inner">
                <h4>Subscribe & get news <br> latest updates.</h4>
                <form method="POST" action="{{route('subscribe')}}" class="form-inner">
                    @csrf
                    <input type="email" name="email" placeholder="Enter your email">
                    <button type="submit" class="btn " style="width: 100%">Submit</button>
                </form>
            </div>
        </div>
        <!--/ End Single Widget -->
    </div>
</div>
