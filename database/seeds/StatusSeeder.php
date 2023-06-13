<?php

use Illuminate\Database\Seeder;
use App\Status;

class StatusSeeder extends Seeder
{
   
    public function run()
    {
        $status= new Status();
        $status->name = 'Guardado';
        $status->save();

        $status= new Status();
        $status->name = 'Pendiente';
        $status->save();

        $status= new Status();
        $status->name = 'Aprobado';
        $status->save();

        $status= new Status();
        $status->name = 'Rechazado';
        $status->save();

        $status= new Status();
        $status->name = 'Completado';
        $status->save();
    }
}
