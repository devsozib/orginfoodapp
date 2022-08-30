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
        Schema::create('purchase_materials', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('vendor_id')->unsigned();
            $table->foreign('vendor_id')->references('id')->on('vendors');
            $table->bigInteger('materials_item_id')->unsigned();
            $table->foreign('materials_item_id')->references('id')->on('materials_items');
            $table->integer('qty');
            $table->integer('price');
            $table->date('date');
            $table->boolean('is_deleted')->default(0);
            $table->rememberToken();
            $table->timestamps();

            //->onDelete('cascade')
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
