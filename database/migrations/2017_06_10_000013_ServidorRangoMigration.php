<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ServidorRangoMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('servidor_rango', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('servidor_id')->unsigned();
            $table->integer('rango_id')->unsigned();
            $table->foreign('servidor_id')->references('id')->on('servidores');
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
        Schema::drop('ip-servidor_rango');
    }
}
