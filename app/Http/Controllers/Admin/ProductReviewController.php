<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Contracts\ProductReviewRepositoryInterface;
use Illuminate\Support\Str;
use App\Models\{ Product, ProductReview };
use App\User;
use Auth;
use Log;

class ProductReviewController extends Controller
{
    protected $review;

    public function __construct(ProductReviewRepositoryInterface $review)
    {
        $this->review = $review;
    }

    public function index()
    {
        $reviews = $this->review->all();

        return view('backend.shop.review.index', compact('reviews'));
    }

    public function destroy($id)
    {   
        try {
            $this->review->delete($id);

            return redirect()->route('product-review.index')->with('success', 'Xóa review thành công');
        } catch (\Exception $e) {
            Log::error('error(loi):'.$e->getMessage().$e->getLine());
        }
    }
}
