<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetalleformulasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalleformulas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('materiaprimas_id')->unsigned();
            $table->bigInteger('formulas_id')->unsigned();
            $table->decimal('cantidad', 8, 2);

            $table->foreign('materiaprimas_id')->references('id')->on('materiaprimas')->onDelete('cascade')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('formulas_id')->references('id')->on('formulas')->onDelete('cascade')->onUpdate('cascade')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detalleformulas');
    }
}
