<?php

use Illuminate\Database\Seeder;
use App\Estado;

class EstadosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Estado::create(['nombre' => 'LARA']);
        Estado::create(['nombre' => 'YARACUY']);
        Estado::create(['nombre' => 'PORTUGUESA']);
        Estado::create(['nombre' => 'ARAGUA']);
        Estado::create(['nombre' => 'CARABOBO']);
        Estado::create(['nombre' => 'ZULIA']);
        Estado::create(['nombre' => 'TRUJILLO']);
        Estado::create(['nombre' => 'BARINAS']);
        Estado::create(['nombre' => 'SUCRE']);
        Estado::create(['nombre' => 'ANZOATEGUI']);
        Estado::create(['nombre' => 'DISTRITO CAPITAL']);
    }
}
