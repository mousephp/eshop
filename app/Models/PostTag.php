<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Post;

class PostTag extends Model
{
    use SoftDeletes;

	protected $table = 'post_tags';
    protected $dates = ['deleted_at'];

    protected $fillable = ['name', 'slug', 'status'];
    
    public function post(){
        return $this->belongsToMany(Post::class, 'post_blog_tags', 'post_id', 'tag_id');

    }

    public static function getBlogByTag($slug){
        return PostTag::with('post')->where('slug',$slug)->first();
    }
}
