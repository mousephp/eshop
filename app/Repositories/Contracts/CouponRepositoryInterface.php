<?php 

namespace App\Repositories\Contracts;

use App\Repositories\Contracts\RepositoryInterface;

interface CouponRepositoryInterface extends RepositoryInterface
{
    public function pagination();

}


