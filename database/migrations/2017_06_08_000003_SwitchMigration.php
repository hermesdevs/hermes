<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SwitchMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){

        Schema::create('switches', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('modelo');
            $table->string('so');
            $table->ipAddress('ip');
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
        Schema::drop('switches');
    }
}
