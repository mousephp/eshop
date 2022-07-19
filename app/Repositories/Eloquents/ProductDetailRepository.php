<?php 

namespace App\Repositories\Eloquents;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Repositories\Contracts\ProductDetailRepositoryInterface;
use App\Models\ProductDetail;
use Illuminate\Support\Facades\DB;

class ProductDetailRepository extends EloquentRepository implements ProductDetailRepositoryInterface
{
	protected $detail;

	function __construct(ProductDetail $detail)
	{
		parent::__construct($detail);
		$this->detail = $detail;
	}

    public function pagination(){
        return $this->detail->paginate(5);
    }

}




