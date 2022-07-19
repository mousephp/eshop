<?php

namespace App\Repositories\Eloquents;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Repositories\Contracts\CateRepositoryInterface;
use Illuminate\Support\Facades\DB;

//abstract không hoạt động với __construct có tham số truyền vào 
class CateRepository extends EloquentRepository implements CateRepositoryInterface
{
    protected $cate;

    public function __construct(Category $cate)
    {
        $this->cate = $cate;
        parent::__construct($cate);
    }

    public function pagination(){
        return $this->cate->paginate(5);
    }

    public function deleteMultiple($attributes){      
        $result = $this->find($attributes);
        if ($result) {
            foreach ($attributes as $id) {
                $this->cate->where("id",$id)->delete(); 
            }
            return true;
        }
        return false;       
    }

}



