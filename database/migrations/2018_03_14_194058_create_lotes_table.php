<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::create('lotes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('fecha_produccion');
            $table->date('fecha_vencimiento');
            $table->integer('cantidad_producida');
            $table->integer('cantidad_prueba');
            $table->string('numero', 12);
            $table->integer('cantidad_disponible');
            $table->string('prueba', 30);
            $table->bigInteger('productos_id')->unsigned();

            $table->foreign('productos_id')->references('id')->on('productos')->onUpdate('cascade')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lotes');
    }
}
