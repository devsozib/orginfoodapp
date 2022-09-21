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
        Schema::create('raw_product_sales', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('raw_product_id')->unsigned();
            $table->foreign('raw_product_id')->references('id')->on('raw_products');
            $table->bigInteger('consumer_id')->unsigned();
            $table->foreign('consumer_id')->references('id')->on('consumers');
            $table->bigInteger('branch_id')->unsigned();
            $table->foreign('branch_id')->references('id')->on('branches');
            $table->integer('qty');
            $table->float('total_amount');
            $table->date('date');
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
        Schema::dropIfExists('raw_product_sales');
    }
};
