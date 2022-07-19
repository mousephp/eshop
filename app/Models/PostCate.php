<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Post;

class PostCate extends Model
{
    use SoftDeletes;

	protected $table = 'post_categories';
    protected $dates = ['deleted_at'];

    protected $fillable = ['name', 'slug', 'status'];

    public function post(){
        return $this->hasMany(Post::class, 'post_cate_id', 'id')->where('status','active');
    }

    public static function getBlogByCategory($slug){
        return PostCate::with('post')->where('slug',$slug)->first();
    }

}
