<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EquipoPuertoMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('equipo_puerto', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('puerto_id')->unsigned();
            $table->integer('equipo_id')->unsigned();
            $table->foreign('puerto_id')->references('id')->on('puertos');
            $table->foreign('equipo_id')->references('id')->on('equipos');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('equipo_puerto');
    }
}
