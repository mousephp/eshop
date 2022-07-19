<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PostBlogTag extends Model
{
    use SoftDeletes;

	protected $table = 'post_blog_tags';
    protected $dates = ['deleted_at'];

    protected $fillable = ['post_id', 'tag_id'];
    
}
