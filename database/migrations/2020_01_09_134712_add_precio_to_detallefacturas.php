<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPrecioToDetallefacturas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('detallefacturas', function (Blueprint $table) {
            $table->decimal('precio', 10,2);
            $table->decimal('costo', 10,2);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('detallefacturas', function (Blueprint $table) {
            $table->dropColumn('precio');
            $table->dropColumn('costo');
        });
    }
}
