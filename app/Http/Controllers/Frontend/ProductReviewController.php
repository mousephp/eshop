<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Notification;
use App\Notifications\StatusNotification;
use App\User;
use App\Models\{ ProductReview, Product };
use Auth;

class ProductReviewController extends Controller
{
    protected $review;
    protected $product;

    public function __construct(Product $product, ProductReview $review)
    {
        $this->review  = $review;
        $this->product = $product;
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'rate'   => 'required|numeric|min:1',
            'review' => 'required'
        ]);

        $data               = $request->all();

        $data['prod_id']    = $product_info->id;

        $data['client_id']  = Auth::guard('client')->user()->id;

        $data['status']     = 'active';

        $status = $this->review->create($data);

        // $product_info       = $this->product->getProductBySlug($request->slug);
        // $details = [
        //     'title'     => 'New Product Rating!',
        //     'actionURL' => route('product-detail',$product_info->slug),
        //     'fas'       => 'fa-star'
        // ];

        // Notification::send($user,new StatusNotification($details));
        if($status){
            return redirect()->back()->with('success', 'Thank you for your feedback');
        }
        
        return redirect()->back()->with('error', 'Something went wrong! Please try again!!');
    }

}
