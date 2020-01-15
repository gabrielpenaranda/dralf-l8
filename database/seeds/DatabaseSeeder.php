<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsuariosTableSeeder::class);
        $this->call(PermissionsTableSeeder::class);
        $this->call(DivisasTableSeeder::class);
        $this->call(EstadosTableSeeder::class);
        $this->call(CiudadesTableSeeder::class);
        $this->call(UnidadMedidasTableSeeder::class);
        $this->call(TipoPersonasTableSeeder::class);
        $this->call(TipoProductosTableSeeder::class);
        $this->call(CorrelativosTableSeeder::class);
    }
}
