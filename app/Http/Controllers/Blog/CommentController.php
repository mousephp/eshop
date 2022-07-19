<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// use App\Notifications\StatusNotification;
use App\Repositories\Contracts\CommentRepositoryInterface;
use Illuminate\Support\Str;
use App\Models\{ Comment, Post };
use App\User;
use Auth;
use Log;

class CommentController extends Controller
{
    protected $comment;

    public function __construct(CommentRepositoryInterface $comment)
    {
        $this->comment = $comment;
    }

    public function index()
    {
        $comments = $this->comment->all();

        return view('backend.blog.comment.index', compact('comments'));
    }

    public function destroy($id)
    {  
        try {
            $this->comment->delete($id);

            return redirect()->route('comment.index')->with('success', 'Xóa comment thành công');
        } catch (\Exception $e) {
            Log::error('error(loi):'.$e->getMessage().$e->getLine());
        }
    }
}
