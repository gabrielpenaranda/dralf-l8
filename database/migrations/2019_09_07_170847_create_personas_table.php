<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre', 50);
            $table->string('apellido', 50);
            $table->string('cargo', 30);
            $table->string('telefono', 50);
            $table->string('email', 50);
            $table->bigInteger('tipopersonas_id')->unsigned();
            $table->bigInteger('terceros_id')->unsigned();

            $table->foreign('terceros_id')->references('id')->on('terceros')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('tipopersonas_id')->references('id')->on('tipopersonas')->onUpdate('cascade')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('personas');
    }
}
