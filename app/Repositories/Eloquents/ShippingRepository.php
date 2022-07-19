<?php 

namespace App\Repositories\Eloquents;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Repositories\Contracts\ShippingRepositoryInterface;
use App\Models\Shipping;
use Illuminate\Support\Facades\DB;

class ShippingRepository extends EloquentRepository implements ShippingRepositoryInterface
{
	protected $shipping;

	function __construct(Shipping $shipping)
	{
		$this->shipping = $shipping;
		parent::__construct($shipping);
	}

	public function pagination(){
		return $this->shipping->paginate(15);
	}
    
}




