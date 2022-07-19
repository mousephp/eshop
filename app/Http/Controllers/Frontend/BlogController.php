<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Contracts\{ PostRepositoryInterface, TagsPostRepositoryInterface, CatePostRepositoryInterface };
use App\Models\{ PostTag, PostCate, Post };
use App\User;
use Session;
use DB;
use Hash;
use Log;
use Exception;
use Illuminate\Support\Facades\Auth;
use Route;

class BlogController extends Controller
{   
    protected $catePost;
    protected $tagPost;
    protected $post;

    public function __construct(PostCate $catePost, Post $post, PostTag $tagPost)
    {
        $this->catePost = $catePost;
        $this->tagPost  = $tagPost;
        $this->post     = $post;
    }

    public function getRoute(){
        $route = Route::current()->uri;

        return $route;
    }

    public function blog(){
        $route = $this->getRoute();

        $post  = $this->post->query();
        
        // if(!empty($_GET['category'])){
        //     $slug    = explode(', ',$_GET['category']);
        //     $cat_ids = $this->catePost->select('id')->whereIn('slug', $slug)->pluck('id')->toArray();
        //     return $cat_ids;

        //     $post->whereIn('post_cate_id', $cat_ids);
        // }

        // if(!empty($_GET['tag'])){
        //     $slug    = explode(',',$_GET['tag']);
        //     $tag_ids = $this->tagPost->select('id')->whereIn('slug', $slug)->pluck('id')->toArray();

        //     $post->where('post_tag_id',$tag_ids);
        // }

        if(!empty($_GET['show'])){
            $posts = $post->where('status', 'active')->orderBy('id', 'DESC')->paginate($_GET['show']);
        }else{
            $posts = $post->where('status', 'active')->orderBy('id', 'DESC')->paginate(8);
        }

        $recent_posts = $this->post->where('status','active')->orderBy('id','DESC')->limit(3)->get();
        
        return view('frontend.pages.blog')->with(compact('posts','recent_posts','route'));
    }

    public function blogDetail($slug){
        $post      = $this->post->getPostBySlug($slug);
        
        $rcnt_post = $this->post->where('status','active')->orderBy('id', 'DESC')->limit(3)->get();
        // $postTags  = $this->post->with('tags')->get();
        // $posts = $postTags->first()->tags;

        // $postTags  = $this->post->whereHas('tags', function($query) {
        //     $query->where('id', 'tag_id');
        // })->get();

        return view('frontend.pages.blog-detail')->with('post',$post)->with('recent_posts',$rcnt_post);
    }

    public function blogSearch(Request $request){
        $rcnt_post = $this->post->where('status', 'active')->orderBy('id', 'DESC')->limit(3)->get();

        $posts = $this->post->orwhere('title', 'like', '%'.$request->search.'%')
                    ->orwhere('quote', 'like', '%'.$request->search.'%')
                    ->orwhere('summary', 'like', '%'.$request->search.'%')
                    ->orwhere('description', 'like', '%'.$request->search.'%')
                    ->orwhere('slug', 'like', '%'.$request->search.'%')
                    ->orderBy('id', 'DESC')
                    ->paginate(8);

        return view('frontend.pages.blog')->with('posts', $posts)->with('recent_posts', $rcnt_post);
    }

    public function blogFilter(Request $request){
        // $data   = $request->all();

        // dd($data);

        // $catURL = "";
        // if(!empty($data['category'])){
        //     foreach($data['category'] as $category){
        //         if(empty($catURL)){
        //             $catURL .='&category='.$category;
        //         }else{
        //             $catURL .=','.$category;
        //         }                      
        //     }
        // }

        // $tagURL = "";
        // if(!empty($data['tag'])){
        //     foreach($data['tag'] as $tag){
        //         if(empty($tagURL)){
        //             $tagURL .='&tag='.$tag;
        //         }else {           
        //             $tagURL .=','.$tag;
        //         }
        //     }
        // }

        // return redirect()->route('blog', $catURL.$tagURL);
    }

    public function blogByCategory(Request $request){
        $post      = $this->catePost->getBlogByCategory($request->slug);

        $rcnt_post = $this->post->where('status','active')->orderBy('id','DESC')->limit(3)->get();

        return view('frontend.pages.blog')->with('posts', $post->post)->with('recent_posts', $rcnt_post)->with('route',$this->getRoute());
    }

    public function blogByTag(Request $request){
        $post      = $this->post->getBlogByTag($request->slug);
        // $post      = $this->tagPost->getBlogByTag($request->slug);
        
        $rcnt_post = $this->post->where('status', 'active')->orderBy('id', 'DESC')->limit(3)->get();

        return view('frontend.pages.blog')->with('posts',$post)->with('recent_posts',$rcnt_post)->with('route',$this->getRoute());
    }

    public function subscribe(Request $request){
        // if(! Newsletter::isSubscribed($request->email)){
        //         Newsletter::subscribePending($request->email);
        //         if(Newsletter::lastActionSucceeded()){
        //             request()->session()->flash('success','Subscribed! Please check your email');
        //             return redirect()->route('home');
        //         }
        //         else{
        //             Newsletter::getLastError();
        //             return back()->with('error','Something went wrong! please try again');
        //         }
        //     }
        //     else{
        //         request()->session()->flash('error','Already Subscribed');
        //         return back();
        //     }
    }
}


// $this->post->query(): 
// =>
// Model::where()->get();
// Is the same as:
// Model::query()->where()->get();


//$_GET: Lấy Tham Số Từ Url