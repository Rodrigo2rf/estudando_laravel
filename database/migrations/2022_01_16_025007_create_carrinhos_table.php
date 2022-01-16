<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarrinhosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carrinhos', function (Blueprint $table) {
            $table->id();
            $table->integer('produto_id');
            $table->integer('feira_id');
            $table->decimal('quantidade', 6, 3);
            $table->decimal('preco', 5, 2);
            $table->decimal('preco_final', 5, 2);
            $table->foreign('produto_id')->references('id')->on('produtos');
            $table->foreign('feira_id')->references('id')->on('feiras');
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
        Schema::dropIfExists('carrinhos');
    }
}
