<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{ Post, LikePost };
use Auth;
use App\User;

class LikeController extends Controller
{
    protected $like;

    public function __construct(LikePost $like)
    {
        $this->like = $like;
    }

    function saveLikeDislike(Request $request){
        if(Auth::guard('client')->user()){
            $isLike = $this->like->where('user_id', Auth::guard('client')->user()->id)
                ->where('post_id', $request->post)
                ->first();

            if($isLike) return $this->isLike();
            
            if(!$isLike) return $this->notIsLike($request, $isLike);
        }

        return response()->json([
            'auth' => false,
            'bool' => false
        ]);
    }

    function isLike(){       
        return response()->json([
            'message' => 'Bạn đã like bài viết này',
            'auth' => true,
            'bool' => true
        ]);   
    }
   
    function notIsLike($request, $isLike){       
        $this->like->post_id = $request->post;
        $this->like->user_id =  Auth::guard('client')->user()->id;

        if($request->type == 'like'){          
            $this->like->like = 1;
        }else{
            $this->like->dislike = 1;
        }

        $this->like->save();

        return response()->json([
            'message' => 'Thanks Your',
            'auth' => true,
            'bool' => true
        ]);  
    }
}
