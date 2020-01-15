<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTercerosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('terceros', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('rif', 10);
            $table->string('nombre', 80);
            $table->string('razon_social', 100);
            $table->string('direccion', 200);
            $table->string('telefono', 50);
            $table->bigInteger('ciudades_id')->unsigned();
            $table->boolean('cliente');
            $table->boolean('proveedor');
            $table->boolean('laboratorio');
            $table->string('email', 50);

            $table->foreign('ciudades_id')->references('id')->on('ciudades')->onUpdate('cascade')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('terceros');
    }
}
