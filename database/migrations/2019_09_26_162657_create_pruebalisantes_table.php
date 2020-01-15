<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePruebaLisantesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pruebalisantes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->float('ph', 5, 2);
            $table->float('conductividad', 5, 2);
            $table->boolean('contaje');
            $table->bigInteger('lotes_id')->unsigned();

            $table->foreign('lotes_id')->references('id')->on('lotes')->onUpdate('cascade')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pruebalisantes');
    }
}
