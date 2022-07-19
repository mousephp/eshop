<?php 

namespace App\Repositories\Contracts;

use App\Repositories\Contracts\RepositoryInterface;

interface WishlistRepositoryInterface extends RepositoryInterface
{
    public function pagination();

}


