<?php

use Illuminate\Database\Seeder;
use App\UnidadMedida;

class UnidadMedidasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        UnidadMedida::create(['unidad' => 'CENTIMETRO CUBICO', 'abreviatura' => 'CC']);
        UnidadMedida::create(['unidad' => 'GALON', 'abreviatura' => 'GL']);
        UnidadMedida::create(['unidad' => 'LITRO', 'abreviatura' => 'LT']);
        UnidadMedida::create(['unidad' => 'KILOGRAMO', 'abreviatura' => 'KG']);
    }
}
