<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PuertoMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('puertos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('vlan_id')->unsigned();
            $table->foreign('vlan_id')->references('id')->on('vlans');
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
        Schema::drop('puertos');
    }
}
