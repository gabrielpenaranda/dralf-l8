<?php

use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\User;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // ***********************************************
        // Usuarios
        Permission::create(['name' => 'usuarios.index']);
        Permission::create(['name' => 'usuarios.edit']);
        Permission::create(['name' => 'usuarios.destroy']);
        Permission::create(['name' => 'usuarios.show']);

        // Roles
        Permission::create(['name' => 'roles.index']);
        Permission::create(['name' => 'roles.create']);
        Permission::create(['name' => 'roles.edit']);
        Permission::create(['name' => 'roles.destroy']);
        Permission::create(['name' => 'roles.show']);

        // ***********************************************

        // Ciudades
        Permission::create(['name' => 'ciudades.index']);
        Permission::create(['name' => 'ciudades.create']);
        Permission::create(['name' => 'ciudades.edit']);
        Permission::create(['name' => 'ciudades.destroy']);
        Permission::create(['name' => 'ciudades.show']);

        // Estados
        Permission::create(['name' => 'estados.index']);
        Permission::create(['name' => 'estados.create']);
        Permission::create(['name' => 'estados.edit']);
        Permission::create(['name' => 'estados.destroy']);
        Permission::create(['name' => 'estados.show']);

        // TipoPersonas
        Permission::create(['name' => 'tipopersonas.index']);
        Permission::create(['name' => 'tipopersonas.create']);
        Permission::create(['name' => 'tipopersonas.edit']);
        Permission::create(['name' => 'tipopersonas.destroy']);
        Permission::create(['name' => 'tipopersonas.show']);

        // TipoProductos
        Permission::create(['name' => 'tipoproductos.index']);
        Permission::create(['name' => 'tipoproductos.create']);
        Permission::create(['name' => 'tipoproductos.edit']);
        Permission::create(['name' => 'tipoproductos.destroy']);
        Permission::create(['name' => 'tipoproductos.show']);

        //UnidadMedidas
        Permission::create(['name' => 'unidadmedidas.index']);
        Permission::create(['name' => 'unidadmedidas.create']);
        Permission::create(['name' => 'unidadmedidas.edit']);
        Permission::create(['name' => 'unidadmedidas.destroy']);
        Permission::create(['name' => 'unidadmedidas.show']);

        //Admin
        $admin = Role::create(['name' => 'Admin']);

        $admin->givePermissionTo([
            'usuarios.index',
            'usuarios.edit',
            'usuarios.show',
            'usuarios.destroy',
            'roles.index',
            'roles.edit',
            'roles.show',
            'roles.create',
            'roles.destroy',
            'ciudades.index',
            'ciudades.edit',
            'ciudades.show',
            'ciudades.create',
            'ciudades.destroy',
            'estados.index',
            'estados.edit',
            'estados.show',
            'estados.create',
            'estados.destroy',
            'tipopersonas.index',
            'tipopersonas.edit',
            'tipopersonas.show',
            'tipopersonas.create',
            'tipopersonas.destroy',
            'tipoproductos.index',
            'tipoproductos.edit',
            'tipoproductos.show',
            'tipoproductos.create',
            'tipoproductos.destroy',
            'unidadmedidas.index',
            'unidadmedidas.edit',
            'unidadmedidas.show',
            'unidadmedidas.create',
            'unidadmedidas.destroy',
        ]);

        //Admin
        $operador = Role::create(['name' => 'Operador']);

        $operador->givePermissionTo([
            'ciudades.index',
            'ciudades.edit',
            'ciudades.show',
            'ciudades.create',
            'estados.index',
            'estados.edit',
            'estados.show',
            'estados.create',
            'tipopersonas.index',
            'tipopersonas.edit',
            'tipopersonas.show',
            'tipopersonas.create',
            'tipoproductos.index',
            'tipoproductos.edit',
            'tipoproductos.show',
            'tipoproductos.create',
            'unidadmedidas.index',
            'unidadmedidas.edit',
            'unidadmedidas.show',
            'unidadmedidas.create',
        ]);
            

        $user = User::find(1);
        $user->assignRole('Admin');

        $user = User::find(2);
        $user->assignRole('Admin');

        $user = User::find(3);
        $user->assignRole('Admin');
    }
}
