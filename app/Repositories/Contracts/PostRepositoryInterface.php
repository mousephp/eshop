<?php 

namespace App\Repositories\Contracts;

use App\Repositories\Contracts\RepositoryInterface;

interface PostRepositoryInterface extends RepositoryInterface
{
    public function pagination();

}



