<?php

namespace App\Repositories\Eloquents;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\User;
use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Support\Facades\DB;

class UserRepository extends EloquentRepository implements UserRepositoryInterface
{
	protected $user;

	public function __construct(User $user){
		parent::__construct($user);
		
		$this->user = $user;
	}

    public function pagination(){
        return $this->user->paginate(5);
    }

	public function updateId($id, $attributes){
		$result = $this->find($id);

		if($result){
			$result->update($attributes);

			return $result;
		}

		return false;
	}

}