<?php 

namespace App\Repositories\Eloquents;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Repositories\Contracts\ProductRejectRepositoryInterface;
use App\Models\ProductReject;
use Illuminate\Support\Facades\DB;

class ProductRejectRepository extends EloquentRepository implements ProductRejectRepositoryInterface
{
	protected $reject;

	function __construct(ProductReject $reject)
	{
		parent::__construct($reject);
		$this->reject = $reject;
	}

    public function pagination(){
        return $this->reject->paginate(5);
    }

}




