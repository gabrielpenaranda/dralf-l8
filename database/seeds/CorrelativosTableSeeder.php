<?php

use Illuminate\Database\Seeder;
use App\Correlativo;

class CorrelativosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Correlativo::create(['documento' => 'FACTURA', 'correlativo' => 0]);
        Correlativo::create(['documento' => 'NOTAENTREGA', 'correlativo' => 0]);
        Correlativo::create(['documento' => 'NOTACREDITO', 'correlativo' => 0]);
        Correlativo::create(['documento' => 'NOTADEBITO', 'correlativo' => 0]);
        Correlativo::create(['documento' => 'PAGO', 'correlativo' => 0]);
        Correlativo::create(['documento' => 'COBRO', 'correlativo' => 0]);
        Correlativo::create(['documento' => 'NOTARECEPCION', 'correlativo' => 0]);
    }
}
