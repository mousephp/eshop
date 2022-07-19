<?php 

namespace App\Repositories\Eloquents;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Repositories\Contracts\SizeRepositoryInterface;
use App\Models\Size;
use Illuminate\Support\Facades\DB;

class SizeRepository extends EloquentRepository implements SizeRepositoryInterface
{
	protected $size;

	function __construct(Size $size)
	{
		parent::__construct($size);
		$this->size = $size;
	}

    public function pagination(){
        return $this->size->paginate(5);
    }

}




