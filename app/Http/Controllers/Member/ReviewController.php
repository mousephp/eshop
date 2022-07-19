<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{ Client, ProductReview };
use Auth;

class ReviewController extends Controller
{
    protected $review;

    public function __construct(ProductReview $review)
    {
        $this->review = $review;
    }

    public function index(){
        $reviews = $this->review->where('client_id',Auth::guard('client')->user()->id)->with('user_info')->paginate(10);

        return view('user.review.index')->with('reviews',$reviews);
    }

    public function edit($id){
        $review = $this->review->findOrFail($id);

        if($review){
            return view('user.review.edit')->with('review',$review);
        }
        
        return redirect()->back()->with('error','Review not found');
    }

    public function update(Request $request, $id){
        $review = $this->review->findOrFail($id);

        $data   = $request->all();
        
        if($review){            
            $status = $review->fill($data)->update();

            if($status){
                return redirect()->back()->with('success','Sửa Review thành công');
            }

            return redirect()->back()->with('erorr','Sửa Review thất bại');
        }
        
        return redirect()->back()->with('erorr','Review Not Found');
    }

    public function destroy($id){
        $review = $this->review->findOrFail($id);

        if($review){
            $status = $review->delete($id);

            if($status){
                return redirect()->back()->with('success','Xóa review thành công');
            }
            
            return redirect()->back()->with('erorr','Xóa review thất bại');
        }
        
        return redirect()->back()->with('erorr','review Not Found');
    }

    public function remove(){

    }

}
