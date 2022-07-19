<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *client_id
     * customer_id
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_number')->unique();
            $table->float('sub_total');
            $table->float('coupon')->nullable();
            $table->float('total_amount');
            $table->integer('quantity');
            $table->enum('payment_method',['cod','paypal'])->default('cod');
            $table->enum('payment_status',['paid','unpaid'])->default('unpaid');
            // $table->enum('status',['new','process','delivered','cancel'])->default('new');

            $table->string('full_name');
            $table->string('email');
            $table->string('phone');
            $table->text('address');

            $table->enum('order_status',['new','process','delivered','cancel'])->default('new');
            $table->double('product_feeship')->default(20000);
            $table->text('notes')->nullable();

            $table->unsignedBigInteger('province_id')->nullable();            
            $table->foreign('province_id')->references('id')->on('provinces')->onDelete('SET NULL');
            $table->unsignedBigInteger('district_id')->nullable();            
            $table->foreign('district_id')->references('id')->on('districts')->onDelete('SET NULL');
            $table->unsignedBigInteger('ward_id')->nullable();            
            $table->foreign('ward_id')->references('id')->on('wards')->onDelete('SET NULL');

            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('SET NULL');

            $table->unsignedBigInteger('shipping_id')->nullable();            
            $table->foreign('shipping_id')->references('id')->on('shippings')->onDelete('SET NULL');

            $table->timestamps();
            $table->softDeletes();          
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
