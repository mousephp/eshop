<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\{ Product, ProductDetail };

class ProductReject extends Model
{
	use SoftDeletes;

 	protected $table = 'product_rejects';
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'price', 'note', 'total', 'status', 'product_detail_id', 'prod_id',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    public function productDetail()
    {
        return $this->belongsTo(ProductDetail::class, 'product_detail_id', 'id');
    }
    
}
