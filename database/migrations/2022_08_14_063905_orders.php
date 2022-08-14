<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('sr_id');
            $table->foreign('sr_id')->references('id')->on('srs');
            $table->bigInteger('branch_is');
            $table->foreign('branch_is')->references('id')->on('branches');
            $table->bigInteger('branch_is');
            $table->foreign('branch_is')->references('id')->on('branches');
            $table->bigInteger('distributor_id');
            $table->foreign('distributor_id')->references('id')->on('distributors');

            $table->bigInteger('product_id');
            $table->foreign('product_id')->references('id')->on('products');
            $table->integer('qty');

            $table->string('status');
            $table->string('date');

            $table->boolean('is_deleted')->default(0);
            $table->rememberToken();
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
        //
    }
};
