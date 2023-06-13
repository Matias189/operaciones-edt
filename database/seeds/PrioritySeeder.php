<?php

use Illuminate\Database\Seeder;
use App\Priority;

class PrioritySeeder extends Seeder
{
 
    public function run()
    {
        $priority= new Priority();
        $priority->name = 'Alta';
        $priority->save();

        $priority= new Priority();
        $priority->name = 'Media';
        $priority->save();
    }
}
