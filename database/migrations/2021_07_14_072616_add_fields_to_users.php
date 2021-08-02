<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            //
            //$table->id();
            $table->string('first_name');
            $table->string('other_name');
            $table->string('last_name');
            $table->string('state');
            $table->string('local_government');
            $table->string('address');
            $table->string('phone');
            $table->string('usertype');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
            $table->dropColumn([
                'first_name',
                'other_name',
                'last_name',
                'state',
                'local_government',
                'address',
                'phone',
                'usertype'
            ]);
        });
    }
}
