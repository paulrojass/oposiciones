<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $administrador = Role::create(['name' => 'administrator']);

        $usuario = Role::create(['name' => 'user']);
        
        //Creamos el permiso crear_usuarios
        Permission::create(['name' => 'crear_usuarios']);


/*		DB::table('roles')->insert([
			'id'	=>	1,
            'name' => 'administrator',
            'guard_name' => 'web'
        ]);

        DB::table('roles')->insert([
            'id'    => 2,
            'name'  => 'operator',
            'guard_name' => 'web'
        ]);

        DB::table('roles')->insert([
        	'id'	=>	3,
            'name' => 'user',
            'guard_name' => 'web'
        ]);*/

    }
}
