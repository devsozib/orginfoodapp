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
        Schema::create('branches', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
            $table->string('name');
            $table->string('type');
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
