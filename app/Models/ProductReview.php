<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\User;
use App\Models\{ Client, Product };
use Auth;

class ProductReview extends Model
{
	use SoftDeletes;

 	protected $table = 'product_reviews';
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'client_id', 'prod_id', 'rate', 'review', 'status'
    ];

    public function product(){
        return $this->belongsTo(Product::class,'id');
    }

    public function user_info(){
        return $this->hasOne(Client::class, 'id', 'client_id');
    }

    public static function getAllReview(){//(-)
        return ProductReview::with('user_info')->paginate(10);
    }

    public static function getAllUserReview(){
        $count = ProductReview::where('client_id', Auth::guard('client')->user()->id)->with('user_info')->count();

        if($count){
            return $count;
        }
        
        return 0;
    }

}
