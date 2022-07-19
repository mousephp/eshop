<?php 

namespace App\Repositories\Eloquents;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Repositories\Contracts\SettingRepositoryInterface;
use App\Models\Setting;
use Illuminate\Support\Facades\DB;

class SettingRepository extends EloquentRepository implements SettingRepositoryInterface
{
	protected $setting;

	function __construct(Setting $setting)
	{
		$this->setting = $setting;
		parent::__construct($setting);
	}

	public function pagination(){
		return $this->setting->paginate(15);
	}
    
}




