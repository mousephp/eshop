<?php

namespace App\Http\Controllers\Warehouse;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use DB;

class WarehouseController extends Controller
{
    public function index()
    {
		$topSale = $this->topSaleProduct();
		
	    return view('backend.warehouse.index', compact('topSale'));
    }

    public function topSaleProduct()
    {
		return Order::with('products')->get()->sortBy(function($order) {
			return $order->products->count();
		})->take(15);
    }
}
