<?php

namespace App\Repositories\Eloquents;

use App\Models\ProductImage;
use App\Repositories\Contracts\ProductImageRepositoryInterface;

class ProductImageRepository extends EloquentRepository implements ProductImageRepositoryInterface
{
    protected $productImage;

    public function __construct(ProductImage $productImage)
    {
        $this->productImage = $productImage;
        parent::__construct($productImage);
    }

    public function findByForeignKey($id)
    {
		  return $this->productImage->where('prod_id',$id)->get();
    }

}
