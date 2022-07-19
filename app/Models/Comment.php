<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Client;
use Auth;

class Comment extends Model
{
    use SoftDeletes;

    protected $table = 'comments';
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'client_id', 'post_id', 'comment', 'replied_comment', 'parent_id', 'status'
    ];

    public function userInfo(){
        return $this->hasOne(Client::class, 'id', 'client_id');
    }

    public static function getAllComments(){
        return Comment::with('userInfo')->paginate(10);
    }

    public static function getAllUserComments(){
        $count = Comment::where('client_id', Auth::guard('client')->user()->id)->with('userInfo')->count();

        if($count){
            return $count;
        }
        
        return 0;
    }

    public function post(){
        return $this->belongsTo(Post::class);
    }

    public function replies(){ 
        return $this->hasMany(Comment::class, 'parent_id')->where('status', 'active');
    }
}
