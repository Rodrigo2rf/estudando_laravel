<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeirasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('feiras', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('supermercado_id');
            $table->timestamp('data');

            // define a chava estrangeira
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('supermercado_id')->references('id')->on('supermercados');
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
        Schema::dropIfExists('feiras');
    }
}
