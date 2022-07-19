<!-- Header Inner -->
<div class="header-inner">
    <div class="container">
        <div class="cat-nav-head">
            <div class="row">
                <div class="col-lg-12 col-12">
                    <div class="menu-area">
                        <!-- Main Menu -->
                        <nav class="navbar navbar-expand-lg">
                            <div class="navbar-collapse">
                                <div class="nav-inner">
                                    <ul class="nav main-menu menu navbar-nav">
                                        <li class="{{Request::path()=='home' ? 'active' : ''}}"><a href="{{route('home')}}">Home</a></li>
                                        <li class="{{Request::path()=='about-us' ? 'active' : ''}}"><a href="{{route('about-us')}}">About Us</a></li>
                                        <li class="@if(Request::path()=='product-grids'||Request::path()=='product-lists')  active  @endif"><a href="{{route('product-grids')}}">Products</a><span class="new">New</span></li>

                                        {{-- {{Helper::getHeaderCategory()}} --}}

                                        <li><a href="#">Shop<i class="ti-angle-down"></i><span class="new">New</span></a>
                                            <ul class="dropdown border-0 shadow">
                                                @foreach(Helper::getMenuMultiple() as $category)
                                                <li>
                                                    <a href="{{route('product-cat',$category->slug)}}">
                                                        {{ $category->name }}
                                                    </a>
                                                    @if(count($category->children))
                                                    @include('frontend.layouts.subCategoryList',['childs' => $category->children])
                                                    @endif
                                                </li>
                                                @endforeach
                                            </ul>
                                        </li>


                                        <li class="{{Request::path()=='blog' ? 'active' : ''}}"><a href="{{route('blog')}}">Blog</a></li>

                                        <li class="{{Request::path()=='contact' ? 'active' : ''}}"><a href="{{route('contact')}}">Contact Us</a></li>
                                    </ul>
                                </div>
                            </div>
                        </nav>
                        <!--/ End Main Menu -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--/ End Header Inner -->
