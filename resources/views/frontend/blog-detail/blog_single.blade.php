<div class="col-lg-8 col-12">
    <div class="blog-single-main">
        <div class="row">
            <div class="col-12">
                <div class="image">
                    <img src="{{asset($post->photo)}}" alt="{{$post->photo}}">
                </div>
                <div class="blog-detail">
                    <h2 class="blog-title">{{$post->title}}</h2>
                    {{-- <div class="sharethis-inline-reaction-buttons"></div> --}}

                    <h5 class="card-header">
                        <small class="float-right">
                            <span title="Likes" id="saveLikeDislike" data-type="like" data-post="{{ $post->id}}" class="mr-2 btn btn-sm btn-outline-primary d-inline font-weight-bold like_post">
                                Like
                                <span class="like-count">{{ $post->likes() }}</span>
                            </span>
                            <span title="Dislikes" id="saveLikeDislike" data-type="dislike" data-type="dislike" data-post="{{ $post->id}}" class="mr-2 btn btn-sm btn-outline-danger d-inline font-weight-bold dislike_post">
                                Dislike
                                <span class="dislike-count">{{ $post->dislikes() }}</span>
                            </span>
                        </small>
                    </h5>

                    <div class="content">
                        @if($post->quote)
                        <blockquote> <i class="fa fa-quote-left"></i> {!! ($post->quote) !!}</blockquote>
                        @endif
                        <p>{!! ($post->description) !!}</p>
                    </div>
                </div>
                <div class="share-social">
                    <div class="row">
                        <div class="col-12">
                            <div class="content-tags">
                                <h4>Tags:</h4>
                                <ul class="tag-inner">
                                    @foreach($post->tags as $tag)
                                        <li><a href="javascript:void(0);">{!!$tag->name!!}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @if(Auth::guard('client')->user())
            <div class="col-12 mt-4">
                <div class="reply">
                    <div class="reply-head comment-form" id="commentFormContainer">
                        <h2 class="reply-title">Leave a Comment</h2>
                        <!-- Comment Form -->
                        <form class="form comment_form" id="commentForm" action="{{route('post-comment.store',$post->slug)}}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group  comment_form_body">
                                        <label>Your Message<span>*</span></label>
                                        <textarea name="comment" id="comment" rows="10" placeholder=""></textarea>
                                        @error('comment')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                        <input type="hidden" name="post_id" value="{{ $post->id }}" />
                                        <input type="hidden" name="parent_id" id="parent_id" value="" />
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group button">
                                        <button type="submit" class="btn"><span class="comment_btn comment">Post Comment</span><span class="comment_btn reply" style="display: none;">Reply Comment</span></button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <!-- End Comment Form -->
                    </div>
                </div>
            </div>

            @else
            <p class="text-center p-5">
                You need to <a href="{{route('login.form')}}" style="color:rgb(54, 54, 204)">Login</a> OR <a style="color:blue" href="{{route('register.form')}}">Register</a> for comment.
            </p>
            <!--/ End Form -->
            @endif

            <div class="col-12">
                <div class="comments">
                    <h3 class="comment-title">Comments ({{$post->allComments->count()}})</h3>
                    <!-- Single Comment -->
                    @include('frontend.pages.comment', ['comments' => $post->comments, 'depth' => 3])
                    <!-- End Single Comment -->
                </div>
            </div>

        </div>
    </div>
</div>

{{-- $post->comments: comment cha --}}




