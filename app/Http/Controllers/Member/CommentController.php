<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{ Client, Comment };
use Auth;

class CommentController extends Controller
{
    protected $comment;

    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
    }
    
    public function index(){
        $comments = $this->comment->where('client_id',Auth::guard('client')->user()->id)->with('userInfo')->paginate(10);

        return view('user.comment.index')->with('comments', $comments);
    }

    public function edit($id){
        $comment = $this->comment->findOrFail($id);

        if($comment){
            return view('user.comment.edit')->with('comment', $comment);
        }
        
        return redirect()->back()->with('error', 'Comment not found');
    }

    public function update(Request $request, $id){
        $comment = $this->comment->findOrFail($id);

        $data    = $request->all();
        
        if($comment){            
            $status = $comment->fill($data)->update();

            if($status){
                return redirect()->back()->with('success', 'Sửa comment thành công');
            }

            return redirect()->back()->with('erorr', 'Sửa comment thất bại');
        }

        return redirect()->back()->with('erorr','Comment Not Found');
    }

    public function destroy($id){
        $comment = $this->comment->findOrFail($id);

        if($comment){
            $status = $comment->delete($id);

            if($status){
                return redirect()->back()->with('success', 'Xóa comment thành công');
            }
            
            return redirect()->back()->with('erorr', 'Xóa comment thất bại');
        }
        
        return redirect()->back()->with('erorr', 'Comment Not Found');
    }

    public function remove(){

    }

}
