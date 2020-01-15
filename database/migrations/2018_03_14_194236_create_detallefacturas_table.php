<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetalleFacturasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detallefacturas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('cantidad');
            $table->integer('resto');
            $table->bigInteger('facturas_id')->unsigned();
            $table->bigInteger('lotes_id')->unsigned();

            $table->foreign('facturas_id')->references('id')->on('facturas')->onDelete('cascade')->onUpdate('cascade')->onDelete('restrict');
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
        Schema::dropIfExists('detallefacturas');
    }
}
