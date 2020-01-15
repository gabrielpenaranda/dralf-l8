<?php

use Illuminate\Database\Seeder;
use App\Divisa;

class DivisasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Divisa::create(['nombre' => 'DOLAR USA', 'abreviatura' => 'USD', 'cambio' => 85000.00]);
    }
}
