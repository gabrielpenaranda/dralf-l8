<?php

use App\Correlativo;
use Illuminate\Database\Seeder;

class CorrelativosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Correlativo::create(['documento' => 'FACTURA', 'correlativo' => 974]);
        Correlativo::create(['documento' => 'NOTAENTREGA', 'correlativo' => 199]);
        Correlativo::create(['documento' => 'NOTACREDITO', 'correlativo' => 0]);
        Correlativo::create(['documento' => 'NOTADEBITO', 'correlativo' => 0]);
        Correlativo::create(['documento' => 'PAGO', 'correlativo' => 0]);
        Correlativo::create(['documento' => 'COBRO', 'correlativo' => 0]);
        Correlativo::create(['documento' => 'NOTARECEPCION', 'correlativo' => 0]);
        Correlativo::create(['documento' => 'ENTREGA', 'correlativo' => 0]);
    }
}
