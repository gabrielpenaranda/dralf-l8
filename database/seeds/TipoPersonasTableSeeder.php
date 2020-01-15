<?php

use Illuminate\Database\Seeder;
use App\TipoPersona;

class TipoPersonasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TipoPersona::create(['nombre' => 'ENCARGADO(A)']);
        TipoPersona::create(['nombre' => 'GERENTE']);
        TipoPersona::create(['nombre' => 'SUPERVISOR(A)']);
        TipoPersona::create(['nombre' => 'ASISTENTE']);
    }
}
