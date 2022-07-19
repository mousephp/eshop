<?php 

namespace App\Repositories\Contracts;

use App\Repositories\Contracts\RepositoryInterface;

interface TagsRepositoryInterface extends RepositoryInterface
{
    public function pagination();
    //public function limit();

}


