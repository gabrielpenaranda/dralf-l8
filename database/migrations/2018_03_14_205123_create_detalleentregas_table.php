<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetalleEntregasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalleentregas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('cantidad');
            $table->bigInteger('entregas_id')->unsigned();
            $table->bigInteger('detallefacturas_id')->unsigned();

            $table->foreign('entregas_id')->references('id')->on('entregas')->onDelete('cascade')->onDelete('restrict');
            $table->foreign('detallefacturas_id')->references('id')->on('detallefacturas')->onUpdate('cascade')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detalleentregas');
    }
}
