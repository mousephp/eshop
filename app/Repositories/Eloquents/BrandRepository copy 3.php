<?php 

namespace App\Repositories\Eloquents;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Repositories\Contracts\BrandRepositoryInterface;
use App\Models\Brand;
use Illuminate\Support\Facades\DB;

class BrandRepository extends EloquentRepository implements BrandRepositoryInterface
{
	protected $brand;

	function __construct(Brand $brand)
	{
		parent::__construct($brand);
		$this->brand = $brand;
	}

    public function pagination(){
        return $this->brand->paginate(5);
        //10 và chia nhỏ là 5.
        //return $brands = DB::table('product_type')->paginate(10)->onEachSide(2);
    }

}




