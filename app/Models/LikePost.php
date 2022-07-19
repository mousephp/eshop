<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LikePost extends Model
{
    use SoftDeletes;
    protected $table 	= 'like_posts';

    protected $fillable = [
        'like', 'dislike', 'post_id', 'client_id',
    ];
    
    protected $dates = ['deleted_at'];

}
