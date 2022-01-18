<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ords', function (Blueprint $table) {
            $table->id();
            $table->string('duration')->nullable();
            $table->string('buyer_id')->nullable();
            $table->string('seller_id')->nullable();
            $table->string('buyerName')->nullable();
            $table->string('sellerName')->nullable();
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
        Schema::dropIfExists('ords');
    }
}
