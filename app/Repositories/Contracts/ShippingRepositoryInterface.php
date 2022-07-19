<?php 

namespace App\Repositories\Contracts;

use App\Repositories\Contracts\RepositoryInterface;

interface ShippingRepositoryInterface extends RepositoryInterface
{
    public function pagination();

}


