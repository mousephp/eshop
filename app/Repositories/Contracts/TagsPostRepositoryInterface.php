<?php 

namespace App\Repositories\Contracts;

use App\Repositories\Contracts\RepositoryInterface;

interface TagsPostRepositoryInterface extends RepositoryInterface
{
    public function pagination();

}


