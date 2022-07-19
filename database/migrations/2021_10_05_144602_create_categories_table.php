<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('summary')->nullable();
            $table->string('photo')->nullable();
            // $table->boolean('is_parent')->default(1);
            $table->enum('status',['active','inactive'])->default('inactive');

            $table->unsignedBigInteger('parent_id')->default(0)->nullable();
            $table->foreign('parent_id')->references('id')->on('categories')->onDelete('SET NULL');

            $table->unsignedBigInteger('added_by')->nullable();
            $table->foreign('added_by')->references('id')->on('users')->onDelete('SET NULL');

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
        Schema::dropIfExists('categories');
    }
}
