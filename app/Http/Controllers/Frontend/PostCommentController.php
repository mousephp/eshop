<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{ Post, Comment };
// use Notification;
use App\User;
// use App\Notifications\StatusNotification;
use Auth;

class PostCommentController extends Controller
{
    protected $comment;
    protected $post;
    
    public function __construct(Post $post, Comment $comment)
    {
        $this->comment = $comment;
        $this->post    = $post;
    }
    
    public function store(Request $request)
    {
        $this->validate($request,[
                'comment' => 'required',
            ]
        );

        $data              = $request->all();

        $data['client_id'] = Auth::guard('client')->user()->id; //$request->user()->id;
        
        $data['status']    = 'active';

        $comment           = $this->comment->create($data);

        // $post_info         = $this->post->getPostBySlug($request->slug);  

        

        // $details = [
        //     'title'     => "New Comment created",
        //     'actionURL' => route('blog.detail',$post_info->slug),
        //     'fas'       => 'fas fa-comment'
        // ];
        
        // Notification::send($user, new StatusNotification($details));

        if($comment){
            request()->session()->flash('success','Thank you for your comment');
        }else{
            request()->session()->flash('error','Something went wrong! Please try again!!');
        }
        
        return redirect()->back();
    }

}
