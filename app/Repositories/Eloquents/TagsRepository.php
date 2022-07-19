<?php 

namespace App\Repositories\Eloquents;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Repositories\Contracts\TagsRepositoryInterface;
use App\Models\Tag;
use Illuminate\Support\Facades\DB;

class TagsRepository extends EloquentRepository implements TagsRepositoryInterface
{
	protected $tag;

	function __construct(Tag $tag)
	{
		$this->tag = $tag;
		parent::__construct($tag);
	}

	public function pagination(){
		return $this->tag->paginate(15);
	}
    
}




