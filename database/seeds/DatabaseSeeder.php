<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    
    public function run()
    {
        $this->call(StatusSeeder::class);
        $this->call(PrioritySeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(DepartmentSeeder::class);

        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
    }
}
