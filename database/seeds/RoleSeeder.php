<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    
    public function run()
    {
        $role1 = Role::create(['name' => 'Admin']);
        $role2 = Role::create(['name' => 'User']);

        //Permission::create(['name' => 'home.index'])->assignRole($role1);

        Permission::create(['name' => 'user.panel1'])->assignRole($role1);

        Permission::create(['name' => 'departamento.sendForm'])->assignRole($role2);
        Permission::create(['name' => 'operaciones.resolution'])->assignRole($role1);
        Permission::create(['name' => 'operaciones.approve'])->assignRole($role1);

        Permission::create(['name' => 'operaciones'])->assignRole($role1);
        Permission::create(['name' => 'departamento'])->assignRole($role2);
    }
}
