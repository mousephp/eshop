<?php

namespace App\Repositories\Eloquents;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\PostCate;
use App\Repositories\Contracts\CatePostRepositoryInterface;
use Illuminate\Support\Facades\DB;

//abstract không hoạt động với __construct có tham số truyền vào 
class CatePostRepository extends EloquentRepository implements CatePostRepositoryInterface
{
    protected $postCate;

    public function __construct(PostCate $postCate)
    {
        $this->postCate = $postCate;
        parent::__construct($postCate);
    }

    public function pagination(){
        return $this->postCate->paginate(5);
    }


}



