<?php 

namespace App\Repositories\Eloquents;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Repositories\Contracts\ProductRepositoryInterface;
use App\Models\Product;
use App\User;
use App\Models\Brand;
use App\Models\Tag;
use App\Models\Category;
use App\Models\ProductImage;
use Illuminate\Support\Facades\DB;

class ProductRepository extends EloquentRepository implements ProductRepositoryInterface
{
	protected $user;
    protected $cate;
    protected $brand;
    protected $tag;
    protected $productImage;
    protected $product;

	function __construct(User $user, Category $cate, Brand $brand, Tag $tag, ProductImage $productImage, Product $product)
	{
		$this->user         = $user;
        $this->cate         = $cate;
        $this->brand        = $brand;
        $this->tag          = $tag;
        $this->product      = $product;
        $this->productImage = $productImage;
		parent::__construct($product);
	}

	public function pagination(){
        return $this->product->paginate(20);
    }

	
}




