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
        Schema::create('distributors', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('sr_id')->unsigned();
            $table->foreign('sr_id')->references('id')->on('srs');
            $table->string('name');
            $table->string('address');
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
