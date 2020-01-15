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
    }
}
