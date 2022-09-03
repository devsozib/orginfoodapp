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
        Schema::create('productions', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('raw_product_id')->unsigned();
            $table->foreign('raw_product_id')->references('id')->on('raw_products');
            $table->bigInteger('branch_id')->unsigned();
            $table->foreign('branch_id')->references('id')->on('branches');
            $table->bigInteger('raw_materials_id')->unsigned();
            $table->foreign('raw_materials_id')->references('materials_item_id')->on('materials_stocks');
            $table->integer('production_qty');
            $table->integer('raw_materials_qty');
            $table->date('date');
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
