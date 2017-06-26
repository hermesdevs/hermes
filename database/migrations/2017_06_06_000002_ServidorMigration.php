<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ServidorMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('servidores', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->ipAddress('ip');
            $table->ipAddress('mac');
            $table->longText('description');
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
        Schema::drop('servidores');
    }
}
