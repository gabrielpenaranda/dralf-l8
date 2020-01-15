<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMateriaPrimasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('materiaprimas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('codigo', 20);
            $table->string('nombre', 80);
            $table->decimal('cantidad_disponible', 10, 2);
            $table->boolean('fraccionable');
            $table->bigInteger('unidadmedidas_id')->unsigned();

            $table->foreign('unidadmedidas_id')->references('id')->on('unidadmedidas')->onUpdate('cascade')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('materiaprimas');
    }
}
