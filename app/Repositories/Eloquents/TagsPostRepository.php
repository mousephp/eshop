<?php 

namespace App\Repositories\Eloquents;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Repositories\Contracts\TagsPostRepositoryInterface;
use App\Models\PostTag;
use Illuminate\Support\Facades\DB;

class TagsPostRepository extends EloquentRepository implements TagsPostRepositoryInterface
{
	protected $postTag;

	function __construct(PostTag $postTag)
	{
		$this->postTag = $postTag;
		parent::__construct($postTag);
	}

	public function pagination(){
		return $this->postTag->paginate(15);
	}
    
}




