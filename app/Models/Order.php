<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\{ District, OrderItem, Product, Province, Client };
use Auth;

class Order extends Model
{
	use SoftDeletes;

 	protected $table = 'orders';
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'client_id', 'order_number', 'sub_total', 'quantity', 'order_status','total_amount', 'post_code', 'full_name', 'phone', 'email', 'address','payment_method', 'payment_status', 'coupon', 'product_feeship','province_id', 'district_id', 'ward_id'  //, 'notes',
    ];

    public function member()
    {
        return $this->belongsTo(Client::class);
    }

    public function orderItem()
    {
        return $this->hasMany(OrderItem::class, "order_id");
    }

    public function province()
    {
        return $this->belongsTo(Province::class);
    }

    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function ward()
    {
        return $this->belongsTo(Ward::class);
    }

    public function user_info(){
        return $this->hasOne(Client::class, 'id', 'client_id');
    }

    public static function getAllUserOrders(){
        $count = Order::where('client_id', Auth::guard('client')->user()->id)->with('user_info')->count();
      
        if($count){
            return $count;
        }
        
        return 0;
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_items', 'order_id', 'prod_id')->withPivot(['quantity', 'price']);
    }
}
