<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductRejectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_rejects', function (Blueprint $table) {
            $table->id();
            $table->float("price")->nullable();
            $table->text("note")->nullable();
            $table->integer('total')->default(0);
            $table->enum('status',['active','inactive'])->default('inactive');
        
            $table->unsignedBigInteger('prod_id')->nullable();
            $table->foreign('prod_id')->references('id')->on('products')->onDelete('SET NULL');
        
            $table->unsignedBigInteger('prod_detail_id')->nullable();
            $table->foreign('prod_detail_id')->references('id')->on('product_details')->onDelete('SET NULL');
        
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
        Schema::dropIfExists('product_rejects');
    }
}
