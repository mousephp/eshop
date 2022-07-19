<?php 

namespace App\Repositories\Eloquents;

use App\Repositories\Contracts\PermissionRepositoryInterface;
use App\Models\Permission;
use Illuminate\Support\Facades\DB;

class PermissionRepository extends EloquentRepository implements PermissionRepositoryInterface
{
	protected $permission;

	public function __construct(Permission $permission)
	{
		$this->permission = $permission;
		parent::__construct($permission);
	}
    
}




