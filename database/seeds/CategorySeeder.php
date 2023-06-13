<?php

use Illuminate\Database\Seeder;
use App\Category;

class CategorySeeder extends Seeder
{

    public function run()
    {
        $category= new Category();
        $category->name = 'Recoger escombros';
        $category->priority_id = 2;
        $category->save();

        $category= new Category();
        $category->name = 'Rejillas';
        $category->priority_id = 1;
        $category->save();

        $category= new Category();
        $category->name = 'Luminaria';
        $category->priority_id = 1;
        $category->save();

        $category= new Category();
        $category->name = 'Solicitud vehículo';
        $category->priority_id = 1;
        $category->save();

        $category= new Category();
        $category->name = 'Solicitud bus';
        $category->priority_id = 1;
        $category->save();

        $category= new Category();
        $category->name = 'Evento';
        $category->priority_id = 1;
        $category->save();

        $category= new Category();
        $category->name = 'Mantención de camino';
        $category->priority_id = 2;
        $category->save();

        $category= new Category();
        $category->name = 'Reparación dependencias';
        $category->priority_id = 2;
        $category->save();

        $category= new Category();
        $category->name = 'Tránsito';
        $category->priority_id = 2;
        $category->save();

        $category= new Category();
        $category->name = 'Movimiento mobiliario';
        $category->priority_id = 2;
        $category->save();

        $category= new Category();
        $category->name = 'Otros';
        $category->priority_id = 2;
        $category->save();
    }
}
