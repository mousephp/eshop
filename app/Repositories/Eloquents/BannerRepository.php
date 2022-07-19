<?php

namespace App\Repositories\Eloquents;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Repositories\Contracts\BannerRepositoryInterface;
use App\Models\Banner;
use Illuminate\Support\Facades\DB;

class BannerRepository extends EloquentRepository implements BannerRepositoryInterface
{
    protected $banner;

    public function __construct(Banner $banner)
    {
        $this->banner = $banner;
        parent::__construct($banner);
    }

    public function pagination(){
        return $this->banner->paginate(5);
    }

}

