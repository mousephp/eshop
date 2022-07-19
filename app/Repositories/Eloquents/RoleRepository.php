<?php 

namespace App\Repositories\Eloquents;

use App\Repositories\Contracts\RoleRepositoryInterface;
use App\Models\Role;
use Illuminate\Support\Facades\DB;

class roleRepository extends EloquentRepository implements RoleRepositoryInterface
{
	protected $role;

	public function __construct(Role $role)
	{
		$this->role = $role;
		parent::__construct($role);
	}
    
}




