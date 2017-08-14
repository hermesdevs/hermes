<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PuertoSwitcheMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('puerto_switche', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('puerto_id')->unsigned();
            $table->integer('switche_id')->unsigned();
            $table->foreign('puerto_id')->references('id')->on('puertos');
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
        Schema::drop('puerto_switch');
    }
}
