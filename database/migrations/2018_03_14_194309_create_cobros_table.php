<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCobrosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cobros', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('fecha');
            $table->string('numero', 30);
            $table->enum('banco', ['Provincial', 'Mercantil', 'Banplus']);
            $table->float('monto', 12, 2);
            $table->bigInteger('facturas_id')->unsigned();

            $table->foreign('facturas_id')->references('id')->on('facturas')->onUpdate('cascade')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cobros');
    }
}
