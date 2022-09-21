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
        Schema::create('materials_stocks', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('materials_item_id')->unsigned();
            $table->foreign('materials_item_id')->references('id')->on('materials_items');
            $table->bigInteger('branch_id')->unsigned();
            $table->foreign('branch_id')->references('id')->on('branches');
            $table->integer('qty');
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
        Schema::dropIfExists('materials_stocks');
    }
};
