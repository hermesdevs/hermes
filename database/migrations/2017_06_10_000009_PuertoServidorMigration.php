<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PuertoServidorMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('puerto_servidor', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('puerto_id')->unsigned();
            $table->integer('servidor_id')->unsigned();
            $table->foreign('puerto_id')->references('id')->on('puertos');
            $table->foreign('servidor_id')->references('id')->on('servidores');
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
        Schema::drop('puerto_servidor');
    }
}
