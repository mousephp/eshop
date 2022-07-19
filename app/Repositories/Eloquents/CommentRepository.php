<?php 

namespace App\Repositories\Eloquents;
use Illuminate\Http\Request;
use App\Repositories\Contracts\CommentRepositoryInterface;
use App\Models\Comment;
use Illuminate\Support\Facades\DB;

class CommentRepository extends EloquentRepository implements CommentRepositoryInterface
{
	protected $comment;

	function __construct(Comment $comment)
	{
        $this->comment = $comment;
		parent::__construct($comment);
	}

	public function pagination(){
		return $tags = DB::table('comments')->paginate(5);
	}

    public function createComment($attributes, $id){
        //return $this->model->create($attributes, $id);
        // $result = $this->comment->find($id);
        // if($result){
        //     $result->create($attributes);
        //     return $result;
        // }
        // return false;
    }
}




