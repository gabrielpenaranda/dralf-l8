<?php

use Illuminate\Database\Seeder;
use App\User;

class UsuariosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'GPG',
            'email' => 'gabrielpg77@gmail.com',
            'password' => bcrypt('123456789'),
        ]);
    }
}
