<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\User;
use App\Models\Client;
use App\Models\{ PostCate, PostTag, PostBlogTag, Comment, LikePost};

class Post extends Model
{
    use SoftDeletes;

	protected $table = 'posts';
    protected $dates = ['deleted_at'];

    protected $fillable = ['title', 'summary', 'slug', 'description', 'photo', 'quote', 'post_cate_id', 'user_id', 'status'];

    public function admin() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function tags() {
        return $this->belongsToMany(PostTag::class, 'post_blog_tags', 'post_id', 'tag_id')->select(['name']);
    }

    public function category() {
        return $this->belongsTo(PostCate::class, 'post_cate_id');
    }

    // Likes
    public function likes(){
        return $this->hasMany(LikePost::class,'post_id')->sum('like');
    }
    // Dislikes
    public function dislikes(){
        return $this->hasMany(LikePost::class,'post_id')->sum('dislike');
    }
    
    public function cat_info(){
        return $this->hasOne('App\Models\PostCate','id','post_cate_id');
    }
    public function tag_info(){ 
        return $this->hasOne('App\Models\PostTag','id','post_tag_id');
    }

    public function author_info(){ 
        return $this->hasOne('App\User','id','added_by');
    }
    public static function getAllPost(){ 
        return Post::with(['cat_info','author_info'])->orderBy('id','DESC')->paginate(10);
    }

    public static function getPostBySlug($slug){
        return Post::with(['tag_info', 'author_info'])->where('slug',$slug)->where('status', 'active')->first();
    }

    //lấy ra comment parent và thông tin user đã comment với comment đó 
    public function comments(){
        return $this->hasMany(Comment::class)->whereNull('parent_id')->where('status','active')->with('userInfo')   ->orderBy('id','DESC');
    }

    public function allComments(){
        return $this->hasMany(Comment::class)->where('status','active');
    }

    public static function getBlogByTag($slug){
        return Post::where('slug', $slug)->paginate(8);
    }

    public static function countActivePost(){
        $data = Post::where('status','active')->count();

        if($data){
            return $data;
        }

        return 0;
    }

}
