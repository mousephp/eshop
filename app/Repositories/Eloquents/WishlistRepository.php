<?php 

namespace App\Repositories\Eloquents;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Repositories\Contracts\WishlistRepositoryInterface;
use App\Models\Wishlist;
use Illuminate\Support\Facades\DB;

class WishlistRepository extends EloquentRepository implements WishlistRepositoryInterface
{
	protected $wishlist;

	function __construct(Wishlist $wishlist)
	{
		$this->wishlist = $wishlist;
		parent::__construct($wishlist);
	}

	public function pagination(){
		return $this->wishlist->paginate(15);
	}
    
}




