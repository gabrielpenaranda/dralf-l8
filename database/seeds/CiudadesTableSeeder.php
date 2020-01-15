<?php

use Illuminate\Database\Seeder;
use App\Ciudad;

class CiudadesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Ciudad::create(['nombre' => 'BARQUISIMETO', 'estados_id' => 1]);
        Ciudad::create(['nombre' => 'CABUDARE', 'estados_id' => 1]);
        Ciudad::create(['nombre' => 'SAN FELIPE', 'estados_id' => 2]);
        Ciudad::create(['nombre' => 'YARITAGUA', 'estados_id' => 2]);
        Ciudad::create(['nombre' => 'ACARIGUA', 'estados_id' => 3]);
        Ciudad::create(['nombre' => 'ARAURE', 'estados_id' => 3]);
    }
}
