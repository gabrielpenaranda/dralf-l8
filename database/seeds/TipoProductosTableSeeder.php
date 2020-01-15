<?php

use Illuminate\Database\Seeder;
use App\TipoProducto;

class TipoProductosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TipoProducto::create(['nombre' => 'ANTICOAGULANTE']);
        TipoProducto::create(['nombre' => 'DILUENTE']);
        TipoProducto::create(['nombre' => 'LISANTE']);
        TipoProducto::create(['nombre' => 'RINSE']);
    }
}
