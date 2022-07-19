<?php 

namespace App\Repositories\Eloquents;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Repositories\Contracts\CouponRepositoryInterface;
use App\Models\Coupon;
use Illuminate\Support\Facades\DB;

class CouponRepository extends EloquentRepository implements CouponRepositoryInterface
{
	protected $coupon;

	function __construct(coupon $coupon)
	{
		$this->coupon = $coupon;
		parent::__construct($coupon);
	}

	public function pagination(){
		return $this->coupon->paginate(15);
	}
    
}




