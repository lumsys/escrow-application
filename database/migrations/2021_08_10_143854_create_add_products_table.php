<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('add_products', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('product_name');
            $table->string('service');
            $table->string('product_category');
            $table->string('description');
            $table->string('quantity');
            $table->string('amount');
            $table->string('buyer_id');
            $table->string('file_path');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('add_products');
    }
}
