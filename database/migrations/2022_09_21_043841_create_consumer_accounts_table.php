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
        Schema::create('consumer_accounts', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('consumer_id')->unsigned();
            $table->foreign('consumer_id')->references('id')->on('consumers');
            $table->bigInteger('branch_id')->unsigned();
            $table->foreign('branch_id')->references('id')->on('branches');
            $table->boolean('status');
            $table->float('amount');
            $table->float('adjustment_balance');
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
        Schema::dropIfExists('consumer_accounts');
    }
};
