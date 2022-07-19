<?php 

namespace App\Repositories\Eloquents;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Repositories\Contracts\{ FrontendRepositoryInterface, CateRepositoryInterface, TagsRepositoryInterface, ProductRepositoryInterface };
use App\Repositories\Contracts\{ UserRepositoryInterface, CommentRepositoryInterface, BannerRepositoryInterface };
use App\Models\{ Tag, Category, Comment, Product, Banner };
use App\User;
use Illuminate\Support\Facades\DB;

class FrontendRepository implements FrontendRepositoryInterface
{
	protected $cate;
	protected $tag;
	protected $product;
	protected $comment;
	protected $banner;
	protected $prodType;

	function __construct(Product $product, Comment $comment, Category $cate, Tag $tag, Banner $banner)
	{
		$this->cate     = $cate;
		$this->tag      = $tag;
		$this->product  = $product;
		$this->comment  = $comment;
		$this->banner   = $banner;
	}
}




