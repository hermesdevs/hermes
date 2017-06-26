<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RangoSwitcheMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rango_switche', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('rango_id')->unsigned();
            $table->integer('switche_id')->unsigned();
            $table->foreign('rango_id')->references('id')->on('rangos');
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
        Schema::drop('ip-switch_rango');
    }
}
