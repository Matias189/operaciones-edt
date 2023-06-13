<?php

use Illuminate\Database\Seeder;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Matias Chadicadi',
            'email' => 'matias@ptovaras.cl',
            'password' => bcrypt('matias123'),
            'department_id' => 33
        ])->assignRole('Admin');

        User::create([
            'name' => 'Ignacio Delgado',
            'email' => 'ignacio@ptovaras.cl',
            'password' => bcrypt('prueba123'),
            'department_id' => 23
        ])->assignRole('User');
        
    }
}
