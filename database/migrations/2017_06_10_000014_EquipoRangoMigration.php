<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EquipoRangoMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('equipo_rango', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('equipo_id')->unsigned();
            $table->integer('rango_id')->unsigned();
            $table->foreign('equipo_id')->references('id')->on('equipos');
            $table->foreign('rango_id')->references('id')->on('rangos');

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
        Schema::drop('ip-equipo_rango');
    }
}
