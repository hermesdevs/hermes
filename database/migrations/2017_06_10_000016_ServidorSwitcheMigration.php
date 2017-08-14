<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ServidorSwitcheMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('servidor_switche', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('servidor_id')->unsigned();
            $table->integer('switche_id')->unsigned();
            $table->foreign('servidor_id')->references('id')->on('servidores');
            $table->foreign('switche_id')->references('id')->on('switches');
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
        Schema::drop('servidor_switche');
    }
}
