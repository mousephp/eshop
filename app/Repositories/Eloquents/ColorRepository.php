<?php 

namespace App\Repositories\Eloquents;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Repositories\Contracts\ColorRepositoryInterface;
use App\Models\Color;
use Illuminate\Support\Facades\DB;

class ColorRepository extends EloquentRepository implements ColorRepositoryInterface
{
	protected $color;

	function __construct(Color $color)
	{
		parent::__construct($color);
		$this->color = $color;
	}

    public function pagination(){
        return $this->color->paginate(5);
    }

}




