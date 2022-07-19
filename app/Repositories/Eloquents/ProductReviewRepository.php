<?php

namespace App\Repositories\Eloquents;

use App\Models\ProductReview;
use App\Repositories\Contracts\ProductReviewRepositoryInterface;

class ProductReviewRepository extends EloquentRepository implements ProductReviewRepositoryInterface
{
    protected $productReview;

    public function __construct(ProductReview $productReview)
    {
        $this->productReview = $productReview;
        parent::__construct($productReview);
    }


}
