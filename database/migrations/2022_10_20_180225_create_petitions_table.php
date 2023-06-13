<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePetitionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('petitions', function (Blueprint $table) {
            $table->id();
            $table->string('name',50)->nullable();
            $table->string('email',50)->nullable();
            $table->string('phone',20)->nullable();

            $table->foreignId('category_id')
                ->constrained('categories');

            $table->string('description',255)->nullable();
            $table->dateTime('date')->nullable();
            $table->string('scheduledate',30)->nullable();
            $table->string('time',30)->nullable();
            $table->string('fixedlocation',150)->nullable();
            $table->string('startinglocation',150)->nullable();
            $table->string('endlocation',150)->nullable();

            $table->string('latitude',100)->nullable();
            $table->string('longitude',100)->nullable();

            $table->string('file',100)->nullable();
            $table->string('rejectionreason',255)->nullable();

            $table->string('executiondate',30)->nullable();
            $table->string('resolution',255)->nullable();
            $table->string('evidence',100)->nullable();

            $table->string('note',50)->nullable();


            $table->foreignId('status_id')
                ->nullable()
                ->constrained('statuses');

            $table->foreignId('user_id')
                ->nullable()
                ->constrained('users');
            
            $table->foreignId('department_id')
                ->nullable()
                ->constrained('departments');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('petitions');
    }
}
